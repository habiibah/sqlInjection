<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
</head>
<body>
  <h2>Registration Form</h2>
  <form action="register.php" method="POST">
    <input type="text" name="name" placeholder="name" required><br><br>
    <input type="text" name="email" placeholder="email" required><br><br>
    <input type="text" name="contact" placeholder="contact" required><br><br>
    <input type="text" name="balance" placeholder="0000" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" name="register" value="Register">
  </form>
</body>
</html>

<?php
// Handle the form submission
if (isset($_POST['register'])) {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $balance = $_POST['balance'];
  $password = $_POST['password'];

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');

  // Insert user information into the "users" table

  $query = "INSERT INTO users (name, email, contact, balance, password) VALUES ('$name', '$email', '$contact', '$balance', '$password')";
  mysqli_query($conn, $query);

  // Close the database connection
  mysqli_close($conn);

  // Redirect to a success page
  header('Location: order.php');
  exit();
}
?>
