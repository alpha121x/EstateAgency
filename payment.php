<?php include("Admin/db_config.php"); ?>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    // Check if the ID parameter is set in the URL
    if (isset($_GET['id'])) {
      // Sanitize the ID parameter to prevent SQL injection
      $property_id = intval($_GET['id']);

      // Fetch property details from the home_content_slider table based on the ID
      $propertyDetails = DB::queryFirstRow("SELECT * FROM home_content_slider WHERE id = %i", $property_id);
      $prop_num = $propertyDetails['property_num'];

      // Check if the form is submitted
      if (isset($_POST['pay-button'])) {

        // Card details
        $cardNumber = $_POST['cardNumber'];
        $cardholderName = $_POST['cardholderName'];
        // Amount details
        $selectedAmount = $_POST['property_price'];

        // Get property ID from the URL
        if (isset($_GET['id'])) {
          $property_id = intval($_GET['id']);

          // Fetch property details for notification
          $propertyDetails = DB::queryFirstRow("SELECT * FROM home_content_slider WHERE id = %i", $property_id);

          // Update property_status in home_content_slider table
          $updateQuery = "UPDATE home_content_slider SET property_status = '3' WHERE id = %i";
          DB::query($updateQuery, $property_id);

          // Customize message for the purchase notification
          $messageTitle = "Property Sold: Plot NO - " . $propertyDetails['property_num'];
          $message = "The property with Plot Num: " . $propertyDetails['property_num'] . " has been sold to " . $cardholderName . ".";

          // Inserting notification into the database
          DB::insert("notifications", array(
            'title' => $messageTitle,
            'is_read' => 0,
            'plot_id' => $property_id,
            'created_by' => $propertyDetails['username'],
            'message' => $message,
            'bid_date' => date('Y-m-d H:i:s') // You can customize the date format as needed
          ));

          // Display SweetAlert message
          echo '<script>
              Swal.fire({
                  title: "Thank You!",
                  text: "Your purchase has been successful.",
                  icon: "success",
                  confirmButtonText: "OK"
              }).then(() => {
                  window.location.href = "index.php";
              });
            </script>';
        }
        exit();
      }

      function sale_property($property_id, $sale_amount, $sold_to, $sold_date, $agent_name)
      {
        $insertQuery = "INSERT INTO sales_intake (plot_id, sale_amount, sold_to, sold_date, agent_name) 
                      VALUES (%i, %s, %s, %s, %s)";

        // Execute the query with the provided values
        DB::query($insertQuery, $property_id, $sale_amount, $sold_to, $sold_date, $agent_name);

        // Additional logic or return statement can be added here
      }
    }

    ?>


    <section style="background-color: #eee;">
      <br><br><br><br><br><br>
      <div class="container py-5">
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="card rounded-3">
              <form action="" method="post">
                <div class="card-body mx-1 my-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="black" class="bi bi-credit-card" viewBox="0 0 16 16">
                        <path d="M15 2H1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm0 1v2H1V4h14zM0 7h16v2H0V7zm0 4h16v2H0v-2z" />
                        <text x="50%" y="75%" font-size="3" font-family="Arial" fill="white" text-anchor="middle">Visa</text>
                      </svg>

                      &nbsp;
                    </div>
                    <div>
                      <p class="d-flex flex-column mb-0">
                        <b>Martina Thomas</b><span class="small text-muted">**** 8880</span>
                      </p>
                    </div>
                  </div>

                  <div class="pt-3">
                    <div class="mb-3">
                      <label for="cardNumber" class="form-label">Card Number</label>
                      <input type="text" name="cardNumber" class="form-control" id="cardNumber" placeholder="**** **** **** 8880">
                    </div>
                    <div class="mb-3">
                      <label for="cardholderName" class="form-label">Cardholder Name</label>
                      <input type="text" name="cardholderName" class="form-control" id="cardholderName" placeholder="Martina Thomas">
                    </div>
                    <div class="mb-3">
                      <label for="cardholderName" class="form-label">Amount</label>
                      <input type="text" name="property_price" value="Rs. <?php echo $propertyDetails['property_price']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="d-flex justify-content-between align-items-center pb-1">
                    <a href="index.php" class="text-muted">Go back</a>
                    <button type="submit" name="pay-button" class="btn btn-primary btn-lg">Pay amount</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <?Php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>

</body>

</html>