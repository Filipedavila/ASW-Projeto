<?php
require_once "../lib/nusoap.php";
include  '../../init.php';

function InfoInstDoacoes($id)
{   $conn = getConnection();
	
	$sql="SELECT Instituicao.tipo_inst, Utilizador.telefone, Distrito.nome_Distrito, Concelho.nome_Concelho ,Freguesia.nome_Freguesia, Alimento.tipo_doacao, Alimento.quantidade, Disponibilidade.hora_inicio, Disponibilidade.hora_fim, Disponibilidade.dia
	FROM Utilizador, Instituicao, Distrito, Concelho, Freguesia, Disponibilidade, Alimento WHERE Utilizador.id = {$id} 
	AND Utilizador.id = Instituicao.id_U 
	AND Utilizador.codigo_distrito = Distrito.cod_distrito
	AND Utilizador.codigo_concelho = Concelho.cod_concelho
	AND Utilizador.codigo_distrito = Concelho.cod_distrito 	 
	AND Utilizador.codigo_freguesia = Freguesia.cod_freguesia 
	AND Utilizador.codigo_concelho = Freguesia.cod_concelho
	AND Disponibilidade.id_U = Utilizador.id
	AND Utilizador.id =  Disponibilidade.id_U
	AND Alimento.inst_id = Disponibilidade.id_U;";

	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) == 0) { 
		return "Sem dados";
	} else {
		
		
		while($row=mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
			}
			$html="<table>".implode("\n",$html)."</table>";	
			mysqli_close($conn);
			return $html;
	}
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