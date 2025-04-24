<?php
    session_start();

    //コーディング中用、セッション消去コマンド（結果画面まで完成したら消して可）
    //$_SESSION = []; 
    //session_destroy();

    //終了画面から戻った場合、セッションを破棄してリダイレクト
    if (isset($_POST["go_back"])) {
        $_SESSION = [];
        session_destroy();
        header("Location: Start.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開始画面</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@700&display=swap" rel="stylesheet">
    <style>
       
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: sans-serif;
            background-color: #f5f5f5;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }
        .error-msg {
            color: red;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .container {
            background-color: white;
            padding: 30px;
            border: 2px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .title {
            font-family: 'Zen Maru Gothic' , sans-serif;
            font-weight: 700;
            font-size: 42px;
            color: #ff0066;
            text-shadow: 2px 2px 0 #fff, 4px 4px 0 #ff99cc;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!--errormsgがあれば表示-->
    <?php if( isset($_SESSION["errormsg"])){ ?>
        <p class="error-msg"><?=$_SESSION["errormsg"]?></p>
        <?php unset($_SESSION["errormsg"]); ?> <!--表示したのでセッションから削除-->
    <?php } ?>


    <!--名前入力と車種選択フォーム-->
    <?php if (!isset($_SESSION["player_name"]) || count($_SESSION["player_name"]) < 4): ?>
        <form action="startAction.php" method="POST">
            <label>プレイヤー名：</label>
            <input type="text" name="input_name" required> <!--requiredがあるので、空だと進めない-->

            <label>車種：</label>
            <select name="selected_brand" required> <!--requiredがあるので、空だと進めない-->
                <option value="Honda">HONDA</option>
                <option value="Nissan">NISSAN</option>
                <option value="Toyota">TOYOTA</option>
                <option value="Ferrari">FERRARI</option>
            </select>

            <button type="submit">追加する</button>
        </form>
    <?php endif; ?>


    <!--追加された名前と車種を表示する-->
    <h1>現在のプレイヤー</h1>
    <ul>
    <?php
    if( isset($_SESSION["player_name"]) && isset($_SESSION["brand"])) {
        for ($i = 0; $i < count($_SESSION["player_name"]); $i++) {
            $name = $_SESSION["player_name"][$i];
            $brand = $_SESSION["brand"][$i] ?? "（未設定）"; // brandがない場合の保険
            echo "<li>{$name} さん：{$brand}</li>";
        }
    }
    ?>
    </ul>
    
    <!--ゲームを始めるボタン-->
    <!--player_idが入っていて、4名いるかをチェックして実行する-->
    <?php if( isset($_SESSION["player_name"]) && count($_SESSION["player_name"]) === 4){ ?>
        <form action="Status.php" method="post">
            <input type="submit" name="start" value="車のステータスを確認" />
        </form>
    <?php } ?>

</body>
</html>