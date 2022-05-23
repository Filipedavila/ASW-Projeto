<?php
include "../../init.php";

error_reporting(E_ALL);
const REQUEST_ID_FIELD ="id";
const FRIEND_ID_FIELD="IDChat";
const REQUEST_FIELD = "request";
const REQUEST_GET_FRIENDS ="GET_FRIENDS";
const REQUEST_SEND_MESSAGE ="SEND_MESSAGE";
const REQUEST_GET_MESSAGES ="GET_MESSAGES";
const REQUEST_SET_SEEN ="SET_SEEN";
const REQUEST_UPDATE_MESSAGE="UPDATE";
const REQUEST_UPDATE_ALERTS="UPDATE_ALERTS";


/**
 *
 */
if(isset($_REQUEST[REQUEST_ID_FIELD])) {
    // verificar se o id é valido
    if (isValidId($_REQUEST[REQUEST_ID_FIELD])) {
        $idUser = $_REQUEST[REQUEST_ID_FIELD];
        // verificar qual a operação a fazer

        if (isset($_REQUEST[REQUEST_FIELD])) {


            if ($_REQUEST["request"]==="GET_FRIENDS") {
                header("Content-Type: application/json");
                $data =getIdsChattingWith($idUser);
                echo json_encode( $data);

            }elseif($_REQUEST[REQUEST_FIELD]=== REQUEST_GET_MESSAGES){

                // verificar qual a conversa que quer fazer load, e verificar se o id do chatBuddie é valido
                $idChatBuddie = $_REQUEST[FRIEND_ID_FIELD];
                if (isValidId($idChatBuddie)) {
                    //obter todas as mensagens enviadas por este contacto
                    $messages = getAllMessages($idUser, $idChatBuddie);

                    header("Content-Type: application/json");
                    echo json_encode($messages);
                }


            } elseif ($_REQUEST[REQUEST_FIELD]=== REQUEST_SEND_MESSAGE ) {
                $idChatBuddie = $_REQUEST[FRIEND_ID_FIELD];

                if (isValidId($idChatBuddie)&&isset($_REQUEST['message'])) {
                    $message =$_REQUEST['message'];

                    //obter todas as mensagens enviadas por este contacto
                    sendMessage($idUser, $idChatBuddie,$message);

                }

            } elseif ($_REQUEST[REQUEST_FIELD]===REQUEST_SET_SEEN) {
                $idMessage = $_REQUEST["idMessage"];

                //obter todas as mensagens enviadas por este contacto
                setMessagesSeen($idMessage);


            } elseif ($_REQUEST[REQUEST_FIELD]===REQUEST_UPDATE_MESSAGE) {
                $idChatBuddie = $_REQUEST[FRIEND_ID_FIELD];
                if (isValidId($idChatBuddie)) {
                    //obter todas as mensagens enviadas por este contacto
                    $messages = getNewMessages($idUser, $idChatBuddie);

                    header("Content-Type: application/json");
                    echo json_encode($messages);
                }

            }elseif ($_REQUEST[REQUEST_FIELD]===REQUEST_UPDATE_ALERTS) {


                //obter todas as mensagens enviadas por este contacto
                $messages = getMyAlertsIds($idUser);

                header("Content-Type: application/json");
                echo json_encode($messages);


            }

        }
    } else {
        die();
    }
}



?>