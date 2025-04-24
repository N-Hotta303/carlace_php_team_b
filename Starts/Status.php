<?php
session_start();
$playerCount = count($_SESSION["player_name"]);
$brandCount  = count($_SESSION["brand"]); // 各配列の件数がズレていないか確認

$playerCount = min($playerCount, $brandCount); // 一番短い配列の件数を基準にする

for ($i = 0; $i < $playerCount; $i++) {
    echo "プレイヤー" .$i+1 ."： {$_SESSION["player_name"][$i]} / "; //index番号は0~3なので、1足して表示
    echo "車種： {$_SESSION["brand"][$i]} / ";
    echo "価格： {$_SESSION["price"][$i]} / ";
    echo "定員数： {$_SESSION["capacity"][$i]} / ";
    echo "乗員数： {$_SESSION["passenger_num"][$i]} / ";
    echo "加速度： {$_SESSION["accel"][$i]} / ";
    echo "ブレーキ性能： {$_SESSION["brake_capa"][$i]}<br>";
}
?>

<form action ="../Games/Game.php" method="POST">
    <input type="submit" name="start" value="始める！" />
</form>