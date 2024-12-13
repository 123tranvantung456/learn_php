<?php
class E_{
  private $one; // id
  private $two; // varchar
  private $three; // int
  private $four; // date
  private $five; // bean con lai
  private $six; // boolean
  
  public function __construct($one, $two, $three, $four, $five, $six){
    $this->one = $one;
    $this->two = $two;
    $this->three = $three;
    $this->four = $four;
    $this->five = $five;
    $this->six = $six;
  }

  public function getOne(){
    return $this->one;
  }

  public function getTwo(){
    return $this->two;
  }

  public function getThree(){
    return $this->three;
  }
  
  public function getFour(){
    return $this->four;
  }

  public function getFive(){
    return $this->five;
  }

  public function getSix(){
    return $this->six;
  }
}
?>