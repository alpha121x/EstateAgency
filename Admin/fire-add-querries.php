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
    $plot_image = $_POST['plot_image'];

    // handle file uploads

    if(isset($_FILES['plot_image'])) {
        $errors = array();
        $file_name = $_FILES['plot_image']['name'];
        $file_size = $_FILES['plot_image']['size'];
        $file_tmp = $_FILES['plot_image']['tmp_name'];
        $file_type = $_FILES['plot_image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['plot_image']['name'])));

        $extensions = array("jpeg", "jpg", "png");

        if(in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }


        if(empty($errors) == true) {
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
            echo "Success";
        } else {
            print_r($errors);
        }

        // Insert query using MeekroDB
    $inserted = DB::insert('plot_listing', [
        'plot_num' => $plot_num,
        'plot_title' => $plot_title,
        'plot_location' => $plot_location,
        'plot_description' => $plot_description,
        'plot_image' => $file_type // Save the file path in the database
    ]);

    if ($inserted) {
        header("Location: add_plot_listing.php");
    } else {
        echo "Error inserting data into the database.";
    }
    }


    
}
?>
