<?php
require_once "Admin/include/classes/meekrodb.2.3.class.php";
require('Admin/db_config.php');

// Fetch properties from the database using MeekroDB (replace 'your_table_name' with the actual table name)
$properties = DB::query("SELECT * FROM plot_listing ORDER BY added_on DESC LIMIT 3");

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
              <a href="property-grid">See all properties
                <span class="bi bi-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($properties as $property) { ?>
          <div class="col-md-4">
            <div class="card-box-a card-shadow">
              <div class="img-box-a">
                <img src="./Admin/<?php echo $property['plot_image']; ?>" alt="" class="img-a img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-overlay-a-content">
                  <div class="card-header-a">
                    <h2 class="card-title-a">
                      <a href="property-single?id=<?php echo $property['plot_id']; ?>"><?php echo $property['plot_num'] . ' ' . $property['plot_title']; ?></a>
                    </h2>
                  </div>
                  <div class="card-body-a">
                    <div class="price-box d-flex">
                      <span class="price-a">
                        <?php
                        $statusLabels = [
                          1 => 'For Sale',
                          2 => 'For Rent',
                          3 => 'Sold',
                          4 => 'Under Contract',
                          5 => 'Reserved',
                          6 => 'Development in Progress',
                          7 => 'Not Available'
                        ];

                        $statusValue = $property['plot_status'];
                        $statusLabel = isset($statusLabels[$statusValue]) ? $statusLabels[$statusValue] : 'Unknown Status';

                        echo $statusLabel . ' | Rs. ' . $property['plot_price'];
                        ?>
                      </span>
                      &nbsp;
                      <span type="button" class="price-a" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $property['plot_id']; ?>" data-property-id="<?php echo $property['plot_id']; ?>">Bid</span>
                    </div>
                    <a href="property-single?id=<?php echo $property['plot_id']; ?>" class="link-a">Click here to view
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
          </div><!-- End property card -->
        <?php } ?>
      </div>
    </div>
  </section>
<?php
} else {
  echo "No properties found in the database.";
}
?>

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