<?php
require_once "include/classes/meekrodb.2.3.class.php";
require('db_config.php');

if (isset($_POST['add-user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $user_image = $_POST['user_image'];

    // Insert query using MeekroDB
    $inserted = DB::insert('admin_users', [
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'user_type' => $user_type,
        'user_image' => $user_image
    ]);

    if ($inserted) {
        header("Location: add-user-profile.php");
    }
}
?>

<?php
require_once "include/classes/meekrodb.2.3.class.php";
require('db_config.php');

if (isset($_POST['add-user-address'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_address = $_POST['user_address'];

    // Insert query using MeekroDB
    $inserted = DB::insert('users_address', [
        'username' => $username,
        'email' => $email,
        'user-address' => $user_address
    ]);

    if ($inserted) {
        header("Location: add_user_address.php");
    }
}
?>

