<?php
session_start();

//セッションが入ってなければ初期化
$_SESSION["player_name"] ??= [];
$_SESSION["brand"]   ??= [];
$_SESSION["capacity"]??= [];
$_SESSION["price"]   ??= [];
$_SESSION["accel"]   ??= [];
$_SESSION["passenger_num"] ??= [];
$_SESSION["errormsg"] ??= ""; //設定画面用
$_SESSION["speed"]   ??= []; //ゲーム用
$_SESSION["position"] ??= []; //ゲーム用
$_SESSION["coord"] ??= []; //座標　ゲーム用
$_SESSION["ranking"] ??= []; //順位　ゴール判定になったら$_SESSION["player_name"]が入る

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //register.phpからPOSTされたnameをチェック＄エラー生成（あれば）＆セッション格納（なければ）
    $errormsg = "";

    $playerName = trim(mb_convert_kana($_POST["input_name"], "s")); //空白を半角にして消す
    $carBrand = $_POST["selected_brand"];

    // 名前の空白と重複、長さをチェックし、問題なければ選んだブランド名の車を生成
    if ($playerName === "") {
        $errormsg = "名前が空白です";
    } elseif (in_array($playerName, $_SESSION["player_name"])) {
        $errormsg = "この名前はすでに使われています。";
    } elseif (mb_strlen($playerName) > 15 ) {
            $errormsg = "名前が長すぎます";
    } else {
        require_once("../Cars/$carBrand.php"); // ブランド名のphpファイルが呼ばれる
        $$carBrand = new $carBrand(); // ブランド名のインスタンスがブランド名のオブジェクト名で生成される

        // プレイヤー名だけ別途追加
        $_SESSION["player_name"][] = $playerName;
    }
}

    $_SESSION["errormsg"] = $errormsg;

    //Start.phpにリダイレクトして終了
    header("Location: Start.php");
    exit;