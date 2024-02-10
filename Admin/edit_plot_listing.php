<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);  // Convert to integer to ensure it's a valid ID

  // SQL query to fetch user data based on user ID using MeekroDB
  $plots = DB::queryFirstRow("SELECT * FROM plot_listing WHERE plot_id = %i", $id);

  if ($plots) {
    // Access user data using the fetched associative array
    $id = $plots['plot_id'];
    $plot_num = $plots['plot_num'];
    $plot_price = $plots['plot_price'];
    $plot_title = $plots['plot_title'];
    $plot_location = $plots['plot_location'];
    $plot_description = $plots['plot_description'];
    $property_type = $plots['property_type'];
    $plot_area = $plots['plot_area'];
    $beds = $plots['beds'];
    $baths = $plots['baths'];
    $plot_image = $plots['plot_image'];  // Assuming the correct column name is 'user_address'

  } else {
    echo "User not found";
    // Handle the case where the user ID doesn't exist in the database
  }
} else {
  echo "User ID not provided";
  // Handle the case where no user ID is provided in the URL
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Plot Listing</title>
  <?php include "include/linked-files.php" ?>
</head>

<body>


  <?php include "include/header-nav.php" ?>

  <?php include "include/side-nav.php" ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Form</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Edit Plot Listing</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form</h5>

              <!-- Horizontal Form -->
              <form method="post" action="fire-update-querries.php" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="plot_listing_edit_page_id" class="col-sm-2 col-form-label">Plot No</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $plot_num; ?>' name="plot_num" required>
                    <input type="hidden" name="plot_listing_edit_page_id" value='<?php echo $id; ?>'>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plotStatus" class="col-sm-2 col-form-label">Plot Status</label>
                  <div class="col-sm-6">
                    <select class="form-select" required name="plot_status" id="plotStatus">
                      <option value="1" <?php echo ($property_type == 'For Sale') ? 'selected' : ''; ?>>For Sale</option>
                      <option value="2" <?php echo ($property_type == 'For Rent') ? 'selected' : ''; ?>>For Rent</option>
                      <option value="3" <?php echo ($property_type == 'Sold') ? 'selected' : ''; ?>>Sold</option>
                      <option value="4" <?php echo ($property_type == 'Under Contract') ? 'selected' : ''; ?>>Under Contract</option>
                      <option value="5" <?php echo ($property_type == 'Reserved') ? 'selected' : ''; ?>>Reserved</option>
                      <option value="6" <?php echo ($property_type == 'Development in Progress') ? 'selected' : ''; ?>>Development in Progress</option>
                      <option value="7" <?php echo ($property_type == 'Not Available') ? 'selected' : ''; ?>>Not Available</option>
                    </select>

                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Area</label>
                  <div class="col-sm-6">
                    <input type="number" value="<?php echo $plot_area ?>" required class="form-control" placeholder="m" required name="plot_area">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="propertyType" class="col-sm-2 col-form-label">Property Type</label>
                  <div class="col-sm-6">
                    <select class="form-select" required name="property_type" id="propertyType">
                      <option value="House" <?php if ($property_type == 'House') echo 'selected'; ?>>House</option>
                      <option value="Property" <?php if ($property_type == 'Property') echo 'selected'; ?>>Property</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="beds" class="col-sm-2 col-form-label">Beds</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="Enter Number of Beds" name="beds" value='<?php echo $beds; ?>'>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="baths" class="col-sm-2 col-form-label">Baths</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="Enter Number of Baths" name="baths" value='<?php echo $baths; ?>'>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plot_price" class="col-sm-2 col-form-label">Plot Price</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $plot_price; ?>' name="plot_price">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plot_title" class="col-sm-2 col-form-label">Plot Title:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $plot_title; ?>' name="plot_title">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plot_location" class="col-sm-2 col-form-label">Plot Location</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $plot_location; ?>' name="plot_location">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plot_description" class="col-sm-2 col-form-label">Plot Description</label>
                  <div class="col-sm-6">
                    <textarea name="plot_description" class="form-control" cols="30" rows="10"><?php echo $plot_description; ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plot_image" class="col-sm-2 col-form-label">Plot Image</label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" name="plot_image">
                    <?php if ($plot_image) : ?>
                      <img src="<?php echo $plot_image; ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    <?php endif; ?>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="update-plot"><i class='bx bx-upload'></i> Save</button>
                </div>
                <br>
              </form>


            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include "include/footer.php" ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include "include/script-files.php" ?>

</body>


</html>