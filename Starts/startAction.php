<?php
session_start();

// セッション初期化
$_SESSION["player_name"] ??= [];
$_SESSION["brand"]   ??= [];
$_SESSION["capacity"]??= [];
$_SESSION["price"]   ??= [];
$_SESSION["accel"]   ??= [];
$_SESSION["passenger_num"] ??= [];
$_SESSION["brake_capa"] ??= [];
$_SESSION["errormsg"] ??= "";
$_SESSION["speed"]   ??= [];
$_SESSION["position"] ??= [];
$_SESSION["coord"] ??= [];
$_SESSION["ranking"] ??= [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $errormsg = "";

    $playerName = trim(mb_convert_kana($_POST["input_name"], "s"));
    $carBrand = $_POST["selected_brand"];

    if ($playerName === "") {
        $errormsg = "名前が空白です";
    } elseif (in_array($playerName, $_SESSION["player_name"])) {
        $errormsg = "この名前はすでに使われています。";
    } elseif (mb_strlen($playerName) > 15 ) {
        $errormsg = "名前が長すぎます";
    } else {
        require_once("../Cars/$carBrand.php");

        try {
            $carInstance = new $carBrand(); // インスタンス作成
        } catch (Exception $e) {
            $errormsg = "車両データの生成に失敗しました";
        }

        if (!$errormsg) {
            // 成功したらすべてのセッション情報を一括で追加
            $_SESSION["player_name"][] = $playerName;
            $index = count($_SESSION["player_name"]);

            $_SESSION["brand"][$index] = $carInstance->brand;
            $_SESSION["price"][$index] = $carInstance->price;
            $_SESSION["capacity"][$index] = $carInstance->capacity;
            $_SESSION["accel"][$index] = $carInstance->acceleration;
            $_SESSION["passenger_num"][$index] = $carInstance->passengerNum;
            $_SESSION["brake_capa"][$index] = $carInstance->brake_capa;
        }
    }

    $_SESSION["errormsg"] = $errormsg;
    header("Location: Start.php");
    exit;
}