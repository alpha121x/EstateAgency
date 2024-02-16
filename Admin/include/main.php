<?php require('db_config.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card viewers-card">

              <?php
              require('db_config.php');

              date_default_timezone_set('Asia/Karachi');

              // Fetch the website viewer count from the visited_count table
              $currentDate = date('Y-m-d');
              $websiteViewerCount = DB::queryFirstField("SELECT IFNULL(SUM(visit_count), 0) FROM visited_count WHERE visit_datetime >= %s AND visit_datetime < %s", $currentDate . ' 00:00:00', $currentDate . ' 23:59:59');

              ?>

              <div class="card-body">
                <h5 class="card-title">Website Viewers <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-eye"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $websiteViewerCount; ?></h6>
                    <!-- <span class="text-success small pt-1 fw-bold">15%</span> -->
                    <!-- <span class="text-muted small pt-2 ps-1">increase</span> -->
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Website Viewers Card -->


          <div class="col-xxl-4 col-md-6">
            <div class="card info-card bids-card">



              <?php
              include('db_config.php');

              date_default_timezone_set('Asia/Karachi');

              $currentDate = date('Y-m-d');
              // Query to get the total number of bids for this month
              $totalBids = DB::queryFirstField("SELECT COUNT(*) FROM plot_bidding WHERE DATE(bid_date) = %s", $currentDate);

              // Display the total bids count
              ?>
              <div class="card-body">
                <h5 class="card-title">Total Bids <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gift"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $totalBids; ?></h6>
                    <!-- You can calculate percentage increase if needed -->
                    <!-- <span class="text-success small pt-1 fw-bold">10%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                  </div>
                </div>
              </div>


            </div>
          </div><!-- End Total Bids Card -->

          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card amounts-card">
              <?php
              include('db_config.php');

              // Query to get the total amount of bids for this day
              $totalAmountLakh = DB::queryFirstField("SELECT FORMAT(SUM(bid), 2) as bid_sum FROM plot_bidding WHERE DATE(bid_date) = %s", $currentDate);
              $totalAmountCrore = convertToCrore($totalAmountLakh, 'Lakh');

              // Display the total bids amount
              ?>
              <div class="card-body">
                <h5 class="card-title">Total Bids Amounts <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rs. <?php echo $totalAmountCrore; ?> Lakh.</h6>
                    <span class="text-muted small pt-1 ps-1">(Converted. : <?php echo $totalAmountLakh; ?> Cr.)</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total Bids Amounts Card -->

          <?php
          function convertToCrore($amount, $unit)
          {
            // Conversion logic based on the unit
            switch ($unit) {
              case 'Lakh':
                return $amount * 100;
              case 'Crore':
                return $amount / 100;
                // Add more cases for other units if needed
              default:
                return $amount;
            }
          }
          ?>



        </div>
        <!-- Chart for daily bids by plot -->
        <canvas id="dailyBidsChart" width="400" height="200"></canvas>
        <?php
        require('db_config.php');

        // Function to get daily bid data for each plot from the database
        function getDailyBidsData()
        {
          try {
            // Fetch daily bid data for each plot
            $query = "SELECT pb.plot_id, pl.plot_num, DAY(pb.bid_date) AS day, FORMAT(SUM(pb.bid), 2) AS total_bid, pb.bid_unit
                  FROM plot_bidding pb
                  JOIN plot_listing pl ON pb.plot_id = pl.plot_id
                  WHERE pb.bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
                  GROUP BY pb.plot_id, DAY(pb.bid_date), pb.bid_unit
                  ORDER BY pb.plot_id, DAY(pb.bid_date);";

            $dailyBidsData = DB::query($query);

            return $dailyBidsData;
          } catch (MeekroDBException $e) {
            die("Error: " . $e->getMessage());
          }
        }

        // Get daily bid data for each plot
        $dailyBidsData = getDailyBidsData();

        // Convert PHP array to JSON
        $jsDailyBidsData = json_encode($dailyBidsData);
        ?>

        <script>
          // Parse the PHP array in JavaScript
          var dailyBidsData = <?php echo $jsDailyBidsData; ?>;

          // Create arrays to store numerical bid amounts for each plot
          var numericalBidsByPlot = {};

          // Convert bid values to lakhs for better readability
          dailyBidsData.forEach(item => {
            var numericalBid = parseFloat(item.total_bid.replace(/[^\d.]/g, ''));

            // Check if the bid is in Cr. and multiply by 100
            if (item.bid_unit === 'Cr.') {
              numericalBid *= 100;
            }

            if (!(item.plot_num in numericalBidsByPlot)) {
              numericalBidsByPlot[item.plot_num] = Array.from({
                length: 31
              }, () => 0); // Assuming 31 days in a month
            }

            numericalBidsByPlot[item.plot_num][parseInt(item.day) - 1] = numericalBid;
          });

          // Get unique plot numbers with data
          var plotNumbersWithData = Object.keys(numericalBidsByPlot);

          // Get the canvas element
          var ctxDailyBids = document.getElementById('dailyBidsChart').getContext('2d');

          // Create the chart
          var dailyBidsChart = new Chart(ctxDailyBids, {
            type: 'bar',
            data: {
              labels: Array.from({
                length: 31
              }, (_, index) => index + 1), // Assuming 31 days in a month
              datasets: plotNumbersWithData.map((plotNum, index) => ({
                label: 'Plot ' + plotNum,
                data: numericalBidsByPlot[plotNum],
                backgroundColor: getRandomColor(index),
                borderColor: getRandomColor(index),
                borderWidth: 1
              }))
            },
            options: {
              scales: {
                x: {
                  type: 'linear',
                  position: 'bottom',
                  title: {
                    display: true,
                    text: 'Days'
                  }
                },
                y: {
                  beginAtZero: false,
                  title: {
                    display: true,
                    text: 'Total Bids'
                  },
                  ticks: {
                    callback: function(value) {
                      return value.toFixed(2) + ' Lakh';
                    }
                  }
                }
              },
              plugins: {
                legend: {
                  display: true,
                  position: 'top',
                  labels: {
                    font: {
                      size: 14
                    }
                  }
                }
              }
            }
          });

          // Function to generate random color
          function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
              color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
          }
        </script>
        <br><br>
        <!-- Chart for total bids last month -->
        <canvas id="bidsChart" width="400" height="200"></canvas>
        <?php
        require('db_config.php');

        // Function to get total bid data for the current month from the database
        function getTotalBidsDataForCurrentMonth()
        {
          try {
            // Fetch total bid data for the current month, including the sum of bids for each day
            $query = "SELECT DAY(bid_date) AS day, 
            SUM(CASE WHEN bid_unit = 'Cr.' THEN bid * 100
                     WHEN bid_unit = 'Lakh' THEN bid
                     ELSE 0 END) AS total_bid
     FROM plot_bidding
     WHERE bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
     GROUP BY DAY(bid_date)
     ORDER BY DAY(bid_date);";

            $totalBidsData = DB::query($query);

            return $totalBidsData;
          } catch (MeekroDBException $e) {
            die("Error: " . $e->getMessage());
          }
        }

        // Get total bid data for the current month
        $totalBidsData = getTotalBidsDataForCurrentMonth();

        // Convert PHP array to JSON
        $jsTotalBidsData = json_encode($totalBidsData);
        // echo $jsTotalBidsData
        ?>

        <script>
          // Parse the PHP array in JavaScript
          var totalBidsData = <?php echo $jsTotalBidsData; ?>;

          // Create arrays to store numerical bid amounts and formatted bid strings
          var numericalTotalBids = [];
          var formattedTotalBids = [];

          // Convert bid values to a uniform format (either in lakh or crore)
          totalBidsData.forEach(item => {
            var bidAmount = item.total_bid;
            var numericalBid = parseFloat(bidAmount.replace(/[^\d.]/g, ''));

            // Check if the bid is in Cr. and convert to lakh
            if (bidAmount.includes('Cr.')) {
              numericalBid *= 100; // Convert Cr. to lakh
            }

            var formattedBid = (numericalBid >= 10000000) ? (numericalBid / 10000000).toFixed(2) + ' Cr.' : (numericalBid / 100000).toFixed(2) + ' Lakh';

            numericalTotalBids.push(numericalBid);
            formattedTotalBids.push(formattedBid);
          });

          // Get the canvas element
          var ctxBids = document.getElementById('bidsChart').getContext('2d');

          // Filter days with data
          var daysWithData = totalBidsData.filter(item => numericalTotalBids.indexOf(parseFloat(item.total_bid.replace(/[^\d.]/g, ''))) !== -1);

          // Create the chart
          var bidsChart = new Chart(ctxBids, {
            type: 'line',
            data: {
              labels: daysWithData.map(item => item.day),
              datasets: [{
                label: 'Total Bids Last Month',
                data: numericalTotalBids,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointRadius: 5,
                fill: false
              }]
            },
            options: {
              scales: {
                x: {
                  type: 'linear',
                  position: 'bottom',
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Days'
                  }
                },
                y: {
                  beginAtZero: false,
                  title: {
                    display: true,
                    text: 'Total Bids (in Lakh)'
                  },
                  ticks: {
                    callback: function(value) {
                      var index = numericalTotalBids.indexOf(value);
                      return (index !== -1) ? formattedTotalBids[index] : value.toFixed(2) + ' Lakh';
                    }
                  }
                }
              },
              plugins: {
                legend: {
                  display: true,
                  position: 'top',
                  labels: {
                    font: {
                      size: 14
                    }
                  }
                }
              }
            }
          });
        </script>
        <br><br>

        <!-- Chart for count of bids last month -->
        <canvas id="bidsCountChart" width="400" height="200"></canvas>
        <?php
        // Function to get count of bids for the current month from the database
        function getBidsCountForCurrentMonth()
        {
          try {
            // Fetch count of bids for the current month
            $query = "SELECT DAY(bid_date) AS day, COUNT(*) AS bid_count
              FROM plot_bidding
              WHERE bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
              GROUP BY DAY(bid_date)
              ORDER BY DAY(bid_date);";

            $bidsCountData = DB::query($query);

            return $bidsCountData;
          } catch (MeekroDBException $e) {
            die("Error: " . $e->getMessage());
          }
        }

        // Get count of bids for the current month
        $bidsCountData = getBidsCountForCurrentMonth();

        // Convert PHP array to JSON
        $jsBidsCountData = json_encode($bidsCountData);
        ?>

        <script>
          // Parse the PHP array for count of bids in JavaScript
          var bidsCountData = <?php echo $jsBidsCountData; ?>;

          // Get the canvas element for count of bids
          var countCtx = document.getElementById('bidsCountChart').getContext('2d');

          // Create the chart for count of bids
          var countChart = new Chart(countCtx, {
            type: 'bar',
            data: {
              labels: bidsCountData.map(item => item.day),
              datasets: [{
                label: 'Bids Count Last Month',
                data: bidsCountData.map(item => item.bid_count),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                x: {
                  position: 'bottom',
                  title: {
                    display: true,
                    text: 'Days'
                  }
                },
                y: {
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Total Bids Count'
                  }
                }
              }
            }
          });
        </script>



        <!-- News & Updates Traffic -->
        <div class="card">


          <?php
          include('db_config.php');

          // Fetch data from the posts table
          $posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC LIMIT 5");

          ?>

          <div class="card-body pb-0">
            <h5 class="card-title">News & Updates| Today <span></span></h5>

            <div class="news">
              <?php foreach ($posts as $post) : ?>
                <div class="post-item clearfix">
                  <img src="<?php echo $post['post_image']; ?>" alt="">
                  <h4><a href="#"><?php echo $post['post_title']; ?></a></h4>
                  <p><?php echo substr($post['post_content'], 0, 100); ?>...</p>
                </div>
              <?php endforeach; ?>
            </div><!-- End sidebar recent posts-->

          </div>

        </div><!-- End News & Updates -->

  </section>

</main><!-- End #main -->