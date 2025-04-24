<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  .map-container {
    display: grid;
    grid-template-columns: repeat(25, 20px);
    grid-template-rows: repeat(25, 20px);
    gap: 1px;
    width: fit-content;
    margin: 20px auto;
  }

  .cell {
    width: 20px;
    height: 20px;
    background-color: #ddd;
    transition: background-color 0.3s;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 1px;
  }

  .track {
    background-color: #444;
  }

  .car {
    background-color: red;
    border-radius: 50%;
  }
  .event {
  background-color: yellow;
}
  .empty {
  background-color: #ddd;
}
.icon {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.car1 { background-color: red; }
.car2 { background-color: blue; }
.car3 { background-color: green; }
.car4 { background-color: purple; }
</style>
</head>
<body>
    
<div class="map-container">
  <!-- ここにマスを配置 -->
  <?php
// 25x25マスの色を指定する配列
$colors = [];
$size = 20;

// 配列を生成（全マスはデフォルトで灰色）
for ($y = 0; $y <= $size; $y++) {
    for ($x = 0; $x < $size; $x++) {
        // 全てのマスを灰色に設定
        $colors[$y][$x] = 'empty';  // ここで「灰色」を指定
    }
}


for ($y = 0; $y < $size; $y++) {
    for ($x = 0; $x < $size; $x++) {
        if ($y == 12 && $x == 5) {
            // 特定のマスにだけ4台の車アイコンを表示
            echo "<div class='cell track'>
                    <div class='icon car1'></div>
                    <div class='icon car2'></div>
                    <div class='icon car3'></div>
                    <div class='icon car4'></div>
                  </div>";
        } 
        elseif ($y == 10 && $x == 5) {
            echo "<div class='cell track'>
                    <div class='icon car1'></div>
                  </div>";
        }
        elseif ($y == 10 && $x == 6) {
            echo  "<div class='cell track'>
            <div class='icon track'></div>
            </div>";
        }
        elseif ($y == 10 && $x == 7) {
            echo  "<div class='cell track'>
            <div class='icon track'></div>
            </div>";
        }
        elseif ($y == 10 && $x == 8) {
            echo  "<div class='cell track'>
            <div class='icon track'></div>
            </div>";
        }
        elseif ($y == 10 && $x == 9) {
            echo  "<div class='cell track'>
            <div class='icon track'></div>
            </div>";
        }
        elseif ($y == 10 && $x == 10) {
            echo  "<div class='cell track'>
            <div class='icon track'></div>
            </div>";
        }
        else {
            $class = $colors[$y][$x];
            echo "<div class='cell $class'></div>";
        }
    }
}


?>

</div>

</body>
</html>