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
        /*マップの大きさ*/
        .map-container { 
            width: 700px;
            height: 460px;
            position: relative;
            margin: 30px auto;
        }

        /*マップ内側のステータス表*/
        .center-status {
            position: absolute;
            top: 180px; /* ← pxにすることで安定 */
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            border-collapse: collapse;
            border: 2px solid #444;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            font-size: 14px;
            z-index: 5;
        }

        /*ステータス表のセル*/
        .center-status th, .center-status td {
            border: 1px solid #666;
            padding: 4px 8px;
            text-align: center;
        }

        /*マップのマス*/
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

        /*アイコン*/
        .player {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: absolute;
            z-index: 10;
            border: 3px solid darkgray;
        }
        .turn-counter {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="map-container" id="map-container"></div>

    <!-- ターン数表示部分 -->
    <div class="turn-counter">
        現在のタイム: <?= $_SESSION["turn"] ?? 0 ?> 秒
    </div>

    <!--マップ作成部分-->
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

        //マス作成用関数
        function createCell(index, x, y) {
            const cell = document.createElement("div");
            cell.className = "cell";
            cell.textContent = index;
            cell.style.left = `${x - 30}px`;
            cell.style.top = `${y - 30}px`;
            container.appendChild(cell);
        }

        // 各座標をJavascriptに保存
        const coords = <?php echo json_encode($coords); ?>;
        // 各車アイコンをJavascriptに保存＆大文字で統一
        const brands = <?php echo json_encode($_SESSION["brand"]); ?>;

        // アイコン登録
        const brandIcons = {
            "HONDA": "🚗",
            "NISSAN": "🚙",
            "TOYOTA": "🛻",
            "FERRARI": "🏎️"
        };

        //アイコンが重ならないよう、ずらす
        const offset = [
            { dx: -12, dy: -12 },
            { dx: 12, dy: -12 },
            { dx: -12, dy: 12 },
            { dx: 12, dy: 12 }
        ];

        //各アイコン表示
        coords.forEach((cellIndex, i) => {
            const { x, y } = positions[cellIndex];
            const player = document.createElement("div");
            player.className = `player player${i}`;

            const brand = (brands[i] || "").toUpperCase(); //brand名を全て大文字に
            player.textContent = brandIcons[brand] || "🚘"; // アイコン表示（万が一未登録でもOKにする）

            player.style.left = `${x + offset[i].dx - 10}px`;
            player.style.top = `${y + offset[i].dy - 10}px`;
            container.appendChild(player);
        });
    </script>


    <!--ステータス画面の表示順を順位/進んだ距離でソートする処理-->
    <?php
    //プレイヤー数のインデックス作成
    $indexes = array_keys($_SESSION["player_name"]);

    usort($indexes, function($a, $b) {
        //$rankingにはゴール済みの名前が入る
        $ranking = $_SESSION["ranking"];

        $nameA = $_SESSION["player_name"][$a];
        $nameB = $_SESSION["player_name"][$b];

        //ランキング済なら、名前を変数に格納
        $rankA = array_search($nameA, $ranking);
        $rankB = array_search($nameB, $ranking);

        // 両方ゴール済 → ランキング順で入れ替え
        if ($rankA !== false && $rankB !== false) {
            return $rankA <=> $rankB;
        }
        // 片方のみゴール済 → ゴールした方が上
        if ($rankA !== false) return -1;
        if ($rankB !== false) return 1;

        // どちらもレース中 → positionで比較
        return $_SESSION["position"][$b] <=> $_SESSION["position"][$a];
    });
    ?>

    <!--ステータス画面-->
    <table class="center-status">
        <tr><th>プレイヤー</th><th>進んだ距離</th><th>速度</th><th>ブレーキ</th><th>順位</th></tr>
        <!--並び変えたインデックスを添え字にしてステータス表示-->
        <?php foreach ($indexes as $i): ?>
    <?php
        $name = htmlspecialchars($_SESSION["player_name"][$i]);
        $brand = strtoupper($_SESSION["brand"][$i] ?? ""); // ブランドを大文字に
        $icons = [
            "HONDA" => "🚗",
            "NISSAN" => "🚙",
            "TOYOTA" => "🛻",
            "FERRARI" => "🏎️"
        ];
        $icon = $icons[$brand] ?? "🚘";
    ?>
    <tr>
        <td><?= $icon . " " . $name ?></td>
            <td><?= $_SESSION["position"][$i] ?>m</td>
            <td><?= number_format($_SESSION["velocity"][$i] * 3.6, 2) ?>km/h</td>
            <td><?= $_SESSION["braked"][$i] ? "⚠ ブレーキ" : "－" ?></td>
            <?php
            $rankIndex = array_search($_SESSION["player_name"][$i], $_SESSION["ranking"]);
            ?>
            <td><?= ($rankIndex !== false) ? ($rankIndex + 1) . " 位" : "レース中" ?></td>
        </tr>
        <?php endforeach; ?>
    </table>


    <!--// すべてのプレイヤーがゴールしたらリザルト画面へ-->
    <?php if (count($_SESSION["ranking"]) === count($_SESSION["player_name"])) { ?>
        <form action="../Results/Result.php" method="post">
        <button type="submit">▶ リザルト確認</button>
        </form>
    <?php } else {?>
        <!--// ゴールしてない車がいれば「進む」ボタン表示-->
        <form action="carAction.php" method="post">
        <button type="submit">▶ 進む</button>
        </form>
    <?php } ?>


    <form id="autoForm" action="carAction.php" method="POST">
    <input type="hidden" name="auto" value="1">
</form>

<!-- 停止ボタン -->
<button id="stopButton">停止</button>

<script>
    // インターバルIDを保持
    let intervalId = setInterval(() => {
        document.getElementById("autoForm").submit();
    }, 2000); // 3秒おきに送信

    // 停止ボタンが押されたとき
    document.getElementById("stopButton").addEventListener("click", () => {
        clearInterval(intervalId); // 自動送信を止める
    });
</script>
      
</body>
</html>