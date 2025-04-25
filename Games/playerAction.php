<?php
class PlayerAction {
    // positionからマス番号（0～31）を計算
    public static function getSquareIndexByPosition($position) {
        return floor($position / 100) % 32;
    }

    // プレイヤーのマス番号をセッションに保存
    public static function setSquare($index) {
        if (!isset($_SESSION["position"][$index])) return;

        $position = $_SESSION["position"][$index];
        $square = self::getSquareIndexByPosition($position);

        $_SESSION["coord"][$index] = $square; // coord にはマス番号を格納
    }
}