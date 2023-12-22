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

if (isset($_POST['add-plot'])) {
    $plot_num = $_POST['plot_num'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];

    // Check if the file is set and not empty
    if (isset($_FILES["plot_image"]) && !empty($_FILES["plot_image"]["name"])) {
        // File handling
        $target_directory = "uploads/"; // Change this to your desired upload directory
        $target_file = $target_directory . basename($_FILES["plot_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image or a fake image
        $check = getimagesize($_FILES["plot_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["plot_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["plot_image"]["tmp_name"], $target_file)) {
                // Insert query using MeekroDB
                $inserted = DB::insert('plot_listing', [
                    'plot_num' => $plot_num,
                    'plot_title' => $plot_title,
                    'plot_location' => $plot_location,
                    'plot_description' => $plot_description,
                    'plot_image' => $target_file // Save the file path in the database
                ]);

                if ($inserted) {
                    header("Location: add_plot_listing.php");
                } else {
                    echo "Error inserting data into the database.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please select a file to upload.";
    }
}
?>



