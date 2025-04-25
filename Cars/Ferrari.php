<?php
require_once("Car.php");

class Ferrari extends Car {
    public function __construct() {
        parent::__construct('Ferrari', 1, 2, 2000, 4000, 8, 55, 1.0); // brake_capa 仮に1.2

        $this->liftCount = $this->getLift_up();
        $this->adjustAcceleration($this->liftCount);
        $this->height = $this->calculateHeight($this->liftCount);
    }

    private function getLift_up(): int {
        return rand(0,2);
    }

    private function adjustAcceleration(int $liftCount) {
        $this->acceleration *= pow(0.8, $liftCount);
    }

    private function calculateHeight(int $liftCount): int {
        return $liftCount * 40;
    }
}
?>