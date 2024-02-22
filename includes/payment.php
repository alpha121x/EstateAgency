<!-- payment.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
</head>

<body>
  <h1>Payment Page</h1>
  <p>Thank you for choosing to buy the property!</p>

  <form action="payment_process.php" method="post">
    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number" required><br>

    <label for="expiry_date">Expiry Date:</label>
    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required><br>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required><br>

    <button type="submit">Submit Payment</button>
  </form>
</body>

</html>
