<?php
require_once("Car.php");

class Ferrari extends Car{
    public function __construct(){
        parent::__construct($brand='Ferrari',$capMin=1, $capMax=2, $priceMin=2000, $priceMax=4000, $accel=12, $maxSpeed=200);
    }

    // 加速度の調整を行うメソッド
    public function getAdjustedAccel($liftCount) {
        return $this->accel * pow(0.8, $liftCount);  // liftCount による加速度調整
    }

    // 車高上昇量を計算するメソッド
    public function getHeight($liftCount) {
        return $liftCount * 40;  // liftCount による車高調整
    }
}

