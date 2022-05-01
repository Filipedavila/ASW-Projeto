<?php
include SITE_ROOT . "/resources/voluntario/search.php";

if(!isLoggedIn()){
header('Location: index.php');
exit();
}

$user = array();
$data = getCompatibleInstitutes($_SESSION['id']);
print_r($data);
// pagina inicial do voluntario ou do instituto,
// se for voluntario mostra uma lista dos institutos da sua area
// se for instituto mostra uma lista de voluntarios da sua area

?>

    
    <article class="row mt-5">
    <div class="col ml-5">
    <?php if(isLoggedInInstitute() && isLoggedIn()): ?>
     
        <h1>Bem Vindo  <?php  echo $_SESSION['user']; ?></h1>
        <p> Obrigado por se registar como Instituto</p>
    <p>Site em construção, mais funcionalidades em breve</p>
    
            </div>
    <div class="col">
        <div class="text-center">
            <img src="img/food-donate.jpg" class="rounded" alt="..."height="350px">
          </div>
    </div>
<?php endif;?>
<?php if(isLoggedInVoluntario() && isLoggedIn()) : ?>
     
    <h1>Bem Vindo  <?php  echo $_SESSION['user']; ?></h1>


<?php endif;?>
    
        
  
    </article>
</body>
