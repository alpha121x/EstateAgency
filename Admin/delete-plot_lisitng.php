<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['deleteid'])) {
    $plot_id = $_GET['deleteid'];

    // Delete query using MeekroDB
    $deleted = DB::delete('plot_listing', 'plot_id=%i', $plot_id);

    if ($deleted) {
        header("Location: plot_listing");
    } else {
        header("Location: plot_listing");
    }
} else {
    // Handle the case where no user ID is provided in the URL
    header("Location: plot_listing");
}
?>