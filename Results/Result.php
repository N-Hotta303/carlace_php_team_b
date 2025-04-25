<?php
session_start();

// 順位データとゴール時間があることを前提
$ranking = $_SESSION["ranking"] ?? [];
$goalTimes = $_SESSION["goal_time"] ?? [];
$brands = $_SESSION["brand"] ?? [];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レース結果</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 60%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #333;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

<h1>🏁 レース結果 🏁</h1>

<table>
    <tr>
        <th>順位</th>
        <th>プレイヤー名</th>
        <th>車種</th>
        <th>ゴールタイム[m's]</th>
    </tr>
    <?php for ($i = 0; $i < count($ranking); $i++): ?>
        <tr>
            <td><?= ($i + 1) ?>位</td>
            <td><?= htmlspecialchars($ranking[$i]) ?></td>
            <td>
                <?php
                $index = array_search($ranking[$i], $_SESSION["player_name"]);
                echo htmlspecialchars($brands[$index] ?? '―');
                ?>
        <td>
            <?php
            $seconds = (int)$goalTimes[$i];
            $minutes = floor($seconds / 60);
            $remainingSeconds = str_pad($seconds % 60, 2, '0', STR_PAD_LEFT);
            echo "{$minutes}' {$remainingSeconds}";
            ?>
        </td>
    <?php endfor; ?>
</table>

<form action="../Starts/Start.php" method="post">
        <input type="submit" name="go_back" value="最初から" />
    </form>

</body>
</html>