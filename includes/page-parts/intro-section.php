<div class="intro intro-carousel swiper position-relative">

  <div class="swiper-wrapper">

    <?php
    include("Admin/db_config.php");


    // Fetch data from home_content_slider table
    $slides = DB::query("SELECT * FROM home_content_slider ORDER BY property_num");

    // Check if there are slides available
    if ($slides) {
      foreach ($slides as $slide) {
        // Extract data from the fetched row
        $background_image = $slide['property_image'];
        $location = $slide['property_location'];
        $property_title = $slide['property_title'];
        $property_address = $slide['property_num'];
        $property_price = $slide['property_price'];
        $property_status = $slide['property_status'];
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
                        <?php if ($property_status == 1) : ?>
                          <a href="#"><span class="price-a">Buy | Rs. <?php echo $property_price; ?></span></a>
                          <span type="button" class="price-a" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $slide['id']; ?>" data-property-id="<?php echo $slide['id']; ?>">Bid</span>
                        <?php elseif ($property_status == 3) : ?>
                          <span class="price-a">Sold</span>
                        <?php endif; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
<?php foreach ($properties as $property) { ?>
  <div class="modal fade" id="Modal<?php echo $property['plot_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel<?php echo $property['plot_id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <?php
          // echo $property['plot_id'];
          // Assuming $property['added_on'] contains the added-on date from your database
          $addedOnDate = date('Y-m-d', strtotime($property['added_on']));
          date_default_timezone_set('Asia/Karachi');
          $currentDate = date("Y-m-d");

          // Calculate the difference in days
          $daysDifference = floor(strtotime($currentDate) - strtotime($addedOnDate)) / (60 * 60 * 24);

          // Calculate the remaining bidding days
          $daysLeft = max(0, $property['bidding_days'] - $daysDifference);

          // If there are still bidding days left, display the time left
          if ($daysLeft > 0) {
            echo '<h1 class="modal-title fs-5" id="ModalLabel' . $property['plot_id'] . '">&nbsp;Bidding Time Left: ' . $daysLeft . ' days</h1>';
          } else {
            echo '<h1 class="modal-title fs-5" id="ModalLabel' . $property['plot_id'] . '">&nbsp;Bidding has ended</h1>';
          }
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="bid" method="post">
            <label for="name" class="form-control fw-bold">Username<input type="hidden" name="plot_id" value="<?php echo $property['plot_id']; ?>" id="propertyIdInput"></label>
            <input type="text" required class="form-control" placeholder="Enter your username" name="username" id="username">
            <br>
            <label for="email" class="form-control fw-bold">Email</label>
            <input type="email" required class="form-control" placeholder="Enter your email" name="email" id="email">
            <br>
            <label for="bid" class="form-control fw-bold">Bid Amount</label>
            <?php
            // Fetch minimum bid amount and plot price from the database
            $minBidAmount = $property['plot_price'];

            // Display the minimum bid amount and plot price in the input field
            echo '<input type="text" required class="form-control" placeholder="Minimum Bid: Rs. ' . $minBidAmount . '" name="bid" id="bid">';
            ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add-bid" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script>
  // JavaScript to update the hidden input value when Bid button is clicked
  document.querySelectorAll('.price-a').forEach(function(bidButton) {
    bidButton.addEventListener('click', function() {
      var propertyId = this.getAttribute('data-property-id');
      document.getElementById('propertyIdInput').value = propertyId;
    });
  });
</script>

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