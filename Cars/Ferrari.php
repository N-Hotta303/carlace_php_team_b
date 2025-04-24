<?php
require_once("Car.php");

class Ferrari extends Car{
    public function __construct(){
        parent::__construct($brand='Ferrari',$capMin=1, $capMax=2, $priceMin=2000, $priceMax=4000, $accel=12, $maxSpeed=55, $brake_capa=1.0);
    }
}
?>