<?php
  include_once("DBContext.php");
  class M_Role extends DBContext{
    public function __construct(){
      parent::__construct();
    }

    public function getAllRole(){
      $sql = "select * from role";
      $result = mysqli_query($this->connection, $sql);
      $roles = [];
      while($row = mysqli_fetch_assoc($result)){
        $roles [] = new E_Role($row['id'], $row['name']);
      }
      return $roles;
    }
  }
?>