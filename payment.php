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
    
    <!-- This script got from frontendfreecode.com -->
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                    <!-- Credit card form tabs -->
                    <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#credit-card" class="nav-link active"> <i class="fas fa-credit-card mr-2"></i> Credit Card </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#paypal" class="nav-link"> <i class="fab fa-paypal mr-2"></i> Paypal </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#net-banking" class="nav-link"> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a>
                        </li>
                    </ul>
                </div>
                <!-- End -->
                <!-- Credit card form content -->
                <div class="tab-content">
                    <!-- credit card info-->
                    <div id="credit-card" class="tab-pane fade show active pt-3">
                        <form role="form">
                            <div class="form-group">
                                <label for="username">
                                    <h6>Card Owner</h6>
                                </label>
                                <input type="text" name="username" placeholder="Card Owner Name" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">
                                    <h6>Card number</h6>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6>Expiration Date</h6>
                                            </span>
                                        </label>
                                        <div class="input-group"><input type="number" placeholder="MM" name="" class="form-control" required /> <input type="number" placeholder="YY" name="" class="form-control" required /></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"><button type="button" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button></div>
                        </form>
                    </div>
                    <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <h6 class="pb-2">Select your paypal account type</h6>
                        <div class="form-group">
                            <label class="radio-inline"> <input type="radio" name="optradio" checked /> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5" />International </label>
                        </div>
                        <p>
                            <button type="button" class="btn btn-primary"><i class="fab fa-paypal mr-2"></i> Log into my Paypal</button>
                        </p>
                        <p class="text-muted">
                            Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                        </p>
                    </div>
                    <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group">
                            <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label>
                            <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank 1</option>
                                <option>Bank 2</option>
                                <option>Bank 3</option>
                                <option>Bank 4</option>
                                <option>Bank 5</option>
                                <option>Bank 6</option>
                                <option>Bank 7</option>
                                <option>Bank 8</option>
                                <option>Bank 9</option>
                                <option>Bank 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p>
                                <button type="button" class="btn btn-primary"><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button>
                            </p>
                        </div>
                        <p class="text-muted">
                            Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                        </p>
                    </div>
                    <!-- End -->
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
</div><a style="font-size: 8pt; text-decoration: none" target="_blank" href="http://frontendfreecode.com">Free Frontend</a>
                                                                            

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

    function GetCardType(number)
{
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";
 
    // Mastercard
    // Updated for Mastercard 2017 BINs expansion
     if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "Mastercard";
 
    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AMEX";
 
    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";
 
    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return "Diners";
 
    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return "Diners - Carte Blanche";
 
    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return "JCB";
 
    // Visa Electron
    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null)
        return "Visa Electron";
 
    return "";
}
  </script>

  <!-- ======= Footer ======= -->
  <?Php include("includes/footer.php") ?>
  <!-- End  Footer -->

  <?php include("includes/preloader.php") ?>

  <?php include("includes/script-files.php") ?>

</body>

</html>