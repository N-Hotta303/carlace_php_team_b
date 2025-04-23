<?php
    //session_start(); //Ferrariに入れるのでここで開始

class Car {
    public string $brand; //ブランド名（キーになる）
    public int $capacity; //定員数
    public int $passengerNum; //乗員数（定員数を上限に作成される）
    public float $price; //価格
    public float $acceleration; //加速度
    public int $maxSpeed; //限界速度

    public function __construct(string $brand, int $capMin, int $capMax, float $priceMin, float $priceMax, float $accel, int $maxSpeed) {
        //引数をメンバ変数に代入していく
        $this->brand = $brand;
        $this->capacity = rand($capMin, $capMax); //定員数を出す
        $this->passengerNum = rand( 1, $this->capacity );//定員数を上限として、乗員数を出す
        $this->price = rand($priceMin * 100, $priceMax * 100) / 100; //価格を出す
        $this->acceleration = $accel; //加速度を入れる
        $this->acceleration = round($this->acceleration * (0.95 ** $this->passengerNum), 2); //加速度を乗員数に応じて下げ、小数点第２位までとする
        $this->maxSpeed = $maxSpeed; //限界速度を入れる

        // プレイヤーの何人目かを$index取得（セッション数で判定）
        $index = count($_SESSION["player_name"]);

        // セッションに順番に追加
        $_SESSION["brand"][$index] = $this->brand;
        $_SESSION["price"][$index] = $this->price;
        $_SESSION["capacity"][$index] = $this->capacity;
        $_SESSION["accel"][$index] = $this->acceleration;
        $_SESSION["passengerNum"][$index] = $this->passengerNum;
    }
}