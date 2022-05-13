<?php

include SITE_ROOT . '/resources/register/validations.php';
include SITE_ROOT . '/resources/register/register.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$erros = array();
$missing = array();
$data = array();
$uploadOk = 0;
$target_dir = SITE_ROOT ."/img/upload/";
//Caso tenha sido feito um pedido Post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data['imgPath'] = "NULL";

    // e caso a variavel submit esteja assignada
    if(array_key_exists('submit',$_POST)){

   // e caso a variavel name não esteja assignada
    if(empty($_POST['nome'])){
    array_push($missing, 'nome');    
    
    }else{
        $data['nome'] = htmlspecialchars($_POST['nome']);
        $data['nome'] = stripcslashes($data['nome']);
    }   
      // e caso a variavel passwor não  esteja assignada
    if(empty($_POST['password'])){
    array_push($missing ,"password");
    }else{
        $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

    }
    if(empty($_POST['password2'])){
        array_push($missing ,"password2");
        }else{
            $passRepetition= password_hash($_POST['password2'], PASSWORD_BCRYPT);
    
        }
      // e caso a variavel email não esteja assignada
    if(empty($_POST['email'])){
        array_push($missing ,"email");
   }else{
       $data['email'] = htmlspecialchars($_POST['email']);
       $data['email'] = stripcslashes( $data['email']);
        $existsEmail = userExistsByEmail($data['email']);
             if($existsEmail){
                  $erros['email']= "Utilizador com email " . $data['email'] . " já existe.";
            }
      }   
     // e caso a variavel cc não esteja assignada
     if(empty($_POST['tel'])){
        array_push($missing ,"tel");
    } else{
        $data['tel'] = htmlspecialchars($_POST['tel']);
        $data['tel'] = stripcslashes($data['tel']);
         $existsTel = userExistsByTel($data['tel']);
         if($existsTel){
             $erros['tel']= "Utilizador com o contacto" . $data['tel'] . " já existe.";
         }
    }
    if(empty($_POST['cc'])){
       array_push($missing ,"cc");
    }else{
        $data['cc'] = htmlspecialchars($_POST['cc']);
        $data['cc'] = stripcslashes($data['cc']);
        $existsCC = userExistsByCC($data['cc'] );
        if($existsCC){
            $erros['cc']= "Cartão de Cidadão" . $_POST['cc'] . " já existente.";
        }
    }
     // e caso a variavel Cconducao não esteja assignada
    if(empty($_POST['Cconducao'])){
        array_push($missing ,"Cconducao");
    } else{
        // caso contrario trata a informação e pede a função da database para ver se já existe,
        // caso existe adiciona a array erros;
        $data['Cconducao'] = htmlspecialchars($_POST['Cconducao']);
        $data['Cconducao']  = stripcslashes(  $data['Cconducao'] );
        $hasCconducao = userExistsByCondC($data['Cconducao'] );
        if($hasCconducao){
         $erros['Cconducao']= "Carta de condução" . $_POST['Cconducao'] . " já existente.";
        }
       // e caso a variavel gen não esteja assignada  
    }if(empty($_POST['dob'])){
        array_push($missing ,"dob");
    }else{
            $data['dob'] = htmlspecialchars($_POST['dob']);
            $data['dob']  = stripcslashes(  $data['dob'] );
        }
    if(empty($_POST['genero'])){
        array_push($missing ,"genero");

    }else{
        $data['genero'] = htmlspecialchars($_POST['genero']);
        $data['genero']  = stripcslashes(  $data['genero'] );
    }
    if(isset($pass)&& isset($passRepetition)){
    if($pass !== $passRepetition){
        $erros['pass'] = "Passwords não são identicas";
    }
    
    }
        if (isset($_POST["inputFile"])) {
            $target_file = $target_dir . basename($_FILES["inputFile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $tipo = $_FILES["inputFile"]["type"];
            $uploadOk = 1;
            if ($tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/jpg" ||   $tipo == "image/pjpeg" ) {


            } else {
                $erros['imgPath'] = "Foto deverá estár no formato png ou jpg";
                $uploadOk = 0;
            }

        }


        if($uploadOk == 1){
            $checkUpload =move_uploaded_file($_FILES["inputFile"]["temp_name"], $target_file);
            if($checkUpload){
                $data['imgPath'] =  $_FILES["inputFile"]["name"];
            }
        }
    // se não houve[r erros ou valores vazios
    if(empty($missing) && empty($erros)){
        $data['cod_distrito'] = htmlspecialchars($_POST['cod_distrito']);
        $data['cod_concelho'] = htmlspecialchars($_POST['cod_concelho']);
        $data['cod_freguesia'] = htmlspecialchars($_POST['cod_freguesia']);
        $data['cod_distrito'] = strip_tags($data['cod_distrito']);
        $data['cod_concelho'] = strip_tags($data['cod_concelho']);
        $data['cod_freguesia'] = strip_tags($data['cod_freguesia']);

    //para cada valor do pos tratar e adicionar a uma array associativa

        $result = RegisterVoluntario($data);
         
        if($result){

            //caso o resultado seja positivo ir para o index
            loginUser($data["email"],$_POST["password"]);
            die();

          }else{
              //caso contrario adicionar a array erros
          $erros['submit'] = TRUE;

        }
    }
    // fazer chamada a função para registar
    
    }   
}

//Obter distritos para select list
echo '<script type="text/javascript">',
'getDistritos();',
'</script>';


?>

<article class="form-group container">
    <br>


<!--  verificar se existem erros ou dados em falta -->
<?php if (count($erros) >0  || count($missing) >0){ echo "
<p class=\"alerta\">Registro Invalido, por favor corrija os dados</p>";}
if(isset($erros['pass'])) echo "<p class=\"alerta\">". $erros['pass'] ."</p>"; 
if(isset($erros['Cconducao'])) echo "<p class=\"alerta\">". $erros['Cconducao'] ."</p>"; 
if(isset($erros['email'])) echo "<p class=\"alerta\">". $erros['email'] ."</p>"; 
 ?>


<div class=" justify-content-center">


    <form  enctype="multipart/form-data" action="" method="POST" id="registro" >




    <!--  verificar se esta em falta o nome -->
    <div class=" row">
        <div class="col">
            <label for="nome">Nome:
            <?php 
            // Caso o campo nome esteja na lista de missing , da erro de aviso
            if (in_array('nome', $missing) ) 
                    echo "<span class=\"alerta\" > Introduza Nome*</span>";?>
            </label>
            <input type="text" class="form-control <?php if (in_array('nome', $missing)) 
                        echo " is-invalid";?> " name="nome" id="nome" value="<?php if(isset($_POST['nome']))
                            echo $_POST['nome'] ?>" placeholder="Digite aqui o Seu nome" >

        </div>
        <div class="col">
            <label for="email">Email:
                <?php // Caso o campo email esteja na lista de missing 
                if (in_array('email', $missing ) ){
                    echo "<span class=\"alerta\" > Introduza Email*</span>";
                }else if(in_array('email', $erros )){
                    echo "<span class=\"alerta\" >".$erros['email']."</span>";
                }
                   ?>

            </label>
            <input type="email"  class="form-control" id="email" name="email" value="<?php if(isset($_POST['email']))
                echo $_POST['email'] ?>" placeholder="Digite aqui o seu email">
            <span class="help-block"> 
                <?php  // Caso o campo email esteja na lista de erros , aviso de erro
                 if(isset( $erros['email']))
                 echo   "<span class=\"alerta\" >".$erros['email'] ."</span>" ?> </span>

        </div>
    </div>

    <div class="row">
        <!--  Primeira Linha -->
        <div class="col"> 

            <label for="password">Password: 
            <?php 
            // caso o campo email esteja na lista de missing criar aviso que esta em falta
            if (in_array('password', $missing) ) 
                echo "<span class=\"alerta\" > Password em falta*</span>";?>
            </label>    
            <input type="password"  class="form-control" name="password" id="password"  placeholder="Digite aqui a sua password" >
        
        </div>
        <div class="col">
            <label for="tel">Telefone:
                <?php
                // Caso o campo tel esteja na lista de missing
                if (in_array('tel', $missing)) {
                    echo "<span class=\"alerta\" > Introduza Telefone*</span>";
                } else if (in_array('tel', $erros)) {
                    echo "<span class=\"alerta\" >" . $erros['tel'] . "</span>";
                }?>

            </label>
            <input  type="tel" pattern="\d*" maxlength="9"  class="form-control  <?php if (in_array('tel', $missing))
                echo " isIis-invalid";?>" id="tel" name="tel" value="<?php
            if(isset($_POST['tel'])) echo $_POST['tel'] ?>"  placeholder="Máximo de 9 Digitos" >
        </div>
        <div class="col">


            <label for="cc">Cartão de Cidadão
               <?php
                if (in_array('cc', $missing)) {
                    echo "<span class=\"alerta\" > Em Falta Cartão de Cidadão*</span>";
                } else if (in_array('cc', $erros)) {
                    echo "<span class=\"alerta\" >" . $erros['cc'] . "</span>";
                }?>
            </label>
            <input type="text" type="text" pattern="\d*" maxlength="8"  class="form-control" name="cc" id="cc" value="<?php
            if(isset($_POST['cc']) && !in_array("cc",$erros)) echo $_POST['cc'] ?>"  placeholder="Digite o seu nº de Cartão de Cidadão" >
        </div>


    </div>
    <!--  Segunda Linha -->
    <div class="row">
        <div class="col">

            <label for="password2">Repita sua Password:
                <?php       ## TO DO , apenas apresentar por favor repita a password em caso do password 1 campo preenchido

                if (in_array('password2', $missing) )
                    echo "<span class=\"alerta\" > Repita a Password *</span>";?>
            </label>
            <input type="password"  class="form-control" name="password2" id="password2"  placeholder="Repita a Sua password" >
        </div>


        <div class="col">

            <label for="Cconducao">Carta de Condução
                <?php
                if (in_array('Cconducao', $missing)) {
                    echo "<span class=\"alerta\" > Em Falta Cartão de Condução*</span>";
                } else if (in_array('Cconducao', $erros)) {
                    echo "<span class=\"alerta\" >" . $erros['Cconducao'] . "</span>";
                }?>
            </label>

            <input type="text"   pattern="\d*" maxlength="8"  class="form-control" name="Cconducao" id="Cconducao" value="<?php
                       if(isset($_POST['Cconducao']) && !in_array("Cconducao",$erros)) echo $_POST['Cconducao'] ?>"
                   placeholder="Digite o nº da carta de condução" >

        </div>
        <div class="col">

            <label for="dob">Data de Nascimento
                <?php
                if (in_array('dob', $missing)) {
                    echo "<span class=\"alerta\" > Em Falta Cartão de Condução*</span>";
                } else if (in_array('dob', $erros)) {
                    echo "<span class=\"alerta\" >" . $erros['dob'] . "</span>";
                }?>

            <?php if (in_array('dob', $missing) )
                    echo "<span class=\"alerta\" > Em Falta *</span>";?>

            </label>
            <input type="date" class="form-control" name="dob" id="dob">
       
        </div>
    </div>


        <!--  Terceira  Linha -->
    <div class="row">
    <div class="col">
            <label for="dist" class="" >
            Distrito
            </label>


            <select name="cod_distrito"  class="form-control"  id="dist">
                <option> Selecione </option>


            </select>
        </div>
        <div class="col">
         <label for="conc" class="" >
            Concelho
            </label>
            <select name="cod_concelho" class="form-control"  id="conc">
                <option> Selecione </option>
           </select>

        </div>
        <div class="col">
         <label for="freg" class="" >
            Freguesia
            </label>
            <select name="cod_freguesia" class="form-control"  id="freg">
                <option> Selecione </option>
           </select>

        </div>
        
    </div>

        <!--  Quarta Linha -->
    <div class="row">

        <div class="col d-flex justify-content-center">
        <label class="form-label" for="tipoSexo" >Tipo</label>
            <br>


                 <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="masculino" value="masculino">
                <label class="form-check-label" for="masculino">
                    Masculino  <?php if (in_array('genero', $missing) ) 
                        echo "<span class=\"alerta\" > Em Falta *</span>";?>
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="feminino" value="feminino" >
                <label class="form-check-label" for="flexRadioDefault2">
                Feminino
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="outro" value="outro" >
                <label class="form-check-label" for="outro">
                Outro
                </label>
                </div>

        </div>

        <div class="col">
            <label class="form-label" for="inputFile" >Foto de Perfil
            <?php   if (in_array('imgPath', $erros)) {
                echo "<span class=\"alerta\" >" . $erros['imgPath'] . "</span>";
            }?></label>
            <!-- MAX_FILE_SIZE deve preceder o campo input -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <input type="file" class="form-control-file" id="inputFile" name="inputFile"  lang="pt">



    
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
         
             <button type="submit" class="btn btn-primary btn-lg" form="registro" name="submit" value="submit">Registar</button>
        </div>
     
    </div>
  </div>
    </form>



</div>



</article>