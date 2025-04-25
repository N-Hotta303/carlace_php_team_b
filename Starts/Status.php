<?php
session_start();
$playerCount = count($_SESSION["player_name"]);
$brandCount  = count($_SESSION["brand"]); // 各配列の件数がズレていないか確認
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プレイヤー情報t</title>
    <style>
        .player-card {
            border: 2px solid #555; /* 枠線 */
            padding: 15px;
            margin: 15px 0;
            border-radius: 10px;
            background-color: #f9f9f9;
            width: 60%;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <?php
    $playerCount = min($playerCount, $brandCount); // 一番短い配列の件数を基準にする

    for ($i = 0; $i < $playerCount; $i++) {
        echo '<div class="player-card">';
        echo "プレイヤー" .$i+1 ."： {$_SESSION["player_name"][$i]} / "; //index番号は0~3なので、1足して表示
        echo "車種： {$_SESSION["brand"][$i]} / ";
        echo "価格： {$_SESSION["price"][$i]} / ";
        echo "定員数： {$_SESSION["capacity"][$i]} / ";
        echo "乗員数： {$_SESSION["passenger_num"][$i]} / ";
        echo "加速度： {$_SESSION["accel"][$i]} / ";
        echo "ブレーキ性能： {$_SESSION["brake_capa"][$i]}<br>";
        echo "リフトアップ回数： {$_SESSION["liftCount"][$i]}<br>";
        echo "車高： {$_SESSION["height"][$i]}<br>";
        echo '</div>';
    }
    ?>
</body>
</html>


<form action ="../Games/map2.php" method="POST">
    <input type="submit" name="start" value="始める！" />
</form>