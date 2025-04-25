<?php
require_once("Ferrari.php");
require_once("Honda.php");
require_once("Nissan.php");

$Ferrari = new Ferrari();
$Honda = new Honda();
$Nissan = new Nissan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q4回答</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    table {
        border-collapse: collapse;
        margin: 20px auto;
        width: 80%;
        max-width: 800px;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
        table-layout: fixed;
    }

    caption {
        font-size: 1.5em;
        font-weight: bold;
        padding: 10px;
        background-color: #333;
        color: white;
    }

    th {
        background-color: #f8f8f8;
        font-weight: bold;
        width: 150px; /* ★ 横幅固定 */
        white-space: nowrap;
    }

    td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        word-break: break-word;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }
</style>
</head>
<body>
        <!--NISSANの表-->
        <table>
        <caption>
            NISSAN
        </caption>
        <tr>
            <th>今回の定員数</th>
            <td><?=$_SESSION["cars"]["Nissan"]["capacity"] ?>人</td>
        </tr>
        <tr>
            <th>今回の乗員乗員数</th>
            <td><?=$_SESSION["cars"]["Nissan"]["passengerNum"] ?>人</td>
        </tr>
        <tr>
            <th>今回の加速度</th>
            <td><?=$_SESSION["cars"]["Nissan"]["acceleration"] ?>m/s&sup2</td>
        </tr>
    </table>

        <!--HONDAの表-->
        <table>
        <caption>
            HONDA
        </caption>
        <tr>
            <th>今回の定員数</th>
            <td><?=$_SESSION["cars"]["Honda"]["capacity"] ?>人</td>
        </tr>
        <tr>
            <th>今回の乗員乗員数</th>
            <td><?=$_SESSION["cars"]["Honda"]["passengerNum"] ?>人</td>
        </tr>
        <tr>
            <th>今回の加速度</th>
            <td><?=$_SESSION["cars"]["Honda"]["acceleration"] ?>m/s&sup2</td>
        </tr>
    </table>

        <!--FERRARIの表-->
        <table>
        <caption>
            FERRARI
        </caption>
        <tr>
            <th>今回の定員数</th>
            <td><?=$_SESSION["cars"]["Ferrari"]["capacity"] ?>人</td>
        </tr>
        <tr>
            <th>今回の乗員乗員数</th>
            <td><?=$_SESSION["cars"]["Ferrari"]["passengerNum"] ?>人</td>
        </tr>
        <tr>
            <th>今回の加速度</th>
            <td><?=$_SESSION["cars"]["Ferrari"]["acceleration"] ?>m/s&sup2</td>
        </tr>
    </table>
</body>
</html>