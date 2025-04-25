<?php
require_once("car.php");
session_start(); //欠陥による加速度低下を反映させるためここで開始

class Nissan extends Car{
    public function __construct(){
        parent::__construct($brand='Nissan',$capMin=3, $capMax=4, $priceMin=200, $priceMax=300, $accel=6, $maxSpeed=55, $brake_capa=0.5);

        $this->acceleration = round($this->acceleration * 0.6, 2); //欠陥により60%の加速度に
        $_SESSION["accel"][$index] = $this->acceleration;

 
        $this->liftCount = $this->getLift_up();
        $this->adjustAcceleration($this->liftCount);
        $this->height = $this->calculateHeight($this->liftCount);
    }

    private function getLift_up(): int {
        return 0;
    }

    private function adjustAcceleration(int $liftCount) {
        $this->acceleration *= pow(0.8, $liftCount);
    }

    private function calculateHeight(int $liftCount): int {
        return $liftCount * 40;
    }
}
?>