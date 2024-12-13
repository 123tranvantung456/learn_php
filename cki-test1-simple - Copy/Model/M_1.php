<?php
  include_once("DBContext.php");
  class M_1 extends DBContext{
    public function __construct(){
      parent::__construct();
    }

    public function getAll(){
      $sql = "select * from table1";
      $result = mysqli_query($this->connection, $sql);
      $Arrays = [];
      while($row = mysqli_fetch_assoc($result)){
        $Arrays [] = new E_1($row['one'], $row['two']);
      }
      return $Arrays;
    }
  }
?>