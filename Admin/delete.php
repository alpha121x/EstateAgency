<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['deleteid'])) {
    $user_id = $_GET['deleteid'];

    // Get the total number of records
    $totalRecords = DB::queryFirstField("SELECT COUNT(*) FROM admin_users");

    // Check if there is only one record left
    if ($totalRecords > 1) {
        // Delete query using MeekroDB
        $deleted = DB::delete('admin_users', 'id=%i', $user_id);

        if ($deleted) {
            header("Location: admin_users.php");
        } else {
            header("Location: admin_users.php");
        }
    } else {
        // If there's only one record left, show an alert and don't allow deletion
        echo "<script>alert('Cannot delete the Admin user.');</script>";
        echo "<script>window.location.href='admin_users.php';</script>";
    }
} else {
    // Handle the case where no user ID is provided in the URL
    header("Location: admin_users.php");
}
?>
