<?php
include SITE_ROOT . "/resources/chat/messageSystem.php";
if(!isLoggedIn()){
    header('Location: index.php');
    exit();
}

$data = array();
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $name = $_SESSION['user'];
    // ver se este utilizador tem mensagens

    $nMessages = numberOfMessages($_SESSION['id']);

    if (isset($_GET["chatId"])) {

        $chatId = $_GET["chatId"];
        if (isValidId($chatId)) {
            $userInfo = json_encode(getUserInfo($chatId));


            echo "<script>
                let contactChat = '$userInfo' ;

                contactChat = JSON.parse(contactChat);
   
                initChatSystem( {$id}, \"{$name}\",contactChat);
              </script>";


        }
    } elseif ($nMessages == 0 && !isset($_GET["chatId"])) {

        echo "<script>
                let id = {$id};
                let name = '{$name}';
                 verifyIfHasMessages = setInterval(callAjax, 2000); 
                 
                 function callAjax(){
                         console.log('teste');
                     checkIfHasMessages();
                 }
                 
    
          
            
              </script>";


    } else {

        echo "<script>
                initChatSystem({$id},\"{$name}\",'NO_CHAT_INITIATED');
            </script>";
    }


}
?>




<article class=" container  justify-content-center">
    <div class=" row mt-3   card-bordered" >
    <div class="card-bordered card  bg-light" >
    <div class="list-group scrollable" id="groupContactList" style="height: 75vh">

    </div>
</div>
    <div class="col">
        <div class="card card-bordered" style="height: 75vh">
            <div class="card-header" >
                <h4 class="card-title"><strong>Chat</strong></h4>
                <i class="fa fa-lg  fa-times-circle"  style="text-align: right" aria-hidden="true"></i>
            </div>


            <div class="ps-container ps-theme-default ps-active-y "  id="chat-content" style="overflow-y: scroll;height: 75vh" !important;">


                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>

            <div class="publisher bt-1 border-light">
                <i class="fa fa-lg  fa-commenting" aria-hidden="true"></i>
                <input class="publisher-input" id="inputMessage" type="text" placeholder="Escrever Mensagem">


                <a class="publisher-btn text-info" id="sendMessage" data-abc="true"><i class="fa fa-lg  fa-paper-plane"></i></a>
            </div>

        </div>
    </div>
    </div>
</article>
</body>
