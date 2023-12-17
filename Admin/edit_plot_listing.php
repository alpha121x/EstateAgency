<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);  // Convert to integer to ensure it's a valid ID

    // SQL query to fetch user data based on user ID using MeekroDB
    $user_data = DB::queryFirstRow("SELECT * FROM plot_listing WHERE plot_id = %i", $user_id);

    if ($user_data) {
        // Access user data using the fetched associative array
        $id = $user_data['plot_id'];
        $plot_num = $user_data['plot_num'];
        $plot_title = $user_data['plot_title'];
        $plot_location = $user_data['plot_location'];
        $plot_description = $user_data['plot_description'];
        $plot_image = $user_data['plot_image'];  // Assuming the correct column name is 'user_address'

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
  <title>Edit Plot Listing- Form</title>
  <?php include"include/linked-files.php" ?>
</head>

<body>

  
  <?php include"include/header-nav.php" ?>  
 
  <?php include"include/side-nav.php" ?> 

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
              <form method="post" action="fire-update-querries.php" enctype="form-data">
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label"><input type="hidden" name="plot_listing_edit_page_id" value='<?php echo $id; ?>'>Plot No</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $user_data['plot_num']; ?>' name="plot_num">
                  </div>
                </div> 
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Title:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $user_data['plot_title']; ?>' name="plot_title">
                  </div>
                </div> 
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Location</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $user_data['plot_location']; ?>' name="plot_location">
                  </div>
                </div> 
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Plot Description</label>
                  <div class="col-sm-6">
                  <textarea name="plot_description"  cols="30" rows="10"><?php echo $plot_description ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Plot Image</label>
                  <div class="col-sm-6">
                   <input type="file" name="plot_image" value='<?php echo $plot_image ?>'>
                  </div>
                </div>

                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="update-plot"><i class='bx bx-upload'></i> Save</button>
                </div>
                <br>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

      

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include"include/footer.php" ?> 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include"include/script-files.php" ?>

</body>


</html>































