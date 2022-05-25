<?php
require_once "../lib/nusoap.php";
include  '../../init.php';


error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0);
function getRowSoap($query){
    $conn = getConnection();
    $result = mysqli_query($conn,$query);

    while($row= mysqli_fetch_array($result,MYSQLI_NUM)){
        $html []="<tr><td>".implode("</td><td>",$row)."</td></tr>";
    }
    $html="<table>".implode("\n",$html)."</table>";


    return $html;

}
function VolRecolhaDoacao($IDVol, $utilizador, $password, $IDInst, $IDDoacao){

    $voluntario = getVoluntario($IDVol);

    // se existir volutnario
    if($voluntario > 0) {


        // verificar password
        if (password_verify($password,$voluntario[0]['pass'])) {



            // verificar se existem donations disponiveis do instituto escolhido
            $query_donation = "SELECT * FROM Alimento WHERE inst_id = {$IDInst} AND id = {$IDDoacao} AND vol_id IS NULL";
            $result_inst = getQuery($query_donation);
            if($result_inst){

                $query = "UPDATE Alimento SET vol_id = {$IDVol} WHERE inst_id = {$IDInst} AND id = {$IDDoacao}";
                $result=setQuery($query);

                //echo 'aceite';
                $query = "SELECT * From Alimento WHERE inst_id = {$IDInst} AND id = {$IDDoacao} AND vol_id = {$IDVol}";
                $html=getRowSoap($query);

                return $html;

            }else{
                throw new SoapFault( '-1' , 'Donation is not available !' );
              // return "DONATION_NOT_AVAILABLE";
            }


        }else{
            throw new SoapFault( '-2' , 'Donation is not available !' );
            //return "WRONG_PASSWORD";
        }
    }else{
        throw new SoapFault( '-3' , 'Donation is not available !' );
         //return "INVALID_USER";
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