<?php

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


?>
