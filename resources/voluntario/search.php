<?php

function getInstitutesBySchedule($voluntarioShedule){
    $conn = getConnection();
    $query = "SELECT id,nome,email,tipo,telefone FROM Instituto  INNER JOIN Disponibilidade";
    $result = mysqli_query($conn,$query);
    $data = array();

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result);
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    return $data;


}

function getAllInstitutos(){

$query = "SELECT id,nome,email,tipo,telefone FROM Utilizador WHERE Utilizador.tipo = \"Instituto\" ";
return getData($query);
}

?>