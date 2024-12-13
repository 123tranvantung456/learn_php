<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
  <link rel="stylesheet" href="../View/style/index.css">
</head>
<body>
  <?php if (isset($_SESSION['bean'])): ?>
    <a href="../Controller/C_.php?action=logout">Logout</a>
  <?php else: ?>
    <a href="../Controller/C_.php?action=login">Login</a>
  <?php endif; ?>
  <a href="../Controller/C_.php?action=add">Add</a>
  <br>
  <a href="../Controller/C_.php?action=list">List</a>
</body>
</html>
