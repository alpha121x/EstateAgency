<?php
require_once "include/classes/meekrodb.2.3.class.php";
require('db_config.php');

if (isset($_POST['add-user'])) {
    $username = $_POST['username'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

     // File Upload
     $uploadsFolder = 'uploads/';
     $user_image = $uploadsFolder . basename($_FILES['user_iamge']['name']);
     $uploadSuccess = move_uploaded_file($_FILES['user_image']['tmp_name'], $user_image);
 
     if (!$uploadSuccess) {
         echo "Error uploading file.";
         exit;
     }

    // Insert query using MeekroDB
    $inserted = DB::insert('admin_users', [
        'username' => $username,
        'first_name' => $first_name,
        'last_name' => $last_name,
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

if (isset($_POST['add-plot'])) {
    $plot_num = $_POST['plot_num'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];
    $plot_price = $_POST['plot_price'];

    // File Upload
    $uploadsFolder = 'uploads/';
    $plot_image = $uploadsFolder . basename($_FILES['plot_image']['name']);
    $uploadSuccess = move_uploaded_file($_FILES['plot_image']['tmp_name'], $plot_image);

    if (!$uploadSuccess) {
        echo "Error uploading file.";
        exit;
    }

    // Insert query using MeekroDB
    $inserted = DB::insert('plot_listing', [
        'plot_num' => $plot_num,
        'plot_title' => $plot_title,
        'plot_location' => $plot_location,
        'plot_description' => $plot_description,
        'plot_price' => $plot_price,
        'plot_image' => $plot_image // Save the file path in the database
    ]);

    if ($inserted) {
        header("Location: add_plot_listing.php");
    } else {
        echo "Error inserting data into the database.";
    }
}
?>

