<?php
require_once "../lib/nusoap.php";

function InfoInstDoacoes($id)
{   //$conn = getConnection();
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw09";	$dbpass="aswgrupo09";	$dbname="asw09";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$sql="SELECT Instituicao.tipo_inst, Utilizador.telefone, Distrito.nome_Distrito, Concelho.nome_Concelho ,Freguesia.nome_Freguesia  FROM Utilizador, Instituicao, Distrito, Concelho, Freguesia WHERE Utilizador.id LIKE {$id} 
	AND Utilizador.id = Instituicao.id_U 
	AND Utilizador.codigo_distrito = Distrito.cod_distrito
	AND Utilizador.codigo_concelho = Concelho.cod_concelho
	AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
	AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
	AND Utilizador.codigo_concelho = Freguesia.cod_concelho;";


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
$server->register("InfoInstDoacoes", // nome metodo
array('id' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#InfoInstDoacoes', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>