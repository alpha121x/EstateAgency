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

              // Fetch the website viewer count from the visited_count table
              $currentDate = date('Y-m-d');
              $websiteViewerCount = DB::queryFirstField("SELECT SUM(visit_count) FROM visited_count WHERE visit_datetime >= %s AND visit_datetime < %s", $currentDate . ' 00:00:00', $currentDate . ' 23:59:59');

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


              // Query to get the total number of bids for this month
              $totalBids = DB::queryFirstField("SELECT COUNT(*) FROM plot_bidding WHERE DATE(bid_date) = %s", date('Y-m-d'));

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
              $totalAmountLakh = DB::queryFirstField("SELECT FORMAT(SUM(bid), 2) as bid_sum FROM plot_bidding WHERE DATE(bid_date) = CURDATE()");
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
                    <span class="text-muted small pt-1 ps-1">(Converted to Cr. : <?php echo $totalAmountLakh; ?> Cr.)</span>
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

        <!-- Chart for bids last month -->
        <canvas id="bidsChart" width="400" height="200"></canvas>
        <?php
        require('db_config.php');

        // Function to get bid data for the last month from the database
        function getBidsDataForLastMonth()
        {
          try {
            // Fetch bid data for the last month
            $query = "SELECT DAY(bid_date) AS day, SUM(bid) AS total_bid
            FROM plot_bidding
            WHERE bid_date >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01')
            AND bid_date < DATE_FORMAT(NOW(), '%Y-%m-%d')
            GROUP BY DAY(bid_date)
            ORDER BY DAY(bid_date);";

            $bidsData = DB::query($query);

            return $bidsData;
          } catch (MeekroDBException $e) {
            die("Error: " . $e->getMessage());
          }
        }

        // Get bid data for the last month
        $bidsData = getBidsDataForLastMonth();

        // Convert PHP array to JSON
        $jsBidsData = json_encode($bidsData);
        ?>

        <script>
          // Parse the PHP array in JavaScript
          var bidsData = <?php echo $jsBidsData; ?>;

          // Get the canvas element
          var ctx = document.getElementById('bidsChart').getContext('2d');

          // Create the chart
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: bidsData.map(item => item.day),
              datasets: [{
                label: 'Bids Last Month',
                data: bidsData.map(item => item.total_bid),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
              }]
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
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Total Bids'
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