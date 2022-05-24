<?php
require_once "../lib/nusoap.php";
include SITE_ROOT . '/config/db_settings.php';

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0); 

function VolRecolhaDoacao($IDVol, $utilizador, $password, $IDInst, $IDDoacao)
{	#$conn= getConnection();
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw09";	$dbpass="aswgrupo09";	$dbname="asw09";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$utilizador="SELECT * FROM Utilizador WHERE id = {$IDVol} AND email LIKE {$utilizador}";
	$result_utilizador=mysqli_query($conn,$utilizador);
	$user = mysqli_fetch_assoc($result_utilizador);
	echo $result_utilizador;

	//a parte do password nao ta a funcionar nao sei porque
	$pass = password_verify($password, $user['pass']);
	if ($pass == true){
		//echo 'password true';
	} else {
		//echo 'password false';
		//return 'Nao aceite';
	}
		
	$inst = "SELECT * FROM Alimento WHERE inst_id = {$IDInst} AND id = {$IDDoacao} AND vol_id IS NULL";
	$result_inst=mysqli_query($conn,$inst);

	                                                                                //or pass == false
	if (mysqli_num_rows($result_utilizador) == 0 or mysqli_num_rows($result_inst) == 0 ) { 
		//sem result return nao aceite
		//echo 'nao aceite';
		return "Não aceite";
	}

	else {
		$query = "UPDATE Alimento SET vol_id = {$IDVol} WHERE inst_id = {$IDInst} AND id = {$IDDoacao}";
		$result=mysqli_query($conn,$query);
		//echo 'aceite';
		$query = "SELECT * From Alimento WHERE inst_id = {$IDInst} AND id = {$IDDoacao} AND vol_id = {$IDVol}";
		$result=mysqli_query($conn,$query);

		while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
			$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
		}
		$html="<table>".implode("\n",$html)."</table>";	
		// echo $html;
		mysqli_close($conn);

		//return $html;
		return "Aceite";
	}

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