<?php
require_once "../lib/nusoap.php";
include SITE_ROOT . '/config/db_settings.php';
function InfoInstDoações($id)
{	$conn= getConnection();
	//$dbhost="appserver-01.alunos.di.fc.ul.pt";
	//$dbuser="asw09";	$dbpass="aswgrupo09";	$dbname="asw09";
	//Cria a ligação à BD
	//$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	//if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$sql="SELECT * FROM Utilizador WHERE id LIKE \"".$id."%\"";
	$result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result,MYSQLI_NUM))
	{
		$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
	}
	$html="<table>".implode("\n",$html)."</table>";	
	// echo $html;
	mysqli_close($conn);
	return $html;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("nomevoluntarios", // nome metodo
array('id' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#nomevoluntarios', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>