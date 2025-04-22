<?php
require_once("Car.php");

class Honda extends Car{
    public function __construct(){
        parent::__construct($brand='Honda',$capMin=5, $capMax=6, $priceMin=300, $priceMax=500, $accel=6, $maxSpeed=200);
    }
}
?>