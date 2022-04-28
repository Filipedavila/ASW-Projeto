<?php

function getInstitutesBySchedule($id,$voluntarioShedule){
    $conn = getConnection();
    $query = getDisponibilidades($id)

    $query2 = "SELECT * FROM Instituicao 
                INNER JOIN Disponibilidade 
                    ON Instituicao.id_U = Disponibilidade.id_U 
                    WHERE Utilizador.codigo_distrito = 
                          AND Utilizador.codigo_concelho =  
                              And Disponibilidade.hora_inicio <= "
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