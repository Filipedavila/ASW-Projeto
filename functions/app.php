<?php // funções relacionadas com o funcionamento do site
function changePage( $page){
    $page = strip_tags($page);
    if(!empty($page)){
        $content =$page;
        }else{
        $content = 'home' ;
        }
        return $content;
}


?>
