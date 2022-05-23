<?php
/**
 * @param $dados
 * @param $id
 * @return bool
 */
function insertVoluntarioDisponibilidade($dados, $id) {
    $query = "INSERT INTO Disponibilidade(id_U, tipo,  hora_inicio, hora_fim, dia) VALUES ( \"{$id}\", 'Voluntario' , \"{$dados['hora_inicial']}\", \"{$dados['hora_final']}\" , \"{$dados['dias']}\")";
    $result = setQuery($query);
    return $result;
}

/**
 * @param $id
 * @return array|null
 */
function getDisponibilidades($id)
{
    $query = "SELECT dia,hora_inicio,hora_fim FROM Disponibilidade  WHERE id_U = '{$id}' ";
    return getData($query);
}

/**
 * @param $id
 * @return void
 */
function getAlimentos($id){
    $query = "SELECT * FROM Alimento WHERE Alimento.inst_id = $id";


}

function commitToDonation($idAlimento,$idVolunter){

}

function updateAlimentoQuantity($idAlimento,$quantityTaken){


}



/**
 * @param $id_U
 * @param $hora_inicio
 * @param $hora_fim
 * @param $dia
 * @return bool
 */
function updateDisponibilidade($id_U, $hora_inicio, $hora_fim, $dia) {
    $conn = getConnection();
    $queryUser = "UPDATE Disponibilidade SET hora_inicio = '{$hora_inicio}', hora_fim = '{$hora_fim}', dia = {$dia}  WHERE id_U = {$id_U};";
    $result = mysqli_query($conn, $queryUser);

    $sucess =false;
    if ($result) {
        echo "Dados alterados com sucesso";
        mysqli_close($conn);
        $sucess = True;
        mysqli_free_result($result);

    } else {
        echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}




