<?php
session_start();
$playerCount = count($_SESSION["player_name"]);
$brandCount  = count($_SESSION["brand"]); // 各配列の件数がズレていないか確認

$validCount = min($playerCount, $brandCount); // 一番短い配列の件数を基準にする

for ($i = 1; $i < $validCount; $i++) {
    echo "プレイヤー {$i}: {$_SESSION["player_name"][$i]} / ";
    echo "車種: {$_SESSION["brand"][$i]} / ";
    echo "価格: {$_SESSION["price"][$i]} / ";
    echo "乗員数: {$_SESSION["passenger_num"][$i]} / ";
    echo "加速度: {$_SESSION["accel"][$i]} / ";
    echo "ブレーキ性能: {$_SESSION["brake_capa"][$i]}<br>";
}

echo "{$_SESSION["price"][1]}";
echo "{$_SESSION["price"][2]}";
echo "{$_SESSION["price"][3]}";
echo "{$_SESSION["price"][4]}";