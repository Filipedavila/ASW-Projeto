<?php
function userExistsByEmail($email){
    $query = "SELECT * FROM Utilizador WHERE email = \"{$email}\"";
    $exists = existsQuery($query);
    return $exists;
}


function userExistsByName($name){
    $query = "SELECT * FROM Utilizador WHERE email = '{$name}'";
    $exists = existsQuery($query);
    return $exists;
}


function userExistsByCondC($conducao){
    $conn = getConnection();
    $query = "SELECT * FROM Voluntario WHERE carta_conducao = '{$conducao}'";
    $exists = existsQuery($query);
    return $exists;
}


function existsInstitutoID($id){
    $query = "SELECT * FROM Instituicao WHERE id_U = '{$id}'";
    $exists = existsQuery($query);
    return $exists;

}
function existsVoluntarioID($id){
    $query = "SELECT * FROM Voluntario WHERE id_U = '{$id}'";
    $exists = existsQuery($query);
    return $exists;
}


?>