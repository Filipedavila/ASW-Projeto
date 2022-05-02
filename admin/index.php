<?php
<<<<<<< HEAD
<<<<<<< HEAD
define('BASE_DIR', realpath(__FILE__));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$LocalDirectory = dirname(__FILE__);
include "function.php";
session_start();

$content = 'login';
$adminLogin;
if(!isset($admin)){
$content="login";
=======
=======
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

>>>>>>> origin/main
define('THIS_FOLDER', realpath(__FILE__));
define('ADMIN_ROOT', dirname(__FILE__));
include ADMIN_ROOT ."/init.php";




if((isset($_GET['action']))){
    if($_GET['action']==="logout"){
        session_destroy();
    }


>>>>>>> origin/filipeNovo

}

session_start();






if(isset($_GET['page'])){

    $content = changePage($_GET['page']);

}else{
    $content = 'home';
}
echo '<!DOCTYPE html>';
echo '<html lang="<?php echo $htmlLang ?>">';

include ADMIN_ROOT .'/header.php';
if(isLoggedInAdmin()){

    include    ADMIN_ROOT .'/nav.php';


    include   ADMIN_ROOT .'/'.$content . '.php';
    include  ADMIN_ROOT .'/footer.php';
}
if(!isLoggedInAdmin()){
    include   './login.php';

}


 
?>