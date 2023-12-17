<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['deleteid'])) {
    $user_id = $_GET['deleteid'];

    // Delete query using MeekroDB
    $deleted = DB::delete('admin_users', 'user_id=%i', $user_id);

    if ($deleted) {
        header("Location: admin_users.php");
    } else {
        header("Location: admin_users.php");
    }
} else {
    // Handle the case where no user ID is provided in the URL
    header("Location: admin_users.php");
}
?>

<?php
include("db_config.php");

// Check if user ID is provided in the URL
if (isset($_GET['deleteid'])) {
    $user_id = $_GET['deleteid'];

    // Delete query using MeekroDB
    $deleted = DB::delete('users_address', 'user_id=%i', $user_id);

    if ($deleted) {
        header("Location: users_address.php");
    } else {
        header("Location: users_address.php");
    }
} else {
    // Handle the case where no user ID is provided in the URL
    header("Location: users_address.php");
}
?>
