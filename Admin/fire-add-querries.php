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
        header("Location: add-user-profile");
    }
}
?>


<?php
require('db_config.php');
require("auth.php");

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
    $username = $_SESSION['user'];

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
        'username' => $username,
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
        header("Location: add_plot_listing");
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

    // Get the current date and time
    $bid_date = date("Y-m-d H:i:s");

    $plot_num = DB::queryFirstField("SELECT plot_num FROM plot_listing WHERE plot_id = %i", $plot_id);

    // Insert query using MeekroDB
    $inserted = DB::insert('plot_bidding', [
        'user_name' => $username,
        'user_email' => $email,
        'bid' => $bid,
        'plot_id' => $plot_id,
        'bid_date' => $bid_date, // Include bid_date in the insert
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
            // 'bid_date' => $bid_date, // Include bid_date in the notification
        ));

        // Redirect to the same page after successful insertion
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Stop further execution
    } else {
        // Handle insertion failure
        echo "Error inserting bid. Please try again.";
    }
}
?>


<?php 
require('db_config.php');
if (isset($_POST['add-post'])) {
    $post_category = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $date_posted = $_POST['date_posted'];

    // File Upload
    $uploadsFolder = 'uploads/';
    $post_image = $uploadsFolder . basename($_FILES['post_image']['name']);
    $uploadSuccess = move_uploaded_file($_FILES['post_image']['tmp_name'], $post_image);

    if (!$uploadSuccess) {
        echo "Error uploading file.";
        exit;
    }

    // Insert query using MeekroDB
    $inserted = DB::insert('posts', [
        'post_category' => $post_category,
        'post_title' => $post_title,
        'post_content' => $post_content,
        'date_posted' => $date_posted,
        'post_image' => $post_image // Save the file path in the database
    ]);

    if ($inserted) {
        header("Location: add-posts");
    } else {
        echo "Error inserting data into the database.";
    }
}
?>

<?php 
require('db_config.php');
if(isset($_POST['add-agent'])) {
$agent_name = $_POST['agent_name'];
$agent_about = $_POST['agent_about'];
$agent_phone = $_POST['agent_phone'];
$agent_email = $_POST['agent_email'];

// File Upload
$uploadsFolder = 'uploads/';
$agent_image = $uploadsFolder . basename($_FILES['agent_image']['name']);
$uploadSuccess = move_uploaded_file($_FILES['agent_image']['tmp_name'], $agent_image);

if (!$uploadSuccess) {
    echo "Error uploading file.";
    exit;
}

// Insert query using MeekroDB
$inserted = DB::insert('agents', [
    'agent_name' => $agent_name,
    'agent_about' => $agent_about,
    'agent_phone' => $agent_phone,
    'agent_email' => $agent_email,
    'agent_image' => $agent_image // Save the file path in the database
]);

if ($inserted) {
    header("Location: add-agents");
} else {
    echo "Error inserting data into the database.";
}











}









?>





