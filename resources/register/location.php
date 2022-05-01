<?php
include "../../init.php";

function getDistritosJSON(){
    $query = "SELECT * FROM Distrito";
    $result = getQuery($query);
    return $result;

}

function getConcelhosJson($idDistrito)
{
    $query = "SELECT cod_concelho,nome FROM Concelho WHERE Concelho.cod_distrito = '{$idDistrito}';";
    $result = getQuery($query);
    return $result;
}
function getFreguesiasJson($idConcelho)
{

    $query = "SELECT cod_freguesia,nome FROM Freguesia WHERE Freguesia.cod_concelho = '{$idConcelho}';";
    $result = getQuery($query);
    return $result;
}

if(isset($_REQUEST["request"])){

    if($_REQUEST["request"]== "Concelho"){
        if(isset($_REQUEST['id'])){
            $concelhos = getConcelhosJson($_REQUEST['id']);
            header("Content-Type: application/json");
            echo json_encode($concelhos);
        }else{
            die();
        }


    }elseif ($_REQUEST["request"]== "Freguesia"){
        if(isset($_REQUEST['id'])){
            $freguesias = getFreguesiasJson($_REQUEST['id']);
            header("Content-Type: application/json");
            echo json_encode($freguesias);
        }else{
            die();
        }

    }elseif ($_REQUEST["request"]== "Distritos"){
        $distritos = getDistritosJSON();
        header("Content-Type: application/json");
        echo json_encode($distritos);


    }else{
        exit();
    }



}





?>