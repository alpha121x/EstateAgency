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
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/slide-2.jpg)">
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
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
include("Admin/db_config.php");


// Fetch data from home_content_slider table
$slides = DB::query("SELECT * FROM home_content_slider");

// Check if there are slides available
if ($slides) {
    foreach ($slides as $slide) {
        // Extract data from the fetched row
        $background_image = $slide['property_image'];
        $location = $slide['property_location'];
        $property_title = $slide['property_title'];
        $property_address = $slide['property_num'];
        $property_price = $slide['property_price'];
?>

        <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(Admin/<?php echo $background_image; ?>)">
            <div class="overlay overlay-a"></div>
            <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <p class="intro-title-top"><?php echo $location; ?></p>
                                    <h1 class="intro-title mb-4">
                                        <span class="color-b"><?php echo $property_address; ?></span><br>
                                        <?php echo $property_title; ?>
                                    </h1>
                                    <p class="intro-subtitle intro-price">
                                        <a href="#"><span class="price-a">Buy | Rs. <?php echo $property_price; ?></span></a>
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
    // Handle the case where no slides are available
    echo "No slides available.";
}
?>



  </div>
  <div class="swiper-pagination"></div>
</div>

