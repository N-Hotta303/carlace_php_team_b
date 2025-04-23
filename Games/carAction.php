<?php
//１％でブレーキ実行。加速度にbrakeCapaをべき乗
    function Brake( float $brakeCapa ){
        if( rand(1, 100) === 1){
            $_SESSION["accel"][$index] = $_SESSION["accel"] *( 0.8 * $brakeCapa);
        }
    }
