<?php


  /*
function getFreguesias(){
$conn = getConnection();
$query = "SELECT * FROM Freguesia";
$result = mysqli_query($conn,$query);

  $data[]= mysqli_fetch_assoc($result);
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }


  } else {
    echo "0 results";
  }

mysqli_close($conn);
return $data;
}

function getFreguesiaById($idConc,$idFreg){   // VERIFICAR se esta correto

  $conn = getConnection();
  $query = "SELECT nome FROM Freguesia WHERE cod_conselho = {$idConc} AND cod_freguesia = {$idFreg}";
  $result = mysqli_query($conn,$query);
  
    $data = null;
    
    if (mysqli_num_rows($result) > 0) {
    $data=mysqli_fetch_field($result);

    }
  
  mysqli_close($conn);
  return $data;
}
function getAllUsers_(){
    $conn = getConnection();
    $query = "SELECT id,nome,email,tipo,telefone FROM Utilizador";
    $result = mysqli_query($conn,$query);
    $data = array();

    if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_all($result);
        } else {
        echo "0 results";
    }
    mysqli_close($conn);
    return $data;


}

  

function getConcelhoById($id){

  $conn = getConnection();
  $query = "SELECT nome FROM Concelho WHERE cod_conselho ={$id}";
  $result = mysqli_query($conn,$query);
  
    $data = null;
    
    if (mysqli_num_rows($result) > 0) {
    $data=mysqli_fetch_field($result);
  
  
    }
  
  mysqli_close($conn);
  return $data;

}

function getDistritoById($id){

  $conn = getConnection();
  $query = "SELECT * FROM Freguesia";
  $result = mysqli_query($conn,$query);
  
    $data[]= mysqli_fetch_assoc($result);
    
    if (mysqli_num_rows($result) > 0) {
      $column = array();
      foreach($result as $key => $value){
        $column[$key] = $value;
      }
  
  
    } else {
      echo "0 results";
    }
  
  mysqli_close($conn);
  return $data;


}

function getConcelhos(){
  $conn = getConnection();
  $query = "SELECT * FROM Concelho";;
  $result = mysqli_query($conn,$query);
  
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }


  } else {
    echo "0 results";
  }
mysqli_close($conn);
return $column;
  }

  ///// FUNÇÕES USUARIOS 
  

function getAllVolunters(){
  $conn = getConnection();
  $query = "SELECT * FROM Voluntario";;
  $result = mysqli_query($conn,$query);
  
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }


  } else {
    echo "0 results";
  }
mysqli_close($conn);
return $column;
  }


  function getAllInstitutions(){
    $conn = getConnection();
    $query = "SELECT * FROM Instituicao";;
    $result = mysqli_query($conn,$query);
    
    
    if (mysqli_num_rows($result) > 0) {
      $column = array();
      foreach($result as $key => $value){
        $column[$key] = $value;
      }
  
  
    } else {
      echo "0 results";
    }
  mysqli_close($conn);
  return $column;
    }

    
function getVoluntario($id){
  $conn = getConnection();
  $query = "SELECT * FROM Concelho";;
  $result = mysqli_query($conn,$query);
  
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }


  } else {
    echo "0 results";
  }
mysqli_close($conn);
return $column;
  }
  
function getInstitutions(){
  $conn = getConnection();
  $query = "SELECT * FROM Concelho";;
  $result = mysqli_query($conn,$query);
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }

    } else {
      echo "0 results";
    }
  mysqli_close($conn);
  return $column;
  }

  
function getDonationByInstitute($id){
  $conn = getConnection();
  $query = "SELECT * FROM Instituicao WHERE id_U = ". $id ;
  $result = mysqli_query($conn,$query);
  
  
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach($result as $key => $value){
      $column[$key] = $value;
    }
      } else {
        echo "Não existe Instituição com id". $id;
      }
    mysqli_close($conn);
    return $column;
  }

      function userExistsByEmail($email){
        $conn = getConnection();
        $query = "SELECT * FROM Utilizador WHERE Utilizador.email = ".$email ;

        $result = mysqli_query($conn,$query);
        mysqli_close($conn);
        if (mysqli_num_rows($result) > 0) {
         return 0;
          }else{
           return 1;
          }
      }

      function userExistsByCondC($conducao){
        $conn = getConnection();
        $query = "SELECT * FROM Voluntario WHERE Voluntario.conducao = ".$conducao ;  // verificar query

        $result = mysqli_query($conn,$query);
        mysqli_close($conn);
        if (mysqli_num_rows($result) > 0) {
         return 0;
          }else{
           return 1;
          }
      }*/
?>
