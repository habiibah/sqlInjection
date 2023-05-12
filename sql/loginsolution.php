<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
</head>
<body>
  <h2>Login Form</h2>
  <form action="login.php" method="POST">
    <input type="text" name="name" placeholder="name" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" name="login" value="Login">
  </form>
</body>
</html>

<?php
// Handle the form submission
if (isset($_POST['login'])) {
  // Get form data
  $name = $_POST['name'];
  $password = $_POST['password'];

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');

  // Check the connection
  if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
  }
  // Prepare the SQL statement
 // $query = "SELECT * FROM users WHERE name = ? AND password = ?";
 // $stmt = mysqli_prepare($conn, $query);

  $query = $conn->prepare("INSERT INTO users (username, email, contact, password) VALUES (?, ?, ?, ?)");
  // Bind the parameters
  //mysqli_stmt_bind_param($stmt, "ss", $name, $password);

  $query->bind_param("sss", $username, $email, $contact, $password);
  $query->execute();
  // Execute the statement
  mysqli_stmt_execute($query);

  // Get the result
  $result = mysqli_stmt_get_result($query);

  // Check if the user exists
  if (mysqli_num_rows($result) > 0) {
    // Redirect to a dashboard or home page for logged-in users
    header('Location: order.php');
    exit();
  } else {
    // Show an error message for invalid credentials
    echo "Invalid username or password";
  }

  // Close the statement and database connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>
