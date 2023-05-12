<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
<h2>Welcome to the Dashboard</h2>
  <p>Here, you can display the user's data from the database.</p>
  <h2>User List</h2>

  <?php
  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'sql');

  // Check the connection
  if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
  }

  // Fetch users from the table
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);

  // Check if any users exist
  if (mysqli_num_rows($result) > 0) {
    // Display user information in a table
    echo '<table>';
    echo '<tr>
    <th><bold>NAME</bold></th>
    <th><bold>EMAIL</bold></th>
    <th><bold>CONTACT</bold></th>
    <th><bold>BALANCE</bold></th>
    </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '<td>' . $row['contact'] . '</td>';
      echo '<td>' . $row['balance'] . '</td>';
      echo '</tr>';
    }

    echo '</table>';
  } else {
    echo 'No users found.';
  }

  // Close the database connection
  mysqli_close($conn);
  ?>
</body>
</html>
