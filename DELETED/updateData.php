<?php 
// funções relacionadas com a alteraçao de dados


function updateUsername($id, $name){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador SET nome = '{$name}' WHERE id = {$id}"; 
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {  #mais a condicao name exists?
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
       mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateUserType($id,$type){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador SET tipo = '{$type}' WHERE id = {$id}"; 
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateUserEmail($id, $email){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador SET email = '{$email}' WHERE id = {$id}"; 
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {  #mais a condicao emailExists?
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateUserPhone($id, $phone){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador SET telefone = '{$phone}' WHERE id = {$id}"; 
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { #mais a condicao phoneExists?
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}


function updateUSerDistritoID($id, $distrito_id){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador  SET codigo_distrito = '{$distrito_id}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}


function getUSerFreguesiaID($id, $freguesia_id){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador  SET codigo_freguesia = '{$freguesia_id}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}


function getUSerConcelhoID($id ,$concelho_id){
    $conn = getConnection();
    $queryUser = "UPDATE Utilizador  SET codigo_concelho = '{$concelho_id}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateVoluntarioDob($id, $dob) {
    $conn = getConnection();
    $queryUser = "UPDATE Voluntario  SET dob = '{$dob}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateVoluntarioImgPath($id, $img) {
    $conn = getConnection();
    $queryUser = "UPDATE Voluntario  SET imgPath = '{$img}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateVoluntarioCConducao($id, $cconducao) {
    $conn = getConnection();
    $queryUser = "UPDATE Voluntario  SET carta_conducao = '{$cconducao}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { // e tbm exists by carta_conducao?
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateVoluntarioCC($id, $cc) {
    $conn = getConnection();
    $queryUser = "UPDATE Voluntario  SET cc = '{$cc}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { // e tbm exists by cc?
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateVoluntarioGen($id, $gen) {
    $conn = getConnection();
    $queryUser = "UPDATE Voluntario  SET cc = '{$gen}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { 
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

//esta funcao nao esta certa nem esta a ser usada
function updateDisponibilidade($id_U, $hora_inicio, $hora_fim, $dia) {
  $conn = getConnection();
  $queryUser = "UPDATE Disponibilidade SET hora_inicio = '{$hora_inicio}', hora_fim = '{$hora_fim}', dia = {$dia}  WHERE id_U = {$id_U};";
  $result = mysqli_query($conn, $queryUser);

  $sucess =false;
  if ($result) { 
    echo "Dados alterados com sucesso";
    mysqli_close($conn);
    $sucess = True; 
    mysqli_free_result($result);
    
  } else {
    echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
  }  
   mysqli_close($conn);
   return   $sucess ;
  // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}




function updateInstTipoInst($id, $tipo_inst) {
    $conn = getConnection();
    $queryUser = "UPDATE Instituicao  SET cc = '{$tipo_inst}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateInstDescricao($id, $descricao) {
    $conn = getConnection();
    $queryUser = "UPDATE Instituicao  SET descricao = '{$descricao}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateInstMorada($id, $morada) {
    $conn = getConnection();
    $queryUser = "UPDATE Instituicao  SET morada = '{$morada}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) {
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateInstN_contacto($id, $n_Contacto) {
    $conn = getConnection();
    $queryUser = "UPDATE Instituicao  SET n_Contacto = '{$n_Contacto}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { //e exists by n_contacto
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

function updateInstNome_contacto($id, $nomeContacto) {
    $conn = getConnection();
    $queryUser = "UPDATE Instituicao  SET nomeContacto = '{$nomeContacto}' WHERE id = {$id};";
    $result = mysqli_query($conn, $queryUser);
  
    $sucess =false;
    if ($result) { //e exists by n_contacto
      echo "Dados alterados com sucesso";
      mysqli_close($conn);
      $sucess = True; 
      mysqli_free_result($result);
      
    } else {
      echo "Erro: Update failed" . $queryUser . "<br>" . mysqli_error($conn);
    }  
     mysqli_close($conn);
     return   $sucess ;
    // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE
}

?>