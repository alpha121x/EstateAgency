<section class="property-single nav-arrow-b">
  <?php
  // Use PHPMailer to send the email
  require 'vendor/autoload.php'; // Include the PHPMailer autoload file

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require('Admin/db_config.php'); // Make sure you include your database configuration file

  // Assuming you have the property ID in the URL
  $propertyId = isset($_GET['id']) ? $_GET['id'] : null;

  // Fetch property details from the plot_listing table
  $propertyDetails = DB::queryFirstRow("SELECT * FROM plot_listing WHERE plot_id = %i", $propertyId);

  // Assuming $propertyDetails['added_on'] contains the added_on date from your database
  $addedOnDate = strtotime($propertyDetails['added_on']);
  $biddingEndDate = strtotime($propertyDetails['bidding_days'], $addedOnDate);

  date_default_timezone_set('Asia/Karachi');
  // Get the current date
  $currentDate = time();

  // // Check if bidding has ended
  // if ($currentDate >= $biddingEndDate) {
  //   // Fetch the top bidder for the specific property
  //   $topBidder = DB::queryFirstRow("
  //   SELECT pb.bid_id, pb.user_email, pb.user_name, pb.bid, pl.plot_num
  //   FROM plot_bidding pb
  //   JOIN plot_listing pl ON pb.plot_id = pl.plot_id
  //   WHERE pb.plot_id = %i
  //   GROUP BY pb.user_name
  //   ORDER BY pb.bid DESC
  //   LIMIT 3", $propertyId);

  //   if ($topBidder) {
  //     // Send congratulatory email to the top bidder
  //     $topBidderName = $topBidder['user_name'];
  //     $topBidAmount = $topBidder['bid'];
  //     $topBidderEmail = $topBidder['user_email'];


  //     // Check if the email has already been sent
  //     if (!isset($_SESSION['email_sent']) || $_SESSION['email_sent'] !== true) {
  //       try {
  //         $mail = new PHPMailer(true);

  //         // Server settings
  //         $mail->SMTPDebug = SMTP::DEBUG_OFF;
  //         $mail->isSMTP();
  //         $mail->Host       = 'smtp.gmail.com'; // Set your SMTP server
  //         $mail->SMTPAuth   = true;
  //         $mail->Username   = 'abbasshakor0123@gmail.com'; // Your SMTP username
  //         $mail->Password   = 'avngwwtgyxeemppm'; // Your SMTP password
  //         $mail->SMTPSecure = 'tls';
  //         $mail->Port       = 587;

  //         // Recipients
  //         $mail->setFrom('abbashakor0123@gmail.com', 'EstateAgency');
  //         $mail->addAddress($topBidderEmail, $topBidderName); // Add the recipient

  //         // Content
  //         $mail->isHTML(true);
  //         $mail->Subject = 'Congratulations! You Won the Bidding';
  //         $mail->Body    = 'Congratulations, ' . $topBidderName . '! Your bid of Rs. ' . $topBidAmount . ' ranked #1. Visit our office or official website for further instructions on completing the purchase process.';
  //         $mail->AltBody = 'Congratulations, ' . $topBidderName . '! Your bid of Rs. ' . $topBidAmount . ' ranked #1. Visit our office or official website for further instructions on completing the purchase process.';
  //         $mail->send();

  //         // Set the session variable to indicate that the email has been sent
  //         $_SESSION['email_sent'] = true;

  //         // echo 'Email has been sent successfully.';
  //       } catch (Exception $e) {
  //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  //       }
  //     }
  //   }
  // }



  ?>

  <div class="container">
    <div class="row justify-content-center">
      <!-- 75% space for image -->
      <div class="col-lg-9">
        <img src="Admin/<?php echo $propertyDetails['plot_image']; ?>" alt="" width="80%" class="img-fluid">
      </div>

      <!-- 25% space for Top 3 Bids -->
      <div class="col-lg-3">
        <div class="row">
          <div class="col-md-12">
            <?php
            require('Admin/db_config.php');

            // Assuming $propertyDetails['added_on'] contains the added_on date from your database
            $addedOnDate = strtotime($propertyDetails['added_on']);
            $currentDate = time();

            // Calculate the remaining bidding days
            $daysLeft = (int)$propertyDetails['bidding_days'] - (int)floor(($currentDate - $addedOnDate) / (60 * 60 * 24));

            // If there are still bidding days left, display the time left
            if ($daysLeft > 0) {
              echo '<h4>Bidding Time Left: ' . $daysLeft . ' days <br> Top 3 Bids</h4>';
              ?>
              <ul>
              <?php
              // Fetch top 3 highest bids from plot_bidding table for a specific plot_id
              $topBids = DB::query("
            SELECT pb.bid_id, pb.plot_id, pb.user_name, pb.bid, pl.plot_num
            FROM plot_bidding pb
            JOIN plot_listing pl ON pb.plot_id = pl.plot_id
            WHERE pb.plot_id = %i
            GROUP BY pb.user_name
            ORDER BY pb.bid DESC
            LIMIT 3", $propertyId);

              foreach ($topBids as $bid) :
                $plot_id = $bid['plot_id'];
                $plot_num = $bid['plot_num'];
              ?>
                <li>
                  <strong><?php echo $bid['user_name']; ?>:</strong>
                  Bid Amount: Rs. <?php echo $bid['bid']; ?>
                </li>
              <?php endforeach; ?>
            </ul>
        <?php
          } else {
          // If no bidding days left, display a message or take appropriate action
          echo '<h4 class="modal-title fs-5" id="exampleModalLabel">&nbsp;Bidding has ended</h4>';
        }
        ?>




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
                  <span class="bi bi-cash">Rs.</span>
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
                    <span><?php echo $propertyDetails['plot_num']; ?></span>
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
                    <span>
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

                      echo $statusLabel;
                      ?>
                    </span>
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