<?php
class PlayerAction {
    public static function setSquare($index) {
        // 位置をセッションの座標から取得
        $coord = $_SESSION["coord"][$index]; // 例: ['top' => '100px', 'left' => '150px']

        // プレイヤーのHTML的な位置情報をセッションに保存（ビューで使う）
        $_SESSION["player_style"][$index] = "top: {$coord['top']}; left: {$coord['left']};";
    }
}