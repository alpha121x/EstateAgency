<!--  write code for shwoing posts in a data table -->
<?php
include('db_config.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bid Report</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

  <?php include("include/header-nav.php") ?>

  <?php include("include/side-nav.php") ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reports</h5>
              <p>Bids Monthly Report</p><br><br>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table table-bordered datatable" style="background-color: white;">
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Total Bids</th>
                      <th scope="col">Bids Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Function to get total bid data for the current month from the database
                    function getTotalBidsDataForCurrentMonth()
                    {
                      try {
                        // Fetch total bid data for the current month, including the sum of bids for each day
                        $query = "SELECT DATE_FORMAT(bid_date, '%Y-%m-%d') AS date,
                        SUM(CASE WHEN bid_unit = 'Cr.' THEN bid * 100
                                WHEN bid_unit = 'Lakh' THEN bid
                                ELSE 0 END) AS total_bid,
                        COUNT(*) AS bid_count
                   FROM plot_bidding
                   WHERE bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
                   GROUP BY DATE_FORMAT(bid_date, '%Y-%m-%d')
                   ORDER BY DATE_FORMAT(bid_date, '%Y-%m-%d');";

                        $totalBidsData = DB::query($query);

                        return $totalBidsData;
                      } catch (MeekroDBException $e) {
                        die("Error: " . $e->getMessage());
                      }
                    }

                    // Get total bid data for the current month
                    $totalBidsData = getTotalBidsDataForCurrentMonth();

                    // Loop through the data and display in rows
                    foreach ($totalBidsData as $item) {
                      $date = $item['date'];
                      $totalBid = $item['total_bid'];
                      $bidCount = $item['bid_count'];

                      // Output table row
                      echo "<tr>";
                      echo "<td>$date</td>";
                      echo "<td>$totalBid Lakh</td>"; // Displaying the unit as Lakh
                      echo "<td>$bidCount</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->


              </tbody>
              </table>
            </div>
            <!-- End Table with stripped rows -->
            <br><br>
            <div class="card"><!-- Bids Monthly Report start-->
              <div class="card-body">
                <h5 class="card-title">Bids Monthly Report</h5>

                <canvas id="bidsChart" width="400" height="200"></canvas>

                <?php
                require('db_config.php');

                // Function to get total bid data for the current month from the database
                function getTotalBidsDataForCurrentMonth1()
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
                $totalBidsData = getTotalBidsDataForCurrentMonth1();

                // Filter days with data
                $daysWithData = array_filter($totalBidsData, function ($item) {
                  return isset($item['total_bid']) && $item['total_bid'] !== null;
                });

                // Convert PHP array to JSON
                $jsTotalBidsData = json_encode($daysWithData);
                ?>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

                  // Create the chart
                  var bidsChart = new Chart(ctxBids, {
                    type: 'line',
                    data: {
                      labels: ['0', ...totalBidsData.map(item => item.day)],
                      datasets: [{
                        label: 'Total Bids Last Month',
                        data: [0, ...numericalTotalBids],
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
              </div>
            </div><!-- Bids Monthly Report end-->
            <div class="card"><!-- Bids Monthly Report start-->
              <div class="card-body">
                <h5 class="card-title">Bids Count Monthly Report</h5>

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
                      },
                      plugins: {
                        legend: {
                          display: true // Hide legend for better space utilization
                        }
                      },
                      layout: {
                        padding: {
                          left: 10,
                          right: 10,
                          top: 10,
                          bottom: 10
                        }
                      },
                      barPercentage: 0.2 // Adjust the bar width (0.8 means 80% of available space)
                    }
                  });
                </script>
              </div>
            </div><!-- Bids Monthly Report end-->






          </div>
        </div>

      </div>
      </div>
    </section>

  </main><!-- End #main -->


  <?php include("include/footer.php") ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("include/script-files.php") ?>

</body>

</html>