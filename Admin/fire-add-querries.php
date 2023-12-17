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

    if (isset($_FILES['plot_image'])) {
        $file = $_FILES['plot_image'];
    
        $uploadDir = 'uploads/';
        // Define allowed file extensions
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    
        if (in_array($fileExtension, $allowedExtensions)) {
            $uniqueFileName = uniqid() . '_' . $file['name'];
            move_uploaded_file($file['tmp_name'], $uploadDir . $uniqueFileName);
    
            $filename = $uniqueFileName;
            $filePath = $uploadDir . $uniqueFileName;
          } else {
              echo "<script>alert('Only PNG, JPG, AND JPEG files are allowed!')</script>";
              echo '<script>window.location = "add_plot_listing.php";</script>';
              exit;
          }
    }
    
    // Insert query using MeekroDB
    $inserted = DB::insert('plot_listing', [
        'plot_num' => $plot_num,
        'plot_title' => $plot_title,
        'plot_location' => $plot_location,
        'plot_description' => $plot_description,
        'plot_image' => $filePath  // Save the path to the uploaded file
    ]);

    if ($inserted) {
        header("Location: add_plot_listing.php");
    }
}
?>


