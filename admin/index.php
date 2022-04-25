
<?php
define('THIS_FOLDER', realpath(__FILE__));
define('SITE_ROOT', dirname(__FILE__));
include  SITE_ROOT .'/init.php';




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
   
    include    SITE_ROOT .'/nav.php';


    include   SITE_ROOT .'/'.$content . '.php';
    include  SITE_ROOT .'/footer.php';
}
if(!isLoggedIn()){
    include   './login.php';

}


 
?>