<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../View/style/base.css">
    <link rel="stylesheet" href="../View/style/util.css">
</head>
<body>
  <!-- <?php 
  if (isset($_GET['message']) && $_GET['message'] == "failed") {
    echo "<h2 style= 'color: red'>Invalid username and password</h2>";
  }
  ?> -->
  <form action="../Controller/C_User.php?action=login" method="post">
    <h2>Login</h2>  
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
    </div>
    <br>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </div>
    <br>
    <div>
      <button type="submit">Login</button>
    </div>
  </form>
</body>
</html>