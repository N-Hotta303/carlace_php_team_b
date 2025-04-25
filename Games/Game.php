<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  .map-container {
    display: grid;
    grid-template-columns: repeat(21, 20px);
    grid-template-rows: repeat(21, 20px);
    gap: 1px;
    width: fit-content;
    margin: 20px auto;
  }

  .cell {
    width: 20px;
    height: 20px;
    background-color: #ddd;
    transition: background-color 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
  }

.icon {
  width: 8px;
  height: 8px;
  position: absolute;
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
<?php
include("map1.php");
// 20x20マスの色を指定する配列
$colors = [];
$size = 21;
for ($y = 0; $y < $size; $y++) {
  for ($x = 0; $x < $size; $x++) {
      $isTrack = false;
      foreach ($trackCells as $cell) {
          if ($cell['x'] === $x && $cell['y'] === $y) {
              $isTrack = true;
              break;
          }
      }

      $class = $isTrack ? 'track' : 'empty';

      // アイコンを表示
      if ($x == $_SESSION['coord'][$i]['x'] && $y == $_SESSION['coord'][$i]['y']) {
        echo "<div class='cell track'><div class='icon car{$i}'></div></div>";
    }

      echo "<div class='cell $class'></div>";
  }
}
?>


</div>

</body>
</html>