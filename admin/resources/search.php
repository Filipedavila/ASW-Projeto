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
 * @return array|null
 */
function getAllInstitutions()
{
    $query = "SELECT * FROM Utilizador,Instituicao WHERE Utilizador.id = Instituicao.id_U";
    $result = getQuery($query);
    return $result;
}

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
function serch($valuesUtilizador, $donation)
{
    $query = "SELECT * FROM Utilizador,Instituicao,Alimento WHERE 
                 Utilizador.id = Instituicao.id_U AND Alimento.inst_id = Instituicao.id_U 
                    AND Alimento.tipo_doacao =  '{$donation}' ";
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
    print_r($result);
    return $result;
}

?>