<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
</head>
<body>
  <h2>Login Form</h2>
  <form action="logic.php" method="POST">
    NAME: <input type="text" name="name" placeholder="name" required><br><br>
    PASSWORD:<input type="password" name="password" placeholder="Password" required><br><br>
    <!-- <button class="btn btn-dark float-left">LOGIN</button> -->
    <input type="submit" name="login" value="Login">
  </form>
</body>
</html>

