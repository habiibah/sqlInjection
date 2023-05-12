<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
</head>
<body>
  <h2>Registration Form</h2>
  <form action="register.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="contact" placeholder="Contact" required><br><br>
    <input type="text" name="balance" placeholder="0000" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" name="register" value="Register">
  </form>
</body>
</html>

<?php
if (isset($_POST['register'])) {
  // Get form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $balance = $_POST['balance'];
  $password = $_POST['password'];

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');

  // Check the connection
  if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
  }

  // Prepare the SQL statement
  $query = $conn->prepare("INSERT INTO users (username, email, contact, balance, password) VALUES (?, ?, ?, ?,?)");
  //$stmt = mysqli_prepare($conn, $query);

  $query->bind_param("sss", $username, $email, $contact, $balance, $password);
  $query->execute();
  // Bind the parameters
  //mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $contact, $password);

  // Execute the statement
  //mysqli_stmt_execute($stmt);

  // Close the statement and database connection
  mysqli_stmt_close($query);
  mysqli_close($conn);

  // Redirect to a success page
  header('Location: order.php');
  exit();
}
?>
