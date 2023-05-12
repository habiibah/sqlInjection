<!DOCTYPE html>
<html>
<head>
  <title>Post Product</title>
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

  // Check if the form is submitted
  if (isset($_POST['postproduct'])) {
    // Get the product details
    $product = $_POST['product'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert the product into the database
    $name = $_SESSION['name'];
    $query = "INSERT INTO product (product, price, quantity) VALUES ('$product', '$price', '$quantity')";
    mysqli_query($conn, $query);

    // Display success message
    echo "Product posted successfully.";

    // Redirect or perform further actions as needed
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

  <h2>Post Product</h2>

  <form action="postproduct.php" method="POST">
    <input type="text" name="product" placeholder="Product" required><br><br>
    <input type="number" name="price" placeholder="Price" required><br><br>
    <input type="number" name="quantity" placeholder="quantity" required><br><br>
    <input type="submit" name="postproduct" value="Post Product">
  </form>
</body>
</html>
