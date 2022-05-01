<?php
include SITE_ROOT . "/functions/crud.php";


function getCompatibleInstitutes($id)
{
    $query = "SELECT dia,hora_inicio,hora_fim FROM Disponibilidade  WHERE id_U = '{$id}' ";
    $data = getData($query);
    $result= array();
    foreach ($data as $valor) {

        $institutos = getInstituteIDBySchedule($valor);
        if(isset($institutos)){
        array_push($result,$institutos  );
        }
        $institutos=null;


    }

    $idInstitutes = array();
    foreach ($result as $subArray) {
        foreach ($subArray as $idInst){
            array_push($idInstitutes, $idInst[0]);
        }

    }
    $ids =array_unique($idInstitutes);



    return getInstitutesByIDS($ids);
}

function getInstituteIDBySchedule($voluntarioDados){


    $query = "SELECT DISTINCT id_U
            FROM Disponibilidade WHERE 
            tipo LIKE 'Instituto' AND dia = \"{$voluntarioDados[0]}\"
                                   AND (hora_inicio BETWEEN  \"{$voluntarioDados[1]}\" 
                                       AND \"{$voluntarioDados[1]}\" OR \"{$voluntarioDados[2]}\" BETWEEN  
                                           \"{$voluntarioDados[1]}\" AND \"{$voluntarioDados[2]}\");";

    return getData($query);
}

function getInstitutesByIDS($ids){
    $institutos= array();
foreach ($ids as $id)  {
    $query = "SELECT id,nome,tipo_inst,codigo_concelho,codigo_distrito,codigo_freguesia FROM Utilizador,Instituicao WHERE id_U = '{$id}' AND id = '{$id}' ";
    $result = getQuery($query);
    print_r($result);
    $result['codigo_distritos'] = getDistritoById($result[0]['codigo_distrito']);
    $result['codigo_concelhos'] = getConcelhosById($result[0]['codigo_concelho']);
    $result['codigo_freguesias'] = getFreguesiaById($result[0]['codigo_freguesia']);
    array_push($institutos, $result[0]);
}
return $institutos;
}

?>