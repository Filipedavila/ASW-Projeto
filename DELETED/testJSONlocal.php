<?php

function getFreguesiasteste($idConcelho)
{

    $query = "SELECT cod_freguesia,nome FROM Freguesia WHERE Freguesia.cod_concelho = '{$idConcelho}';";
    $result = getQuery($query);
    return $result;
}


ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../../init.php";
ini_set('display_errors', 1);


header("Content-Type: application/json");
$teste = getFreguesiasteste(1106);
echo json_encode($teste);



?>