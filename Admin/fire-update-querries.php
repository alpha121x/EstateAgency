<?php
require_once "include/classes/meekrodb.2.3.class.php";
include('db_config.php');

// Update user details
if (isset($_POST['update-user'])) {
    $user_edit_page_id = $_POST['user-edit-page-id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $user_image = $_POST['user_image'];

    // Update query using MeekroDB
    $updated = DB::update('admin_users', [
        'username' => $username,
        'email' => $email,
        'user_type' => $user_type,
        'user_image' => $user_image
    ], 'id=%i', $user_edit_page_id);

    if ($updated) {
        header("Location: admin_users.php");
    }
}
?>
<?php
// Update user password
if (isset($_POST['update-password'])) {
    $password = $_POST['renewpassword'];

    // Update query using MeekroDB
    $updated_password = DB::update('admin_users', ['password' => $password], 'LIMIT 1');

    if ($updated_password) {
        header("Location: admin-profile.php");
    }
}
?>

<?php 
// Update user-address details
if (isset($_POST['update-plot'])) {
    $plot_edit_page_id = $_POST['plot_listing_edit_page_id'];
    $plot_num = $_POST['plot_num'];
    $plot_tite = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];
    $plot_image = $_POST['plot_image'];

    // Update query using MeekroDB
    $updated = DB::update('plot_listing', [
        'plot_num' => $plot_num,
        'plot_title' => $plot_tite,
        'plot_location' => $plot_location,
        'plot_description' => $plot_description,
        'plot_image' => $plot_image
    ], 'plot_id=%i', $plot_edit_page_id);

    if ($updated) {
        header("Location: plot_listing.php");
    }
}

?>
