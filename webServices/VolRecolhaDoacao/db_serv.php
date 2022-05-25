<?php
require_once "../lib/nusoap.php";
include  '../../init.php';

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0); 

function VolRecolhaDoacao($IDVol, $utilizador, $password, $IDInst, $IDDoacao)
{	$conn= getConnection();
    $voluntario = getVoluntario($IDVol);
	
    // se existir voluntario
    if($voluntario > 0) {
        // verificar password
			if (password_verify($password,$voluntario[0]['pass'])) {

				// verificar se existem donations disponiveis do instituto escolhido
				$query_donation = "SELECT * FROM Alimento WHERE inst_id = {$IDInst} AND id = {$IDDoacao} AND vol_id IS NULL";
				//$result_inst = getQuery($query_donation);
				
				$result_inst = mysqli_query($conn,$query_donation);

				if(mysqli_num_rows($result_inst) == 1){

					$query = "UPDATE Alimento SET vol_id = {$IDVol} WHERE inst_id = {$IDInst} AND id = {$IDDoacao}";
					$result=setQuery($query);
					return 'Aceite';

				}else{ 
					return 'Não aceite';}
			}else{ 
				return 'Não aceite: Password errada'; }
    }else{ 
		return 'Não aceite: Voluntário não existe';}
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("VolRecolhaDoacao", // nome metodo
array('IDVol' => 'xsd:string', 'utilizador' => 'xsd:string', 'password' => 'xsd:string' , 'IDInst' => 'xsd:string', 'IDDoacao' => 'xsd:string'), //input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#VolRecolhaDoacao', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>