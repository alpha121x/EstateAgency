<?php require("auth.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dashboard - NiceAdmin</title>

    <?php include("include/linked-files.php") ?>

</head>

<body>

    <?php include("include/header-nav.php") ?>

    <?php include("include/side-nav.php") ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Notifications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datatables</h5>
                            <p>Edit Notifications record.</p>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Changes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("db_config.php");
                                    require_once("include/classes/meekrodb.2.3.class.php");

                                    // Select all users from the admin_users table
                                    $users = DB::query("SELECT * FROM notifications WHERE is_read = 0 ORDER BY id DESC");

                                    if ($users) {
                                        foreach ($notifications as $notification) {
                                    ?>
                                            <!-- Display data in the rows -->
                                            <tr>
                                                <td><?php echo $notification['title']; ?></td>
                                                <td><?php echo substr($notification['message'], 0, 71); ?>...</td>
                                                <td><?php echo $notification['created_by']; ?></td>
                                                <td>
                                                    <a href=''><i class="bi bi-eye-fill"></i></a>

                                                    <a href="notifications.php" data-notification-id="<?php echo $notification['id']; ?>" id="markAsRead"><i class="bi bi-alarm-fill"></i></a>

                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No notifications found in the database.";
                                    }
                                    ?>


                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php
    // notifications.php

    // Check if it's an AJAX request and the notification_id parameter is set
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification_id'])) {
        // Include your database configuration and connection code here
        require_once "include/classes/meekrodb.2.3.class.php";
        require('db_config.php');

        $notificationId = $_POST['notification_id'];

        // Update the database to mark the specific notification as read
        $updated = DB::update('notifications', ['is_read' => 1], 'id=%i', $notificationId);

        if ($updated) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }

        exit(); // Stop further execution
    }

    // Handle other parts of your server-side code below if needed
    ?>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('#markAsRead').forEach(function(markAsReadBtn) {
                markAsReadBtn.addEventListener('click', function() {
                    var notificationId = this.getAttribute('data-notification-id');
                    markNotificationAsRead(notificationId);
                });
            });

            function markNotificationAsRead(notificationId) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'notifications.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    // Update your UI or perform any additional actions
                                } else {
                                    // Handle error
                                }
                            } catch (error) {
                                console.error('Error parsing JSON response:', error);
                                // Handle parsing error
                            }
                        } else {
                            console.error('HTTP request failed with status:', xhr.status);
                            // Handle HTTP request error
                        }
                    }
                };
                xhr.send('notification_id=' + notificationId);
            }
        });
    </script>


    <?php include("include/footer.php") ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php include("include/script-files.php") ?>

</body>

</html>