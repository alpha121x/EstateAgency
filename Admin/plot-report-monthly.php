<!--  write code for shwoing posts in a data table -->
<?php
include('db_config.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Plots Bid Report</title>
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
                            <p>Plots Bids Monthly Report</p> <br><br>

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