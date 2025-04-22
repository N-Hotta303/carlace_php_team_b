<?php
require_once("Honda.php");
$honda = new Honda();
require_once("Nissan.php");
$nissan = new Nissan();
require_once("Ferrari.php");
$ferrari = new ferrari();


echo $honda->brand ."\n";
echo $honda->capMin."～".$honda->capMax ."\n";
echo $honda->priceMin."～".$honda->priceMax ."\n";
echo $honda->acceleration ."\n";
echo $nissan->brand ."\n";
echo $nissan->capMin."～".$nissan->capMax ."\n";
echo $nissan->priceMin."～".$nissan->priceMax ."\n";
echo $nissan->acceleration ."\n";
echo $ferrari->brand ."\n";
echo $ferrari->capMin."～".$ferrari->capMax ."\n";
echo $ferrari->priceMin."～".$ferrari->priceMax ."\n";
echo $ferrari->acceleration ."\n";
?>