<?php
    session_start();

    //終了画面から戻った場合、セッションを破棄してリダイレクト
    if (isset($_POST["go_back"])) {
        $_SESSION = []; 
        session_destroy();
        header("Location: Start.php");
        exit();
    }

    //セッションを強制的に消す開発用コード（必要があれば有効に）
    //$_SESSION = []; 
    //session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
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

        input[type="text"], input[type="submit"], select, button {
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

        .input-form {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #fff;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .input-form label,
        .input-form input,
        .input-form select,
        .input-form button {
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .player-list {
            border: 1px solid #ccc;
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .player-list ul {
            padding-left: 20px;
            margin: 0;
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
        <form action="startAction.php" method="POST" class="input-form">
            <label>プレイヤー名：</label>
            <input type="text" name="input_name" required>

            <label>車種：</label>
            <select name="selected_brand" required>
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
    <ul style="list-style: none; padding: 0; max-width: 400px; margin: 0 auto;">
    <?php
    if (isset($_SESSION["player_name"]) && isset($_SESSION["brand"])) {
        for ($i = 0; $i < count($_SESSION["player_name"]); $i++) {
            $name = $_SESSION["player_name"][$i];
            $brand = $_SESSION["brand"][$i] ?? "（未設定）";
            echo "
            <li style='display: flex; justify-content: space-between; border: 1px solid #ccc; padding: 8px 12px; margin-bottom: 6px; border-radius: 6px; background-color: #fff;'>
                <span>$name さん </span>
                <span>$brand</span>
            </li>";
        }
    }
    ?>
    </ul>
    
    <!--ゲームを始めるボタン-->
    <?php if( isset($_SESSION["player_name"]) && count($_SESSION["player_name"]) === 4){ ?>
        <form action="Status.php" method="post">
            <input type="submit" name="start" value="車のステータスを確認" />
        </form>
    <?php } ?>

</body>
</html>