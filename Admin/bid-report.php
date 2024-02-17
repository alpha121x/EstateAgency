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
                                <table class="table table-bordered" style="background-color: white;">
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