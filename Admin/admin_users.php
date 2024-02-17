<?php require("auth.php") ?>
<?php include("db_config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Users</title>

  <?php include("include/linked-files.php") ?>

</head>

<body>

  <?php include("include/header-nav.php") ?>

  <?php include("include/side-nav.php") ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Users Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Users</h5>
              <p>Users record.</p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">
                <table class="table table-bordered" style="background-color: white;">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Email</th>
                      <th scope="col">User Type</th>
                      <th scope="col" class="text-center">Changes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include("db_config.php");
                    require_once("include/classes/meekrodb.2.3.class.php");

                    // Select all users from the admin_users table
                    $users = DB::query("SELECT * FROM admin_users");

                    if ($users) {
                      $index = 1; // Initialize the index
                      foreach ($users as $user) {
                        // Assign variables from the fetched row
                        $id = $user['id'];
                        $username = $user['username'];
                        $email = $user['email'];
                        $user_type = $user['user_type'];
                        $user_image = $user['user_image'];
                    ?>
                        <!-- Display data in the rows -->
                        <tr>
                        <td><?php echo $index; ?></td>
                          <td><?php echo $user['username']; ?></td>
                          <td><?php echo $user['email']; ?></td>
                          <td><?php echo $user['user_type']; ?></td>
                          <td class="text-center">
                            <a href='edit-user.php?id=<?php echo $id; ?>' class="btn btn-success btn-sm"><i class='fa fa-edit'></i>Edit</a>

                            <?php
                            if ($_SESSION['user_type'] == 'admin') {
                            ?>
                              <a href='delete.php?deleteid=<?php echo $id; ?>' class="btn btn-danger btn-sm"><i class='fa fa-trash-o'></i>Delete</a>
                            <?php
                            }
                            ?>


                          </td>
                        </tr>
                    <?php
                     $index++; // Increment the index
                      }
                    } else {
                      echo "No admin users found in the database.";
                    }
                    ?>


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