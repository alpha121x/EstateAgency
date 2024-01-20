<div class="intro intro-carousel swiper position-relative">

<div class="swiper-wrapper">

  <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/slide-1.jpg)">
    <div class="overlay overlay-a"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="intro-body">
                <p class="intro-title-top">Doral, Florida
                  <br> 78345
                </p>
                <h1 class="intro-title mb-4 ">
                  <span class="color-b">204 </span> Mount
                  <br> Olive Road Two
                </h1>
                <p class="intro-subtitle intro-price">
                  <a href="#"><span class="price-a">Buy | $ 12.000</span></a>
                  <a href="#"><span class="price-a" data-bs-toggle="modal" data-bs-target="#exampleModal">Bid <i class="bi bi-coin"></i></span></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
require_once "Admin/include/classes/meekrodb.2.3.class.php";
require('Admin/db_config.php');

// Fetch data from the plot_listing table using MeekroDB
$rows = DB::query("SELECT * FROM plot_listing");

// Check if there are results
if ($rows) {
    foreach ($rows as $row) {
?>
        <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(<?php echo $row['plot_image']; ?>)">
            <div class="overlay overlay-a"></div>
            <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <p class="intro-title-top"><?php echo $row['plot_location']; ?>
                                        <br> <?php echo $row['plot_num']; ?>
                                    </p>
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b"><?php echo $row['plot_num']; ?> </span> <?php echo $row['plot_title']; ?>
                                    </h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Buy | $ 12.000</span></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="price-a">Bid <i class="bi bi-coin"></i></span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "0 results";
}
?>


</div>
<div class="swiper-pagination"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Your Details.<input type="hidden" name="plot_num" value="<?php echo $row['plot_num']; ?>"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <label for="name" class="form-control fw-bold">Username</label>
        <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username">
        <br>
        <label for="email" class="form-control fw-bold">Email</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email">
        <br>
        <label for="bid" class="form-control fw-bold">Bid Amount</label>
        <input type="number" class="form-control" placeholder="Rs." name="bid" id="bid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


































































<!-- <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/slide-2.jpg)">
    <div class="overlay overlay-a"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="intro-body">
                <p class="intro-title-top">Doral, Florida
                  <br> 78345
                </p>
                <h1 class="intro-title mb-4">
                  <span class="color-b">204 </span> Rino
                  <br> Venda Road Five
                </h1>
                <p class="intro-subtitle intro-price">
                  <a href="#"><span class="price-a">Buy | $ 12.000</span></a>
                  <a href="#"><span class="price-a">Bid <i class="bi bi-coin"></i></span></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/slide-3.jpg)">
    <div class="overlay overlay-a"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="intro-body">
                <p class="intro-title-top">Doral, Florida
                  <br> 78345
                </p>
                <h1 class="intro-title mb-4">
                  <span class="color-b">204 </span> Alira
                  <br> Roan Road One
                </h1>
                <p class="intro-subtitle intro-price">
                  <a href="#"><span class="price-a">Buy | $ 12.000</span></a>
                  <a href="#"><span class="price-a">Bid <i class="bi bi-coin"></i></span></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->