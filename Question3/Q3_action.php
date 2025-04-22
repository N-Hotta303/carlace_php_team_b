<?php
session_start();
require_once("Nissan.php");
require_once("Honda.php");
require_once("Ferrari.php");

// セッションの初期化（上書き防止のため）
$_SESSION["cars"]["Nissan"] = [];
$_SESSION["cars"]["Honda"] = [];
$_SESSION["cars"]["Ferrari"] = [];

// 1〜10台ランダムで生成
$NissanNums = rand(1, 10);
$HondaNums = rand(1, 10);
$FerrariNums = rand(1, 10);

for ($i = 0; $i < $NissanNums; $i++) {
    $nissan = new Nissan();

    // ニッサンをインデックス付きでセッションに保存
    $_SESSION["cars"]["Nissan"][] = [
        "capacity" => $nissan->capacity,
        "price" => $nissan->price,
        "acceleration" => $nissan->accel,
        "maxSpeed" => $nissan->maxSpeed,
    ];
}

for ($i = 0; $i < $HondaNums; $i++) {
    $honda = new Honda();
    
    // ホンダをインデックス付きでセッションに保存
    $_SESSION["cars"]["Honda"][] = [
        "capacity" => $honda->capacity,
        "price" => $honda->price,
        "acceleration" => $honda->accel,
        "maxSpeed" => $honda->maxSpeed,
    ];
}

for ($i = 0; $i < $FerrariNums; $i++) {
    $ferrari = new Ferrari();
        
    // フェラーリをインデックス付きでセッションに保存
    $_SESSION["cars"]["Ferrari"][] = [
        "capacity" => $ferrari->capacity,
        "price" => $ferrari->price,
        "acceleration" => $ferrari->accel,
        "maxSpeed" => $ferrari->maxSpeed,
    ];
}

//平均価格
    //合計台数
    function sumCars( $NissanNums, $HondaNums, $FerrariNums ){
        return $NissanNums + $HondaNums + $FerrariNums;
    }
    $sumCars = sumCars( $NissanNums, $HondaNums, $FerrariNums );

    //合計金額
    $nissanTotal = 0;
    foreach ($_SESSION["cars"]["Nissan"] as $car) {
        $nissanTotal += $car["price"];
    }

    $hondaTotal = 0;
    foreach ($_SESSION["cars"]["Honda"] as $car) {
        $hondaTotal += $car["price"];
    }

    $ferrariTotal = 0;
    foreach ($_SESSION["cars"]["Ferrari"] as $car) {
        $ferrariTotal += $car["price"];
    }
    $TotalPrice = floor($nissanTotal + $hondaTotal + $ferrariTotal);

    //平均価格
    $avgPrice = floor($TotalPrice / $sumCars); 
?>