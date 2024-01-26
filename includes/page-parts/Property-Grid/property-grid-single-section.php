<section class="property-grid grid">
  <div class="container">
    <div class="row">
      <?php
      require_once "Admin/include/classes/meekrodb.2.3.class.php";
      require('Admin/db_config.php'); // Make sure you include your database configuration file


      // Fetch data from the database
      $properties = DB::query("SELECT * FROM plot_listing");

      foreach ($properties as $property) {
        // Loop through each row of data and display it
      ?>
        <div class="col-md-4">
          <div class="card-box-a card-shadow">
            <div class="img-box-a">
              <img src="Admin/<?php echo $property['plot_image']; ?>" alt="" class="img-a img-fluid">
            </div>
            <div class="card-overlay">
              <div class="card-overlay-a-content">
                <div class="card-header-a">
                  <h2 class="card-title-a">
                    <a href="#"><?php echo $property['plot_title']; ?></a>
                  </h2>
                </div>
                <div class="card-body-a">
                  <div class="price-box d-flex">
                    <span class="price-a">Buy | $ <?php echo $property['plot_price']; ?></span>
                  </div>
                  <a href="property-single.php?id=<?php echo $property['plot_id'];  ?>" class="link-a">Click here to view
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
        </div>
      <?php
      }
      ?>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <nav class="pagination-a">
          <ul class="pagination justify-content-end">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <span class="bi bi-chevron-left"></span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item next">
              <a class="page-link" href="#">
                <span class="bi bi-chevron-right"></span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>