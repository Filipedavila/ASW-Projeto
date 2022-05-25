<?php
/**
 *
function isValidId($id){
    $query = "SELECT id FROM Utilizador WHERE Utilizador.id = {$id} LIMIT 1";
    $result = existsQuery($query);
    return $result;
}
/**/
function getUserInfo($id){
    $query = "SELECT id, nome,tipo FROM Utilizador WHERE Utilizador.id ={$id}";
    $result = getData($query);

    return $result;

}



/**
 *
/**/
function numberOfMessages($id){
    $query = "SELECT COUNT(messageId) FROM Message WHERE Message.id_Sender = {$id} OR Message.id_Receiver = {$id}";
    $result = getJoinedData($query);

    return $result[0];

}


/**
 * @param $idUser
 * @param $idChatBuddy
 * @return false|string
 */
function getAllMessages($idUser,$idChatBuddy){
    $query ="SELECT * FROM Message where (Message.id_Sender = {$idUser} AND Message.id_Receiver = {$idChatBuddy}) OR (Message.id_Sender ={$idChatBuddy} AND Message.id_Receiver = {$idUser}) ORDER BY time ";
    $result = getQuery($query);
    return json_encode($result);
}

/**
 * @param $idReceiver
 * @param $idSender
 * @return bool
 */
function setMessagesSeen($idMessage){
    $query ="UPDATE Message SET seen = 1 WHERE Message.messageId = {$idMessage}";
    $result = setQuery($query);
    return $result;
}

// OR (Message.id_Sender ={$idReceiver} AND Message.id_Receiver = $idReceiver)

function sendMessage($idSender,$idReceiver,$mensagem){
   $query =" INSERT INTO Message (Id_Sender, Id_Receiver, Message)
            VALUES ({$idSender}, {$idReceiver},{$mensagem})";

   $result = setQuery($query);

   return $result;


}

/**
 * @param $idUser
 * @param $idChatBuddy
 * @return false|string
 */
function getNewMessages($idUser,$idChatBuddy){
    $query ="SELECT * FROM Message where (id_Sender ={$idChatBuddy} AND id_Receiver = {$idUser}) AND seen = 0 ORDER BY time";
    $result = getQuery($query);

    return json_encode($result);
}


function getMyAlertsIds($myId){
    $query ="SELECT id, nome,tipo FROM Utilizador WHERE Utilizador.id  IN (SELECT id_Sender FROM Message WHERE Message.seen = 0 AND Message.Id_Receiver = {$myId})";
  //$quer2y = " SELECT id_Sender FROM Message WHERE Message.seen = 0 AND Message.id_Sender <> {$myId}";
  $result = getData($query);
  return $result;
}
/*
/**
 * @param $idUser
 * @param $idChatBuddy
 * @return false|string
 *//*
function updateUsers($myId,$knownUsers){
    $query ="SELECT * FROM Message where (id_Sender ={$idChatBuddy} AND id_Receiver = {$idUser}) AND seen = 0 ORDER BY time";
    $result = getQuery($query);

    return json_encode($result);
}

*/
/**
 * @param $id
 * @return false|string
 */
function getIdsFromChatUsers($id){
    $query = "SELECT id, tipo, nome FROM Utilizador WHERE id IN (SELECT id_sender as id FROM Message WHERE Message.id_Receiver = {$id} UNION SELECT id_Receiver as id FROM Message WHERE Message.id_Sender =  {$id} ORDER BY id ASC)";
    $result = getQuery($query);
    return json_encode($result);

}

/**Função que obtem todos os ids das pessoas que têm conversa com o id do user dado
 *
 * @param $id - id do user
 * @return array - ids das pessoas em contacto
 */
function getIdsChattingWithDeprecated($id){
    $query = "SELECT id_sender as id FROM Message WHERE Message.id_Receiver = {$id} 
                                    UNION 
            SELECT id_Receiver as id FROM Message WHERE Message.id_Sender =  {$id} ORDER BY id ASC";
    $result = getJoinedData($query);

   return $result;
}

function getIdsChattingWith($id){
    $query = "SELECT id, nome,tipo FROM Utilizador WHERE Utilizador.id  IN (SELECT id_sender as id FROM Message WHERE Message.id_Receiver = {$id} 
                                    UNION 
            SELECT id_Receiver as id FROM Message WHERE Message.id_Sender =  {$id}) ORDER BY id ASC";
    $result = getData($query);

    return $result;


}

function testeGetUsersAndMessages(){
    $mensagem = array();
    $ids = array(5,6);
    foreach ($ids as $id){
        print_r($id);
        $messages[$id] = getNewMessages(1,$id);
        array_push($mensagem,$messages);

        
    }

    return json_encode($mensagem);



}

function deleteMessage($messageId){


}

function setMessagesRead($messagesId){


}










?>