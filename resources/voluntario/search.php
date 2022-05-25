<?php

/**
 * @param $id
 * @return bool
 */
function isValidId($id){
    $query = "SELECT id FROM Utilizador WHERE Utilizador.id = {$id} LIMIT 1";
    $result = existsQuery($query);
    return $result;
}

/**
 * @param $id
 * @return bool
 */
function isValidDonation($id){
    $query = "SELECT id FROM Alimento WHERE Alimento.id = {$id} LIMIT 1";
    $result = existsQuery($query);
    return $result;
}


function getDonationById($id){
    $query = "SELECT * FROM Alimento WHERE Alimento.id = {$id} ";
    $result = getQuery($query);
    return $result;

}

function searchInstitutionsByConditions($valuesUtilizador,$valuesInstituto)
{
    $query = "SELECT * FROM Utilizador,Instituicao,Concelho, Freguesia, Distrito WHERE Utilizador.id = Instituicao.id_U 
    AND (Utilizador.codigo_distrito = Distrito.cod_distrito
    AND Utilizador.codigo_concelho = Concelho.cod_concelho
    AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
    AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
    AND Utilizador.codigo_concelho = Freguesia.cod_concelho)";

    $num = count($valuesUtilizador);
    $i = 1;
    if(count($valuesUtilizador)>0) {
        foreach ($valuesUtilizador as $key => $value) {
            $query .= " AND Utilizador.{$key}=". "\"".$value."\"" ;
            if ($i < $num) {

            }
            $i += 1;
        }
    }

    $num = count($valuesInstituto);
    $i = 1;
    if(count($valuesInstituto)>0) {
        foreach ($valuesInstituto as $key => $value) {
            $query .= " AND Instituicao.{$key}=". "\"".$value."\"" ;
            if ($i < $num) {

            }
            $i += 1;
        }
    }

    $result = getQuery($query);
    return $result;
}
function searchInstitutionsByConditionsAndDonations($valuesUtilizador, $donation)
{
    $query = "SELECT * FROM Utilizador,Instituicao,Alimento,Concelho, Freguesia, Distrito WHERE 
                 Utilizador.id = Instituicao.id_U AND Alimento.inst_id = Instituicao.id_U 
                    AND Alimento.tipo_doacao =  '{$donation}'
                    AND (Utilizador.codigo_distrito = Distrito.cod_distrito
                    AND Utilizador.codigo_concelho = Concelho.cod_concelho
                    AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
                    AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
                    AND Utilizador.codigo_concelho = Freguesia.cod_concelho)";
                    
    $num = count($valuesUtilizador);
    $i = 1;
    if(count($valuesUtilizador)>0) {
        foreach ($valuesUtilizador as $key => $value) {
            $query .= " AND Utilizador.{$key}=". "\"".$value."\"" ;
            if ($i < $num) {

            }
            $i += 1;
        }
    }


    $result = getQuery($query);

    return $result;
}
function getVoluntarioLocal($id){
    $query = "SELECT codigo_distrito, codigo_concelho, codigo_freguesia FROM Utilizador WHERE id = {$id}";
    return getOneResultQuery($query);
}
/**Função que obtem os institutos compativeis a um certo voluntario
 * @param $id voluntario ID
 * @return array Institutos Compativeis
 */
function getCompatibleInstitutes($id)
{
    $query = "SELECT dia,hora_inicio,hora_fim FROM Disponibilidade  WHERE id_U = '{$id}'";
    $data = getData($query);

    $result= array();
    $resultado =null;
    $local = getVoluntarioLocal($id);
    if($data != null ){
    foreach ($data as $valor) {

        $institutos = getInstituteIDBySchedule($valor);
        
        if (isset($institutos)) {
            array_push($result, $institutos);
        }
        $institutos = null;


    }

    $idInstitutes = array();
    foreach ($result as $subArray) {
        foreach ($subArray as $idInst) {
            array_push($idInstitutes, $idInst[0]);
        }

    }
    $ids = array_unique($idInstitutes);

$resultado = getInstitutesByLocalAndID($ids,$local);

}
    return $resultado;
}

/**
 * @param $voluntarioDados
 * @return array|null
 */
function getInstituteIDBySchedule($voluntarioDados){

    $query = "SELECT id_U
            FROM Disponibilidade WHERE 
            tipo LIKE 'Instituto' 
            AND dia = '{$voluntarioDados[0]}'
            AND (hora_inicio BETWEEN '{$voluntarioDados[1]}' AND '{$voluntarioDados[2]}' 
            OR hora_fim BETWEEN '{$voluntarioDados[1]}' AND '{$voluntarioDados[2]}');";

    return getData($query);
}

/**
 * @param $ids
 * @return array
 */
function getInstitutesByLocalAndID($ids,$local){
    $institutos= array();

foreach ($ids as $id)  {

    $query = "SELECT * FROM Utilizador,Instituicao, Concelho, Freguesia, Distrito
                        WHERE  Utilizador.id = '{$id}'  
                        AND Instituicao.id_U = Utilizador.id
                        AND Utilizador.codigo_distrito = '{$local['codigo_distrito']}' 
                        AND Utilizador.codigo_concelho = '{$local['codigo_concelho']}' 
                        AND Utilizador.codigo_distrito = Distrito.cod_distrito
                        AND Utilizador.codigo_concelho = Concelho.cod_concelho
                        AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
                        AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
                        AND Utilizador.codigo_concelho = Freguesia.cod_concelho;";

    $result = getOneResultQuery($query);
    array_push($institutos, $result);
    
}
return $institutos;
}


/**
 * @return array
 */
//Obter todos os distritos
function getDistritos() {
    $query = "SELECT * FROM Distrito;";
    $result = getQuery($query);
    return $result;
}

/**
 * @return array|null
 */
function getAllInstitutions()
{
    $query = "SELECT * FROM Utilizador,Instituicao,Concelho, Freguesia, Distrito
    WHERE Utilizador.id = Instituicao.id_U 
    AND Utilizador.codigo_distrito = Distrito.cod_distrito
    AND Utilizador.codigo_concelho = Concelho.cod_concelho
    AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
    AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
    AND Utilizador.codigo_concelho = Freguesia.cod_concelho;";
    $result = getQuery($query);
    return $result;
}

//Obter todos os distritos
/**
 * @param $idConcelho
 * @return array
 */
function getFreguesias($idConcelho)
{

    $query = "SELECT * FROM Freguesia WHERE Freguesia.cod_concelho = '{$idConcelho}';";
    $result = getQuery($query);
    return $result;
}

/**
 * @param $idDistrito
 * @return array
 */
//Obter todos os Concelhos
function getConcelhos($idDistrito)
{
    $query = "SELECT * FROM Concelho WHERE Concelho.cod_distrito = '{$idDistrito}';";
    $result = getQuery($query);
    return $result;
}


/**
 * @param $id
 * @return array
 */
function getVoluntario($id)
{

    $query = "SELECT * FROM Utilizador,Voluntario,Concelho, Freguesia, Distrito
    WHERE Utilizador.id = '{$id}'
    AND Utilizador.codigo_distrito = Distrito.cod_distrito
    AND Utilizador.codigo_concelho = Concelho.cod_concelho
    AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
    AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
    AND Utilizador.codigo_concelho = Freguesia.cod_concelho;";

    $result = getQuery($query);
    return $result;
}
/**
 * @param $id
 * @return array
 */
function getVoluntarioForSoap($id)
{

    $query = "SELECT DISTINCT * FROM Utilizador,Voluntario
    WHERE Utilizador.id = {$id} LIMIT 1;";

    $result = getData($query);
    return $result;
}
/**
 * @param $id
 * @return array
 */
function getInstitutionById($id)
{
    $query = "SELECT * FROM Utilizador,Instituicao, Distrito, Freguesia, Concelho  
    WHERE Utilizador.id = {$id} 
    AND Instituicao.id_u ={$id} 
    AND Utilizador.codigo_distrito = Distrito.cod_distrito
    AND Utilizador.codigo_concelho = Concelho.cod_concelho
    AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
    AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
    AND Utilizador.codigo_concelho = Freguesia.cod_concelho;";
    $result = getQuery($query);
    return $result;
}

/**
 * @param $idDistrito
 * @param $idConcelho
 * @return array
 */
function getConcelhosById($idDistrito,$idConcelho)
{
    $query = "SELECT * FROM Concelho  WHERE Concelho.cod_concelho = '{$idDistrito}' AND Concelho.cod_distrito = '{$idConcelho}' ";

    $result = getQuery($query);
    return $result;
}

/**
 * @param $id
 * @return array
 */
function getDistritoById($id)
{
    $query = "SELECT * FROM Distrito  WHERE Distrito.cod_distrito = '{$id}'";
    $result = getQuery($query);
    return $result;
}

/**
 * @param $idConcelho
 * @return array
 */
function getAllFreguesiasFromConcelho($idConcelho)
{
    $query = "SELECT cod_freguesia,nome FROM Freguesia WHERE Freguesia.cod_concelho = '{$idConcelho}';";
    $result = getQuery($query);
    return $result;
}

/**
 * @param $idConcelho
 * @param $idFreguesia
 * @return array
 */
function getFreguesiaById($idConcelho,$idFreguesia)
{
    $query = "SELECT * FROM Freguesia  WHERE Freguesia.cod_freguesia = '{$idFreguesia}' AND Freguesia.cod_concelho = '{$idConcelho}' ";
    $result = getQuery($query);
    return $result;
}

/**
 * @param $id
 * @return array
 */
function getDonationByInstitute($idInst)
{
    $query = "SELECT * FROM Alimento WHERE inst_id = '{$idInst}' AND vol_id IS NULL";
    $result = getQuery($query);
    return $result;
}

function getIdFromDonatedItems($idInst)
{
    $query = "SELECT id FROM Alimento WHERE inst_id = '{$idInst}' AND vol_id IS NULL";
    $result = getJoinedData($query);
    return $result;
}


function getIDDonationByInstitute($idInst)
{
    $query = "SELECT id FROM Alimento WHERE inst_id = '{$idInst}' AND vol_id IS NULL";
    $result = getQuery($query);
    return $result;
}

function getDonationByVol($idVol)
{
    $query = "SELECT * FROM Alimento WHERE vol_id = {$idVol}";
    $result = getQuery($query);
    return $result;
}

function updateDonation($idVol, $idInst, $idDonation){

    $conn = getConnection();
    $query = "UPDATE Alimento SET vol_id = '{$idVol}' WHERE id = '{$idDonation}' AND inst_id = '{$idInst}' AND vol_id is NULL";
    if(mysqli_query($conn, $query))
        return true;
    else {
        return false;
    }
}


function updateAndGetDonation($idVol, $idInst, $idDonation){

    $conn = getConnection();
    $query = "UPDATE Alimento SET vol_id = '{$idVol}' WHERE id = '{$idDonation}' AND inst_id = '{$idInst}' AND vol_id is NULL";
    if(mysqli_query($conn, $query))
        echo "updated";
    else {
        echo "Error". mysqli_error($conn);
    }
    return getDonationByInstitute($idInst);
}


?>