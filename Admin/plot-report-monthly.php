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
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-bordered" style="background-color: white;">
                                    <thead>
                                        <h5 class="card-title">Plots Bid Monthly Report</h5>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Plot Numbers</th>
                                            <th scope="col">Total Bids</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Function to get total bid data for the current month from the database
                                        function getTotalBidsDataForCurrentMonth()
                                        {
                                            try {
                                                // Fetch total bid data for the current month, including the sum of bids for each day
                                                $query = "SELECT DATE_FORMAT(pb.bid_date, '%Y-%m-%d') AS date,
                        GROUP_CONCAT(DISTINCT pl.plot_num ORDER BY pl.plot_num) AS plot_numbers,
                        SUM(CASE WHEN pb.bid_unit = 'Cr.' THEN pb.bid * 100
                                WHEN pb.bid_unit = 'Lakh' THEN pb.bid
                                ELSE 0 END) AS total_bids
                   FROM plot_bidding pb
                   JOIN plot_listing pl ON pb.plot_id = pl.plot_id
                   WHERE pb.bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
                   GROUP BY DATE_FORMAT(pb.bid_date, '%Y-%m-%d')
                   ORDER BY DATE_FORMAT(pb.bid_date, '%Y-%m-%d');";

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
                                            $plotNumbers = $item['plot_numbers'];
                                            $totalBids = $item['total_bids'];

                                            // Output table row
                                            echo "<tr>";
                                            echo "<td>$date</td>";
                                            echo "<td>$plotNumbers</td>";
                                            echo "<td>$totalBids Lakh</td>"; // Displaying the unit as Lakh
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <!-- End Table with stripped rows -->

                            <div class="table-responsive">
                                <table id="individualPlotsTable" class="table table-bordered" style="background-color: white;">
                                    <thead>
                                        <h5 class="card-title">Individual Plots Monthly Report</h5>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Plot Number</th>
                                            <th scope="col">Total Bids</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Function to get total bid data for each plot from the database
                                        function getIndividualPlotBids()
                                        {
                                            try {
                                                // Fetch total bid data for each plot
                                                $query = "SELECT pl.plot_num,
                DATE_FORMAT(pb.bid_date, '%Y-%m-%d') AS bid_date,
                SUM(CASE WHEN pb.bid_unit = 'Cr.' THEN pb.bid * 100
                         WHEN pb.bid_unit = 'Lakh' THEN pb.bid
                         ELSE 0 END) AS total_bids
         FROM plot_bidding pb
         JOIN plot_listing pl ON pb.plot_id = pl.plot_id
         WHERE pb.bid_date >= DATE_FORMAT(NOW(), '%Y-%m-01')
         GROUP BY pl.plot_num, DATE_FORMAT(pb.bid_date, '%Y-%m-%d')
         ORDER BY pb.bid_date, DATE_FORMAT(pb.bid_date, '%Y-%m-%d');
         ";

                                                $plotBidsData = DB::query($query);

                                                return $plotBidsData;
                                            } catch (MeekroDBException $e) {
                                                die("Error: " . $e->getMessage());
                                            }
                                        }

                                        // Get total bid data for each plot
                                        $plotBidsData = getIndividualPlotBids();

                                        // Variable to keep track of the previous date
                                        $previousDate = null;

                                        // Array to store colors for each unique date
                                        $dateColors = [];

                                        // Loop through the data and display in rows
                                        foreach ($plotBidsData as $item) {
                                            $plotNumber = $item['plot_num'];
                                            $totalBids = $item['total_bids'];
                                            $lastBidDate = $item['bid_date'];

                                            // Check if the date has already been assigned a color
                                            if (!isset($dateColors[$lastBidDate])) {
                                                // Assign a new color for the unique date
                                                $dateColors[$lastBidDate] = getRandomColor();
                                            }

                                            // Get the color for the date
                                            $textColor = $dateColors[$lastBidDate];

                                            // Output table row
                                            echo "<tr>";
                                            echo "<td style='color: $textColor; font-weight: bold;'>$lastBidDate</td>";
                                            echo "<td>$plotNumber</td>";
                                            echo "<td>$totalBids Lakh</td>"; // Displaying the unit as Lakh
                                            echo "</tr>";
                                        }

                                        // Function to generate random color
                                        function getRandomColor()
                                        {
                                            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with individual plots, their total biddings, and last bid date -->



                            <script>
                                $(document).ready(function() {
                                    // Initialize DataTable
                                    $('#individualPlotsTable').DataTable();
                                });
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