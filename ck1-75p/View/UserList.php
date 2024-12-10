<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách user</title>
    <link rel="stylesheet" href="../View/style/base.css">
    <link rel="stylesheet" href="../View/style/list.css">
</head>
<body>
<h1>Welcome user: <?php 
    $user = unserialize($_SESSION['user']);
    echo $user->getUsername();
?></h1>
    <h1>Danh sách user</h1>
    <div class="search">
        <form action="../Controller/C_User.php">
            <span>Name: </span>
            <input type="hidden" name="action" value="list">
            <input type="text" name="search">
            <button type="submit">search</button>
        </form>
    </div>
    <br>
    <table border="1" width="100%">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        <?php if (is_array($users) && !empty($users)) {
          foreach ($users as $user) { ?>
              <tr>
                  <td><?php echo $user->getUsername(); ?></td>
                  <td><?php echo $user->getFirstName() . " " . $user->getLastName() ?></td>
                  <td><?php echo $user->getRole()->getName()?></td>
                  <td>
                    <a href="../Controller/C_User.php?action=update&username=<?php echo $user->getUsername() ?>"><button>sửa</button></a>
                    <button style="background: red" onclick="confirmDelete('<?php echo $user->getUsername()?>')">xóa</button>
                  </td>
              </tr>
          <?php }
      } else { ?>
          <tr>
              <td colspan="5" class="no-data">No users found.</td>
          </tr>
      <?php } ?>
    </table>
    <p><a href="../View/index.php">Trang chủ</a></p>

    <script>
        
        function confirmDelete(username) {
            const confirmDelete = confirm('Bạn có chắc chắn muốn xóa sinh viên này?');
            if (confirmDelete) {
                window.location.href = `../controller/C_user.php?action=delete&username=${username}`;
            }
        }
    </script>
</body>
</html>