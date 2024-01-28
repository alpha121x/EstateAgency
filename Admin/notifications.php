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

                                                    <a href="#" id="markAsRead"><i class="bi bi-alarm-fill"></i></a>
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

    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php
// Your database connection and session handling code goes here

// Update the 'is_read' status for the notifications (example query)
// Adjust this query based on your database schema
$updated = DB::update('notifications', ['is_read' => 1], 'your_condition_here');

if ($updated) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>


<!-- Your script -->
<script>
$(document).ready(function() {
    $('#markAsRead').on('click', function(e) {
        e.preventDefault();
        
        // Perform AJAX request to mark notifications as read
        $.ajax({
            url: '', // Update with your server-side script
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Update the UI or perform additional actions if needed
                    console.log('Notifications marked as read.');
                    
                    // Add code to update the UI as needed
                    // For example, hide or change the icon color
                } else {
                    console.error('Failed to mark notifications as read.');
                }
            },
            error: function(error) {
                console.error('Error in AJAX request:', error);
            }
        });
    });
});
</script>


    <?php include("include/footer.php") ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php include("include/script-files.php") ?>

</body>

</html>