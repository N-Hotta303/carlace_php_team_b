<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ゲーム結果</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f8ff;
        }
        h1 {
            color: #333;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
        }
        th {
            background-color: #cceeff;
        }
        tr:nth-child(even) {
            background-color: #e6f7ff;
        }
    </style>
</head>
<body>
    <h1>🏆 最終結果発表 🏆</h1>

    <?php
    session_start();
    $ranking = $_SESSION["ranking"];
    ?>

    <table>
        <tr>
            <th>順位</th>
            <th>プレイヤー名</th>
            <th>ゴールタイム</th>
        </tr>
        <?php foreach ($ranking as $index => $player): ?>
            <tr>
                <td><?= $index + 1 ?>位</td>
                <td><?= htmlspecialchars($player) ?></td>
                <td><?= number_format($_SESSION["goal_time"][$index]) ?>秒</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <form action="../Starts/Start.php" method="post">
        <input type="submit" name="go_back" value="最初から" />
    </form>
</body>
</html>