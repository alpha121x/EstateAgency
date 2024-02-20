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

    $photo_dir = "uploads/$u_name" . $photo_name;

    move_uploaded_file($photo_tmp_name, $photo_dir);

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
    $bidding_days = $_POST['bidding_days'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];
    $plot_price = $_POST['plot_price'];
    $plot_status = $_POST['plot_status'];
    $property_type = $_POST['property_type'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];
    $plot_area = $_POST['plot_area'];
    date_default_timezone_set('Asia/Karachi');
    // Get the current date and time
    $plot_date = date("Y-m-d H:i:s");
    $username = $_SESSION['user'];

    // File Upload
    $uploadsFolder = 'uploads/';
    $plot_image = $uploadsFolder . basename($_FILES['plot_image']['name']);
    $plot_video = $uploadsFolder . basename($_FILES['plot_video']['name']);
    $uploadSuccess = move_uploaded_file($_FILES['plot_image']['tmp_name'], $plot_image);
    // $uploadSuccess = move_uploaded_file($_FILES['plot_video']['tmp_name'], $plot_video);


    if (!$uploadSuccess) {
        echo "Error uploading file.";
        exit;
    }

    // Insert query using MeekroDB
    $inserted = DB::insert('plot_listing', [
        'plot_num' => $plot_num,
        'bidding_days' => $bidding_days,
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
        'plot_image' => $plot_image, // Save the file path in the database
        'plot_video' => $plot_video,
        'added_on' => $plot_date
    ]);

    if ($inserted) {
        header("Location: add_plot_listing");
    } else {
        echo "Error inserting data into the database.";
    }
}
?>
<?php
require('db_config.php');
require("auth.php");

if (isset($_POST['add-content'])) {
    $plot_num = $_POST['plot_num'];
    $bidding_days = $_POST['bidding_days'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_price = $_POST['plot_price'];
    $plot_status = $_POST['plot_status'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];
    $plot_area = $_POST['plot_area'];
    date_default_timezone_set('Asia/Karachi');
    // Get the current date and time
    $plot_date = date("Y-m-d H:i:s");
    $username = $_SESSION['user'];

    // File Upload
    $uploadsFolder = 'uploads/';
    $plot_image = $uploadsFolder . basename($_FILES['plot_image']['name']);
    $uploadSuccess = move_uploaded_file($_FILES['plot_image']['tmp_name'], $plot_image);

    // Check if the uploaded file is an image
    $imageInfo = getimagesize($_FILES['plot_image']['tmp_name']);
    if ($imageInfo === false) {
        echo "<script>alert('Please upload a valid image file.');</script>";
        echo "<script>window.location.href='add-home-content';</script>";
        exit;
    }

    // Check if the image dimensions meet the specified criteria (1920 x 960)
    $requiredWidth = 1920;
    $requiredHeight = 960;
    if ($imageInfo[0] != $requiredWidth || $imageInfo[1] != $requiredHeight) {
        echo "<script>alert('Please upload an image with dimensions 1920 x 960.');</script>";
        echo "<script>window.location.href='add-home-content';</script>";
        exit;
    }

    // Check if the file extension is allowed (jpeg, jpg, png)
    $allowedExtensions = ['jpeg', 'jpg', 'png'];
    $fileExtension = pathinfo($_FILES['plot_image']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo "<script>alert('Only JPEG, JPG, and PNG file formats are allowed.');</script>";
        echo "<script>window.location.href='add-home-content';</script>";
        exit;
    }

    // Insert query using MeekroDB
    $inserted = DB::insert('home_content_slider', [
        'plot_num' => $plot_num,
        'bidding_days' => $bidding_days,
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
        'plot_image' => $plot_image, // Save the file path in the database
        'plot_video' => $plot_video,
        'added_on' => $plot_date
    ]);

    if ($inserted) {
        header("Location: add-home-content");
    } else {
        echo "Error inserting data into the database.";
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

    // Check if the uploaded file is an image
    $imageInfo = getimagesize($_FILES['post_image']['tmp_name']);
    if ($imageInfo === false) {
        echo "Error: Invalid file format. Please upload a valid image.";
        exit;
    }

    // Check if the image size is 500x500 pixels
    $maxWidth = 500;
    $maxHeight = 500;
    if ($imageInfo[0] != $maxWidth || $imageInfo[1] != $maxHeight) {
        echo "<script>alert('Error: Image dimensions should be 500x500 pixels.')</script>";
        exit;
    }

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
if (isset($_POST['add-agent'])) {
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





