<?php
require_once("car.php");

class Nissan extends Car{
    public function __construct(){
        parent::__construct($brand='Nissan',$capMin=3, $capMax=4, $priceMin=200, $priceMax=300, $accel=6, $maxSpeed=200);
    }
}
?>