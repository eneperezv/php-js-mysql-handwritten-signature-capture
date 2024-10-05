<?php
include 'conexion.php';

$img = $_POST['base64'];
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = '../shared/'.uniqid().'_'.$_POST['numeroplanilla'].'_.png';
file_put_contents($fileName, $fileData);

$sqlAdd = "INSERT INTO pruebas(NUMPLANILLA,URLFIRMA) VALUES ('".$_POST["numeroplanilla"]."','".$fileName."')";

mysqli_query($linknv,$sqlAdd);

header("Location: ../../index.php");
?>