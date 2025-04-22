<?php
class Car {
    public string $brand; //ブランド名（キーになる）
    public int $capacity; //定員数
    public float $price; //価格
    public float $acceleration;
    public int $maxSpeed;
    public float $brakeCapa;

    function Brake( float $brakeCapa ){
        if( rand(1, 100) === 1){
            $this->acceleration = $this->acceleration *( 0.8 * $brakeCapa);
        }
    }

    public function __construct(string $brand, int $capMin, int $capMax, float $priceMin, float $priceMax, float $accel, int $maxSpeed) {
        $this->brand = $brand;
        $this->capacity = rand($capMin, $capMax); //定員数を出す
        $this->price = rand($priceMin * 100, $priceMax * 100) / 100; //価格を出す
        $this->acceleration = $accel; //加速度を入れる
        $this->maxSpeed = $maxSpeed; //最高速度を入れる


        //セッションに保存（ブランド名をキーにすることで複数台対応）
        $_SESSION["cars"][$this->brand] = [
            "capacity" => $this->capacity,
            "price" => $this->price,
            "acceleration" => $this->acceleration
        ];
    }
}