<?php
require_once("Ferrari.php");

$ferrari = new Ferrari();
$initialAccel = $ferrari->accel;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Ferrari 調整インタラクティブ</title>
    <style>
        .hidden { display: none; }
        button {
            margin: 10px 5px;
            padding: 8px 16px;
            font-size: 16px;
        }
        .info {
            margin: 15px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <h2>Ferrari リフトアップ調整</h2>

    <div class="info">
        <strong>【変更前の加速度】</strong>: <?= $initialAccel ?>m/s&sup2<br>
    </div>

    <div class="info">
        <strong>リフトアップ回数</strong>: <span id="liftCount"></span>回<br>
        <strong>【変更後の加速度】</strong>: <span id="adjustedAccel"><?= $initialAccel ?></span>m/s&sup2<br>
        <strong>車高上昇</strong>: <span id="height">0</span>mm<br>
    </div>

    <button onclick="changeLift(-1)">−1</button>
    <button onclick="changeLift(1)">＋1</button>

    <script>
        class FerrariAdjustment {
            constructor(initialAccel) {
                this.initialAccel = initialAccel;
                this.liftCount = 0;
            }

            getAdjustedAccel() {
                return this.initialAccel * Math.pow(0.8, this.liftCount);
            }

            getHeight() {
                return this.liftCount * 40;
            }

            changeLift(delta) {
                this.liftCount += delta;
                if (this.liftCount < 0) this.liftCount = 0;
                if (this.liftCount > 2) this.liftCount = 2;
                this.updateDisplay();
            }

            updateDisplay() {
                const adjustedAccel = this.getAdjustedAccel();
                const height = this.getHeight();

                document.getElementById("liftCount").textContent = this.liftCount;
                document.getElementById("adjustedAccel").textContent = adjustedAccel.toFixed(2);
                document.getElementById("height").textContent = height;
            }
        }

        const ferrariAdjustment = new FerrariAdjustment(<?= $initialAccel ?>);

        function changeLift(delta) {
            ferrariAdjustment.changeLift(delta);
        }

        // 初期表示
        ferrariAdjustment.updateDisplay();
    </script>

</body>
</html>