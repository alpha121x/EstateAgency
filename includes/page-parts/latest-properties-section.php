<?php
require_once "Admin/include/classes/meekrodb.2.3.class.php";
require('Admin/db_config.php'); // Make sure you include your database configuration file

// Fetch properties from the database using MeekroDB (replace 'your_table_name' with the actual table name)
$properties = DB::query("SELECT * FROM plot_listing");

// Check if there are results
if ($properties) {
?>
  <section class="section-property section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Latest Properties</h2>
            </div>
            <div class="title-link">
              <a href="property-grid">All Property
                <span class="bi bi-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div id="property-carousel" class="swiper">
        <div class="swiper-wrapper">
          <?php foreach ($properties as $property) { ?>
            <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="./Admin/<?php echo $property['plot_image']; ?>" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <h2 class="card-title-a">
                        <a href="property-single.html"><?php echo $property['plot_num'] . ' ' . $property['plot_title']; ?></a>
                      </h2>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">Buy $ <?php echo $property['plot_price']; ?></span>
                      </div>
                      <a href="#" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                    <ul class="card-info d-flex justify-content-around">
                    <li>
                      <h4 class="card-info-title">Area</h4>
                      <span><?php echo $property['plot_area']; ?>m
                        <sup>2</sup>
                      </span>
                    </li>
                    <?php if ($property['property_type'] == 'House') : ?>
                      <li>
                        <h4 class="card-info-title">Beds</h4>
                        <span><?php echo $property['beds']; ?></span>
                      </li>
                      <li>
                        <h4 class="card-info-title">Baths</h4>
                        <span><?php echo $property['baths']; ?></span>
                      </li>
                      <li>
                        <h4 class="card-info-title">Garages</h4>
                        <span>1</span>
                      </li>
                    <?php else : ?>
                      <!-- Display only the 'Area' for property types other than 'House' -->
                    <?php endif; ?>

                  </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End carousel item -->
          <?php } ?>
        </div>
      </div>
      <div class="propery-carousel-pagination carousel-pagination"></div>
    </div>
  </section>
<?php
} else {
  echo "No properties found in the database.";
}
?>