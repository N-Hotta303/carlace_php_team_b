<?php
class EventNum {
    //$posに応じてブレーキの発生確率となる値を返す
    public static function getEvent($pos): float {
        if ($pos <= 800) 
            return 0.9;
        elseif ($pos <= 1600) 
            return 0.5;
        elseif ($pos <= 2400) 
            return 0.9;
        elseif ($pos <= 3200) 
            return 0.5;
        elseif ($pos <= 4000) 
            return 0.9;
        elseif ($pos <= 4800) 
            return 0.5;
        elseif ($pos <= 5600) 
            return 0.9;
        elseif ($pos <= 6400) 
            return 0.5;
        else return 0.2;
    }
}
