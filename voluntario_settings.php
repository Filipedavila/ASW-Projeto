<?php


if(!isLoggedIn() || !isLoggedInVoluntario()){ 
    header('Location: index.php');
    exit();
    }



$erros = array();
$missing = array();
$data = array();
$utilizador = array();

    if(isset($_SESSION['id'])){

        $data = getVoluntario($_SESSION['id']);



    }



//Caso tenha sido feito um pedido Post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // e caso a variavel submit esteja assignada
    if(array_key_exists('submit',$_POST)){

    if(empty($_POST['nome'])){
    array_push($missing, 'nome');    
    
    }else{
        $utilizador['nome'] = htmlspecialchars($_POST['nome']);
        $utilizador['nome'] = stripcslashes($utilizador['nome']);
    }   
   
    if(empty($_POST['telefone'])){
        array_push($missing ,"telefone");
    } else{
        $utilizador['telefone'] = htmlspecialchars($_POST['telefone']);
        $utilizador['telefone'] = stripcslashes($utilizador['telefone']);  
    }
  
    
     // e caso a variavel Cconducao não esteja assignada
      if(empty($_POST['dob'])){
        array_push($missing ,"dob");
    }else{
        $voluntario['dob'] = htmlspecialchars($_POST['dob']);
        $voluntario['dob']  = stripcslashes(  $voluntario['dob'] );
       
    }if(empty($_POST['genero'])){
        array_push($missing ,"genero");

    }else{
        $voluntario['genero'] = htmlspecialchars($_POST['genero']);
        $voluntario['genero']  = stripcslashes(  $voluntario['genero'] );
    }
    
    }

    // se não houve[r erros ou valores vazios
    if(empty($missing) && empty($erros)){
        $utilizador['codigo_distrito'] = htmlspecialchars($_POST['codigo_distrito']);
        $utilizador['codigo_concelho'] = htmlspecialchars($_POST['codigo_distrito']);
        $utilizador['codigo_freguesia'] = htmlspecialchars($_POST['codigo_freguesia']);
        $utilizador['codigo_distrito'] = strip_tags($utilizador['codigo_distrito']);
        $utilizador['codigo_concelho'] = strip_tags($utilizador['codigo_concelho']);
        $utilizador['codigo_freguesia'] = strip_tags($utilizador['codigo_freguesia']);
    //para cada valor do pos tratar e adicionar a uma array associativa
    $result = updateValuesUtilizador($utilizador,$_SESSION['id']);
    $result2 = updateValuesVoluntario($voluntario,$_SESSION['id']);
        if($result && $result2){
            //caso o resultado seja positivo ir para o index
            session_start();
        
             header('Location: index.php');
                 die();

          }else{
              //caso contrario adicionar a array erros
          $erros['submit'] = TRUE;

        }
    }
    // fazer chamada a função para registar
    
    

    }


echo '<script type="text/javascript">',
'getDistritos();',
'</script>';



    



?>

<article class="form-group container">
    <br>


<!--  verificar se existem erros ou dados em falta -->
<?php if (count($erros) >0  || count($missing) >0){ echo "
<p class=\"alerta\">Registro Invalido, por favor corrija os dados</p>";}
if(isset($erros['pass'])) echo "<p class=\"alerta\">". $erros['pass'] ."</p>";  // secalhar no futuro metemos um foreach dos erros


 ?>


<div class=" justify-content-center">


    <form action="" method="POST" id="registro" >
    <!--  verificar se esta em falta o nome -->
    <div class=" row">
        <div class="col">
            <label for="nome">Nome:
            <?php if (in_array('nome', $missing) ) 
                    echo "<span class=\"alerta\" > Introduza Nome*</span>";?>
            </label>
            <input type="text" class="form-control <?php if (in_array('nome', $missing)) 
                        echo " is-invalid";?> " name="nome" id="nome" value="<?php echo $data[0]['nome'] ?> "  >

        </div>
        <div class="col">         
                <label for="tel">Telefone: 
                    <?php if (in_array('tel', $missing)) 
                        echo " Telefone em falta";?>
                </label>
                <input type="number"  class="form-control  <?php if (in_array('telefone', $missing)) 
                        echo " isIis-invalid";?>" id="telefone" name="telefone" value="<?php echo $data[0]['telefone'] ?>">
                </div>
    </div>
    </div>


    <div class="row">
         
        <div class="col">
    


            <label for="dob">Data de Nascimento
            <?php if (in_array('dob', $missing) ) 
                    echo "<span class=\"alerta\" > Em Falta *</span>";?>

            </label>
            <input type="date" class="form-control" name="dob" id="dob"  value="<?php echo $data[0]['dob'] ?>">
       
        </div>
        <div class="col">
            <label for="dist" class="" >
                Distrito
            </label>
            <script type="text/javascript" src="./js/locations.js"></script>

            <select name="cod_distrito"  class="form-control"  id="dist">
                <option> Selecione </option>


            </select>
        </div>
    </div>

    

    <div class="row">

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
    <div class="row">
        
        <div class="col"><br>
    
                 <div class="form-check-inline">

                 <?php 
                 $isMale=False;
                 $isFem=False;
                 $isOther =False;
                 $choosen = $data[0]['genero'];
                 if($choosen === "masculino"){
                    $isMale=true;
                 }elseif ($choosen === "feminino"){
                    $isFem=true;
                 }else{
                    $isOther =true;
                 }
                    ?>
                <input class="form-check-input" type="radio" name="genero" id="masculino" <?php if($isMale) echo "checked" ?>>
                <label class="form-check-label" for="masculino">
                    Masculino  <?php if (in_array('genero', $missing) ) 
                        echo "<span class=\"alerta\" > Em Falta *</span>";?>
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="feminino"  <?php if($isFem) echo "checked" ?>>
                <label class="form-check-label" for="flexRadioDefault2">
                Feminino
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="outro" <?php if($isOther) echo "checked" ?>>
                <label class="form-check-label" for="outro">
                Outro
                </label>
                </div>
        </div>  
        
        <div class="col-auto">
            <br>
    <label for="inputFile" class="col-form-label">Foto de perfil</label>
  </div>
        <div class="col">
            <div class="custom-file">
                <br>
         
                    <input type="file" class="form-control-file" id="inputFile"  lang="pt">
                    <span id="passwordHelpInline" class="form-text">
        Ficheiro max 2mb
    </span>
                
            </div>

    
        </div>
    </div>
    <div class="row justify-content-center">
        
         
             <button type="submit" class="btn btn-primary btn-lg" form="registro" name="submit" value="submit">Registar</button>
            
     
    </div>
  </div>
    </form>



</div>



</article>