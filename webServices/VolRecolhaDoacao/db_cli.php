<?php
require_once "../lib/nusoap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    if(isset($_POST['IDVol']) && isset($_POST['utilizador']) && isset($_POST['password']) && isset($_POST['IDInst']) && isset($_POST['IDDoacao']) ){
        $IDVol = $_POST['IDVol'];
        $utilizador = $_POST['utilizador'];
        $password = $_POST['password'];
        $IDInst = $_POST['IDInst'];
        $IDDoacao = $_POST['IDDoacao'];


    $client = new nusoap_client(
        'http://appserver-01.alunos.di.fc.ul.pt/~asw09/ASW-Projeto/webServices/VolRecolhaDoacao/db_serv.php'
    );
    $error = $client->getError();
    $result = $client->call('VolRecolhaDoacao', array('IDVol' => $IDVol, 'utilizador' => $utilizador, 'password' => $password , 'IDInst' => $IDInst, 'IDDoacao' => $IDDoacao));	//handle errors

    echo "<h2>Pedido</h2>";
    echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
    echo "<h2>Resposta</h2>";
    echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";

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