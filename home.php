<?php
include SITE_ROOT ."/resources/instituto/search.php";
if(!isLoggedIn()){
header('Location: index.php');
exit();
}
if(isLoggedInInstitute()){
    $data = getAllVolunters();
    print_r($data);

}elseif(isLoggedInVoluntario()) {
    $user = array();
    $data = getCompatibleInstitutes($_SESSION['id']);
    $noResults = false;


    if (empty($data[0])) {
        $noResults = true;

    }
}

?>

    

<article class="container mt-2">
    <div class="col ">
    <?php if(isLoggedInInstitute()): ?>

        <div class="container ">
        <div class="row d-flex justify-content-center">

            <h2>Bem Vindo  <?php  echo $_SESSION['user']; ?></h2>
        </div>
            <div class="row ">
                <div class="col d-flex justify-content-center">
                    <h4>Todos os Voluntarios de Refood Fcul</h4>

                </div>
            </div>
            <table class="d-flex justify-content-center table table-striped  table-hover">
                <tr class="thead-dark">
                    <th>Tipo de Conta</th>
                    <th>Nome</th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Perfil</th>
                    <th>chat</th>
                </tr>
                <?php foreach($data as $user ): ?>
                    <?php if(count($user) > 0): ?>
                        <tr>
                            <td><?= $user['tipo'] ?></td>
                            <td><?= $user['nome'] ?></td>
                            <td><?= $user['nome_distrito'] ?></td>
                            <td><?= $user['nome_concelho'] ?></td>
                            <td><?= $user['nome_freguesia'] ?></td>
                            <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>
                            <td><a href="index.php?page=mensagem&chatId=<?= $user['id'] ?>"> enviar msg</a></td>


                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>
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
            <th>chat</th>
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
                <td><a href="index.php?page=mensagem&chatId=<?= $user['id'] ?>"> enviar msg</a></td>


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
