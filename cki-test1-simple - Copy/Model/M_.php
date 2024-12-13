<?php
  include_once("E_.php");
  include_once("DBContext.php");
  include_once("E_.php");
  class M_ extends DBContext{
    public function __construct(){
      parent::__construct();
    }

    public function login($username, $password) {
      $Result = $this->getDetail($username);
      if($Result){
        if($Result->getTwo() == $password){
          return $Result;
        }
      }
      return null;
    }

    public function getAll(){
      $sql = "SELECT * FROM tb";
      $result = mysqli_query($this->connection, $sql);
      $Arrays = [];
      while($row = mysqli_fetch_assoc($result)){
        $Arrays [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
      }
      return $Arrays;
    }

    public function getDetail($one){
      $sql = "SELECT * FROM tb WHERE `one` = '" .$one. "'";
      $result = mysqli_query($this->connection, $sql);
      if($row = mysqli_fetch_assoc($result)){
        $RsDetail = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
        return $RsDetail;
      }
      return null;
    }

    public function add($bean) {
      $one = $bean->getOne();
      $two = $bean->getTwo();
      $three = $bean->getThree();
      $four = $bean->getFour();
      $five = $bean->getFive();

      $sql = "INSERT INTO tb (one, two, three, four, five) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->connection->prepare($sql);
  
      $stmt->bind_param("ssisi", $one, $two, $three, $four, $five);
  
      $stmt->execute();
  
      $result = false;
      if ($stmt->affected_rows > 0) {
          // echo "add ok";
          $result = true;
      } else {
          // echo "add failed";
      }
  
      $stmt->close();
      return $result;
  }  
    public function update($bean) {
      $one = $bean->getOne();
      $two = $bean->getTwo();
      $three = $bean->getThree();
      $four = $bean->getFour();
      $five = $bean->getFive();

      $sql = "UPDATE tb SET two = ?, three = ?, four = ?, five = ? WHERE one = ?";
      $stmt = $this->connection->prepare($sql);

      $stmt->bind_param("sisis",$two, $three, $four, $five, $one);

      $stmt->execute();

      $result = false;
      if ($stmt->affected_rows > 0) {
          // echo "add ok";
          $result = true;
      } else {
          // echo "add failed";
      }
  
      $stmt->close();
      return $result;
  }


    public function delete($one){
      $sql = "DELETE FROM tb WHERE one = ?";
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param("s", $one);
      $stmt->execute();
      $result = false;
      if ($stmt->affected_rows > 0) {
          // echo "add ok";
          $result = true;
      } else {
          // echo "add failed";
      }
  
      $stmt->close();
      return $result;
    }

    public function search($data) {
      $sql = "SELECT * from tb WHERE two LIKE ?";
      $stmt = $this->connection->prepare($sql);
      if (!$stmt) {
          echo "SQL Error: " . $this->connection->error;
          return [];
      }

      $data = "%" . $data . "%";

      $stmt->bind_param("s", $data);
      $stmt->execute();
      $result = $stmt->get_result();
  
      $Arrays = [];
      while($row = mysqli_fetch_assoc($result)){
        $Arrays [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
      }
      $stmt->close();
      return $Arrays;
    }

    public function search1($searchBy, $data) {

      $column = '';
      $paramType = '';
      $sql = '';
  
      switch ($searchBy) {
          case '':
            return $this->getAll();
          case 'one':
          case 'two':
              $column = $searchBy;
              $paramType = "s";
              $sql = "SELECT * FROM tb WHERE $column LIKE ?";
              $data = "%" . $data . "%";
              break;
          case 'three':
              $column = "three";
              $paramType = "i";
              $sql = "SELECT * FROM tb WHERE $column = ?";
              break;
          default:
              echo "Invalid";
              return [];
      }


      $stmt = $this->connection->prepare($sql);
      if (!$stmt) {
          echo "SQL Error: " . $this->connection->error;
          return [];
      }

      $stmt->bind_param($paramType, $data);
      $stmt->execute();
      $result = $stmt->get_result();
  
      $Arrays = [];
      while($row = mysqli_fetch_assoc($result)){
        $Arrays [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], $row['five']);
      }
      $stmt->close();
      return $Arrays;
    }

    public function checkExists($one) {
      $sql = "SELECT COUNT(*) FROM tb WHERE `one` = ?";
      $stmt = $this->connection->prepare($sql);
      $stmt->bind_param("s",  $one);
      $stmt->execute();
      $stmt->bind_result($count);
      $stmt->fetch();
      $stmt->close();
      return $count > 0;
    } 
}
?>