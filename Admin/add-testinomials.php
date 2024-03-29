<!-- // write code for adding testimomials -->
<?php include("db_config.php") ?>
<?php
if (isset($_POST["add-testimonial"])) {
    // Get form data
    $testimonialName = $_POST['testimonial_name'];
    $testimonialAbout = $_POST['testinomial_about'];

     // File Upload
     $uploadsFolder = 'uploads/';
     $testinomial_image = $uploadsFolder . basename($_FILES['testinomial_image']['name']);
     $uploadSuccess = move_uploaded_file($_FILES['testinomial_image']['tmp_name'], $testinomial_image);
 
     if (!$uploadSuccess) {
         echo "Error uploading file.";
         exit;
     }

     // Insert query using MeekroDB
    $inserted = DB::insert('testinomials', [
        'name' => $testimonialName,
        'description' => $testimonialAbout,
        'image' => $testinomial_image // Save the file path in the database
    ]);

    if ($inserted) {
        echo "<script>window.location.href='add-testinomials';</script>";
    } else {
        echo "Error inserting data into the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Testinomials</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

  
  <?php include("include/header-nav.php") ?>  
 
  <?php include("include/side-nav.php") ?> 

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Testinomials</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Add Testinomials</li>
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
              <form method="post"  enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Add Name</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Enter Name" name="testimonial_name">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Add Description</label>
                  <div class="col-sm-6">
                    <textarea name="testinomial_about" class="form-control" placeholder="Enter content" cols="30" rows="10"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputimage" class="col-sm-2 col-form-label">Add Testinomials Image</label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" name="testinomial_image">
                  </div>
                </div>
                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="add-testinomial"><i class='bx bx-upload'></i> Add</button>
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

  <?php include("include/footer.php") ?> 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php include("include/script-files.php") ?>

</body>


</html>































