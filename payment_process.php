<?php
include("Admin/db_config.php");

// Check if the form is submitted
if (isset($_POST['pay-button'])) {
    // Process the payment logic here

   

    // Card details
    $cardNumber = $_POST['cardNumber'];
    $cardholderName = $_POST['cardholderName'];
   // Amount details
    $selectedAmount = $_POST['property_price'];

    print_r($_POST['pay-button']);
     // For demonstration purposes, you can simply print the posted data
     echo "<h2>Payment Details:</h2>";
    echo "<p>Card Number: $cardNumber</p>";
    echo "<p>Cardholder Name: $cardholderName</p>";
    echo "<p>Selected Amount: $selectedAmount</p>";

    // Additional processing logic can be added here

    // End the script or redirect to a success page
    // header("Location: success.php");
    // exit();
} else {
    // If the form is not submitted, redirect to the payment page
    header("Location: payment.php");
    exit();
}
?>
