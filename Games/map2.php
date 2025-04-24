<?php
session_start();

// プレイヤーごとの現在マス番号（0〜31）が格納されていることを想定
$coords = $_SESSION["coord"] ?? [];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>トラック型マップ</title>
    <style>
        .map-container {
            width: 700px;
            height: 460px;
            position: relative;
            margin: 30px auto;
        }

        .cell {
            width: 60px;
            height: 60px;
            background-color: #eee;
            border: 1px solid #999;
            position: absolute;
            text-align: center;
            line-height: 60px;
            border-radius: 10px;
            font-weight: bold;
        }

        .player {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: absolute;
            z-index: 10;
            border: 2px solid white;
        }

        .player0 { background-color: red; }
        .player1 { background-color: blue; }
        .player2 { background-color: green; }
        .player3 { background-color: orange; }
    </style>
</head>
<body>
    <div class="map-container" id="map-container"></div>

    <script>
        const container = document.getElementById("map-container");
        const r = 160;
        const centerY = 230;
        const centerLeft = 60;
        const centerRight = 640;
        const positions = [];

        // 上辺（0～7）
        for (let i = 0; i < 8; i++) {
            const x = 122 + i * 65;
            const y = 60;
            createCell(i, x, y);
            positions[i] = { x, y };
        }

        // 右辺（8～15）
        for (let i = 0; i < 8; i++) {
            const angle = -Math.PI / 2 + Math.PI * (i / 7);
            const x = centerRight + Math.cos(angle) * r;
            const y = centerY + Math.sin(angle) * r;
            createCell(8 + i, x, y);
            positions[8 + i] = { x, y };
        }

        // 下辺（16～23）
        for (let i = 0; i < 8; i++) {
            const x = 578 - i * 65;
            const y = 390;
            createCell(16 + i, x, y);
            positions[16 + i] = { x, y };
        }

        // 左辺（24～31、下から上）
        for (let i = 0; i < 8; i++) {
            const angle = Math.PI / 2 + Math.PI * ((7 - i) / 7);
            const x = centerLeft + Math.cos(angle) * r;
            const y = centerY + Math.sin(angle) * r;
            const index = 24 + (7 - i);
            createCell(index, x, y);
            positions[index] = { x, y };
        }

        function createCell(index, x, y) {
            const cell = document.createElement("div");
            cell.className = "cell";
            cell.textContent = index;
            cell.style.left = `${x - 30}px`;
            cell.style.top = `${y - 30}px`;
            container.appendChild(cell);
        }

        // coord（マス番号）をPHPから取得
        const coords = <?php echo json_encode($coords); ?>;

        const offset = [
            { dx: -12, dy: -12 },
            { dx: 12, dy: -12 },
            { dx: -12, dy: 12 },
            { dx: 12, dy: 12 }
        ];

        coords.forEach((cellIndex, i) => {
            const { x, y } = positions[cellIndex];
            const player = document.createElement("div");
            player.className = `player player${i}`;
            player.style.left = `${x + offset[i].dx - 10}px`;
            player.style.top = `${y + offset[i].dy - 10}px`;
            container.appendChild(player);
        });
    </script>
    
    <form action="carAction.php" method="post">
    <button type="submit">▶ 進む</button>
    </form>

</body>
</html>