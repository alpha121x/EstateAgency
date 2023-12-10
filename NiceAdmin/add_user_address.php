<?php include("db_config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add User Profile - Form</title>
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
          <li class="breadcrumb-item">Add Users Address</li>
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
              <form method="post" action="fire-add-querries.php" enctype="form-data">
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Username" name="username">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input type="email" class="form-control" placeholder="Enter Email" name="email">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Adress</label>
                  <div class="col-sm-6">
                   <textarea class="form-control" name="user_address" cols="30" rows="10"></textarea>
                  </div>
                </div>


                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="add-user-address"><i class='bx bx-upload'></i> Add</button>
                  <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
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































