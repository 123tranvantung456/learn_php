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
    
    <h2>Chi tiết</h2>
    
    <table border="1" width="100%">
        <tr>
            <th>One</th>
            <th>Two</th>
            <th>Three</th>
            <th>Four</th>
            <th>Five</th>
        </tr>

        <?php if (!empty($bean)) {?>
              <tr>
                  <td><?php echo $bean->getOne(); ?></td>
                  <td><?php echo $bean->getTwo() ?></td>
                  <td><?php echo $bean->getThree() ?></td>
                  <td><?php echo $bean->getFour() ?></td>
                  <td><?php echo $bean->getFive()?></td>
              </tr>
          
        <?php } else { ?>

          <tr>
              <td colspan="5" class="no-data">No users found.</td>
          </tr>
        
        <?php } ?>

    </table>
    <p><a href="../Controller/C_.php?action=list">Danh sách</a></p>

</body>
</html>