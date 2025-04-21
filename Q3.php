<?php
session_start();
require_once("Nissan.php");

// まずセッションの初期化（上書き防止のため）
$_SESSION["cars"]["Nissan"] = [];

$numCars = rand(1, 10); // 1〜10台ランダムで生成

for ($i = 0; $i < $numCars; $i++) {
    $nissan = new Nissan();

    // 各車両をインデックス付きでセッションに保存
    $_SESSION["cars"]["Nissan"][] = [
        "capacity" => $nissan->capacity,
        "price" => $nissan->price,
        "acceleration" => $nissan->acceleration,
        "maxSpeed" => $nissan->maxSpeed,
    ];
}

// 確認用出力（省略してOK）
echo "Nissan車を {$numCars} 台生成しました！<br>";
foreach ($_SESSION["cars"]["Nissan"] as $index => $car) {
    echo "🚗 Nissan #{$index}<br>";
    echo "価格: {$car["price"]}万円<br>";

}