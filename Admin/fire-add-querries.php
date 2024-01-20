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

if (isset($_POST['update-plot'])) {
    // Sanitize and validate input data
    $plot_edit_page_id = $_POST['plot_listing_edit_page_id'];
    $plot_num = $_POST['plot_num'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];

    // File Upload
    $uploadsFolder = 'uploads/';
    $plot_image = $uploadsFolder . basename($_FILES['plot_image']['name']);

    // Check if a new image was provided and update the file path accordingly
    if ($_FILES['plot_image']['size'] > 0) {
        // Remove the existing image file
        $existingImage = DB::queryFirstField("SELECT plot_image FROM plot_listing WHERE plot_id=%i", $plot_edit_page_id);
        if ($existingImage) {
            unlink($existingImage);
        }

        // Upload the new image
        $uploadSuccess = move_uploaded_file($_FILES['plot_image']['tmp_name'], $plot_image);

        if (!$uploadSuccess) {
            echo "Error uploading file.";
            exit;
        }
    } else {
        // If no new image provided, retain the existing image path
        $plot_image = DB::queryFirstField("SELECT plot_image FROM plot_listing WHERE plot_id=%i", $plot_edit_page_id);
    }

    // Update query using MeekroDB
    $updated = DB::update(
        'plot_listing',
        [
            'plot_num' => $plot_num,
            'plot_title' => $plot_title,
            'plot_location' => $plot_location,
            'plot_description' => $plot_description,
            'plot_image' => $plot_image
        ],
        'plot_id=%i',
        $plot_edit_page_id
    );

    // Check if the update was successful
    if ($updated) {
        header("Location: plot_listing.php");
        exit(); // Ensure script termination after redirection
    } else {
        echo "Error updating data in the database.";
    }
}
?>


