<?php
class E_1{
  private $one1; // id
  private $two1; // varchar
  public function __construct($one1, $two1){
    $this->one1 = $one1;
    $this->two1 = $two1;
  }

  public function getOne1(){
    return $this->one1;
  }

  public function getTwo1(){
    return $this->two1;
  }
}

?>