<?php

if(!isLoggedIn()){
header('Location: index.php');
exit();
}

$user = array();
$data = getCompatibleInstitutes($_SESSION['id']);

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
                <td><?= $user['tipo_inst'] ?></td>
                <td><?= $user['nome_distrito'] ?></td>
                <td><?= $user['nome_concelho'] ?></td>
                <td><?= $user['nome_freguesia'] ?></td>
                <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>


            </tr>
        <?php endif;?>
        <?php endforeach; ?>
    </table>
</div>
<?php endif;?>
</div>
        
  </article>

</body>
