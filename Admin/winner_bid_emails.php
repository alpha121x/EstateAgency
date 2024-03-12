<?php require("auth.php") ?>
<?php include("db_config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bid Winners Emails</title>

    <?php include("include/linked-files.php") ?>

</head>

<body>

    <?php include("include/header-nav.php") ?>

    <?php include("include/side-nav.php") ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bid Winners Emails</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Bid Winners Emails</li>
                    <li class="breadcrumb-item active">View All</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bid Winners Emails</h5>
                            <p>View All</p>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-bordered" style="background-color: white;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Plots</th>
                                            <th scope="col">Bidding Winner</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <?php
// Your database query
$query = "
SELECT
    p.plot_num,
    p.plot_title,
    MAX(pb.bid) AS top_bid,
    (
        SELECT user_name
        FROM plot_bidding
        WHERE plot_id = pb.plot_id
        ORDER BY bid DESC
        LIMIT 1
    ) AS bid_winner,
    (
        SELECT user_email
        FROM plot_bidding
        WHERE plot_id = pb.plot_id
        ORDER BY bid DESC
        LIMIT 1
    ) AS bid_winner_email,
    'Pending' AS status
FROM
    plot_bidding pb
JOIN
    plot_listing p ON pb.plot_id = p.plot_id
GROUP BY
    pb.plot_id;
";

// Execute the query
$result = DB::query($query);
?>

<tbody>
    <?php foreach ($result as $index => $row) : ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $row['plot_num']; ?></td>
            <td><?php echo $row['bid_winner']; ?></td>
            <td><?php echo $row['bid_winner_email']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td class="text-center">
            <button type="submit" name="email-sent" class="btn btn-success btn-sm"><i class='fa fa-edit'></i>Send Email</button>
            </td>
        </tr>
    <?php endforeach; ?>
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