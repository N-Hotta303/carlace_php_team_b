<?php
class Brake {
    public static function actBrake($i, float $eventRate): float {
        $accel = $_SESSION["accel"][$i]; //毎ターン初期値に戻すため、セッションで変数を上書き
        $brakeCapa = $_SESSION["brake_capa"][$i]; //引数に私用するため、変数に格納

        //eventRate%で実行し加速度を下げる。実行されなければ加速度をそのまま返却
        if (rand(1, 100) <= $eventRate * 100) {
            return $accel * pow(0.8, $brakeCapa);
        }
        return $accel;
    }
}