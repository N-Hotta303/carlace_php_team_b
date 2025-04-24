<?php
class CarAction {
    public static function changeStatus() {
        // 1秒進める用にターン数カウント
        $_SESSION["turn"] = ($_SESSION["turn"] ?? 0) + 1;

        for ($i = 0; $i < count($_SESSION["player_name"]); $i++) {
            // ゴール済みなら処理スキップ
            if (in_array($_SESSION["player_name"][$i], $_SESSION["ranking"])) 
            continue;

            $event = EventNum::getEvent($_SESSION["position"][$i]); //位置に応じたブレーキ率取得
            $accel = Brake::actBrake($i, $event); //ブレーキ率に応じてブレーキを作動し、加速度を取得
            $_SESSION["velocity"][$i] += $accel; //加速度を速度に加算

            //速度が上限を超えたら丸め処理
            if ($_SESSION["velocity"][$i] > $_SESSION["maxSpeed"][$i]) {
                $_SESSION["velocity"][$i] = $_SESSION["maxSpeed"][$i];
            }

            $_SESSION["position"][$i] += $_SESSION["velocity"][$i] + 0.5 * $accel; //速度と加速度に応じて進んだ距離を加算

            MapAction::changeCoord($i); //距離に応じて座標を取得
            PlayerAction::setSquare($i); //座標に応じてアイコンを移動

            // ゴールラインを超えた人を記録しておく（後で順位を決める）
            if ($_SESSION["position"][$i] >= 6200) {
                $newFinishers[] = [
                    'index' => $i,
                    'position' => $_SESSION["position"][$i],
                ];
            }
        }

        // 新たにゴールした人がいれば、positionでソートしてから追加
        if (!empty($newFinishers)) {
            usort($newFinishers, function ($a, $b) {
                return $b['position'] <=> $a['position']; // 降順（大きい順）で$newFinishersの順番変更
            });

            foreach ($newFinishers as $finisher) {
                $idx = $finisher['index'];
                $name = $_SESSION["player_name"][$idx];

                // まだ登録されていない場合だけ追加
                if (!in_array($name, $_SESSION["ranking"])) {
                    $_SESSION["ranking"][] = $name;
                    $_SESSION["goal_time"][] = $_SESSION["turn"];
                }
            }
        }

        //ゲーム画面にリダイレクトして終了
        header("Location: Game.php");
        exit;
    }
}