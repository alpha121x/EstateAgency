<section class="news-grid grid">
  <div class="container">
    <div class="row">
      <?php
      include('Admin/db_config.php');

      // Define the number of posts per page
      $postsPerPage = 6;
      
      // Get the current page number from the URL
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      
      // Calculate the offset for the query
      $offset = ($page - 1) * $postsPerPage;
      
      // Fetch data from the posts table with pagination
      $posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC LIMIT %i OFFSET %i", $postsPerPage, $offset);
      
      // Fetch the total number of posts for pagination
      $totalPosts = DB::queryFirstField("SELECT COUNT(*) FROM posts");
      
      // Calculate the total number of pages
      $totalPages = ceil($totalPosts / $postsPerPage);

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
                    <a href="blog-single?post_id=<?php echo $post['id']; ?>" class="category-b"><?php echo $post['post_category']; ?></a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single?post_id=<?php echo $post['id']; ?>"><?php echo strlen($post['post_title']) > 20 ? substr($post['post_title'], 0, 20) . '...' : $post['post_title']; ?></a>
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
    <div class="row">
    <div class="col-sm-12">
      <nav class="pagination-a">
        <ul class="pagination justify-content-end">
          <!-- Previous Page Link -->
          <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>" tabindex="-1">
              <span class="bi bi-chevron-left"></span>
            </a>
          </li>

          <!-- Page Numbers -->
          <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Next Page Link -->
          <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo ($page < $totalPages) ? $page + 1 : $totalPages; ?>">
              <span class="bi bi-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  </div>
</section>