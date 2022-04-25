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
?>
