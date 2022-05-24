<?php
if(!isLoggedIn() || !isLoggedInVoluntario()){
    header('Location: index.php');
    exit();
}

$data = array();
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $data = getVoluntario( $id );
    $dataDoacao = getDonationByVol($id);
}
?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="img/profile_default.png"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?php echo $data[0]['nome'] ?></h5>
                        <p class="text-muted mb-1"><?php echo $data[0]['genero'] ?></p>
                        <p class="text-muted mb-4"><?php echo $data[0]['dob'] ?></p>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Telefone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['telefone'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Carta de certidão</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> <?php echo $data[0]['cc'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Carta de condução:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $data[0]['carta_conducao'] ?></p>
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
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Recolhas</h3>
                        <?php if(isset($dataDoacao)) :?>
                            <table class="table table-striped  table-hover">
                                <tr class="thead-dark">
                                    <th>Dia</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fim</th>
                                    <th>Id</th>
                                    <th>Doacao</th>
                                    <th>Quant</th>
                                </tr>
                                <?php foreach($dataDoacao as $user ): ?>
                                    <tr>
                                        <td><?= $user['dia'] ?></td>
                                        <td><?= $user['hora_inicio'] ?></td>
                                        <td><?= $user['hora_fim'] ?></td>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['tipo_doacao'] ?></td>
                                        <td><?= $user['quantidade'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                
                            </table>
                        <?php endif;?>
                    </div>
            </div>
        </div>
    </div>
</section>