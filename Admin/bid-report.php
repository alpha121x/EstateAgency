<!--  write code for shwoing posts in a data table -->
<?php
include('db_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Posts</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

    <?php include("include/header-nav.php") ?>

    <?php include("include/side-nav.php") ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reports</h5>
                            <p>Bids Report</p>


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
