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
<h1 style="text-align: center; color: green">Welcome user: <?php 
    if(isset($_SESSION['user'])){
        echo $_SESSION['user'];
    }
    else{
        echo "guest";
    }
?></h1>
    <h2>Danh sách</h2>
    
    <!-- form search input -->
    <div class="search">
        <form action="../Controller/C_.php">
            <span>Two: </span>
            <input type="hidden" name="action" value="list">
            <input type="text" name="search">
            <button type="submit">search</button>
        </form>
    </div>
    <br>

    <!-- form search  -->
    <div class="form-search">
        <form action="../Controller/C_.php" method="GET">
            <input type="hidden" name="action" value="list">

            <input id="one" type="radio" name="searchType" value="one" <?php if (isset($searchType) && $searchType == 'one') echo 'checked'; ?>>
            <label for="one">one</label>

            <input id="two" type="radio" name="searchType" value="two" <?php if (isset($searchType) && $searchType == 'two') echo 'checked'; ?>>
            <label for="two">two</label>
            
            <input id="three" type="radio" name="searchType" value="three" <?php if (isset($searchType) && $searchType == 'three') echo 'checked'; ?>>
            <label for="three">three</label>
            
            <br>
            <br>
            <label>Nhập thông tin:</label>
            <input type="text" name="data" value="<?php if (isset($data)) echo $data ?>">
            <input type="submit" value="OK">
            <input type="reset" value="Reset">
        </form>
    </div>
    <br>
    <br>

    <table border="1" width="100%">
        <tr>
            <th>One</th>
            <th>Two</th>
            <th>Three</th>
            <th>Four</th>
            <th>Five</th>
            <th>Six</th>
            <th>Action</th>
        </tr>

        <?php if (is_array($beans) && !empty($beans)) {
          foreach ($beans as $bean) { ?>
              <tr>
                  <td><?php echo $bean->getOne() ?></td>
                  <td><?php echo $bean->getTwo() ?></td>
                  <td><?php echo $bean->getThree() ?></td>
                  <td><?php echo $bean->getFour() ?></td>
                  <td><?php echo $bean->getFive()->getTwo1() ?></td>
                  <td><?php echo $bean->getSix() == 1 ? "nam" : "nu" ?></td>
                  <td>
                    <input type="checkbox" name="one" value = "<?php echo $bean->getOne() ?>">
                    <a href="../Controller/C_.php?action=update&one=<?php echo $bean->getOne() ?>"><button>sửa</button></a>
                    <button style="background: red" onclick="confirmDelete('<?php echo $bean->getOne()?>')">xóa</button>
                  </td>
              </tr>
          <?php }
      } else { ?>
          <tr>
              <td colspan="5" class="no-data">No users found.</td>
          </tr>
      <?php } ?>

      <!-- deleteall -->
      <tr><td colspan="7" style="text-align: end;"><button onclick="handledelete()" style="background:red;">Xóa nhiều</button></td></tr>  

    </table>
    <p><a href="../View/index.php">Trang chủ</a></p>

    <script>
        
        function confirmDelete(key) {
            const confirmDelete = confirm('Bạn có chắc chắn muốn xóa ?');
            if (confirmDelete) {
                window.location.href = `../Controller/C_.php?action=delete&one=${key}`;
            }
        }

        function handledelete() {
            const checkedItems = document.querySelectorAll('input[name="one"]:checked');
            if (checkedItems.length === 0) {
                alert('Vui lòng chọn ít nhất một bản ghi để xóa.');
                return;
            }

            // Confirm before deletion
            const confirmDelete = confirm('Bạn có chắc chắn xóa các bản ghi này?');
            if (confirmDelete) {
                const deletePromises = Array.from(checkedItems).map(item => {
                    return fetch(`../Controller/C_.php?action=delete&one=${item.value}`, {
                        method: 'GET',
                    });
                });

                // Wait for all deletion requests to complete
                Promise.all(deletePromises)
                    .then(() => {
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(() => {
                        alert('Có lỗi xảy ra khi xóa sinh viên.');
                    });
            }
        }
        
    </script>
</body>
</html>