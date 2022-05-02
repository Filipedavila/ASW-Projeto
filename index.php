
<?php
include dirname(__FILE__) . '/init.php';
define('INDEX', realpath(__FILE__));




if (!isset($_SESSION)) session_start();

$pageTittle = "Refood Fcul - ";

if(isset($_GET['page'])){
    
$content = changePage($_GET['page']);
$pageTittle .= $_GET['page'];
}else{
    if(isset($_SESSION['id'])){
        $content = 'home';
    }else {
        $content = 'content';
    }
    }
echo '<!DOCTYPE html>';
echo '<html lang="<?php echo $htmlLang ?>">';

include SITE_ROOT .'/header.php';

include SITE_ROOT .'/nav.php';

include   SITE_ROOT .'/'.$content . '.php';

include  SITE_ROOT .'/footer.php';
 
?>