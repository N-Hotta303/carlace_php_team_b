<?php
class Car {
    public string $brand;
    public int $capacity;
    public int $passengerNum;
    public float $price;
    public float $acceleration;
    public int $maxSpeed;
    public float $brake_capa;

    public function __construct(string $brand, int $capMin, int $capMax, float $priceMin, float $priceMax, float $accel, int $maxSpeed, float $brake_capa) {
        $this->brand = $brand;
        $this->capacity = rand($capMin, $capMax);
        $this->passengerNum = rand(1, $this->capacity);
        $this->price = rand($priceMin * 100, $priceMax * 100) / 100;
        $this->acceleration = round($accel * (0.95 ** $this->passengerNum), 2);
        $this->maxSpeed = $maxSpeed;
        $this->brake_capa = $brake_capa;
    }
}