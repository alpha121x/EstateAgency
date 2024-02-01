<?php
include('Admin/db_config.php');
// get the post id from the url
$id = $_GET['agent_id'];
// get the post category from the database
$agent = DB::queryFirstRow("SELECT * FROM agents WHERE agent_id=%i", $id);
?>
<section class="agent-single">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-md-6">
            <div class="agent-avatar-box">
              <img src="Admin/<?php echo $agent['agent_image']; ?>" alt="" class="agent-avatar img-fluid">
            </div>
          </div>
          <div class="col-md-5 section-md-t3">
            <div class="agent-info-box">
              <div class="agent-title">
                <div class="title-box-d">
                  <h3 class="title-d"><?php echo $agent['agent_name']; ?></h3>
                </div>
              </div>
              <div class="agent-content mb-3">
                <p class="content-d color-text-a"><?php echo $agent['agent_about']; ?></p>
                <div class="info-agents color-a">
                  <p>
                    <strong>Phone: </strong>
                    <span class="color-text-a"><?php echo $agent['agent_phone']; ?></span>
                  </p>
                  <p>
                    <strong>Mobile: </strong>
                    <span class="color-text-a"><?php echo $agent['agent_phone']; ?></span>
                  </p>
                  <p>
                    <strong>Email: </strong>
                    <span class="color-text-a"><?php echo $agent['agent_email']; ?></span>
                  </p>
                </div>
              </div>
              <div class="socials-footer">
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <a href="#" class="link-one">
                      <i class="bi bi-facebook" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#" class="link-one">
                      <i class="bi bi-twitter" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#" class="link-one">
                      <i class="bi bi-instagram" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#" class="link-one">
                      <i class="bi bi-linkedin" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 section-t8">
        <div class="title-box-d">
          <h3 class="title-d">My Properties</h3>
        </div>
      </div>
      <div class="row property-grid grid">
        <div class="col-sm-12">
          <div class="grid-option">
            <form>
              <select class="custom-select">
                <option selected>All</option>
                <option value="1">New to Old</option>
                <option value="2">For Rent</option>
                <option value="3">For Sale</option>
              </select>
            </form>
          </div>
        </div>
        <?php
        require_once "Admin/include/classes/meekrodb.2.3.class.php";
        require('Admin/db_config.php');

        $propertiesPerPage = 6;

        $agentname = $agent['agent_name'];

        // Fetch the first and last name from the admin_users table
        $userInfo = DB::queryFirstRow("SELECT * FROM admin_users WHERE first_name = %s", $agentname);

        // Access the first and last name from the $userInfo array
        $username = $userInfo['username'];

        // Get the current page number from the URL
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the offset for the query
        $offset = ($page - 1) * $propertiesPerPage;

        // Fetch data from the plot_listing table with pagination and agent's username parameter
        $properties = DB::query(
          "SELECT * FROM plot_listing WHERE username = %s LIMIT %i OFFSET %i",
          $username,
          $propertiesPerPage,
          $offset
        );

        // Fetch the total number of properties for pagination with agent's username parameter
        $totalProperties = DB::queryFirstField(
          "SELECT COUNT(*) FROM plot_listing WHERE username = %s",
          $username
        );

        // Calculate the total number of pages
        $totalPages = ceil($totalProperties / $propertiesPerPage);

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
  </div>
</section>