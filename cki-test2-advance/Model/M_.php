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
      $sql = "SELECT * FROM tb INNER JOIN table1 ON tb.five = table1.one1";
      $result = mysqli_query($this->connection, $sql);
      $Arrays = [];
      while($row = mysqli_fetch_array($result)){
        $Arrays [] = new E_($row['one'], $row['two'], $row['three'],
         $row['four'], new E_1($row['one1'], $row['two1']), $row['six']);
      }
      return $Arrays;
    }

    public function getDetail($one){
      $sql = "SELECT * FROM tb INNER JOIN table1 ON tb.five = table1.one1 WHERE `one` = '" .$one. "'";
      $result = mysqli_query($this->connection, $sql);
      if($row = mysqli_fetch_assoc($result)){
        $RsDetail = new E_($row['one'], $row['two'], $row['three'],
        $row['four'], new E_1($row['one1'], $row['two1']), $row['six']);
        return $RsDetail;
      }
      return null;
    }

    public function add($bean) {
      $one = $bean->getOne();
      $two = $bean->getTwo();
      $three = $bean->getThree();
      $four = $bean->getFour();
      $five = $bean->getFive()->getOne1();
      $six = $bean->getSix();

      $sql = "INSERT INTO tb (one, two, three, four, five, six) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $this->connection->prepare($sql);
  
      $stmt->bind_param("ssisii", $one, $two, $three, $four, $five, $six);
  
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
      $five = $bean->getFive()->getOne1();
      $six = $bean->getSix();

      $sql = "UPDATE tb SET two = ?, three = ?, four = ?, five = ?, six = ? WHERE one = ?";
      $stmt = $this->connection->prepare($sql);

      $stmt->bind_param("sisiis",$two, $three, $four, $five, $six, $one);

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
      $sql = "SELECT * from tb INNER JOIN table1 ON tb.five = table1.one1 WHERE two LIKE ?";
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
        $row['four'], new E_1($row['one1'], $row['two1']), $row['six']);
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
              $sql = "SELECT * FROM tb INNER JOIN table1 ON tb.five = table1.one1 WHERE $column LIKE ?";
              $data = "%" . $data . "%";
              break;
          case 'three':
              $column = "three";
              $paramType = "i";
              $sql = "SELECT * FROM tb INNER JOIN table1 ON tb.five = table1.one1 WHERE $column = ?";
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
        $row['four'], new E_1($row['one1'], $row['two1']), $row['six']);
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