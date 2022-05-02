<?php
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
define('THIS_FOLDER', realpath(__FILE__));
define('SITE_ROOT', dirname(__FILE__));
include  SITE_ROOT .'/init.php';




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
include './header.php';

if(isLoggedIn()){
   
    include    SITE_ROOT .'/nav.php';


    include   SITE_ROOT .'/'.$content . '.php';
    include  SITE_ROOT .'/footer.php';
}
if(!isLoggedIn()){
    include   './login.php';

}


 
?>