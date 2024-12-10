<?php
class E_User{
  private $username;
  private $password;
  private $firstName;
  private $lastName;
  
  private $role;

  public function __construct($username, $password, $firstName, $lastName, $role){
    $this->username = $username;
    $this->password = $password;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->role = $role;
  }

  public function getUsername(){
    return $this->username;
  }

  public function setUsername($username){
    $this->username = $username;
  }

  public function getPassword(){
    return $this->password;
  }

  public function setPassword($password){
    $this->password = $password;
  }


  public function getFirstName(){
    return $this->firstName;
  }

  public function setFirstName($firstName){
    $this->firstName = $firstName;
  }
  
  public function getLastName(){
    return $this->lastName;
  }

  public function setLastName($lastName){
    $this->lastName = $lastName;
  }

  public function getRole(){
    return $this->role;
  }

  public function setRole($role){
    $this->role = $role;
  }
}

?>