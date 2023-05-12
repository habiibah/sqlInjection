<?php
// Handle the form submission
if (isset($_POST['login'])) {
//   // Get form data
  $name = $_POST['name'];
  $password = $_POST['password'];
// var_dump($_POST);

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');
//   var_dump($conn);

  // Retrieve user information from the "users" table
  $query = "SELECT * FROM users WHERE name='$name' and password='$password'";
  $result = mysqli_query($conn, $query);


  // Check if the user exists
  if (mysqli_num_rows($result) > 0) {
    // Redirect to a dashboard or home page for logged-in users
    header("Location: order.php");
    // header('Location: http://localhost/sql/order.php');
    var_dump($result);
  } else {
    // Show an error message for invalid credentials
    echo "Invalid username or password";
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
