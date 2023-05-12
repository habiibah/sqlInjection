<!DOCTYPE html>
<html>
<head>
  <title>Place Order</title>
</head>
<body>
  <?php
  // Check if user is logged in
  session_start();
  if (!isset($_SESSION['name'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
  }

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');

  // Check the connection
  if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
  }

  // Fetch user's account balance
  $name = $_SESSION['name'];
  $query = "SELECT balance FROM users WHERE name = '$name'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $balance = $row['balance'];


  // Check if the form is submitted
if (isset($_POST['placeorder'])) {
    // Get the order details
    //Added mysqli_real_escape_string() function to escape user input when retrieving order details from the form
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $total = $price * $quantity;

//   if (isset($_POST['place_order'])) {
//     // Get the order details
//     $product = $_POST['product'];
//     $quantity = $_POST['quantity'];
//     $price = $_POST['price'];
//     $total = $_POST[$price * $quantity];

    // Check if the user has sufficient balance
    if ($balance >= $total) {
      // Deduct the amount from the account balance
      $newBalance = $balance - $total;

      // Update the user's account balance in the database
      $updateQuery = "UPDATE users SET balance = $newBalance WHERE name = '$name'";
      mysqli_query($conn, $updateQuery);

       // Insert the order details into the "orders" table
  $insertQuery = "INSERT INTO order (product, price, quantity, total) VALUES ('$product', '$price', '$quantity', '$total')";
  mysqli_query($conn, $insertQuery);

      // Display success message
      echo "Order placed successfully. Amount deducted from your account balance.";

      // Redirect or perform further actions as needed
    } else {
      // Display error message if insufficient balance
      echo "Insufficient balance. Please add funds to your account.";

      // Redirect or perform further actions as needed
    }
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

  <h2>Place Order</h2>
  <p>Your account balance: <?php echo $balance; ?></p>

  <form action="placeorder.php" method="POST">
    <input type="text" name="product" placeholder="Product" required><br><br>
    <input type="number" name="price" placeholder="Price" required><br><br>
    <input type="number" name="quantity" placeholder="0" required><br><br>
    <input type="submit" name="placeorder" value="Place Order">
  </form>
</body>
</html>
