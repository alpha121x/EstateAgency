<?php
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
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_image'] = $row['user_image'];
        $_SESSION['user_type'] = $row['user_type']; // Assuming 'user_type' is the column name

        header("Location: index");
        exit(); // Stop further execution
    } else {
        header("Location: login");
        exit(); // Stop further execution
    }
} else {
    echo "Invalid credentials...";
}
?>
