<?php
require_once("Car.php");

class Toyota extends Car{
    public int $tmp_price;
    public function __construct(){
        parent::__construct($brand='Toyota',$capMin=3, $capMax=4, $priceMin=300, $priceMax=500, $accel=5, $maxSpeed=55, $brake_capa=1.0);
        
        //価格に応じて加速度を変更
        $this->tmp_price = $this->price -300; //下限の300（万）を引く
        $this->accel = 0.02 * $this->tmp_price + 5; //加速度を価格x2% + 5で更新

        
        $this->liftCount = $this->getLift_up();
        $this->adjustAcceleration($this->liftCount);
        $this->height = $this->calculateHeight($this->liftCount);
    }

    private function getLift_up(): int {
        return 0;
    }

    private function adjustAcceleration(int $liftCount) {
        $this->acceleration *= pow(0.8, $liftCount);
    }

    private function calculateHeight(int $liftCount): int {
        return $liftCount * 40;
    }
}
?>