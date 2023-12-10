<?php
require_once "include/classes/meekrodb.2.3.class.php";
include("db_config.php"); // Include your database connection file

// Select the first row from the admin_users table
$firstAdminUser = DB::queryFirstRow("SELECT * FROM admin_users LIMIT 1");

if ($firstAdminUser) {
    // Access individual columns like $firstAdminUser['column_name']
    $id = $firstAdminUser['id'];
    $username = $firstAdminUser['username'];
    $password = $firstAdminUser['password'];
    $email = $firstAdminUser['email'];
    $user_type = $firstAdminUser['user_type'];
    $user_image = $firstAdminUser['user_image'];

    // Process the data as needed
    // Example: echo "User ID: $id, Username: $username, Email: $email, UserType: $user_type<br>";
} else {
    echo "No admin users found in the database.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Profile</title>
  <?php (include"include/linked-files.php") ?>
</head>

<body>

  
  <?php include"include/header-nav.php" ?>  
 
  <?php include"include/side-nav.php" ?> 

  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Admin Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/abbas.jpeg" alt="Profile" class="rounded-circle">
              <h2><?php echo $username ?></h2>
              <h3>Web Developer</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
              <?php
                // Check if the user is an admin
                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
                    echo'<li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>';
                } else {
                  echo'  <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>';
                }
                ?>

              

              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Bio.....</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Username</div>
                    <div class="col-lg-9 col-md-8"><?php echo $username ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $email; ?> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">User Type</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $user_type; ?> </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="fire-update-querries.php">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/<?php echo $user_image ?>" class="form-control" alt="Profile" name="photo">
                        <div class="col-sm-6">
                        <input type="file" class="form-control" name="photo">
                        </div>
                      </div>
                      </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control"  value='<?php echo $username; ?>'>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputuser" class="col-md-4 col-lg-3 col-form-label">User Type</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="utype" type="text" class="form-control" value='<?php echo $user_type; ?>'>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" value='<?php echo $email; ?>'>
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div> -->

                    <div class="text-center">
                      <button type="submit" name="save-changes" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="fire-update-querries.php">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password"  type="password" value='<?php echo $password ?>' class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update-password" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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
<script src="jquery/jquery.min.js"></script>

</html>































