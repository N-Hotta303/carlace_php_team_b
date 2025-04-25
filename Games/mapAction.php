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
        global $trackCells;

        // トラック全体の長さを取得
        $trackLength = count($trackCells);
        $maxProgress = 7880; // 進行度の最大値（余裕をもっとく）
    
        // 進行度をtrackCellのインデックスに変換（端が100を超えないように）
        $currSq = floor($pos / $maxProgress) * ($trackLength - 1);
    
        // 安全のため範囲を制限
        $currSq = max(0, min($currSq, $trackLength - 1));

        return $trackCells[$currSq];
    }
}