<?php
// Include MeekroDB library
require_once 'include/classes/meekrodb.2.3.class.php';
include("db_config.php");

if (isset($_POST['login'])) {
    $log_password = $_POST['password'];
    $username = $_POST['username'];

    // Use DB::queryFirstRow to get a single row directly
    $row = DB::queryFirstRow("SELECT * FROM admin_users WHERE username=%s AND password = %s", $username, $log_password);

    if ($row) {
        session_start(); // Start session

        // Store user information in session variables
        $_SESSION['user'] = $username;
        $_SESSION['user_type'] = $row['user_type']; // Assuming 'user_type' is the column name

        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
} else {
    echo "Invalid credentials...";
}
?>
