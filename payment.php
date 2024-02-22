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

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400&display=swap" rel="stylesheet">
    
    <div class="w-100 vh-100 bg-light">
      <div class="d-flex h-100 align-items-center">
        <div class="col-xl-8 col-lg-10 col-md-10 col-sm-10 mx-auto">
          <div class="row align-items-center">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="position-relative">
                <div class="cardStyle">
                  <div class="text-end"><strong>DB BANK</strong></div>
                  <div class="mt-3 d-flex align-items-center justify-content-between">
                    <div><img src="/static_files/images/logos/chip.png" alt="Chip" height="32"></div>
                    <div><img style="transform:rotate(90deg)" src="/static_files/svgs/wifi.svg" alt="Chip" height="24"></div>
                  </div>
                  <div class="fs-4 mt-2 cardFont text-shadow-white" id="visualNumber">1234 5678 1234 5678</div>
                  <div class="row mt-2">
                    <div class="col"></div>
                    <div class="col text-shadow-white"><span id="visualMonth">12</span>/<span id="visualYear">24</span></div>
                  </div>
                  <div class="text-info text-shadow-black"><strong id="visualName">P John Doe</strong></div>
                </div>
                <div class="cardStyle cardBack pt-3" >
                  <div class="mt-4 p-4 bg-black"></div>
                  <div class="mb-3 bg-white">
                    <div class="d-flex justify-content-between">
                      <div class="p-3 bg-white"></div>
                      <div class="p-3 bg-light"><em id="visualCVV">123</em></div>
    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="px-4 py-5 bg-white customRounded shadow">
                <h4>Payment Details</h4>
                <form action="">
                  <div class="mt-4 mb-3"><input onkeyup="updateCard(this,'visualNumber')" onblur="protect(this,4)" type="text" name="cardNumber" id="cardNumber" placeholder="CARD NUMBER" class="form-control"></div>
                  <div class="mb-3"><input type="text" onkeyup="updateCard(this,'visualName')" name="cardholderName" id="cardholderName" placeholder="CARD HOLDER NAME" class="form-control"></div>
                  <div class="row">
                    <div class="col"><input type="text" onkeyup="updateCard(this,'visualMonth')" placeholder="12" name="month" class="form-control"></div>
                    <div class="col"><input type="text" onkeyup="updateCard(this,'visualYear')" placeholder="2028" name="year" class="form-control"></div>
                    <div class="col"><input type="text" onkeyup="updateCard(this,'visualCVV')" placeholder="CVV" name="year" class="form-control"></div>
                  </div>
                  <div class="mt-3 d-flex">
                    <button class="btn btn-primary w-75 me-2">PAY $22.88</button>
                    <a href="" class="btn btn-outline-primary w-25 ms-2 ">Cancel</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->

  <script>
    function updateCard(t,id){
      var elem = document.getElementById(id)
      var num = t.value
      if(id==='visualNumber'){
        if(num.length > 16) return t.value = num.substr(0,16)
        num = num.toString().match(/.{4}/g) ? num.toString().match(/.{4}/g).join(' ') : num;
      }
      elem.innerText = num
    }
    
    function protect(t,end){
      var num = t.value
      t.value = num.substr(num.length-4,num.length)
    }
  </script>

  <!-- ======= Footer ======= -->
  <?Php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>

</body>

</html>