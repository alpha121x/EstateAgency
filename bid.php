<?php
require('Admin/db_config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['add-bid'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bid = $_POST['bid'];
    $plot_id = $_POST['plot_id'];

    date_default_timezone_set('Asia/Karachi');
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
        $message = "A new bid has been entered by " . $username . " with email " . $email . " for Plot Num: " . $plot_num . " with a bid amount of Rs." . $bid;

        // Inserting notification into the database
        DB::insert("notifications", array(
            'title' => $messageTitle,
            'is_read' => 0,
            'plot_id' => $plot_id,
            'created_by' => $username,
            'message' => $message,
            'bid_date' => $bid_date
            // 'bid_date' => $bid_date, // Include bid_date in the notification
        ));

        // Send email confirmation using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Set your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'abbasshakor0123@gmail.com'; // Your SMTP username
            $mail->Password   = 'lwwlyrzqyawighog'; // Your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('abbasshakor0123@gmail.com', 'EstateAgency');
            $mail->addAddress($email, $username); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Bid Confirmation';
            $mail->Body = 'Thank you for placing a bid. Your bid has been successfully recorded for Plot Num: ' . $plot_num . ' with a bid amount of Rs.' . $bid . '. If your bid ranks in the top 3, you may have a chance to purchase it.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Send the email
            $mail->send();

            // Redirect using JavaScript
            echo '<script>window.location.replace("' . $_SERVER['HTTP_REFERER'] . '");</script>';
            exit(); // Stop further execution
        } catch (Exception $e) {
            // Handle email sending failure
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Handle insertion failure
        echo "Error inserting bid. Please try again.";
    }
}
?>
