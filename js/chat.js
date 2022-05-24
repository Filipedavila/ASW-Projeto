/**
 * Filipe Dávila Fernandes aluno nº55981
 */
"use strict";
const REQUEST_ID_FIELD ="id";
const FRIEND_ID_FIELD="IDChat";
const REQUEST_FIELD = "request";
const REQUEST_GET_FRIENDS ="GET_FRIENDS";
const REQUEST_SEND_MESSAGE ="SEND_MESSAGE";
const REQUEST_GET_MESSAGES ="GET_MESSAGES";
const REQUEST_SET_SEEN ="SET_SEEN";
const REQUEST_UPDATE_MESSAGE="UPDATE";

const URL_CHAT_PHP_APP = "/resources/chat/chat.php";
//construir os objetos, depois ir buscar a lista de usuarios que estou a falar e depois por o evento em cada uma desses nomes em que faz o pedido
//dessa janela, cria uma janela e coloca um eventhandler no send message e

//tambem tem que iniciar o set interval para ir buscar as mensagens
var path = window.location.pathname;
var currentDirectory = path.substring(0, path.lastIndexOf('/'));

var chatApp;
var intervalUpdateNewMsg;


function updateCurrentChat(){
    if(chatApp != null) {
        chatApp.updateMessages();
    }
}

function checkForAlerts(){
    if(chatApp != null) {
        chatApp.checkForNewAlerts();
    }
}
/*
function  startChat(id, name, idFriend){
    initChatSystem(id,name);
    addUserToPage()


}
*/

function initChatSystem(idUser,name,chatContact){
    let friendList =[];
    console.log(chatContact);

    let isNotChatRequest = (chatContact === 'NO_CHAT_INITIATED');


    console.log(friendList);
    if(!isNotChatRequest){

        friendList.push(chatContact[0]);
    }

    //obter todos os usuarios com quem falo

    $.ajax({
        url:currentDirectory+URL_CHAT_PHP_APP,
        dataType:'json',
        timeout:1000,
        data: {"id":idUser,"request":"GET_FRIENDS"},
        success:function (data){
            data = data || [];
            data.forEach((id)=>{
               friendList.push(id);
            });
            chatApp = new Window(idUser,name,friendList);
            chatApp.init();



      }
    });

    console.log(friendList);
    if(!isNotChatRequest){
        $("#"+chatContact[1]).click();
    }

}





//1 descobrir o meu id, dois , ir buscar todos os usuarios de quem tenho mensagens e por um event listener em cada
//um deles.... criar ent


class Window{
    listOfContacts;
    idsWithNewMessages;
    myId;
    myName;
    friendId;
    friendName;
    messages;
    contactListElement;
    windowElement;
    interval;

    constructor(id,name,listContacts) {
        this.myName=name;
        this.myId = id;
        this.windowElement = document.getElementById("chat-content");;
        //remover contactos repetidos ( caso a pessoa tenha selecionado para chat uma pessoa com quem ja tem conversa)
        let listIdUnique =[]
        let listUnique =[];

        listContacts.forEach((contact)=>{
            if(!listIdUnique.includes(contact[0])){
                listIdUnique.push(contact[0]);
                listUnique.push(contact);
            }


        })
        this.listOfContacts = listUnique;
        this.contactListElement =document.getElementById("groupContactList");;
        this.messages =[];
        this.interval=null;
        this.friendName=null;
        this.idsWithNewMessages=[];




    }

    init(){
        //adicionar os utilizadores com mensagem a grupo de pessoas e adiciona os eventos de click aos mesmos com o id
        this.listOfContacts.forEach((contact)=>{
            this.addUserToPage(contact[1],contact[0]);



        })
        console.log( this.listOfContacts[0][1]);
        $("#"+ this.listOfContacts[0][0]).click();


    }

    addUserToPage(name, id){
        this.friendName = name;
        let contactoNovo = document.createElement("a");
        contactoNovo.setAttribute("class", "list-group-item list-group-item-action");
        contactoNovo.innerHTML =" <div class='d-flex w-100 justify-content-between cursor-pointer' id='"+id+"'><i class='fa fa-user' aria-hidden='true'></i><h5 class='mb-1'>"+name+"</h5></div>";
        contactoNovo.addEventListener("click",(function (e){
            chatApp.changeChatPerson(id,e);
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
        }));
        this.contactListElement.appendChild(contactoNovo);

    }

    changeChatPerson(id){
        this.friendId = id;
        if(intervalUpdateNewMsg !=null){
            clearInterval(intervalUpdateNewMsg);
        }
        // empty a conversa atual
        $("#chat-content").empty();
        $("#sendMessage").off();
        $("#"+this.friendId +"> p").empty();

        // Se for um contacto com novas mensagens
        this.idsWithNewMessages = this.idsWithNewMessages.filter((id)=>{
            return id != this.friendId;
        })

        //colocar o evento no caso do utilizador clickar para enviar uma mensagem
        $("#sendMessage").click(function (){
         let message =  $("#inputMessage").val();
            $("#inputMessage").val('');
         if(message != ""){
             chatApp.sendMessage(message)

         }
        })
        document.getElementById("inputMessage").addEventListener("keyup",function (e){
            let keypressed = e.which;

             if(keypressed ==13) {
                 let message = $("#inputMessage").val();
                 $("#inputMessage").val('');
                 if (message != "") {
                     chatApp.sendMessage(message)

                 }
             }});



        //colocar o botão como ativo
        this.friendId = id;
        this.getAllMessages();

        intervalUpdateNewMsg = setInterval(function (){
            updateCurrentChat();
            checkForAlerts();
        },2000);


        //desligar o setinterval de update de mensagens
        // ir buscar a nova conversa ao php
        // por um novo setInterval do ajax ao novo amigochat



    }

    getAllMessages(){
        $.ajax({
            url:currentDirectory+URL_CHAT_PHP_APP,
            dataType:'json',
            timeout:1000,
            data:{"id":this.myId,"request":"GET_MESSAGES","IDChat":this.friendId},
            success:function (data){
                let messages = JSON.parse(data);
                messages.forEach((message)=>{
                    console.log(message);
                    chatApp.addMessageToWindow(message["id_Sender"],message["message"]);
                    if(message["seen"]==0){
                        chatApp.setMessageSeen(message["messageId"]);

                    }


                })
            }
        });

    }
    setMessageSeen(idMessage){
        $.ajax({
            url:currentDirectory+URL_CHAT_PHP_APP,
            dataType:'json',
            timeout:1000,
            data:{"id":this.myId,"request":"SET_SEEN","idMessage":idMessage},

        });
    }

    addMessageToWindow(idSender,message){
        let limit = 100;
        let messagePrepared = message.split(" ");
        let readyMessage = "<p>";
        let lettersToGo = 100;
        messagePrepared.forEach((word)=>{
            if(word.length < lettersToGo && word.length < limit){
                readyMessage += word + " ";
                lettersToGo -= word.length;
            }else if(word.length < limit){
                readyMessage +="<br>" + word + " ";
                lettersToGo = limit - word.length;

            }else{
                let part1 = word.substring(0,Number(limit-1));
                part1 +="-<br>";
                let part2 ="-";
                 part2 += word.substring(limit,word.length );
                 lettersToGo = limit - (part2.length -4);
                readyMessage += part1 + part2;
            }


        })
        readyMessage +="</p>";

        let newMessage = document.createElement("div");

        if(idSender==this.myId){

            newMessage.setAttribute("class","media media-chat");
            newMessage.innerHTML = "<div class='media-body'><p style='width: fit-content'>"+this.myName+":</p>"+readyMessage+" </div>";
        }else if(idSender == this.friendId){

            newMessage.setAttribute("class","media media-chat media-chat-reverse");
            newMessage.innerHTML = "<div class='media-body'><p style='width: fit-content'>"+this.friendName+":</p> "+readyMessage+"</div>";
        }

        this.windowElement.appendChild(newMessage);
        this.windowElement.scrollTo(0, this.windowElement.scrollHeight);
    }


    updateMessages() {

        $.ajax({
            type:'POST',
            url: currentDirectory + URL_CHAT_PHP_APP,
            dataType: 'json',
            data: {"id": this.myId, "request": "UPDATE", "IDChat": this.friendId},
            success: function (data) {
                let messages = JSON.parse(data);
                messages.forEach((message) => {

                    chatApp.addMessageToWindow(message["id_Sender"], message["message"]);
                    chatApp.setMessageSeen(message["messageId"]);




                });

            },
        })
    }



        // ver se existe novas mensagens da pessoa com quem estou a conversar
        // ver se existem novos contactos a tentar falar comigo
        // caso ajam tenho de fazer load dos mesmos para a janela de contactos e estarem com classe de mensagens a espera de ser lidas




    sendMessage(message){
        // enviar mensagem ao idamigo atraves de um ajax request
        // por a mesma na lista de mensages e adiciona la a janela
        $.ajax({
            url: currentDirectory + URL_CHAT_PHP_APP,
            dataType: 'json',
            timeout: 1000,
            data: {"id": this.myId, "request": "SEND_MESSAGE", "IDChat": this.friendId, "message": JSON.stringify(message)}
        });
        this.addMessageToWindow(this.myId,message);



    }
    checkForNewAlerts(){
        let myCurrentContact = [];
        this.listOfContacts.forEach((contact)=>{
            myCurrentContact.push(contact[0]);
        })
        $.ajax({
            type:'POST',
            url: currentDirectory + URL_CHAT_PHP_APP,
            dataType: 'json',
            data: {"id": this.myId, "request": "UPDATE_ALERTS"},
            success: function (data) {

                let listContacts = data || [];

                listContacts.forEach((contact) => {
                    if(myCurrentContact.includes(contact[0],0)){
                        if(!chatApp.idsWithNewMessages.includes(contact[0])){
                            $("#"+contact[0]).append("<p>Novas Mensagens</p>");
                            chatApp.idsWithNewMessages.push(contact[0]);
                            // adicionar a palavra mensagens novas ao seu id
                        }
                    }else{
                        this.addUserToPage(contact[1],contact[0]);
                        //adicionar novo utilizador a lista
                        // criar elemento com esse nome e id e por o seu evento ao click
                    }


                });

            },
        })




    }
    getMyId(){
        return this.myId;

    }
    getChattingWithId(){
        return this.friendId;
    }
}


class Mensagem{
    myId;
    idSender;
    mensagem;
    timestamp;

    constructor(myId,idSender,mensagem,timestamp) {
        this.myId = myId;
        this.idSender = idSender;
        this.mensagem = mensagem;
        this.timestamp = timestamp;
    }

    getMessageElement(){
    let messageContainer = document.createElement("div");
    if(this.myId == this.idSender){
        messageContainer.setAttribute("class" ,"media media-chat media-chat-reverse");
    }else {
        messageContainer.setAttribute("class" ,"media media-chat");
    }
    let messageBody = document.createElement("div");
    messageBody.setAttribute("class","media-body");
    messageBody.innerHTML = "<p>"+ this.mensagem +"</p>";


    //TODO TRATAR O TIMESTAMP PARA COLOCAR EM HORAS, CASO SEJA DO DIA ANTERIOR COLOCAR O  <div class="media media-meta-day">Yesterday</div> --------------------------------------------------------------------------////////////////////////////////////////////////////////////////////


    messageBody.innerHTML += "<p className='meta'><time dateTime='2018'>00:07</time> </p>";

        messageContainer.appendChild(messageBody);



        return messageContainer;

    }


}