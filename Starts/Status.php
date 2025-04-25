<?php
session_start();
$playerCount = count($_SESSION["player_name"]);
$brandCount  = count($_SESSION["brand"]); // 各配列の件数がズレていないか確認
$playerCount = min($playerCount, $brandCount); // 一番短い配列の件数を基準にする
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プレイヤー情報t</title>
    <style>
         body {
            margin: 0;
            height: 100vh;
            font-family: sans-serif;
            background-color: #f0f0f0;
        }

        .player-card {
            position: absolute;
            border: 2px solid #555; /* 枠線 */
            padding: 15px;
            margin: 15px 0;
            border-radius: 10px;
            background-color: #f9f9f9;
            width: 46%;
            font-family: sans-serif;
        }

        #player1 { top: 10px; left: 10px; }
        #player2 { top: 10px; right: 10px; }
        #player3 { bottom: 40px; left: 10px; }
        #player4 { bottom: 40px; right: 10px; }

        .start-button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <?php
    $positions = ['player1', 'player2', 'player3', 'player4'];
    for ($i = 0; $i < $playerCount; $i++) {
        $posId = $positions[$i]; // プレイヤーカードごとの位置ID
        echo  "<div id=\"$posId\" class=\"player-card\">"; // 各プレイヤーカードにidを適用
        echo "プレイヤー" . ($i + 1) ."： {$_SESSION["player_name"][$i]} / "; //index番号は0~3なので、1足して表示
        echo "車種： {$_SESSION["brand"][$i]}<br> ";
        echo "価格： {$_SESSION["price"][$i]}万円<br>";
        echo "定員数： {$_SESSION["capacity"][$i]}人<br>";
        echo "乗員数： {$_SESSION["passenger_num"][$i]}人<br> ";
        echo "加速度： {$_SESSION["accel"][$i]}m/s²<br>";
        echo "ブレーキ性能： {$_SESSION["brake_capa"][$i]}m/s²<br>";
        echo "リフトアップ回数： {$_SESSION["liftCount"][$i]}回<br>";
        echo "車高： +{$_SESSION["height"][$i]}mm<br>";
        echo '</div>';
    }
    ?>
</body>
</html>


<form action ="../Games/map2.php" method="POST" class="start-button">
    <input type="submit" name="start" value="始める！" />
</form>

