<?php  // funções relacionadas com o login  System


function loginUser($email, $password){
    $conn = getConnection();
    $query = "SELECT * FROM Utilizador WHERE Utilizador.email = '{$email}'";
    $result = mysqli_query($conn,$query);
    $loginState= false;
    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }  
       echo $user['pass'];
       if(password_verify($password, $user['pass'])){

        $_SESSION['tipo'] = $user['tipo'];

        $nomeExploded = explode(" ", $user['nome']);       
        $_SESSION['user'] = $nomeExploded[0];
        $_SESSION['email'] = $user['email'];     
        $_SESSION['id'] = $user['id'];
        $_SESSION['logged']= true;
        header('Location: index.php?page=home');
        die();
       }
    }

    return $loginState;
}
function isLoggedIn(){
  $result =false;
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
      $_SESSION = array();
  }  
  if(!empty($_SESSION)){
      if($_SESSION['logged']){
       $result = true;
      }
  }
  return $result;
}


function isLoggedInVoluntario(){
    $result =false;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION = array();
    }  
    if(!empty($_SESSION)){
        if($_SESSION['tipo'] === "V"){
         $result = true;
        }
    }
    return $result;
}
function isLoggedInInstitute(){ $result =false;
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
      $_SESSION = array();
  }  
  if(!empty($_SESSION)){
      if($_SESSION['tipo'] === "I"){
       $result = true;
      }
  }
  return $result;
}
    
    

?>