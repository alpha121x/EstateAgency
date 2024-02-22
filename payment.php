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

    <div class="container">
      <div class="row">
        <div class="col-sm-4 mx-auto my-5">
          <div id="cardDesign" class="position-relative shadow p-4">
            <div class="d-flex align-items-center justify-content-between">
              <div class="fs-4"><strong>$8228.22</strong></div>
              <div><img src="/static_files/svgs/wifi.svg" alt="Wifi Svg" width="24" style="transform:rotate(90deg);filter: invert(1)"></div>
            </div>
            <div class="mt-4 fs-3" id="visualCC">**** **** **** ****</div>
            <div><small class="text-secondary">Valid Thru <span id="visualMM">**</span> / <span id="visualYY">**</span></small></div>
            <div class="mt-3">
              <div class="d-flex justify-content-between align-items-center">
                <div class="text-warning fs-5"><strong id="visualName">XXXX X X</strong></div>
                <div id="cardLogo"></div>
              </div>
            </div>
          </div>
          <div class="p-4 shadow bg-white position-relative" id="formWrap">
            <div class="p-5"></div>
            <form action="">
              <div class="form-floating">
                <input type="text" onkeyup="updateCard(this,'visualCC')" class="form-control" id="cardNumber">
                <label for="cardNumber">Card Number</label>
              </div>
              <div class="form-floating mt-4">
                <input type="text" onkeyup="updateCard(this,'visualName')" class="form-control" id="cardName">
                <label for="cardName">Name On Card</label>
              </div>
              <div class="row mt-2 g-3">
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="expiryMonth" onkeyup="updateCard(this,'visualMM')">
                    <label for="expiryMonth">Expiry(mm)</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="expiryYear" onkeyup="updateCard(this,'visualYY')">
                    <label for="expiryYear">Expiry(yy)</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 g-3">
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="CVV">
                    <label for="CVV">CVV</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="zip">
                    <label for="zip">Postal / Zip code</label>
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <button class="btn btn-primary w-100" type="submit">Pay Now</button>
              </div>
              <div class="text-center mt-3 text-secondary">
                <small>&#128274; Protected By XYZ end-to-end encryption service</small>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->

  <script>
    function updateCard(t, id) {
      var elem = document.getElementById(id)
      if (t.value !== "") elem.innerText = t.value
    }
  </script>

  <!-- ======= Footer ======= -->
  <?Php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>

</body>

</html>