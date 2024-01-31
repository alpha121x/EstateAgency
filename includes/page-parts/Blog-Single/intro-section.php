<?php
include('Admin/db_config.php');
// get the post id from the url
$id = $_GET['post_id'];
// get the post category from the database
$post = DB::queryFirstRow("SELECT * FROM posts WHERE id=%i", $id);
?>
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single"><?php echo $post['post_title']; ?></h1>
        </div>
      </div>
      <div class="col-md-12 col-lg-4">
        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              <?php echo $post['post_category']; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <img src="Admin/<?php echo $post['post_image']; ?>" alt="" class="img-b img-fluid">
          </div>
        </div>
        <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
        <p class="color-text-a text-start"><?php echo $post['post_content'] ?></p>

        </div>
      </div>
        </div>
  </div>
</section>