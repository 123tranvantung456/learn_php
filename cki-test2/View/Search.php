<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
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
</body>
</html>