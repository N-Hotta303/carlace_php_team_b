<?php
    require_once("Q3_action.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1回答</title>

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
        width: 100px; /* ★ 横幅固定 */
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
            <th>台数</th>
            <td><?=$NissanNums ?></td>
        </tr>
        <tr>
            <th>価格</th>
        

        <?php foreach ($_SESSION["cars"]["Nissan"] as $index => $car) { ?>
            
                <td><?=$car["price"]?>万円</td>
            
        <?php } ?>
        </tr>
    </table>


    <!--HONDAの表-->
    <table>
        <caption>
            HONDA
        </caption>
        <tr>
            <th>台数</th>
            <td><?=$HondaNums ?></td>
        </tr>
        <tr>
            <th>価格</th>
        

        <?php foreach ($_SESSION["cars"]["Honda"] as $index => $car) { ?>
            
                <td><?=$car["price"]?>万円</td>
            
        <?php } ?>
        </tr>
    </table>


    <!--FERRARIの表-->
    <table>
        <caption>
            FERRARI
        </caption>
        <tr>
            <th>台数</th>
            <td><?=$FerrariNums ?></td>
        </tr>
        <tr>
            <th>価格</th>
        

        <?php foreach ($_SESSION["cars"]["Ferrari"] as $index => $car) { ?>
            
                <td><?=$car["price"]?>万円</td>
            
        <?php } ?>
        </tr>
    </table>
<br>
    <p style="text-align: center;">合計：<?=$TotalPrice ?>万円<br></p>
    <p style="text-align: center;">平均：<?=$avgPrice ?>万円</p>    
</body>
</html>