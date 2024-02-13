<?php include("db_config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Posts</title>
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
          <li class="breadcrumb-item">Add Posts Lisinting</li>
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
              <form method="post" action="fire-add-querries.php" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot No</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Plot Num." required name="plot_num">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plotStatus" class="col-sm-2 col-form-label">Plot Status</label>
                  <div class="col-sm-6">
                    <select class="form-select" required name="plot_status" id="plotStatus">
                      <option value="1">For Sale</option>
                      <option value="2">For Rent</option>
                      <option value="3">Sold</option>
                      <option value="4">Under Contract</option>
                      <option value="5">Reserved</option>
                      <option value="6">Development in Progress</option>
                      <option value="7">Not Available</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Area</label>
                  <div class="col-sm-6">
                    <input type="number" required class="form-control" placeholder="m" required name="plot_area">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="propertyType" class="col-sm-2 col-form-label">Property Type</label>
                  <div class="col-sm-6">
                    <select class="form-select" required name="property_type" id="propertyType">
                      <option value="House">House</option>
                      <option value="Property">Property</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="beds" class="col-sm-2 col-form-label">Beds</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="Enter Number of Beds" name="beds">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="baths" class="col-sm-2 col-form-label">Baths</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" placeholder="Enter Number of Baths" name="baths">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Price</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" required placeholder="Enter Plot Price" name="plot_price">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Title</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" required placeholder="Enter Plot Title.." name="plot_title">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Plot Location</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" required placeholder="Enter Plot Location.." name="plot_location">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Plot Description</label>
                  <div class="col-sm-6">
                    <textarea class="form-control" required name="plot_description" cols="30" rows="10"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Add Image</label>
                  <div class="col-sm-6">
                    <input type="file" required class="form-control" name="plot_image">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Add Video(Optional)</label>
                  <div class="col-sm-6">
                    <input type="file"  class="form-control" name="plot_video">
                  </div>
                </div>



            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="add-plot"><i class='bx bx-upload'></i> Add</button>
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

  <?php include "include/footer.php" ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include "include/script-files.php" ?>

</body>


</html>