<?php
require('db_config.php');

if (isset($_POST['add-user'])) {
    $username = $_POST['username'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

   $photo = $_FILES['user_image'];

    $photo_name = $_FILES['user_image']['name'];
    $photo_tmp_name = $_FILES['user_image']['tmp_name'];
    $photo_size = $_FILES['user_image']['size'];
    $photo_type = $_FILES['user_image']['type'];
    
    $photo_dir = "uploads/$u_name" .$photo_name;
    
    move_uploaded_file($photo_tmp_name , $photo_dir);

    // Insert query using MeekroDB
    $inserted = DB::insert('admin_users', [
        'username' => $username,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => $password,
        'email' => $email,
        'user_type' => $user_type,
        'user_image' => $photo_dir
    ]);

    if ($inserted) {
        header("Location: add-user-profile.php");
    }
}
?>


<?php
require('db_config.php');

if (isset($_POST['add-plot'])) {
    $plot_num = $_POST['plot_num'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];
    $plot_price = $_POST['plot_price'];
    $plot_status = $_POST['plot_status'];
    $property_type = $_POST['property_type'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];
    $plot_area = $_POST['plot_area'];

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
        'property_type' => $property_type,
        'plot_area' => $plot_area,
        'plot_status' => $plot_status,
        'beds' => $beds,
        'baths' => $baths,
        'plot_image' => $plot_image // Save the file path in the database
    ]);

    if ($inserted) {
        header("Location: add_plot_listing.php");
    } else {
        echo "Error inserting data into the database.";
    }
}
?>
 <!-- For adding bids -->
 <?php
require('db_config.php');

if (isset($_POST['add-bid'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bid = $_POST['bid'];
    $plot_id = $_POST['plot_id'];

    $plot_num = DB::queryFirstField("SELECT plot_num FROM plot_listing WHERE plot_id = %i", $plot_id);


    // Insert query using MeekroDB
    $inserted = DB::insert('plot_bidding', [
        'user_name' => $username,
        'user_email' => $email,
        'bid' => $bid,
        'plot_id' => $plot_id
    ]);

    if ($inserted) {

        // Customize message for the bid notification
        $messageTitle = "New Bid Entered for Plot NO: " . $plot_num;
        $message = "A new bid has been entered by " . $username . " with email " . $email . " for Plot ID: " . $plot_id . " with a bid amount of $" . $bid;

        // Inserting notification into the database
        DB::insert("notifications", array(
            'title' => $messageTitle,
            'is_read' => 0,
            'plot_id' => $plot_id,
            'created_by' => $username,
            'message' => $message,
        ));

        // Redirect to the same page after successful insertion
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Stop further execution
    }
    else {
        // Handle insertion failure
        echo "Error inserting bid. Please try again.";
    }
}
?>






