<?php
include SITE_ROOT . '/resources/voluntario/funcionalidades.php';
if(!isLoggedIn() ){
    header('Location: index.php');
    exit();
}
$data = array();


if(isset($_GET['id'])){
    $id =$_GET['id'];
    $data = getInstitutionById( $id );
    $dataDisp = getDisponibilidades($id);
}

?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h3 class="my-3"><?php echo $data[0]['nome'] ?></h3>
                        <p class="text-muted mb-1">Tipo: <?php echo $data[0]['tipo_inst'] ?></p>
                        <p class="text-muted mb-4">Descrição: <?php echo $data[0]['descricao'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nome contacto: </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['nome_contacto'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Telefone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> <?php echo $data[0]['telefone'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['email'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Distrito:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['nome_distrito'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Freguesia:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['nome_freguesia'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Concelho:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['nome_concelho'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Morada</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['morada'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Disponibilidades</h3>
                        <?php if(isset($dataDisp)) :?>
                            <table class="table table-striped  table-hover">
                                <tr class="thead-dark">
                                    <th>Dia</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fim</th>
                                </tr>
                                <?php foreach($dataDisp as $user ): ?>
                                    <tr>
                                        <td><?= $user[0] ?></td>
                                        <td><?= $user[1] ?></td>
                                        <td><?= $user[2] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6">
      <div class="card mb-4">
          <div class="card-body">
      <h3>Disponibilidades</h3>
            <?php if(isset($dataDisp)) :?>
                <table class="table table-striped  table-hover">
                    <tr class="thead-dark">
                        <th>Dia</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fim</th>
                    </tr>
                    <?php foreach($dataDisp as $user ): ?>
                        <tr>
                            <td><?= $user[0] ?></td>
                            <td><?= $user[1] ?></td>
                            <td><?= $user[2] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif;?>
          </div>
      </div>  
      </div>
    </div>
</section>