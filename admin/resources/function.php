<?php



function loginAdmin($user,$pass){
        $conn = getConnection();
        $query = "SELECT * FROM Admin WHERE username =  \"{$user}\"  ";
        $result = mysqli_query($conn,$query);
        $login=false;
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }  
             if(password_verify($pass, $user['password'])){

             
           // caso as passwords sejam iguais , criar uma sessão em que
              $_SESSION['tipo'] = 'Admin';          // é declarado um voluntário e é dado o seu nome e id encriptado
              $_SESSION['user'] = $user['username'];      // o id encriptado sera usado para ir a sua pagina de preferencias 
              $_SESSION['id'] = $user['admin_id'];
              $_SESSION['logged']= true;
              $login = true;
             }
            }else{
                return false;
            }
        
        mysqli_close($conn);
        return $login;
    }

    function checkIfAdminExists($id){
        $conn = getConnection();
        $query = "SELECT * FROM Admin WHERE admin_id =  \"{$id}\" ";
        $result = mysqli_query($conn,$query);
        $login=false;
        if (mysqli_num_rows($result) > 0) {
            $login= true;
            }else{
                $login= false;
            }
        
        mysqli_close($conn);
       return $login;
    }


function isLoggedInAdmin(){
$result =false;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION = array();
}  
if(!empty($_SESSION)){
    if($_SESSION['tipo'] === "Admin" && $_SESSION['logged']==TRUE){
     $result = true;
    }
}
  // $result = checkIfAdminExists($_SESSION['id']);
    
return $result;
}




function createTable($data,$titles){
echo "<table class='table table-striped table-hover'>";
    createRowTittle($titles);
    for( $i = 0 ; $i< count($data) ; $i++){
        echo "<td>". createRow($data[$i]) . "</td>";
    }



echo "</table>";


}

function createRowTittle($rowHeading){
    echo "<tr>";
    for( $i = 0 ; $i< count($rowHeading) ; $i++){
    echo "<th>{$rowHeading[$i]}</th>";

    }
    echo "</tr>";

}
function createRow($row){

    echo "<tr>";
    for( $i = 0 ; $i< count($row) ; $i++){   
     if($i == 4) $i++;
    echo "<td class='table-light'>{$row[$i]}</td>";

    }
    echo "</tr>";
}



function getUserById($id){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario WHERE Utilizador.'{$id}' = Voluntario.'{$id}';"; 
    $query .= "SELECT * FROM Utilizador, Instituicao WHERE Utilizador.'{$id}' = Instituicao.'{$id}'"; 
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

function getUserByName($name){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario WHERE nome = '{$name}' AND Utilizador.id = Voluntario.id_U;"; 
    $query .= "SELECT * FROM Utilizador, Instituicao WHERE nome = '{$name}' AND Utilizador.id = Instituicao.id_U"; 
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




function getUserbyType($type){

    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario where tipo = '{$type}' AND Utilizador.id = Voluntario.id_U;";
    $query .= "SELECT * FROM Utilizador, Instituicao where tipo = '{$type}' AND Utilizador.id = Instituicao.id_U";
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

function getUserByEmail($email){

    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario where Utilizador.email = '{$email}' AND Utilizador.id = Instituicao.id_U";
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



function getUserByAge($age) {

    $conn = getConnection();
    $query = "SET @age = {$age} ; SELECT * FROM Voluntario V Utilizador WHERE YEAR(CURRENT_TIMESTAMP) - YEAR(V.dob) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(V.dob, 5)) = @age AND U.id = V.id_U;";
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


function getUSerbyDistritoID($distrito_id){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario where codigo_distrito = '{$distrito_id}' AND Utilizador.id = Voluntario.id_U;";
    $query .= "SELECT * FROM Utilizador, Instituicao where codigo_distrito = '{$distrito_id}' AND Utilizador.id = Instituicao.id_U";
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


function getUSerbyFreguesiaID($freguesia_id){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario where codigo_freguesia = '{$freguesia_id}' AND Utilizador.id = Voluntario.id_U;";
    $query .= "SELECT * FROM Utilizador, Instituicao where codigo_freguesia = '{$freguesia_id}' AND Utilizador.id = Instituicao.id_U";
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

function getUSerbyConcelhoID($concelho_id){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador, Voluntario where codigo_concelho = '{$concelho_id}' AND Utilizador.id = Voluntario.id_U;";
    $query .= "SELECT * FROM Utilizador, Instituicao where codigo_concelho = '{$concelho_id}' AND Utilizador.id = Instituicao.id_U";
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


function getCountUsers(){

    $conn = getConnection();
    $query = "SELECT COUNT(*) FROM Utilizador";
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


function getCountVoluntarios(){
    $conn = getConnection();
    $query = "SELECT COUNT(*) FROM Voluntario";
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

function getCountInstitutos(){
    $conn = getConnection();
    $query = "SELECT COUNT(*) FROM Instituicao";
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


?>