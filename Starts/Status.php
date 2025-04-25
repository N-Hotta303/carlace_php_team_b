<?php
session_start();
$playerCount = count($_SESSION["player_name"]);
$brandCount  = count($_SESSION["brand"]);
$playerCount = min($playerCount, $brandCount);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プレイヤー情報</title>

    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
            background-color: #fff;
        }

        th {
            background-color: #ddd;
        }
        .start-button {
        display: flex;
        justify-content: center;
        align-items: center;          
        font-size: 20px;
        font-family: "Rounded Mplus 1c", sans-serif;  
        padding: 12px 24px;
        width: 200px;
        height: 60px;
        border: none;
        border-radius: 10px;
        color: black;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 230%); 
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        

    </style>
</head>

<h1 style="text-align: center;">🚗【プレイヤー情報】🚗</h1></br>
<table>
    <thead>
        <tr>
            <th>プレイヤー</th>
            <th>車種</th>
            <th>価格 (万円)</th>
            <th>定員数 (人)</th>
            <th>乗員数 (人)</th>
            <th>加速度 (m/s²)</th>
            <th>ブレーキ性能 (%)</th>
            <th>リフトアップ回数</th>
            <th>車高 (+mm)</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < $playerCount; $i++): ?>
        <tr>
            <td style="text-align: left;">プレイヤー<?= $i + 1 ?>：<?= htmlspecialchars($_SESSION["player_name"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["brand"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["price"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["capacity"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["passenger_num"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["accel"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["brake_capa"][$i]*100) ?></td>
            <td><?= htmlspecialchars($_SESSION["liftCount"][$i]) ?></td>
            <td><?= htmlspecialchars($_SESSION["height"][$i]) ?></td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>

<form action="../Games/map2.php" method="POST">
    <input type="submit" name="start" value="始める！" class="start-button"/>
</form>

</body>
</html>


