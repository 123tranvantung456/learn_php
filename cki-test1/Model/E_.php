<?php
class E_{
  private $one; // id
  private $two; // varchar
  private $three; // int
  private $four; // date time
  private $five; // pk
  
  public function __construct($one, $two, $three, $four, $five){
    $this->one = $one;
    $this->two = $two;
    $this->three = $three;
    $this->four = $four;
    $this->five = $five;
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
}

?>