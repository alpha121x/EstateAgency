<?php
include('Admin/db_config.php');

// Fetch data from the posts table
$posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC LIMIT 3");

?>

<section class="section-news section-t8">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title-wrap d-flex justify-content-between">
          <div class="title-box">
            <h2 class="title-a">Latest News</h2>
          </div>
          <div class="title-link">
            <a href="blog-grid">All News
              <span class="bi bi-chevron-right"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div id="news-carousel" class="swiper">
      <div class="swiper-wrapper">
        <?php foreach ($posts as $post) : ?>
          <div class="carousel-item-c swiper-slide">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="Admin/<?php echo $post['post_image']; ?>" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b"><?php echo $post['post_category']; ?></a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['post_title']; ?></a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b"><?php echo date('d M. Y', strtotime($post['date_posted'])); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End carousel item -->
        <?php endforeach; ?>
      </div>
    </div>

    <div class="news-carousel-pagination carousel-pagination"></div>
  </div>
</section>
