<?php
/**Ficheiro que contem as funções relacionadas com as buscas do Administrador
 *
 */


/**Obtem todos os voluntarios
 * @return array
 */
function getAllVolunters()
{
    $query = "SELECT * FROM Utilizador,Voluntario WHERE  Utilizador.id = Voluntario.id_U";
    $result = getQuery($query);
    return $result;
}
/**
 * @return array
 */
function getAllUsers()
{
    $query = "SELECT * FROM Utilizador";
    $result = getQuery($query);
    return $result;
}


/**
 * @param $valuesUtilizador
 * @param $tipo
 * @return array
 *
 */
function searchUsuarioByLocal($valuesUtilizador,$tipo)
{
    $query = "SELECT * FROM Utilizador, ".$tipo." WHERE Utilizador.id = ".$tipo.".id_U ";

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
    $query = "SELECT * FROM Utilizador,Voluntario  WHERE Utilizador.id = Voluntario.id_U ";
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