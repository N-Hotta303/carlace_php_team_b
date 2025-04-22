<?php
require_once("Honda.php");
$honda = new Honda();
require_once("Nissan.php");
$nissan = new Nissan();
require_once("Ferrari.php");
$ferrari = new ferrari();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>３社比較</title>
</head>
<body>
    <table>
        <tr>
            <td>
            </td>
            <td>定員数 </td>
            <td>価格</td>
            <td>加速度</td>
        </tr>
        <tr>
            <td><?php echo $honda->brand ?></td>
            <td><?=$honda->capMin?>～<?=$honda->capMax ?></td>
            <td><?=$honda->priceMin?>～<?=$honda->priceMax ?></td>
            <td><?php echo $honda->acceleration ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?=$_SESSION["cars"]["Honda"]["capacity"] ?></td>
            <td><?=$_SESSION["cars"]["Honda"]["price"] ?></td>
            <td><?=$_SESSION["cars"]["Honda"]["acceleration"] ?></td>
        </tr>
        <tr>
            <td><?php echo $nissan->brand ?></td>
            <td><?php echo $nissan->capMin."～".$nissan->capMax; ?></td>
            <td><?php echo $nissan->priceMin."～".$nissan->priceMax; ?></td>
            <td><?php echo $nissan->acceleration ?></td>
        </tr>
        
        <tr>
            <td></td>
            <td><?=$_SESSION["cars"]["Nissan"]["capacity"] ?></td>
            <td><?=$_SESSION["cars"]["Nissan"]["price"] ?></td>
            <td><?=$_SESSION["cars"]["Nissan"]["acceleration"] ?></td>
        </tr>
        <tr>
            <td><?php echo $ferrari->brand ?></td>
            <td><?php echo $ferrari->capMin."～".$ferrari->capMax; ?></td>
            <td><?php echo $ferrari->priceMin."～".$ferrari->priceMax; ?></td>
            <td><?php echo $ferrari->acceleration ?></td>
        </tr>
        
        <tr>
            <td></td>
            <td><?=$_SESSION["cars"]["Ferrari"]["capacity"] ?></td>
            <td><?=$_SESSION["cars"]["Ferrari"]["price"] ?></td>
            <td><?=$_SESSION["cars"]["Ferrari"]["acceleration"] ?></td>
        </tr>
    </table>
</body>
</html><?php
require_once("Honda.php");
$honda = new Honda();
require_once("Nissan.php");
$nissan = new Nissan();
require_once("Ferrari.php");
$ferrari = new ferrari();
?>