"use strict";



/**
 * Filipe Dávila Fernandes aluno nº55981
 */
"use strict";
const REQUEST_OPTION_TYPE="request";
const REQUEST_ID_Donation ="idDonation";
const REQUEST_ID_Vol ="idVol";
const REQUEST_ID_Inst ="idInst";

const REQUEST_GET_ALL ="GET_ALL_DONATIONS";
const REQUEST_UPDATE ="UPDATE";
const REQUEST_CONFIRM_DONATION = "CONFIRM";

const REQUEST_GET_ALL_Donations_BY_ID_VOL ="GET_DONATIONS_BY_idVol";
const URL_DONATION_PHP_APP = "/resources/donation/donation.php";
const DIV_DONATION_ID = "donations";
const TABLE_DONATION_ID = "tableDonations";
const ID_NOT_AVAILABLE_TR_MSG ="notAvailable";

var path = window.location.pathname;
var currentDirectory = path.substring(0, path.lastIndexOf('/'));

var donationApp;
const IntervalUpdate = 3000;
var intervalUpdateNewMsg ;

function update(){
    donationApp.update();


}

function initDonationSystem(idVoluntario,idInstituto){
    let idListDonations =[];
    let donations =[];



    //obter todos os usuarios com quem falo

    $.ajax({
        url:currentDirectory+URL_DONATION_PHP_APP,
        type:'POST',
        dataType:'json',
        timeout:1000,
        data: {"idInst":idInstituto,"request":"GET_ALL_DONATIONS"},
        success:function (data){

           data.forEach((doacao)=>{
                if(doacao["vol_id"]==null) {
                    idListDonations.push(doacao["id"]);
                    donations.push(doacao);
                }

           })
            donationApp = new Donation(idInstituto,idVoluntario,idListDonations,donations,"#"+DIV_DONATION_ID);
            donationApp.init();


    }});





}

class Donation {
    idInstituto;
    idVoluntario;
    idsOfDonations = [];
    listOfDonations = [];
    divDonations;

    constructor(idInst,idVol,ids, donations, div) {
        this.idsOfDonations = ids;
        this.listOfDonations = donations;
        this.divDonations = div;
        this.idInstituto = idInst;
        this.idVoluntario = idVol;

    }

    // construir tabela com os valores returnados
    init() {
        let numberOfItems = this.listOfDonations.length;

        let divDonation = document.getElementById("donationDiv");
        let tabela = document.createElement("table");
        tabela.setAttribute("class", "table table-striped  table-hover");
        tabela.setAttribute("id", TABLE_DONATION_ID);
        tabela.innerHTML = " <tr  class='thead-dark text-center'><th >Nome Item</th><th>Quant.</th>" +
            "<th>Recolher doação</th></tr>";
        if (numberOfItems > 0) {
            this.listOfDonations.forEach((item) => {
                tabela.innerHTML += "<tr id='"+ item['id']+"row"+"' class='text-center'><td>" + item['tipo_doacao'] + "<td>" + item['quantidade'] + "</td>" +
                    "<td><button id='" + item['id'] + "' onclick='donationApp.chooseDonation("+item['id'] +")'>Recolher</button>" + "</td> </tr>";
            });
        } else {
            tabela.innerHTML += "<tr class='text-center' id='notAvailable'><td colspan='3'>Não existem Doações disponíveis  </td></tr>";
        }
        divDonation.appendChild(tabela);


        intervalUpdateNewMsg = setInterval(update, IntervalUpdate);


    }

    addItem(id) {

        //obter esta doação
        $.ajax({
            url: currentDirectory + URL_DONATION_PHP_APP,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            data: {"idDonation": id, "request": "GET_DONATION"},
            success: function (data) {
                console.log(donationApp.idsOfDonations.length);
                if ( $("#"+ID_NOT_AVAILABLE_TR_MSG).length >0) {
                    //tenho que remover o texto doações antes de adicionar
                    $("#"+ID_NOT_AVAILABLE_TR_MSG).empty();
                }
                console.log(data);
                console.log(data[0]['tipo_doacao']);

                    $("#"+TABLE_DONATION_ID).append("<tr id='"+ data[0]['id']+"row"+"' class='text-center'><td>" + data[0]['tipo_doacao'] + "<td>" + data[0]['quantidade'] + "</td>" +
                        "<td><button id='" + data[0]['id'] + "' onclick='donationApp.chooseDonation("+data[0]['id'] +")'>Recolher</button>" + "</td> </tr>");
                        donationApp.listOfDonations.push(data);



            }


        });

        if($("#notAvailable").length > 0){
            $("#notAvailable").remove();
        }
    }

    removeItem(id) {
        $("#" + id+"row").remove();
        this.idsOfDonations = this.idsOfDonations.filter((item) => {
            return item != id;
        })

        this.listOfDonations = this.listOfDonations.filter((item) => {
            return item['id'] != id;
        });
        if($("#"+TABLE_DONATION_ID + " tr").length == 1){
            let tabela = document.getElementById(TABLE_DONATION_ID);
            tabela.innerHTML = tabela.innerHTML += "<tr class='text-center' id='notAvailable' ><td colspan='3'>Não existem Doações disponíveis  </td></tr>";
        }

    }

    update() {
        console.log("chamada");
        let newActive = [];
        let stillActive = []

        // fazer filtro e extrair o elemento que esta a mais ou a menos, depois descobrir de qual das arrays é, se for de uma das arrays remove-se , se for de outro adiciona-se
        $.ajax({
            url: currentDirectory + URL_DONATION_PHP_APP,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            data: {"idInst": this.idInstituto, "request": "UPDATE"},
            success: function (data) {
                console.log(JSON.stringify(donationApp.idsOfDonations));
                let isEqual = JSON.stringify(data) ==JSON.stringify(donationApp.idsOfDonations);

                if (!isEqual) {
                    data.forEach((id) => {
                        if (donationApp.idsOfDonations.includes(id)) {
                            stillActive.push(id);

                        } else {
                            newActive.push(id);
                        }

                    })
                    let missingFromActive = [];

                    //TODO deve estar aqui o erro
                    missingFromActive = donationApp.idsOfDonations.filter((id) => {
                        if (!stillActive.includes(id)) {
                            return id;
                        }
                    });

                    if (missingFromActive.length > 0) {
                        // donationApp.listOfDonations = donationApp.listOfDonations.filter((donation) => {
                        //   return !(donation["id"] in rem);
                        //});
                        missingFromActive.forEach((x) => {
                            donationApp.removeItem(x);
                        });


                    }
                    if (newActive.length > 0) {
                        newActive.forEach((x) => {
                            stillActive.push(x);
                            donationApp.addItem(x);
                        });
                    }
                    console.log("novo\n");

                    console.log(newActive);

                    console.log("Mantendo se\n");

                    console.log(stillActive);

                    console.log("a remover\n");

                    console.log(missingFromActive);
                    donationApp.idsOfDonations = stillActive.sort((a,b)=>{return a-b});


                }
            }
        });
    }

    chooseDonation(id) {
        let idInst = this.idInstituto;
        let idVol = this.idVoluntario;
        $.ajax({
            url:currentDirectory+URL_DONATION_PHP_APP,
            type:'POST',
            dataType:'json',
            timeout:1000,
            data: {"idInst":idInst,"idVol":idVol,"idDonation":id,"request":"CONFIRM"},
            success:function (data){
                if(data){
                    donationApp.removeItem(id);
                }

            }});



    }




}

