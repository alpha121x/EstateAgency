<section class="property-grid grid">
  <div class="container">
    <div class="row">
      <?php
      require_once "Admin/include/classes/meekrodb.2.3.class.php";
      require('Admin/db_config.php'); // Make sure you include your database configuration file

      $propertiesPerPage = 6;

      // Get the current page number from the URL
      $page = isset($_GET['page']) ? $_GET['page'] : 1;

      // Calculate the offset for the query
      $offset = ($page - 1) * $propertiesPerPage;

      // Fetch data from the plot_listing table with pagination
      $properties = DB::query("SELECT * FROM plot_listing ORDER BY plot_id DESC LIMIT %i OFFSET %i", $propertiesPerPage, $offset);

      // Fetch the total number of properties for pagination
      $totalProperties = DB::queryFirstField("SELECT COUNT(*) FROM plot_listing");

      // Calculate the total number of pages
      $totalPages = ceil($totalProperties / $propertiesPerPage);


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
                    <span type="button" class="price-a" data-bs-toggle="modal" data-bs-target="#exampleModal">Bid</span>
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
            <!-- Previous Page Link -->
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
              <a class="page-link" href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>" tabindex="-1">
                <span class="bi bi-chevron-left"></span>
              </a>
            </li>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
              <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
              <a class="page-link" href="?page=<?php echo ($page < $totalPages) ? $page + 1 : $totalPages; ?>">
                <span class="bi bi-chevron-right"></span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Your Details.</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="bid" method="post">
          <label for="name" class="form-control fw-bold">Username<input type="hidden" name="plot_id" value="<?php echo $property['plot_id'];  ?>"></label>
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
        <button type="submit" name="add-bid" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>