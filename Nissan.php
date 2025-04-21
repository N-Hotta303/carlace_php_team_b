<?php
require_once("Car.php");

class Nissan extends Car{
    public function __construct(){
        parent::__construct('Nissan', 3, 4, 200, 300, 6, 200);
    }
}