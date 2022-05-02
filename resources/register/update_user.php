<?php
include SITE_ROOT . "/resources/database/dbconnections.php";
function updateValuesInstituto($values, $id)
{
    $query = "UPDATE Instituicao SET ";
    $num = count($values);
    $i = 1;
    foreach ($values as $key => $value) {
        $query .= $key . "=" . '"' . $value . '"';
        if ($i < $num) {
            $query .= ",";
        }
        $i += 1;
    }

    $query .= " WHERE Instituicao.id_U = {$id};";

    $result = setQuery($query);
    return $result;
}


function updateValuesUtilizador($values, $id){
    $query = "UPDATE Utilizador SET " ;
    $num = count($values);
    $i = 1;
    foreach($values as $key=>$value){

        $query .= $key . "=" .  '"' .$value . '"';
        if($i < $num ){
            $query .= ",";
        }
        $i+=1;

    }

    $query .= " WHERE Utilizador.id = {$id};";
    $result =setQuery($query);
    return $result;

}


function updateValuesVoluntario($values, $id){

    $query = "UPDATE Voluntario SET " ;
    $num = count($values);
    $i = 1;
    foreach($values as $key=>$value){
        $query .= $key . "=" .  '"' .$value . '"';
        if($i < $num ){
            $query .= ",";
        }
        $i+=1;
    }

    $query .= " WHERE Voluntario.id_U = {$id};";


    $result =setQuery($query);
    return $result;
}
?>