<?php
<<<<<<< HEAD:functions/database.php
define('DB_SERVIDOR', 'localhost');
=======
define('DB_SERVIDOR','localhost');
>>>>>>> origin/filipeNovo:admin/resources/database.php
define('DB_NOME', 'asw09');
define('DB_USUARIO', 'asw09');
define('DB_PASSWORD', 'aswgrupo09');
function getConnection()
{

  $conn = mysqli_connect(DB_SERVIDOR, DB_USUARIO, DB_PASSWORD, DB_NOME);

<<<<<<< HEAD:functions/database.php
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}

function getFreguesias()
{
  $conn = getConnection();
  $query = "SELECT * FROM Freguesia;";
  $result = mysqli_query($conn, $query);

  $data[] = mysqli_fetch_assoc($result);
=======
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      return $conn;
    
  }   

  ///// FUNÇÕES LOCALIDADES 
  
function getFreguesias(){
$conn = getConnection();
$query = "SELECT * FROM Freguesia";
$result = mysqli_query($conn,$query);
>>>>>>> origin/filipeNovo:admin/resources/database.php

  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }

  mysqli_close($conn);
  return $data;
}

<<<<<<< HEAD:functions/database.php
function getConcelhos()
{
  $conn = getConnection();
  $query = "SELECT * FROM Concelho;";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
  return $column;
}


function getAllUsers()
{
  $conn = getConnection();
  $query = "SELECT * FROM Utilizador";
  $result = mysqli_query($conn, $query);


=======
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
  
  
>>>>>>> origin/filipeNovo:admin/resources/database.php
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
  return $column;
}

<<<<<<< HEAD:functions/database.php

function getAllVolunters()
{
  $conn = getConnection();
  $query = "SELECT * FROM Voluntarios";
  $result = mysqli_query($conn, $query);


=======
  ///// FUNÇÕES USUARIOS 
  

function getAllVolunters(){
  $conn = getConnection();
  $query = "SELECT * FROM Voluntario";;
  $result = mysqli_query($conn,$query);
  
  
>>>>>>> origin/filipeNovo:admin/resources/database.php
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
  return $column;
}


function getAllInstitutions()
{
  $conn = getConnection();
  $query = "SELECT * FROM Instituicao";;
  $result = mysqli_query($conn, $query);


  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
  return $column;
}


function getVoluntario($id)
{
  $conn = getConnection();
  $query = "SELECT * FROM Voluntario WHERE id_U = '{$id}'"; 
  $result = mysqli_query($conn, $query);


  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
  } else {
    echo "0 results";
  }
<<<<<<< HEAD:functions/database.php
  mysqli_close($conn);
  return $column;
}

function getInstitution($id)
{
  $conn = getConnection();
  $query = "SELECT * FROM Instituicao WHERE id_U = '{$id}'"; 
  $result = mysqli_query($conn, $query);


=======
mysqli_close($conn);
return $column;
  }
  
function getInstitutions(){
  $conn = getConnection();
  $query = "SELECT * FROM Concelho";;
  $result = mysqli_query($conn,$query);
  
>>>>>>> origin/filipeNovo:admin/resources/database.php
  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
<<<<<<< HEAD:functions/database.php
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
  return $column;
}
=======

    } else {
      echo "0 results";
    }
  mysqli_close($conn);
  return $column;
  }
>>>>>>> origin/filipeNovo:admin/resources/database.php


function getDonationByInstitute($id)
{
  $conn = getConnection();
  $query = "SELECT * FROM Alimento WHERE inst_id = '{$id}'"; 
  $result = mysqli_query($conn, $query);


  if (mysqli_num_rows($result) > 0) {
    $column = array();
    foreach ($result as $key => $value) {
      $column[$key] = $value;
    }
<<<<<<< HEAD:functions/database.php
  } else {
    echo "Não existe Instituição com id" . $id;
  }
  mysqli_close($conn);
  return $column;
}


function RegisterVoluntario($dados)
{  // POR O RESTO DOS DADOS NECESSARIOS
  $conn = getConnection();
  $query = "INSERT INTO Utilizador (email, tipo, telefone, pass, nome, codigo_distrito, codigo_concelho, codigo_freguesia) VALUES ( " . $dados['email'] . ", V ," .  $dados['tel'] . "," .  $dados['password'] . "," .  $dados['nome'] . ", " . $dados['c_distrito']  . "," .  $dados['c_concelho'] . "," .  $dados['c_freguesia'] . ");";
  $query .= "INSERT INTO Voluntario (cc, carta_conducao, genero, dob, imgPath) VALUES ( " . $dados['cc'] . "," . $dados['Cconducao'] . "," . $dados['gen'] . "," . $dados['dob'] . "," . $dados['imgPath'] . ");";

  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "Um novo registo inserido com sucesso";
    mysqli_close($conn);
    return True;
  } else {
    echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
    mysqli_close($conn);
    return False;
  }
}   // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE


function RegisterInstitution($dados)
{ 
  $conn = getConnection();
  $query = "INSERT INTO Utilizador (email, tipo, telefone, pass, nome, codigo_distrito, codigo_concelho, codigo_freguesia) VALUES ( " . $dados['email'] . ", I ," .  $dados['tel'] . "," .  $dados['password'] . "," .  $dados['nome'] . ", " . $dados['c_distrito']  . "," .  $dados['c_concelho'] . "," .  $dados['c_freguesia'] . ");";
  $query .= "INSERT INTO Instituicao (tipo, descricao, morada, n_contacto, nome_contacto) VALUES ( " . $dados['tipo'] . "," . $dados['descricao'] . "," . $dados['morada'] . "," . $dados['contactoR'] . "," . $dados['nomeR'] . ");";

  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "Um novo registo inserido com sucesso";
    mysqli_close($conn);
    return True;
  } else {
    echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
    mysqli_close($conn);
    return False;
  }
}   // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE

function addDonation($idInstitute,$name, $tipo, $quantidade ){ 
  $conn = getConnection();
  $query = "INSERT INTO Alimento( inst_id, id, tipo_doacao, quantidade) VALUES (" . $idInstitute . ", NULL ," .  $name . "," . $tipo . "," . $quantidade . ");"; 
  $result = mysqli_query($conn,$query);
  
  if ($result) {
    echo "Um novo registo inserido com sucesso";
    mysqli_close($conn);
    return True;
  } else {
    echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
    mysqli_close($conn);
    return False;
  }  
} // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE


  function loginUser($email, $password){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador WHERE email = '{$email}'" . "AND pass = '{$password}'";
    $result = mysqli_query($conn,$query);
    $loginState= false;
    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
        if($user['password'] === $password){ // caso as passwords sejam iguais , criar uma sessão em que
          $_SESSION['tipo'] = $user['tipo'];          // é declarado um voluntário e é dado o seu nome e id encriptado
          $_SESSION['user'] = $user['nome'];      // o id encriptado sera usado para ir a sua pagina de preferencias 
          $_SESSION['id'] = md5($user['id']);
          $loginState = true;
        }
    }

    return $loginState;
}

  function userExistsByEmail($email){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador WHERE email = '{$email}'"; 

    $result = mysqli_query($conn,$query);
       
    if (mysqli_num_rows($result) > 0) {
     return 0;
      }else{
       return 1;
      }

  }


  function userExistsByName($name){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador WHERE email = '{$name}'";  

    $result = mysqli_query($conn,$query);
       
    if (mysqli_num_rows($result) > 0) {
     return 0;
      }else{
       return 1;
      }

  }


  function userExistsByCondC($conducao){
    $conn = getConnection();
    $query = "SELECT * FROM Voluntario WHERE carta_conducao = '{$conducao}'";

    $result = mysqli_query($conn,$query);
 
    if (mysqli_num_rows($result) > 0) {
     return 0;
      }else{
       return 1;
      }

  }
=======
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
      }    
?>
>>>>>>> origin/filipeNovo:admin/resources/database.php
