<?php
// File path for the counter
$counterFilePath = 'counter.txt';

// Read the current count from the file
$currentCount = file_exists($counterFilePath) ? intval(file_get_contents($counterFilePath)) : 0;

// Increment the count for each visit
$currentCount++;

// Write the updated count back to the file
file_put_contents($counterFilePath, $currentCount);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<title>Home</title>
  
<?php include("includes/linked-files.php") ?>

</head>

<body>

   <?php include("includes/property-search-section.php") ?>

   <?php include("includes/header-nav.php") ?>

  <!-- ======= Intro Section ======= -->
  <?php include("includes/page-parts/intro-section.php") ?>
  <!-- End Intro Section -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <?php include("includes/page-parts/services-section.php") ?>
    <!-- End Services Section -->

    <!-- ======= Latest Properties Section ======= -->
    <?php include("includes/page-parts/latest-properties-section.php") ?>
    <!-- End Latest Properties Section -->

    <!-- ======= Agents Section ======= -->
    <?php include("includes/page-parts/agents-section.php") ?>
    <!-- End Agents Section -->

    <!-- ======= Latest News Section ======= -->
    <?php include("includes/page-parts/latest-news-section.php") ?>
    <!-- End Latest News Section -->

    <!-- ======= Testimonials Section ======= -->
    <?php include("includes/page-parts/testinomial-section.php") ?>
    <!-- End Testimonials Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>


</body>

</html>