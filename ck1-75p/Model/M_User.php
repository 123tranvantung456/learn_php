<?php
  include_once("E_User.php");
  include_once("DBContext.php");
  include_once("E_Role.php");
  class M_User extends DBContext{
    public function __construct(){
      parent::__construct();
    }

    public function login($username, $password) {
      // $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
      // $stmt = $this->connection->prepare($sql);
      // $stmt->bind_param('ss', $username, $password);
      // $stmt->execute();
      // $result = $stmt->get_result();
      // return $result->num_rows > 0;
      $user = $this->getUserDetail($username);
      if($user){
        if($user->getPassword() == $password){
          return $user;
        }
      }
      return null;
    }

    public function getAllUser(){
      $sql = "select * from user inner join role on user.roleId = role.id";
      $result = mysqli_query($this->connection, $sql);
      $users = [];
      while($row = mysqli_fetch_assoc($result)){
        $users [] = new E_User($row['username'], $row['password'], $row['firstName'],
         $row['lastName'], new E_Role($row['id'], $row['name']));
      }
      return $users;
    }

    public function getUserDetail($username){
      $sql = "select * from user inner join role on user.roleId = role.id where `username` = '" .$username . "'";
      
      $result = mysqli_query($this->connection, $sql);

      if($row = mysqli_fetch_assoc($result)){
        $user = new E_User($row['username'], $row['password'], $row['firstName'],
        $row['lastName'], new E_Role($row['id'], $row['name']));
        return $user;
      }
      return null;
    }

    public function addUser($user) {
      $username = $user->getUsername();
      $firstName = $user->getFirstName();
      $lastName = $user->getLastName();
      $password = $user->getPassword();
      $roleId = $user->getRole()->getId();
  
      $sql = "INSERT INTO user (username, firstName, lastName, password, roleId) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->connection->prepare($sql);
  
      $stmt->bind_param("ssssi", $username, $firstName, $lastName, $password, $roleId);
  
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