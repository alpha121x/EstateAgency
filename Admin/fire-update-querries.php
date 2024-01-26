<?php
require_once "include/classes/meekrodb.2.3.class.php";
include('db_config.php');

// Update user details
if (isset($_POST['update-user'])) {
    $user_edit_page_id = $_POST['user-edit-page-id'];
    $username = $_POST['username'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Check if 'plot_image' key exists in the $_FILES array
    if (isset($_FILES['user_image'])) {
        // File Upload
        $uploadsFolder = 'uploads/';
        $plot_image = $uploadsFolder . basename($_FILES['user_image']['name']);

        // Check if a new image was provided and update the file path accordingly
        if ($_FILES['user_image']['size'] > 0) {
            // Remove the existing image file
            $existingImage = DB::queryFirstField("SELECT user_image FROM admin_users WHERE id=%i", $user_edit_page_id);
            if ($existingImage) {
                unlink($existingImage);
            }

            // Upload the new image
            $uploadSuccess = move_uploaded_file($_FILES['user_image']['tmp_name'], $user_image);

            if (!$uploadSuccess) {
                echo "Error uploading file.";
                exit;
            }
        } else {
            // If no new image provided, retain the existing image path
            $user_image = DB::queryFirstField("SELECT plot_image FROM admin_users WHERE id=%i", $user_edit_page_id);
        }
    } else {
        // If 'plot_image' key is not set in $_FILES, handle accordingly (e.g., set $plot_image to the existing path)
        $user_image = DB::queryFirstField("SELECT user_image FROM admin_users WHERE id=%i", $user_edit_page_id);
    }

    // Update query using MeekroDB
    $updated = DB::update('admin_users', [
        'username' => $username,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'user_type' => $user_type,
        'user_image' => $user_image
    ], 'id=%i', $user_edit_page_id);

    if ($updated) {
        header("Location: admin_users.php");
    }
}
?>
<?php
// Update user password
if (isset($_POST['update-password'])) {
    $password = $_POST['renewpassword'];

    // Update query using MeekroDB
    $updated_password = DB::update('admin_users', ['password' => $password], 'LIMIT 1');

    if ($updated_password) {
        header("Location: admin-profile.php");
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
    $plot_price = $_POST['plot_price'];

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

