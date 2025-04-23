<?php
class Brake{
    public static float $accel = 0;
//１％でブレーキ実行。加速度にbrakeCapaをべき乗
    static function runBrake( float $brakeCapa, float $event ){
        $brakeCapa = $_SESSION["brakeCapa"][$index];
        if( rand(1, 100) <= $event){
            self::$accel = self::$accel *( -1 * $brakeCapa);
        }
    }
}