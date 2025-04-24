<?php
class MapAction {
    //$index人目の位置$posを元に、座標["coord"]を更新する
    public static function changeCoord($index) {
        $pos = $_SESSION["position"][$index];
        $_SESSION["coord"][$index] = self::positionToCoord($pos);
    }

    // 位置から座標を取り出す
    private static function positionToCoord($pos) {
        // 位置→座標の対応ロジック
    }
}