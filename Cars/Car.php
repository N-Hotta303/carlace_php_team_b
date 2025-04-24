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
        $this->brand = $brand; //ブランド名
        $this->capacity = rand($capMin, $capMax); //定員数
        $this->passengerNum = rand(1, $this->capacity); //定員数を上限とした乗員数
        $this->price = floor(rand($priceMin * 100, $priceMax * 100) / 100); //価格は整数に
        $this->acceleration = round($accel * (0.95 ** $this->passengerNum), 1); //乗員1人につき5%減少した加速度（小数第1位まで）
        $this->maxSpeed = $maxSpeed; //最高速度
        $this->brake_capa = $brake_capa; //ブレーキ性能
    }
}