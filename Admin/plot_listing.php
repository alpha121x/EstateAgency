<?php require("auth.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Plot Listing</title>

  <?php include("include/linked-files.php") ?>

</head>

<body>

  <?php include("include/header-nav.php") ?>

  <?php include("include/side-nav.php") ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Plot Lisiting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Plot Listing</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Plot Lisitng</h5>
              <p>View All</p>

              <!-- Table with stripped rows -->
              <table  class="table table-bordered" style="background-color: white;">
                <thead>
                  <tr>
                    <th scope="col">id.</th>
                    <th scope="col">Plot number</th>
                    <th scope="col">Plot Title</th>
                    <th scope="col">Plot Location</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text-center">Changes</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include("db_config.php");
                  require_once("include/classes/meekrodb.2.3.class.php");

                  // Select all users from the admin_users table
                  $plots = DB::query("SELECT * FROM plot_listing ORDER BY added_on DESC");

                  if ($plots) {
                    foreach ($plots as $plot) {
                      // Assign variables from the fetched row
                      $id = $plot['plot_id'];
                      $plot_num = $plot['plot_num'];
                      $plot_title = $plot['plot_title'];
                      $plot_location = $plot['plot_location'];
                      $plot_description = $plot['plot_description'];
                      $added_on = $plot['added_on'];
                      $plot_image = $plot['plot_image'];
                  ?>
                      <!-- Display data in the rows -->
                      <tr>
                        <td><?php echo $plot['plot_id']; ?></td>
                        <td><?php echo $plot_num; ?></td>
                        <td><?php echo $plot_title; ?></td>
                        <td><?php echo $plot_location ?></td>
                        <td><?php echo $added_on; ?></td>
                        <td class="text-center">
                          <a href='edit_plot_listing.php?id=<?php echo $id; ?>' class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                          |
                          <a href='delete-plot_lisitng?deleteid=<?php echo $id; ?>'class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        </td>

                      </tr>
                  <?php
                    }
                  }
                  ?>


                </tbody>
              </table>
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