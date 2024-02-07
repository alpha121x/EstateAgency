<?php
// File path for the viewer counter in the root directory
$counterFilePath = '../counter.txt';

// Read the current count from the file
$currentCount = file_exists($counterFilePath) ? intval(file_get_contents($counterFilePath)) : 0;
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card viewers-card">

              <?php
              require('db_config.php');

              // Fetch the website viewer count from the visited_count table
              $currentDate = date('Y-m-d');
              $websiteViewerCount = DB::queryFirstField("SELECT SUM(visit_count) FROM visited_count WHERE visit_datetime >= %s AND visit_datetime < %s", $currentDate . ' 00:00:00', $currentDate . ' 23:59:59');

              ?>

              <div class="card-body">
                <h5 class="card-title">Website Viewers <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-eye"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $websiteViewerCount; ?></h6>
                    <span class="text-success small pt-1 fw-bold">15%</span>
                    <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>


            </div>
          </div><!-- End Website Viewers Card -->

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card bids-card">



              <?php
              include('db_config.php');


              // Query to get the total number of bids for this month
              $totalBids = DB::queryFirstField("SELECT COUNT(*) FROM plot_bidding WHERE DATE(bid_date) = %s", date('Y-m-d'));

              // Display the total bids count
              ?>
              <div class="card-body">
                <h5 class="card-title">Total Bids <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gift"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php echo $totalBids; ?></h6>
                    <!-- You can calculate percentage increase if needed -->
                    <!-- <span class="text-success small pt-1 fw-bold">10%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                  </div>
                </div>
              </div>


            </div>
          </div><!-- End Total Bids Card -->

          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card amounts-card">


              <?php
              include('db_config.php');

              // Query to get the total amount of bids for this day
              $totalAmount = DB::queryFirstField("SELECT CONCAT( FORMAT(SUM(bid), 2), ' Cr.') as bid_sum FROM plot_bidding WHERE DATE(bid_date) = CURDATE()");

              // Display the total bids amount
              ?>
              <div class="card-body">
                <h5 class="card-title">Total Bids Amounts <span>| Today</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rs.<?php echo $totalAmount; ?></h6>
                    <!-- You can calculate percentage decrease if needed -->
                    <!-- <span class="text-danger small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Total Bids Amounts Card -->


        </div>

        <!-- News & Updates Traffic -->
        <div class="card">


          <?php
          include('db_config.php');

          // Fetch data from the posts table
          $posts = DB::query("SELECT * FROM posts ORDER BY date_posted DESC LIMIT 5");

          ?>

          <div class="card-body pb-0">
            <h5 class="card-title">News & Updates| Today <span></span></h5>

            <div class="news">
              <?php foreach ($posts as $post) : ?>
                <div class="post-item clearfix">
                  <img src="<?php echo $post['post_image']; ?>" alt="">
                  <h4><a href="#"><?php echo $post['post_title']; ?></a></h4>
                  <p><?php echo substr($post['post_content'], 0, 100); ?>...</p>
                </div>
              <?php endforeach; ?>
            </div><!-- End sidebar recent posts-->

          </div>

        </div><!-- End News & Updates -->

  </section>

</main><!-- End #main -->
