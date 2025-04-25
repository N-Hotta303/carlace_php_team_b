<?php

require_once("Honda.php");
$honda = new Honda();
require_once("Nissan.php");
$nissan = new Nissan();
require_once("Ferrari.php");
$ferrari = new ferrari();

function applyBrake($acceleration) {
    if(true) {
        $acceleration *= 0.8;
        echo "ブレーキ発生時\n";
    }
    return $acceleration;
}


//ホンダステータス
echo $honda->brand ."\n";
echo "定員数: " . $honda->capMin."～".$honda->capMax ."人\n";
echo "価格: " . $honda->priceMin."～".$honda->priceMax ."万円\n";
echo "加速度: " . $honda->acceleration ."m/s²\n";

$hondaAccel = $honda->acceleration;
$hondaAccel = applyBrake($hondaAccel); // ブレーキ処理を適用
echo "加速度: " . $hondaAccel ."m/s²\n\n";

//日産ステータス
echo $nissan->brand ."\n";
echo "定員数: " .$nissan->capMin."～".$nissan->capMax ."人\n";
echo "価格: " .$nissan->priceMin."～".$nissan->priceMax ."万円\n";
echo "加速度: " . $nissan->acceleration ."m/s²\n";

$nissanAccel = $nissan->acceleration;
$nissanAccel = applyBrake($nissanAccel); // ブレーキ処理を適用
echo "加速度: " . $nissanAccel . "m/s²\n\n";

//フェラーリステータス
echo $ferrari->brand ."\n";
echo "定員数: " .$ferrari->capMin."～".$ferrari->capMax ."人\n";
echo "価格: " .$ferrari->priceMin."～".$ferrari->priceMax ."万円\n";
echo "加速度: " . $ferrari->acceleration ."m/s²\n";

$ferrariAccel = $ferrari->acceleration;
$ferrariAccel = applyBrake($ferrariAccel); // ブレーキ処理を適用
echo "加速度: " . $ferrariAccel . "m/s²\n\n";
?>