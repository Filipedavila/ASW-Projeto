<?php

function searchInstitutionsByConditions($valuesUtilizador,$valuesInstituto)
{
    $query = "SELECT  Utilizador.id,Instituicao.id_U,Utilizador.nome,Utilizador.tipo, Instituicao.tipo_inst, Concelho.nome as nome_concelho , Distrito.nome as nome_distrito ,
       Freguesia.nome as nome_freguesia,Utilizador.codigo_distrito,Utilizador.codigo_concelho,Utilizador.codigo_freguesia FROM Utilizador,Instituicao,Concelho, Freguesia, Distrito WHERE Utilizador.id = Instituicao.id_U AND 
(Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
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
    $query = "SELECT Utilizador.id,Instituicao.id_U,Utilizador.nome,Utilizador.tipo, Instituicao.tipo_inst, Concelho.nome as nome_concelho , Distrito.nome as nome_distrito ,
       Freguesia.nome as nome_freguesia,Utilizador.codigo_distrito,Utilizador.codigo_concelho,Utilizador.codigo_freguesia FROM Utilizador,Instituicao,Alimento,Concelho, Freguesia, Distrito WHERE 
                 Utilizador.id = Instituicao.id_U AND Alimento.inst_id = Instituicao.id_U 
                    AND Alimento.tipo_doacao =  '{$donation}' AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
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
            tipo LIKE 'Instituto' AND dia = '{$voluntarioDados[0]}'
                                   AND (hora_inicio BETWEEN '{$voluntarioDados[1]}' 
                                       AND '{$voluntarioDados[2]}' OR hora_fim BETWEEN '{$voluntarioDados[1]}' AND '{$voluntarioDados[2]}');";

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
                        WHERE  Utilizador.id = '{$id}'  AND Instituicao.id_U = Utilizador.id
                          AND (Utilizador.codigo_distrito = '{$local['codigo_distrito']}' AND Utilizador.codigo_concelho = '{$local['codigo_concelho']}' AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND  Utilizador.codigo_freguesia = Freguesia.cod_freguesia))";

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
WHERE Utilizador.id = Instituicao.id_U AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
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
WHERE Utilizador.id = '{$id}' AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)"; 
    $result = getQuery($query);
    return $result;
}

/**
 * @param $id
 * @return array
 */
function getInstitutionById($id)
{
    $query = "SELECT * FROM Utilizador,Instituicao, Distrito, Freguesia, Concelho  WHERE id = {$id} AND id_u ={$id} AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
    AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                      Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
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
function getDonationByInstitute($id)
{
    $query = "SELECT * FROM Alimento WHERE inst_id = '{$id}'";
    $result = getQuery($query);
    return $result;
}

?>