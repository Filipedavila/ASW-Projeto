<?php
if(!isLoggedIn() || !isLoggedInVoluntario()){
    header('Location: index.php');
    exit();
    }
include SITE_ROOT . '/resources/voluntario/funcionalidades.php';
$data = array();
if(isset($_SESSION['id'])){

$data = getDisponibilidades($_SESSION['id']);



}


$erros = array();
$missing = array();

$utilizador = array();

//Caso tenha sido feito um pedido Post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // e caso a variavel submit esteja assignada
    if(array_key_exists('submit',$_POST)){

    if(empty($_POST['dias'])){
    array_push($missing, 'dias');    
    
    }else{
        $utilizador['dias'] = htmlspecialchars($_POST['dias']);
        $utilizador['dias'] = stripcslashes($utilizador['dias']);
    }   
   
    if(empty($_POST['hora_inicial'])){
        array_push($missing ,"hora_inicial");
    } else{
        $utilizador['hora_inicial'] = htmlspecialchars($_POST['hora_inicial']);
        $utilizador['hora_inicial'] = stripcslashes($utilizador['hora_inicial']);  
    }
    
     // e caso a variavel Cconducao não esteja assignada
      if(empty($_POST['hora_final'])){
        array_push($missing ,"hora_final");
    }else{
        $utilizador['hora_final'] = htmlspecialchars($_POST['hora_final']);
        $utilizador['hora_final']  = stripcslashes(  $utilizador['hora_final'] );
       
    }
    }

    //para cada valor do pos tratar e adicionar a uma array associativa
    $result = insertVoluntarioDisponibilidade($utilizador,$_SESSION['id']);
    //$result2 = updateAreaGeografica($utilizador,$_SESSION['id']);
   
        if($result){
            header("Location: index.php?page=voluntario_disponibilidade");
          }else{
          $erros['submit'] = TRUE;
          print_r($erros);
        }
    
    }
?>
<article class="form-group container">
    <br>

    <!--  verificar se existem erros ou dados em falta -->
    <?php if (count($erros) >0  || count($missing) >0){ echo  "
<p class=\"alerta\">Registro Invalido, por favor corrija os dados</p>";}

if(isset($erros['pass'])) echo "<p class=\"alerta\">". $erros['pass'] ."</p>";  // secalhar no futuro metemos um foreach dos erros
 ?>

    <div class=" justify-content-center">
        <form action="" method="POST" id="registro">

            <!--  verificar se esta em falta o nome -->
            <h3>Disponibilidade</h3>
            <div class=" row">
                <div class="col">
                    <div>
                        <label for="dias">Dia</label>
                    </div>
                    <select name="dias" class="form-control">
                        <option value="1">Domingo</option>
                        <option value="2">Segunda-feira</option>
                        <option value="3">Terça-feira</option>
                        <option value="4">Quarta-feira</option>
                        <option value="5">Quinta-feira</option>
                        <option value="6">Sexta-feira</option>
                        <option value="7">Sábado</option>    
                    </select>
                </div>
                <div class="col">
                    <label for="hora_inicial">Hora inicial
                        <?php if (in_array('hora_inicial', $missing)) 
                        echo " hora_inicial em falta";?>
                    </label>
                    <input type="time" class="form-control" name = "hora_inicial" <?php if (in_array('hora_inicial', $missing)) 
                        echo " isIis-invalid";?>" id="hora_inicial" name="hora_inicial"
                        value="<?php echo $data[0]['hora_inicial'] ?>">
                </div>

                <div class="col">       
                    <label for="hora_final">Hora final:
                        <?php if (in_array('hora_final', $missing)) 
                        echo " hora_final em falta";?>
                    </label>
                    <input type="time" class="form-control" name = "hora_final" <?php if (in_array('hora_final', $missing)) 
                        echo " isIis-invalid";?>" id="hora_final" name="hora_final"
                        value="<?php echo $data[0]['hora_final'] ?>">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg" form="registro" name="submit" value="submit">Registar</button>
            </div>
               
            </div>
            <br>
            <h3>Minhas disponibilidades</h3>
            <?php if(isset($data)) :?>
                <table class="table table-striped  table-hover">
                    <tr class="thead-dark">
                        <th>Dia</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fim</th>
                    </tr>
                    <?php foreach($data as $user ): ?>
                        <tr>
                            <td><?= $user[0] ?></td>
                            <td><?= $user[1] ?></td>
                            <td><?= $user[2] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif;?>
    </div>
    </form>
    </div>
</article>