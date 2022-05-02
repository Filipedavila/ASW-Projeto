<?php

if(!isLoggedIn()){
header('Location: index.php');
exit();
}

$user = array();
$data = getAllInstitutions();



// pagina inicial do voluntario ou do instituto,
// se for voluntario mostra uma lista dos institutos da sua area
// se for instituto mostra uma lista de voluntarios da sua area

?>

    
    <article class="row mt-5">
    <div class="col ml-5">
    <?php if(isLoggedInInstitute() && isLoggedIn()): ?>
     
        <h1>Bem Vindo  </h1>
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
    <table class="table table-striped  table-hover">
        <tr class="thead-dark">
            <th>Nome Instituição</th>
            <th>Tipo Instituição</th>
            <th>Distrito</th>
            <th>Concelho</th>
            <th>Freguesia</th>
            <th>Perfil</th>
        </tr>
        <?php foreach($data as $user ): ?>
            <tr>
                <td><?= $user[0] ?></td>
                <td><?= $user[1] ?></td>
                <td><?= $user[2] ?></td>
                <td><?= $user[3] ?></td>
                <td><?= $user[4] ?></td>



            </tr>
        <?php endforeach; ?>
    </table>
    
            </div>
    <div class="col">
        <div class="text-center">
            <img src="img/food-donate.jpg" class="rounded" alt="..."height="350px">
          </div>
    </div>


<?php endif;?>
    
        
  
    </article>
</body>
