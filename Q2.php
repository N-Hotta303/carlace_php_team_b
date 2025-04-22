<?php
require_once("Ferrari.php");

$ferrari = new Ferrari();

// 変更前の加速度（初期状態）
$initialAccel = $ferrari->accel;

// ランダム係数を取得
$randFactor = rand(0, 2);

// 加速度を調整
$ferrari->accel *= pow(0.8 , $randFactor);

// 車高の調整（mm）
$heightIncrease = $randFactor * 40;

$_SESSION["cars"][$ferrari->brand]["accel"] = $ferrari->accel;
$_SESSION["cars"][$ferrari->brand]["height"] = $heightIncrease;

// 変更前後の値を表示
echo "【変更前の加速度】: " . $initialAccel . "<br>";
echo "【変更後の加速度】: " . $ferrari->accel . "<br>";
echo "リフトアップ回数: " . $randFactor . "<br>";
echo "車高上昇: " . $heightIncrease . "mm<br>";
?>