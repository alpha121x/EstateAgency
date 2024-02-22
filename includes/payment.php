<!DOCTYPE html>
<html lang="en">

<head>

  <title>Payment Page</title>

  <?php include("linked-files.php") ?>

  
</head>

<body>

  <!-- ======= Property Search Section ======= -->
  <?php include("property-search-section.php") ?>
  <!-- End Property Search Section -->

  <!-- ======= Header/Navbar ======= -->
  <?php include("header-nav.php") ?>
  <!-- End Header/Navbar -->

  <main id="main">

  <h1>Payment Page</h1>
  <p>Thank you for choosing to buy the property!</p>

  <form action="payment_process.php" method="post">
    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number" required><br>

    <label for="expiry_date">Expiry Date:</label>
    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required><br>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required><br>

    <button type="submit">Submit Payment</button>
  </form>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?Php include("footer.php") ?>
  <!-- End  Footer -->

  <?php include("preloader.php") ?>

  <?php include("script-files.php") ?>

</body>

</html>