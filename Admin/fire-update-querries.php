<?php
include('db_config.php');

// Update user details
if (isset($_POST['update-user'])) {
    $user_edit_page_id = $_POST['user-edit-page-id'];
    $username = $_POST['username'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // File upload code
    $fname = $_FILES['user_image']['name'];

    if ($fname != null) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["user_image"]["name"]);

        // Check file size
        if ($_FILES["user_image"]["size"] > 102400) {
            $_SESSION['imageSize'] = true;
            header("Location: admin_users.php");
            exit();
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $_SESSION['fileType'] = true;
            header("Location: admin_users.php");
            exit();
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            $_SESSION['user'] = true;
            header("Location: admin_users.php");
            exit();
        }

        $photo = $target_file;

        // Check if 'user_image' is set in the database
        $userDetails = DB::queryFirstRow("SELECT user_image FROM admin_users WHERE id=%i", $user_edit_page_id);

        if ($userDetails['user_image'] == null) {
            // Insert 'user_image' field if there was no previous image
            $sts = DB::update('admin_users', ['user_image' => $photo], 'id=%i', $user_edit_page_id);

            if (!$sts) {
                $_SESSION['user'] = true;
                header("Location: admin_users.php");
                exit();
            }
        } else {
            // Update 'user_image' field if there was a previous image
            $sts = DB::update('admin_users', ['user_image' => $photo], 'id=%i', $user_edit_page_id);

            if (!$sts) {
                $_SESSION['user'] = true;
                header("Location: admin_users.php");
                exit();
            }
        }
    }

    // Update user details using MeekroDB
    $updated = DB::update('admin_users', [
        'username' => $username,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'user_type' => $user_type
    ], 'id=%i', $user_edit_page_id);

    if ($updated) {
        $_SESSION['status'] = true;
        header("Location: admin_users.php");
        exit();
    } else {
        $_SESSION['error'] = true;
        header("Location: admin_users.php");
        exit();
    }
}
?>

<?php
include('db_config.php');
// Update user password
if (isset($_POST['update-password'])) {
    $password = $_POST['renewpassword'];
    
    $id = $_POST['id'];

    // Update query using MeekroDB
    $updated_password = DB::update('admin_users', ['password' => $password], ['id' => $id]); // Assuming 'id' is the primary key

    if ($updated_password) {
        header("Location: users_profile.php");
    }
}
?>


<?php
require('db_config.php');

if (isset($_POST['update-plot'])) {
    // Sanitize and validate input data
    $plot_edit_page_id = $_POST['plot_listing_edit_page_id'];
    $plot_num = $_POST['plot_num'];
    $plot_title = $_POST['plot_title'];
    $plot_location = $_POST['plot_location'];
    $plot_description = $_POST['plot_description'];
    $plot_price = $_POST['plot_price'];
    $plot_status = $_POST['plot_status'];
    $plot_area = $_POST['plot_area'];
    $property_type = $_POST['property_type'];
    $beds = $_POST['beds'];
    $baths = $_POST['baths'];

    // Check if 'plot_image' key exists in the $_FILES array
    if (isset($_FILES['plot_image'])) {
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
    } else {
        // If 'plot_image' key is not set in $_FILES, handle accordingly (e.g., set $plot_image to the existing path)
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
            'plot_price' => $plot_price,
            'property_type' => $property_type,
            'plot_area' => $plot_area,
            'plot_status' => $plot_status,
            'beds' => $beds,
            'baths' => $baths,
            'plot_image' => $plot_image
        ],
        'plot_id=%i',
        $plot_edit_page_id
    );

    // Check if the update was successful
    if ($updated) {
        header("Location: plot_listing.php");
        // Optionally redirect to another page or perform additional actions
    } else {
        echo "Error updating data in the database.";
    }
}
?>

