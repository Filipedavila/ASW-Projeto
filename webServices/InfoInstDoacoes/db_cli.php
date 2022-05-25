<?php
require_once "../lib/nusoap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    if(isset($_POST['id'])){
        $id = htmlspecialchars($_POST['id']);
        $id = strip_tags($id);

    $client = new nusoap_client(
        'http://appserver-01.alunos.di.fc.ul.pt/~asw09/ASW-Projeto/webServices/InfoInstDoacoes/db_serv.php?wsdl',true
    );
     
    $error = $client->getError();
    $result = $client->call('InfoInstDoacoes', array('id' => $id));	//handle errors

    echo "<h2>Pedido</h2>";
    echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
    echo "<h2>Resposta</h2>";
    echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";

    //check fault
    if($client->fault) {
        echo "<strong>Fault:</strong>".
        print_r($callResult);
        } else { //check error
        $err = $client->getError();
        if($err) { //write the error
        echo "<strong>Error:</strong>".$err;
        }
        else { echo "<h2>$result</h2>"; } //result ok
        }
 }
}
?>