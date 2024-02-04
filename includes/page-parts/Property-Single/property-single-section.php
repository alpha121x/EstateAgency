<section class="property-single nav-arrow-b">
  <?php
  require('Admin/db_config.php'); // Make sure you include your database configuration file

  // Assuming you have the property ID in the URL
  $propertyId = isset($_GET['id']) ? $_GET['id'] : null;

  // Fetch property details from the plot_listing table
  $propertyDetails = DB::queryFirstRow("SELECT * FROM plot_listing WHERE plot_id = %i", $propertyId);

  ?>

  <div class="container">
  <div class="row justify-content-center">
  <!-- 75% space for image -->
  <div class="col-lg-9">
    <img src="Admin/<?php echo $propertyDetails['plot_image']; ?>" alt="" width="80%"  class="img-fluid">
  </div>

  <!-- 25% space for Top 3 Bids -->
  <div class="col-lg-3">
    <div class="row">
      <div class="col-md-12">
        <h3>Top 3 Bids</h3>
        <ul>
          <?php
          // Fetch top 3 highest bids from plot_bidding table
          $topBids = DB::query("SELECT pb.bid_id, pb.plot_id, pb.user_name, pb.bid, pl.plot_num
          FROM plot_bidding pb
          JOIN plot_listing pl ON pb.plot_id = pl.plot_id
          WHERE pb.plot_id = %i
          ORDER BY pb.bid DESC
          LIMIT 3", $propertyId);

          foreach ($topBids as $bid) :
            $plot_id = $bid['plot_id'];
            $plot_num = DB::queryFirstField("SELECT plot_num FROM plot_listing WHERE plot_id = %i", $plot_id);
          ?>
            <li>
              <strong><?php echo $bid['user_name']; ?>:</strong>
              Bid Amount: Rs. <?php echo number_format($bid['bid']); ?> for Plot Num <?php echo $plot_num; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

    <br>


    <div class="row">
      <div class="col-sm-12">
        <div class="row justify-content-between">
          <div class="col-md-5 col-lg-4">
            <!-- Property Price -->
            <div class="property-price d-flex justify-content-center foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="bi bi-cash">$</span>
                </div>
                <div class="card-title-c align-self-center">
                  <h5 class="title-c"><?php echo $propertyDetails['plot_price']; ?></h5>
                </div>
              </div>
            </div>

            <!-- Property Summary - Populate with PHP -->
            <div class="property-summary">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d section-t4">
                    <h3 class="title-d">Quick Summary</h3>
                  </div>
                </div>
              </div>
              <div class="summary-list">
                <ul class="list">
                  <li class="d-flex justify-content-between">
                    <strong>Property ID:</strong>
                    <span><?php echo $propertyDetails['plot_id']; ?></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Location:</strong>
                    <span><?php echo $propertyDetails['plot_location']; ?></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Property Type:</strong>
                    <span><?php echo $propertyDetails['property_type']; ?></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Status:</strong>
                    <span>Sale</span>
                  </li>

                  <?php if ($propertyDetails['property_type'] === 'House') : ?>
                    <li class="d-flex justify-content-between">
                      <strong>Beds:</strong>
                      <span><?php echo $propertyDetails['beds']; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Baths:</strong>
                      <span><?php echo $propertyDetails['baths']; ?></span>
                    </li>
                  <?php else : ?>
                    <li class="d-flex justify-content-between">
                      <strong>Area:</strong>
                      <span><?php echo $propertyDetails['plot_area']; ?>m<sup>2</sup></span>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-7 col-lg-7 section-md-t3">
            <!-- Property Description - Populate with PHP -->
            <div class="row">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Property Description</h3>
                </div>
              </div>
            </div>
            <div class="property-description">
              <p class="description color-text-a">
                <?php echo $propertyDetails['plot_description']; ?>
              </p>
            </div>
            <div class="row section-t3">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Amenities</h3>
                </div>
              </div>
            </div>
            <div class="amenities-list color-text-a">
              <ul class="list-a no-margin">
                <li>Balcony</li>
                <li>Outdoor Kitchen</li>
                <li>Cable Tv</li>
                <li>Deck</li>
                <li>Tennis Courts</li>
                <li>Internet</li>
                <li>Parking</li>
                <li>Sun Room</li>
                <li>Concrete Flooring</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-10 offset-md-1">
        <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="true">Video</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans" aria-selected="false">Floor Plans</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-map-tab" data-bs-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false">Ubication</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
            <iframe src="https://player.vimeo.com/video/73221098" width="100%" height="460" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
          <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
            <img src="assets/img/plan2.jpg" alt="" class="img-fluid">
          </div>
          <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row section-t3">
          <div class="col-sm-12">
            <div class="title-box-d">
              <h3 class="title-d">Contact Agent</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <img src="assets/img/agent-4.jpg" alt="" class="img-fluid">
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="property-agent">
              <h4 class="title-agent">Anabella Geller</h4>
              <p class="color-text-a">
                Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet
                dui. Quisque velit nisi,
                pretium ut lacinia in, elementum id enim.
              </p>
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between">
                  <strong>Phone:</strong>
                  <span class="color-text-a">(222) 4568932</span>
                </li>
                <li class="d-flex justify-content-between">
                  <strong>Mobile:</strong>
                  <span class="color-text-a">777 287 378 737</span>
                </li>
                <li class="d-flex justify-content-between">
                  <strong>Email:</strong>
                  <span class="color-text-a">annabella@example.com</span>
                </li>
                <li class="d-flex justify-content-between">
                  <strong>Skype:</strong>
                  <span class="color-text-a">Annabela.ge</span>
                </li>
              </ul>
              <div class="socials-a">
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="bi bi-facebook" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="bi bi-twitter" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="bi bi-instagram" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="bi bi-linkedin" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <div class="property-contact">
              <form class="form-a">
                <div class="row">
                  <div class="col-md-12 mb-1">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg form-control-a" id="inputName" placeholder="Name *" required>
                    </div>
                  </div>
                  <div class="col-md-12 mb-1">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-lg form-control-a" id="inputEmail1" placeholder="Email *" required>
                    </div>
                  </div>
                  <div class="col-md-12 mb-1">
                    <div class="form-group">
                      <textarea id="textMessage" class="form-control" placeholder="Comment *" name="message" cols="45" rows="8" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-a">Send Message</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>