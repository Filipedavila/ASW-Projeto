<?php
function addDonation($idInstitute,$name, $tipo, $quantidade ){
    $query = "INSERT INTO Alimento( inst_id, id, tipo_doacao, quantidade) VALUES (" . $idInstitute . ", NULL ," .  $name . "," . $tipo . "," . $quantidade . ");";
    $result = setQuery($query);
    return $result;
}
?>