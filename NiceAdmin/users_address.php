<?php require("auth.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Dashboard - NiceAdmin</title>

  <?php include("include/linked-files.php") ?>

</head>

<body>

<?php include("include/header-nav.php") ?>

<?php include("include/side-nav.php") ?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Datatables</h5>
          <p>Edit Users record.</p>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">id.</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">User Address</th>
                <th scope="col">Changes</th>
              </tr>
            </thead>
            <tbody>
            <?php
                  include("db_config.php");
                  require_once ("include/classes/meekrodb.2.3.class.php");

                  // Select all users from the admin_users table
                  $users = DB::query("SELECT * FROM users_address");

                  if ($users) {
                      foreach ($users as $user) {
                          // Assign variables from the fetched row
                          $id = $user['user_id'];
                          $username = $user['username'];
                          $email = $user['email'];
                          $user_address = $user['user-address'];
                          ?>
                          <!-- Display data in the rows -->
                          <tr>
                              <td><?php echo $user['user_id']; ?></td>
                              <td><?php echo $user['username']; ?></td>
                              <td><?php echo $user['email']; ?></td>
                              <td><?php echo $user['user-address']; ?></td>
                              <td>
                              <?php
                                // Check if the user is an admin
                                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
                                    echo"<a href='edit-user.php?id=<?php echo $id; ?>'><i class='fa fa-edit'></i>Edit</a>
                                    |
                                    <a href='delete.php?deleteid=<?php echo $id; ?>'><i class='fa fa-trash-o'></i>Delete</a>";
                                } else {
                                    echo"<a href='edit-user.php?id=<?php echo $id; ?>'><i class='fa fa-edit'></i>Edit</a>";
                                }
                                ?>
                              </td>
                          </tr>
                          <?php
                      }
                  } else {
                      echo "No admin users found in the database.";
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