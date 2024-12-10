<?php
  include_once("E_.php");
  include_once("DBContext.php");
  include_once("E_.php");
  class M_User extends DBContext{
    public function __construct(){
      parent::__construct();
    }

    public function login($one, $two) {
      // $sql = "SELECT * FROM table WHERE username = ? AND password = ?";
      // $stmt = $this->connection->prepare($sql);
      // $stmt->bind_param('ss', $username, $password);
      // $stmt->execute();
      // $result = $stmt->get_result();
      // return $result->num_rows > 0;


      $Result = $this->getDetail($one);
      if($Result){
        if($Result->getTwo() == $two){
          return $Result;
        }
      }
      return null;
    }

    public function getAll(){
      $sql = "select * from table";
      $result = mysqli_query($this->connection, $sql);
      $Arrays = [];
      while($row = mysqli_fetch_assoc($result)){
        $Arrays [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
      }
      return $Arrays;
    }

    public function getDetail($one){
      $sql = "select * from table `one` = '" .$one. "'";
      $result = mysqli_query($this->connection, $sql);
      if($row = mysqli_fetch_assoc($result)){
        $rsDetail [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
        return $rsDetail;
      }
      return null;
    }

    public function add($bean) {
      $one = $bean->getOne();
      $two = $bean->getTwo();
      $three = $bean->getThree();
      $four = $bean->getFour();
      $five = $bean->getFive;
  
      $sql = "INSERT INTO user (one, two, three, four, five) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->connection->prepare($sql);
  
      $stmt->bind_param("ssisi", $one, $two, $three, $four, $five);
  
      $stmt->execute();
  
      if ($stmt->affected_rows > 0) {
          echo "add ok";
      } else {
          echo "add failed";
      }
  
      $stmt->close();
  }
  
    public function updateUser($user) {
      $username = $user->getUsername();
      $firstName = $user->getFirstName();
      $lastName = $user->getLastName();
      $roleId = $user->getRole()->getId();

      $sql = "UPDATE user SET firstName = ?, lastName = ?, roleId = ? WHERE username = ?";
      $stmt = $this->connection->prepare($sql);

      $stmt->bind_param("ssis",$firstName, $lastName, $roleId, $username);

      $stmt->execute();

      if ($stmt->affected_rows > 0) {
          echo "update ok";
      } else {
          echo "update failed";
      }

      $stmt->close();
  }


    public function deleteStudent($username){
      $sql = "DELETE FROM user WHERE username = ?";
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      if($stmt->affected_rows > 0 ){
        echo "delete ok";
      }
      else{
        echo "delete failed";
      }

      $stmt->close();
    }

    public function searchUser($data) {
      $sql = "select * from user inner join role on user.roleId = role.id WHERE firstName LIKE ? OR lastName LIKE ?";
  
      $stmt = $this->connection->prepare($sql);
      if (!$stmt) {
          echo "SQL Error: " . $this->connection->error;
          return [];
      }

      $data = "%" . $data . "%";

      $stmt->bind_param("ss", $data, $data);
      $stmt->execute();
      $result = $stmt->get_result();
  
      $users = [];
      while ($row = $result->fetch_assoc()) {
        $users [] = new E_User($row['username'], $row['password'], $row['firstName'],
        $row['lastName'], new E_Role($row['id'], $row['name']));
      }
  
      $stmt->close();
      return $users;
  }
    public function checkUserExists($username) {
      $sql = "SELECT COUNT(*) FROM user WHERE username = ?";
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $stmt->bind_result($count);
      $stmt->fetch();
      $stmt->close();
      return $count > 0;
  } 
}


// Trong PHP, isset() là một hàm dùng để 
// kiểm tra xem một biến có tồn tại và có giá trị khác null hay không. 
// Hàm này trả về true nếu biến đã được khai báo và có giá trị khác null, ngược lại trả về false.
?>