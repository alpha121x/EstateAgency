<section class="news-grid grid">
  <div class="container">
    <div class="row">
      <?php
      include('Admin/db_config.php');

      // Fetch data from the posts table
      $posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC LIMIT 5");

      if ($posts) {
        foreach ($posts as $post) {
      ?>
          <div class="col-md-4">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="Admin/<?php echo $post['post_image']; ?>" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="blog-single" class="category-b"><?php echo $post['post_category']; ?></a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single"><?php echo $post['post_title']; ?></a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b"><?php echo date('d M. Y', strtotime($post['date_posted'])); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        // Handle the case where no posts are found
        echo '<p>No posts found.</p>';
      }
      ?>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <nav class="pagination-a">
        <ul class="pagination justify-content-end">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">
              <span class="bi bi-chevron-left"></span>
            </a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">1</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">3</a>
          </li>
          <li class="page-item next">
            <a class="page-link" href="#">
              <span class="bi bi-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  </div>
</section>