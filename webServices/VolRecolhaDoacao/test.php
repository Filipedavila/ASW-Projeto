<?php
require_once "../lib/nusoap.php";
include  '../../init.php';

echo "print get usuario";
$voluntario = getVoluntarioForSoap(1);
print_r($voluntario);
if($voluntario > 0){
    echo "identificou que existe o voluntarionasdkhaskshddas";
    if(password_verify("aswgrupo09",$voluntario[0]['pass'])){
        echo "password funcionou";

    };
}
echo "print get donation";

$query_donation = "SELECT * FROM Alimento WHERE inst_id = 2 AND id = 1 AND vol_id IS NULL";
$result_inst = existsQuery($query_donation);

print_r($result_inst);

$query = "UPDATE Alimento SET vol_id = 1  WHERE inst_id = 2 AND id = 1 ";
$result1=setQuery($query);


$query = "SELECT * From Alimento WHERE inst_id = 2 AND id = 1 AND vol_id = 1";
$result11=getData($query);
print_r($result11);


?>