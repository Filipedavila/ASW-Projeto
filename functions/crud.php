<?php

  //Obter todos os distritos
  function getDistritos() {
    $query = "SELECT * FROM Distrito;";
    $result = array();
   $result = getQuery($query);
    return $result;
  }
  
  

  //Obter todos os distritos
  
  function getFreguesias()
  {
    $conn = getConnection();
    $query = "SELECT * FROM Freguesia;";
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  
    //Obter todos os Concelhos
  function getConcelhos()
  {
    $conn = getConnection();
    $query = "SELECT * FROM Concelho;";
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
    
  function getAllUsers()
  {
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador";
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  
  function getAllVolunters()
  {
    $conn = getConnection();
    $query = "SELECT * FROM Voluntarios";
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  
  function getAllInstitutions()
  {
    $conn = getConnection();
    $query = "SELECT * FROM Instituicao";;
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  function existsVoluntarioID($id){
    $conn = getConnection();
    $query = "SELECT * FROM Voluntario WHERE id_U = '{$id}'"; 
    $exists = existsQuery($query);
    return $exists;
  }

  

  function existsInstitutoID($id){
    $conn = getConnection();
    $query = "SELECT * FROM Instituicao WHERE id_U = '{$id}'"; 
    $exists = existsQuery($query);
    return $exists;
    
  }
  
  
  function getVoluntario($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador,Voluntario  WHERE id = '{$id}' AND id_u ='{$id}'"; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  function getInstitution($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador,Instituicao  WHERE id = '{$id}' AND id_u ='{$id}'"; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  function getConcelhosById($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Concelho  WHERE Concelho.cod_concelho = '{$id}' "; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }

   
  function getDistritoById($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Distrito  WHERE Distrito.cod_distrito = '{$id}'"; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  function getFreguesiaById($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Freguesia  WHERE Freguesia.codigo_freguesia = '{$id}' "; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }

  function getDonationByInstitute($id)
  {
    $conn = getConnection();
    $query = "SELECT * FROM Alimento WHERE inst_id = '{$id}'"; 
    $result = array();
    $result = getQuery($query);
     return $result;
  }
  
  
  
  //função que adiciona uma doação
  function addDonation($idInstitute,$name, $tipo, $quantidade ){ 
    $conn = getConnection();
    $query = "INSERT INTO Alimento( inst_id, id, tipo_doacao, quantidade) VALUES (" . $idInstitute . ", NULL ," .  $name . "," . $tipo . "," . $quantidade . ");"; 
    $result = array();
    $result = setQuery($query);
     return $result;
  } 
  
  
  
    function userExistsByEmail($email){
      $conn = getConnection();
      $query = "SELECT * FROM Utilizador WHERE email = \"{$email}\""; 

      $exists = existsQuery($query);
      return $exists;
    }
  
  
    function userExistsByName($name){
      $conn = getConnection();
      $query = "SELECT * FROM Utilizador WHERE email = '{$name}'";  
      $exists = existsQuery($query);
      return $exists;
    }
  
  
    function userExistsByCondC($conducao){
      $conn = getConnection();
      $query = "SELECT * FROM Voluntario WHERE carta_conducao = '{$conducao}'";
      $exists = existsQuery($query);
      return $exists;
    }

    function updateValuesVoluntario($values, $id){
      $conn = getConnection();
      $query = "UPDATE Voluntario SET " ;
      $num = count($values);
      $i = 1;
    foreach($values as $key=>$value){
        $query .= $key . "=" .  '"' .$value . '"';
        if($i < $num ){
          $query .= ",";
        }
        $i+=1;
    }

    $query .= " WHERE Voluntario.id_U = {$id};";
     

    $result =setQuery($query);
    return $result;
    }
function updateValuesUtilizador($values, $id){
      $conn = getConnection();
      $query = "UPDATE Utilizador SET " ;
      $num = count($values);
      $i = 1;
      foreach($values as $key=>$value){
    
        $query .= $key . "=" .  '"' .$value . '"';
        if($i < $num ){
          $query .= ",";
        }
        $i+=1;
    
      }

      $query .= " WHERE Utilizador.id = {$id};"; 
      $result =setQuery($query);
      return $result;
    
    }

function updateValuesInstituto($values, $id){
  $conn = getConnection();
  $query = "UPDATE Instituicao SET " ;
  $num = count($values);
      $i = 1;
  foreach($values as $key=>$value){
    $query .= $key . "=" .  '"' .$value . '"' ;
    if($i < $num ){
      $query .= ",";
    }
    $i+=1;
  }

  $query .= " WHERE Instituicao.id_U = {$id};"; 

  $result =setQuery($query);
  return $result;

}
function insertVoluntarioDisponibilidade($dados, $id) {
  $conn = getConnection();
  $query = "INSERT INTO Disponibilidade(id_U, tipo,  hora_inicio, hora_fim, dia) VALUES ( \"{$id}\", 'Voluntario' , \"{$dados['hora_inicial']}\", \"{$dados['hora_final']}\" , \"{$dados['dias']}\")";
  $result = setQuery($query);
  return $result;
}

function updateAreaGeografica($dados, $id){
  $conn = getConnection();
  $query = "UPDATE Utilizador SET codigo_distrito = \"{$dados['codigo_distrito']}\" , codigo_concelho = \"{$dados['codigo_concelho']}\", codigo_freguesia = \"{$dados['codigo_freguesia']}\" WHERE Utilizador.id = {$id}; " ;
  $result =setQuery($query);
  return $result;
}

function getDisponibilidades($id)
{
  $conn = getConnection();
  $query = "SELECT * FROM Disponibilidade  WHERE id_U = '{$id}' "; 
  $result = array();
  $result = getQuery($query);
   return $result;
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

    ?>
      
