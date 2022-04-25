<?php

function getInstitutionsPrefer($voluntarioId){
    $disponibilidade = getDisponibilidadeVol($voluntarioId);


    $instituicoes = getAllInstitutions();


}


function obterDisponibilidadeVoluntario($id){

    $query = "SELECT * FROM Disponibilidade WHERE id_U = '{$id}'";
    $data = getQuery($query);
    $timeStart = $data['hora_inicio'];
    $timeEnd = $data['hora_fim'];
    $dia = $data['dia'];


}

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




