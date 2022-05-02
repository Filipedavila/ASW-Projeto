<?php
    if(!isLoggedIn() || !isLoggedInVoluntario()){
        header('Location: index.php');
        exit();
    }

    $data = array();
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $data = getVoluntarioById( $id );
    }
?>
    <div class="justify-content-center">
            <div class= "row">
                <div class="col">
                    <p>Imagem de Perfil: <?php echo $data[0]['imgPath'] ?></p>
                </div>
            </div>
            <div class=" row">
                <div class="col">
                    <p>Nome: <?php echo $data[0]['nome'] ?></p>
                </div>
                <div class="col">
                <p>Gênero: <?php echo $data[0]['genero'] ?></p>
                </div>
                <div class="col">
                <p>Data de nascimento: <?php echo $data[0]['dob'] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                 <p>Telefone: <?php echo $data[0]['telefone'] ?></p>
                </div>
                <div class="col">
                 <p>Carta de certidão: <?php echo $data[0]['cc'] ?></p>
                </div>
                <div class="col">
                 <p>Carta de condução: <?php echo $data[0]['carta_conducao'] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Distrito: <?php echo $data[0]['nome_distrito'] ?></p>
                </div>
                <div class="col"> 
                    <p>Freguesia: <?php echo $data[0]['nome_freguesia'] ?></p>
                </div>
                <div class="col"> 
                    <p>Freguesia: <?php echo $data[0]['nome_concelho'] ?></p>
                </div>
            </div>
    </div>
