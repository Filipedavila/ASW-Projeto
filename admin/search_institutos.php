<?php

$data = getAllInstitutions();

?>

<article class="container mt-2">
    <div class="col ">
    <?php if(isLoggedInAdmin()): ?>

        <div class="container ">
        <div class="row d-flex justify-content-center">

            <h2>Bem Vindo  <?php  echo $_SESSION['user']; ?></h2>
        </div>
            <div class="col d-flex justify-content-center">
                <h4>Todos os Institutos de Refood Fcul</h4>

            </div>
            <table class="d-flex justify-content-center table table-striped  table-hover">
                <tr class="thead-dark">
                    <th>Tipo de Conta</th>
                    <th>Nome Instituto</th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Perfil</th>
                    <th>Editar</th>
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
                            <td><a href="index.php?delete=id=<?= $user['id'] ?>"> apagar</a></td>


                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif;?>
    </div>

    </article>

    </body>












