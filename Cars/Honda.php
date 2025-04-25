<?php
require_once("Car.php");

class Honda extends Car{
    public function __construct(){
        parent::__construct($brand='Honda',$capMin=5, $capMax=6, $priceMin=300, $priceMax=500, $accel=6, $maxSpeed=55, $brake_capa=1.0);
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
