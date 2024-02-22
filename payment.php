<!DOCTYPE html>
<html lang="en">

<head>

  <title>Payment Page</title>

  <?php include("includes/linked-files.php") ?>

  
</head>

<body>

  <!-- ======= Property Search Section ======= -->
  <?php include("includes/property-search-section.php") ?>
  <!-- End Property Search Section -->

  <!-- ======= Header/Navbar ======= -->
  <?php include("includes/header-nav.php") ?>
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
  <?Php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>

</body>

</html>