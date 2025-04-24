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
$_SESSION["errormsg"] ??= ""; //設定画面用
$_SESSION["speed"]   ??= []; //ゲーム用
$_SESSION["position"] ??= []; //ゲーム用
$_SESSION["coord"] ??= []; //座標　ゲーム用
$_SESSION["ranking"] ??= []; //順位　ゴール判定になったら$_SESSION["player_name"]が入る

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //register.phpからPOSTされたnameをチェック・エラー生成（あれば）＆セッション格納（なければ）
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
        require_once("../Cars/$carBrand.php"); // ブランド名のphpファイルが呼ばれる
        try {
            $carInstance = new $carBrand(); // ブランド名のインスタンス生成
        } catch (Exception $e) {
            $errormsg = "車両データの作成に失敗しました";
        }

        // 成功したら（エラーが無ければ）すべてのセッション情報を一括で追加	// プレイヤー名だけ別途追加
        if (!$errormsg) {	
            $index = count($_SESSION["player_name"]);
            $_SESSION["player_name"][] = $playerName;

            $_SESSION["brand"][$index] = $carInstance->brand;	
            $_SESSION["price"][$index] = $carInstance->price;
            $_SESSION["capacity"][$index] = $carInstance->capacity;
            $_SESSION["accel"][$index] = $carInstance->acceleration;
            $_SESSION["passenger_num"][$index] = $carInstance->passengerNum;
            $_SESSION["brake_capa"][$index] = $carInstance->brake_capa;

            $_SESSION["velocity"][$index] = 0;
            $_SESSION["position"][$index] = 0;
            $_SESSION["coord"][$index] = 0;
        }	
    }
    //作成されたエラー文をセッションに格納
    $_SESSION["errormsg"] = $errormsg;
    header("Location: Start.php");
    exit;
}