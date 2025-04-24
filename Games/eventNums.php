<?php
class EventNum {
    //$posに応じてブレーキの発生確率となる値を返す
    public static function getEvent($pos): float {
        if ($pos >= 500 && $pos <= 800) return 0.9;
        elseif ($pos >= 300 && $pos < 500) return 0.5;
        else return 0.2;
    }
}
