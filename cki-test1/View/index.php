<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if (isset($_SESSION['user'])): ?>
    <a href="../Controller/C_User.php?action=logout">Logout</a>
  <?php else: ?>
    <a href="../Controller/C_User.php?action=login">Login</a>
  <?php endif; ?>
  <br>
  <a href="../Controller/C_User.php?action=register">Register</a>
</body>
</html>
