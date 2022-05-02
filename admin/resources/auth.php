<?php


/**
 * @param $user
 * @param $pass
 * @return bool
 */
function loginAdmin($user,$pass){
        $conn = getConnection();
        $query = "SELECT * FROM Admin WHERE username =  \"{$user}\"  ";
        $result = mysqli_query($conn,$query);
        $login=false;
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }  else{
                session_destroy();
                session_start();
            }
             if(password_verify($pass, $user['password'])){

             
           // caso as passwords sejam iguais , criar uma sessão em que
              $_SESSION['tipo'] = 'Admin';          // é declarado um voluntário e é dado o seu nome e id encriptado
              $_SESSION['user'] = $user['username'];      // o id encriptado sera usado para ir a sua pagina de preferencias 

              $_SESSION['logged']= true;
              $login = true;
             }
            }else{
                return false;
            }
        
        mysqli_close($conn);
        return $login;
    }


/**
 * @return bool
 */
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

    
return $result;
}



?>