
<?php
define('THIS_FOLDER', realpath(__FILE__));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$LocalDirectory = dirname(__FILE__);
include "function.php";
if((isset($_GET['action']))){
    if($_GET['action']==="logout"){
        session_destroy();
    }



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
   
    include    './nav.php';
    
    
    include   './home.php';
    include  './footer.php';
}
if(!isLoggedIn()){
    include   './login.php';

}


 
?>