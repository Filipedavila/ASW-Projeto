<?php

include SITE_ROOT . '/resources/register/validations.php';
include SITE_ROOT . '/resources/register/register.php';

if(!isLoggedIn()){
header('Location: index.php');
exit();
}

$user = array();

$data = getCompatibleInstitutes($_SESSION['id']);
$noResults = false;

if ($data == null){
    $data = getAllInstitutions();
}else{
    if(empty($data[0])){
        $noResults = true;

    }
}
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
    </article>
<?php endif;?>
<?php if(isLoggedInVoluntario() && isLoggedIn()) : ?>
<?php if($noResults): ?>
<div class="container  ">

    <div class="row d-flex justify-content-center ">


        <h2> Não Existem Institutos Disponiveis para as sua disponibilidade</h2>



    </div>
    <div class="row d-flex justify-content-center ">


        <p> Não Existem Institutos Disponiveis para as sua disponibilidade</p>
    </div>
        <div class="row d-flex justify-content-center ">

        <img src="./img/notfound.png" alt="not found instituto" class="img-fluid">



    </div>
</div>
<?php else: ?>




<div class="container ">

     <div class="row d-flex justify-content-center">


         <h2> Institutos Disponiveis de acordo com sua Disponibilidade</h2>

    <table class="d-flex justify-content-center table table-striped  table-hover">
        <tr class="thead-dark">
            <th>Nome Instituição</th>
            <th>Tipo Instituição</th>
            <th>Distrito</th>
            <th>Concelho</th>
            <th>Freguesia</th>
            <th>Perfil</th>
        </tr>

        <?php foreach($data as $user ): ?>

          <?php if(count($user) > 0): ?>
            <tr>
                <td><?= $user['nome'] ?></td>
                <td><?= $user['tipo'] ?></td>
                <td><?= getConcelhosNomeById($user['codigo_distrito'], $user['codigo_concelho']  ); ?></td>
                <td><?= getDistritoNomeById( $user['codigo_distrito']) ?></td>
                <td><?= getFreguesiaNomeById($user['codigo_concelho'],$user['codigo_freguesia']) ?></td>
                <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>


            </tr>
        <?php endif;?>
        <?php endforeach; ?>
    </table>
</div>
<?php endif;?>
    <?php endif;?>
</div>

  </article>

</body>
