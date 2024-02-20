<?php require("auth.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Home Content</title>

  <?php include("include/linked-files.php") ?>

</head>

<body>

  <?php include("include/header-nav.php") ?>

  <?php include("include/side-nav.php") ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Property Listing</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Content Slider Listing</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Content Slider Listing</h5>
              <p>View All</p>

              <!-- Table with stripped rows -->
              <table class="table table-bordered" style="background-color: white;">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Property number</th>
                    <th scope="col">Property Title</th>
                    <th scope="col">Property Location</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text-center">Changes</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include("db_config.php");
                  require_once("include/classes/meekrodb.2.3.class.php");

                  // Select all users from the admin_users table
                  $properties = DB::query("SELECT * FROM home_content_slider ORDER BY added_on DESC");

                  if ($properties) {
                    $index = 1;
                    foreach ($properties as $property) {
                      // Assign variables from the fetched row
                      $id = $property['id'];
                      $property_num = $property['property_num'];
                      $property_title = $property['property_title'];
                      $property_location = $property['property_location'];
                      $added_on = $property['added_on'];
                      $property_image = $property['property_image'];
                  ?>
                      <!-- Display data in the rows -->
                      <tr>
                        <td><?php echo $index; ?></td>
                        <td><?php echo $property_num; ?></td>
                        <td><?php echo $property_title; ?></td>
                        <td><?php echo $property_location ?></td>
                        <td><?php echo $added_on; ?></td>
                        <td class="text-center">
                          <a href='edit-content-slider?id=<?php echo $id; ?>' class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                          <?php
                          if ($_SESSION['user_type'] == 'admin') {
                          ?>
                            |
                            <a href='delete-content-slider.php?id=<?php echo $id; ?>' class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                          <?php
                          }
                          ?>

                        </td>

                      </tr>
                  <?php
                      $index++;
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
