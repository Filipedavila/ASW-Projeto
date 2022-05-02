<?php 

function getFreguesias($municipio){

$jsonurl = "https://geoptapi.org/freguesia?municipio=".$freguesia;
$json = file_get_contents($jsonurl);
$data;

try {
    return json_decode($json);
} catch (JsonException $e) {
    $e->getMessage();
}

}




