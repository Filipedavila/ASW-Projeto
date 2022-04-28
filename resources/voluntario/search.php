<?php


function getAllInstitutos(){

$query = "SELECT id,nome,email,tipo,telefone FROM Utilizador WHERE Utilizador.tipo = \"Instituto\" ";
return getData($query);
}

?>