<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);  // Convert to integer to ensure it's a valid ID

    // SQL query to fetch user data based on user ID using MeekroDB
    $user_data = DB::queryFirstRow("SELECT * FROM users_address WHERE user_id = %i", $user_id);

    if ($user_data) {
        // Access user data using the fetched associative array
        $id = $user_data['user_id'];
        $username = $user_data['username'];
        $email = $user_data['email'];
        $user_address = $user_data['user-address'];  // Assuming the correct column name is 'user_address'

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
  <title>Edit user- Form</title>
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
          <li class="breadcrumb-item">Edit Users Address</li>
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
                  <label for="inputusername" class="col-sm-2 col-form-label"><input type="hidden" name="user-address-edit-page-id" value='<?php echo $id; ?>'>Username</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value='<?php echo $username; ?>' name="username">
                  </div>
                </div> 
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input type="email" class="form-control" value='<?php echo $email; ?>' name="email">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-6">
                   <textarea name="user_address" class="form-control" cols="30" rows="10"><?php echo $user_address; ?></textarea>
                  </div>
                </div>

                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="update-user-address"><i class='bx bx-upload'></i> Save</button>
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































