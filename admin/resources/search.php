<?php
/**Ficheiro que contem as funções relacionadas com as buscas do Administrador
 *
 */


/**Obtem todos os voluntarios
 * @return array
 */
function getAllVolunters()
{
    $query = "SELECT *
FROM Utilizador,Voluntario,Concelho, Freguesia, Distrito
WHERE Utilizador.id = Voluntario.id_U AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
    $result = getQuery($query);
    return $result;
}
/**
 * @return array
 */
function getAllUsers()
{
    $query = "SELECT *
FROM Utilizador,Concelho, Freguesia, Distrito
WHERE  (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
    $result = getQuery($query);
    return $result;
}


/**
 * @param $valuesUtilizador
 * @param $tipo
 * @return array
 *
 */
function searchInstitutoByLocal($valuesUtilizador)
{
    $query = "SELECT *  FROM Utilizador, Instituicao , Voluntario,Concelho, Freguesia, Distrito WHERE Utilizador.id = Instituicao.id_U 
    AND  (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
        AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
        Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";

    if(count($valuesUtilizador)>0) {
        foreach ($valuesUtilizador as $key => $value) {
            $query .= " AND Utilizador.{$key}=". "\"".$value."\"" ;

        }
    }


    $result = getQuery($query);
    return $result;
}

/**
 * @param $valuesUtilizador
 * @param $tipo
 * @return array
 *
 */
function searchVoluntarioByLocal($valuesUtilizador)
{
    $query = "SELECT *  FROM Utilizador, Voluntario ,Concelho, Freguesia, Distrito WHERE Utilizador.id = Voluntario.id_U 
    AND  (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
        AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
        Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";

    if(count($valuesUtilizador)>0) {
        foreach ($valuesUtilizador as $key => $value) {
            $query .= " AND Utilizador.{$key}=". "\"".$value."\"" ;

        }
    }


    $result = getQuery($query);
    return $result;
}

/**
 * @param $idade
 * @return array
 */
function searchVoluntarioByAge($idade)
{
    $query = "SELECT *
FROM Utilizador,Voluntario,Concelho, Freguesia, Distrito WHERE Utilizador.id = Voluntario.id_U AND (Utilizador.codigo_distrito = Distrito.cod_distrito AND Utilizador.codigo_distrito=Distrito.cod_distrito
                           AND Utilizador.codigo_concelho = Concelho.cod_concelho AND Utilizador.codigo_concelho = Freguesia.cod_concelho AND
                                             Utilizador.codigo_freguesia = Freguesia.cod_freguesia)";
    if(!empty($idade['idade_minima'])) {
        $data_minima = date("Y-m-d", strtotime("-".$idade['idade_minima']." years"));
        $query .= "AND Voluntario.dob < '{$data_minima}' ";

    }
    if(!empty($idade['idade_maxima'])) {
        $data_maxima = date("Y-m-d", strtotime("-".$idade['idade_maxima']." years"));

        $query .= " AND Voluntario.dob > '{$data_maxima}'";

    }
    $result = getQuery($query);

    return $result;
}

/**
 * @param $valuesUtilizador
 * @param $valuesInstituto
 * @return array
 */
function searchInstitutosByParameters($valuesUtilizador,$valuesInstituto)
{   print_r($valuesUtilizador);
    $query = "SELECT * FROM Utilizador,Instituicao WHERE Utilizador.id = Instituicao.id_U ";
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
?>