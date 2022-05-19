<?php
require_once "../lib/nusoap.php";
include SITE_ROOT . '/config/db_settings.php';

function VolRecolhaDoacao($IDVol, $utilizador, $password, $IDInst, $IDDoacao)
{	#$conn= getConnection();
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw09";	$dbpass="aswgrupo09";	$dbname="asw09";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$sql="SELECT * FROM Utilizador WHERE id ";
	$result=mysqli_query($conn,$sql);

	if (mysqli_num_rows($result) == 0) { 
		//sem result return nao aceite
		return "Não aceite";
	}

	else {

		while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
			$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
		}
		$html="<table>".implode("\n",$html)."</table>";	
		// echo $html;
		mysqli_close($conn);
		return $html;
		//return "Aceite";
	}

}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("VolRecolhaDoacao", // nome metodo
array('idVol' => 'xsd:string', 'utilizador' => 'xsd:string', 'password' => 'xsd:string' , 'IDInst' => 'xsd:string', 'IDDoacao' => 'xsd:string'), //input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#VolRecolhaDoacao', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>