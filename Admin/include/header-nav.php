<?php require("auth.php"); ?>
<?php require("db_config.php"); ?>
<?php
// Use DB::queryFirstRow to get a single row directly
$user_data = DB::queryFirstRow("SELECT * FROM admin_users WHERE username=%s", $_SESSION['user']);
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->


      <!-- alert pop up -->
      <div id="message-alert" class="alert alert-success alert-dismissible position-absolute top-0 start-50 translate-middle-x mt-1 ms-4" role="alert" style="display: none;">
        <strong>You have unread messages.</strong>
      </div>

      <div id="notification-alert" class="alert alert-success alert-dismissible position-absolute top-0 start-50 translate-middle-x mt-1 ms-4" role="alert" style="display: none;">
        <strong>You have unread notifications.</strong>
      </div>
      <!-- Notification Nav -->
      <?php
      $notificationCount = DB::queryFirstField("SELECT COUNT(*) FROM notifications WHERE is_read = 0");
      $notifications = DB::query("SELECT * FROM notifications WHERE is_read = 0 ORDER BY id DESC");
      $counter = 0;
      ?>

      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <?php if ($notificationCount > 0) : ?>
            <span class="badge bg-primary badge-number">
              <?php echo ($notificationCount > 9) ? '9+' : $notificationCount; ?>
            </span>
          <?php endif; ?>
        </a>

        <!-- Notification Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have <?php echo ($notificationCount > 9) ? '9+' : $notificationCount; ?> new notifications
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <?php
          foreach ($notifications as $notification) :
            if ($counter >= 3) {
              break;
            }
          ?>
            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4><?php echo $notification['title']; ?></h4>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
          <?php
            $counter++;
          endforeach;
          ?>

          <?php
          if (!isset($_SESSION['notification_sound_played']) && isset($_SESSION['user']) && $notificationCount > 0) {
          ?>
            <script>
              function showNotificationAlert() {
                var notificationAlert = document.getElementById('notification-alert');
                notificationAlert.style.display = 'block';

                setTimeout(function() {
                  notificationAlert.style.display = 'none';
                }, 3000);
              }

              var audio = new Audio('assets/sounds/notifications.mp3');
              audio.play();
              showNotificationAlert();

              <?php $_SESSION['notification_sound_played'] = true; ?>
            </script>
          <?php
          }
          ?>


          <li class="dropdown-footer">
            <a href="notifications.php">Show all notifications</a>
          </li>
        </ul><!-- End Notification Dropdown Items -->
      </li>
      <!-- End Notification Nav -->


      <?php
      // Fetch messages from the contact_messages table
      $messages = DB::query("SELECT * FROM contact_messages ORDER BY id DESC LIMIT 3");

      // Check if there are messages
      if ($messages) {
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number"><?php echo count($messages); ?></span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have <?php echo count($messages); ?> new messages
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php foreach ($messages as $message) : ?>
              <li class="message-item">
                <a href="#">
                  <img src="assets/img/message.png" alt="" class="rounded-circle">
                  <div>
                    <h4><?php echo $message['name']; ?></h4>
                    <p><?php echo substr($message['message'], 0, 50); ?>...</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php endforeach; ?>

            <?php
            // Check if the sound notification has been played in the current session
            if (!isset($_SESSION['messages_sound_played']) && isset($_SESSION['user']) && count($messages) > 0) {
              // Set a delay (in milliseconds) before playing the sound
              $delay = 4000; // 5000 milliseconds (5 seconds)
            ?>
              <script>
                // Function to show the hidden div
                function showmessageAlert() {
                  var messageAlert = document.getElementById('message-alert');
                  messageAlert.style.display = 'block';

                  setTimeout(function() {
                    messageAlert.style.display = 'none';
                  }, 5000); // 5000 milliseconds (5 seconds) for the alert to fade away
                }

                setTimeout(function() {
                  var audio = new Audio('assets/sounds/messages.mp3');
                  audio.play();
                  showmessageAlert(); // Call the function to show the hidden div
                }, <?php echo $delay; ?>);

                // Set the session variable to indicate that the sound has been played
                <?php $_SESSION['messages_sound_played'] = true; ?>
              </script>
            <?php
            }
            ?>



            <!-- Your existing code for displaying messages goes here -->

            <li class="dropdown-footer">
              <a href="messages.php">Show all messages</a>
            </li>
          </ul><!-- End Messages Dropdown Items -->
        </li>
      <?php
      } else {
        // If there are no messages
        echo '<li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
            </a>
          </li>';
      }
      ?>
      <!-- End Messages Nav -->


      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?php echo $user_data['user_image']; ?>" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">
          </span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $user_data['username']; ?></h6>
            <span><?php echo $user_data['user_type']; ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users_profile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="admin-profile.php">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->