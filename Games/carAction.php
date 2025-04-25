<?php
session_start();
require_once 'eventNums.php';
require_once 'Brake.php';
require_once 'mapAction.php';
require_once 'playerAction.php';

class CarAction {
    public static function changeStatus() {
        // 1秒進める用にターン数カウント
        $_SESSION["turn"] = ($_SESSION["turn"] ?? 0) + 1;

        $newFinishers = []; // ゴールした人のリストを初期化

        for ($i = 0; $i < count($_SESSION["player_name"]); $i++) {
            // ゴール済みなら処理スキップ
            if (in_array($_SESSION["player_name"][$i], $_SESSION["ranking"])) 
                continue;

            $event = EventNum::getEvent($_SESSION["position"][$i]); //位置に応じたブレーキ率取得
            $accel = Brake::actBrake($i, $event); //ブレーキ率に応じて加速度取得

            $_SESSION["velocity"][$i] += $accel; //加速度を速度に加算

            // 速度が上限を超えたら制限
            if ($_SESSION["velocity"][$i] > 56) {
                $_SESSION["velocity"][$i] = 56;
            }

            //マイナスを制限
            if ($_SESSION["velocity"][$i] < 0) {
                $_SESSION["velocity"][$i] = 0;
            }

            $_SESSION["position"][$i] += $_SESSION["velocity"][$i] + 0.5 * $accel; //移動距離を加算

            MapAction::changeCoord($i);       // 座標更新
            PlayerAction::setSquare($i);      // マスの位置更新

            // ゴール判定と記録
            if ($_SESSION["position"][$i] >= 6400) {
                $newFinishers[] = [
                    'index' => $i,
                    'position' => $_SESSION["position"][$i],
                ];
            }

        }

        // ゴールした人の順位を決定
        if (!empty($newFinishers)) {
            usort($newFinishers, function ($a, $b) {
                return $b['position'] <=> $a['position'];
            });

            foreach ($newFinishers as $finisher) {
                $idx = $finisher['index'];
                $name = $_SESSION["player_name"][$idx];

                if (!in_array($name, $_SESSION["ranking"])) {
                    $_SESSION["ranking"][] = $name;
                    $_SESSION["goal_time"][] = $_SESSION["turn"];
                }
            }
        }

        // ゲーム画面に戻る
        header("Location: map2.php");
        exit;
    }
}

// ==== ボタン押下時に実行する処理 ====
CarAction::changeStatus();