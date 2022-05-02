<?php 
$freguesia = "lisboa";
$jsonurl = "https://geoptapi.org/freguesia?municipio=".$freguesia;
$json = file_get_contents($jsonurl);
$data = json_decode($json);
foreach($data as $valor){
echo "<p> {$valor->nome}";
echo "{$valor->codigo} </p>";



}






?>