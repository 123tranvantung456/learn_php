<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../View/style/base.css">
  <style>
    /* Định dạng chung cho form */
.form-search {
  width: 100%;
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  font-family: Arial, sans-serif;
}

/* Căn chỉnh các input và label */
.form-search input[type="radio"] {
  margin-right: 5px;
}

.form-search label {
  margin-right: 15px;
  font-weight: bold;
  color: #333;
}

/* Dành cho ô nhập thông tin */
.form-search input[type="text"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-top: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Căn chỉnh các nút */
.form-search input[type="submit"],
.form-search input[type="reset"] {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  background-color: #007BFF;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s;
  margin-right: 10px;
}

.form-search input[type="reset"] {
  background-color: #dc3545;
}

.form-search input[type="submit"]:hover {
  background-color: #0056b3;
}

.form-search input[type="reset"]:hover {
  background-color: #c82333;
}

/* Định dạng khoảng cách giữa các phần tử */
.form-search br {
  display: block;
  margin-top: 10px;
}

  </style>
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