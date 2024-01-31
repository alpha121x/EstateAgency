<?php 
include("db_config.php");
 // Check if post ID is provided in the URL
if (isset($_GET['post_id'])) {
  $post_id = intval($_GET['post_id']);  // Convert to integer to ensure it's a valid ID

  // SQL query to fetch post data based on post ID using MeekroDB
  $post_data = DB::queryFirstRow("SELECT * FROM posts WHERE id = %i", $post_id);

  if ($post_data) {
    // Access post data using the fetched associative array
    $id = $post_data['id'];
    $post_category = $post_data['post_category'];
    $post_title = $post_data['post_title'];
    $post_content = $post_data['post_content'];
    $date_posted = $post_data['date_posted'];
    $post_image = $post_data['post_image'];  // Assuming the correct column name is 'user_address'

  } else {
    echo "Post not found";
    // Handle the case where the post ID doesn't exist in the database
  }
} else {
  echo "Post ID not provided";
  // Handle the case where no post ID is provided in the URL
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Posts</title>
  <?php include("include/linked-files.php") ?>
</head>

<body>

  
  <?php include("include/header-nav.php") ?>  
 
  <?php include("include/side-nav.php") ?> 

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Posts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Add Posts</li>
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
              <form method="post" action="fire-update-querries" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Post Category</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?php echo $post_category; ?>" placeholder="Enter category" name="post_category">
                    <input type="hidden" name="edit_posts_id" value='<?php echo $id; ?>'>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Post Title</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?php echo $post_title; ?>" placeholder="Enter title" name="post_title">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Post Content</label>
                  <div class="col-sm-6">
                    <textarea name="post_content" value="<?php echo $post_content; ?>" class="form-control" placeholder="Enter content" cols="30" rows="10"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputusername" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-6">
                    <input type="date" class="form-control" value="<?php echo $date_posted; ?>" placeholder="Enter date" name="date_posted">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputimage" class="col-sm-2 col-form-label">Add Post Image</label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" name="post_image">
                    <?php if ($post_image) : ?>
                      <img src="<?php echo $post_image; ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    <?php endif; ?>  
                  </div>
                </div>
                   
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="update-post"><i class='bx bx-upload'></i> Add</button>
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































