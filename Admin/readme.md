<?php
require_once "Admin/include/classes/meekrodb.2.3.class.php";
require('Admin/db_config.php');

// Fetch plot listings from the database
$plotListings = DB::query("SELECT * FROM plot_listing");

?>

<div class="intro intro-carousel swiper position-relative">
    <div class="swiper-wrapper">
        <?php foreach ($plotListings as $plot) : ?>
            <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/<?php echo $plot['plot_image']; ?>)">
                <div class="overlay overlay-a"></div>
                <div class="intro-content display-table">
                    <div class="table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="intro-body">
                                        <p class="intro-title-top"><?php echo $plot['plot_location']; ?></p>
                                        <h1 class="intro-title mb-4 ">
                                            <span class="color-b"><?php echo $plot['plot_num']; ?></span>
                                            <br><?php echo $plot['plot_title']; ?>
                                        </h1>
                                        <p class="intro-subtitle intro-price">
                                            <a href="#"><span class="price-a">Buy | $12,000</span></a>
                                            <a href="#"><span class="price-a" data-bs-toggle="modal" data-bs-target="#exampleModal">Bid <i class="bi bi-coin"></i></span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>