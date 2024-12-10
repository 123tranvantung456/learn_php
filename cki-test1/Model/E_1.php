<?php
class E_1{
  private $one; // id
  private $two; // varchar
  public function __construct($one, $two){
    $this->one = $one;
    $this->two = $two;
  }

  public function getOne(){
    return $this->one;
  }

  public function getTwo(){
    return $this->two;
  }
}

?>