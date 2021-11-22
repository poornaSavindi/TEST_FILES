<?php
class Test{
  private int $testVariable;

  public function __construct(){
    $this->testVariable = 5;
  }

  public function print(){
    echo $this->testVariable;
  }
}

$test = new Test();
$test->print();

$array = ['id'=> '123'];
var_dump($array);
unset($array);
var_dump($array);
