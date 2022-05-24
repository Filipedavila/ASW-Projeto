<?php
include "../../init.php";


const REQUEST_FIELD="request";
const REQUEST_ID_Donation ="idDonation";
const REQUEST_ID_Vol ="idVol";
const REQUEST_ID_Inst ="idInst";
const REQUEST_GET_DONATION ="GET_DONATION";
const REQUEST_GET_ALL_DONATIONS ="GET_ALL_DONATIONS";
const REQUEST_UPDATE ="UPDATE";
const REQUEST_CONFIRM_DONATION = "CONFIRM";

/**
 *
 */



        if (isset($_REQUEST[REQUEST_FIELD])) {
            if ($_REQUEST[REQUEST_FIELD]===REQUEST_GET_DONATION) {
                if(isset($_REQUEST[REQUEST_ID_Donation])) {

                    $idDonat = $_REQUEST[REQUEST_ID_Donation];
                    if(isValidDonation($idDonat)){


                        $data = getDonationById($idDonat);
                        header("Content-Type: application/json");
                        echo json_encode($data);

                    }
                }


            }elseif ($_REQUEST[REQUEST_FIELD]===REQUEST_GET_ALL_DONATIONS) {
                if(isset($_REQUEST[REQUEST_ID_Inst])) {
                    $idInst = $_REQUEST[REQUEST_ID_Inst];

                    if(isValidId($idInst)){


                        $data = getDonationByInstitute($idInst);
                        header("Content-Type: application/json");
                        echo json_encode($data);

                    }
                }


              }elseif($_REQUEST[REQUEST_FIELD]===REQUEST_UPDATE){
                if(isset($_REQUEST[REQUEST_ID_Inst]) ) {
                    $idInst = $_REQUEST[REQUEST_ID_Inst];
                    if(isValidId($idInst)){

                        header("Content-Type: application/json");
                        $data = getIdFromDonatedItems($idInst);
                        echo json_encode($data);

                    }
                }

                }elseif($_REQUEST[REQUEST_FIELD]===REQUEST_CONFIRM_DONATION) {
                if (isset($_REQUEST[REQUEST_ID_Inst])) {
                    $idInst = $_REQUEST[REQUEST_ID_Inst];
                    $idVol = $_REQUEST[REQUEST_ID_Vol];
                    $idDon = $_REQUEST[REQUEST_ID_Donation];
                    if (isValidId($idInst) && isValidId($idVol) && isValidDonation($idDon)) {



                        $success =updateDonation($idVol, $idInst, $idDon);

                        header("Content-Type: application/json");
                        echo json_encode($success);

                    }


                }
            }


    } else {

        die();

}



?>