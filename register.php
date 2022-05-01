<?php





$erros = array();
$missing = array();
$data = array();


//Caso tenha sido feito um pedido Post
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        $checkResult = userExistsByEmail($data['email']);
             if($checkResult){
                  $erros['email']= "Utilizador com email" . $data['email'] . " já existe.";
            }
      }   
     // e caso a variavel cc não esteja assignada
     if(empty($_POST['tel'])){
        array_push($missing ,"tel");
    } else{
        $data['tel'] = htmlspecialchars($_POST['tel']);
        $data['tel'] = stripcslashes($data['tel']);  
    }
    if(empty($_POST['cc'])){
       array_push($missing ,"cc");
    }else{
        $data['cc'] = htmlspecialchars($_POST['cc']);
        $data['cc'] = stripcslashes($data['cc']);
    }
     // e caso a variavel Cconducao não esteja assignada
    if(empty($_POST['Cconducao'])){
        array_push($missing ,"Cconducao");
    } else{
        // caso contrario trata a informação e pede a função da database para ver se já existe,
        // caso existe adiciona a array erros;
        $data['Cconducao'] = htmlspecialchars($_POST['Cconducao']);
        $data['Cconducao']  = stripcslashes(  $data['Cconducao'] );
        $checkResult = userExistsByCondC($data['Cconducao'] );
        if($checkResult){
         $erros['Cconducao']= "Utilizador com email" . $_POST['Cconducao'] . " já existe.";
        }
       // e caso a variavel gen não esteja assignada  
    }if(empty($_POST['dob'])){
        array_push($missing ,"dob");
    }else{
        $data['dob'] = htmlspecialchars($_POST['dob']);
        $data['dob']  = stripcslashes(  $data['dob'] );
       
    }if(empty($_POST['genero'])){
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

    // se não houve[r erros ou valores vazios
    if(empty($missing) && empty($erros)){
        $data['cod_distrito'] = htmlspecialchars($_POST['cod_distrito']);
        $data['cod_concelho'] = htmlspecialchars($_POST['cod_concelho']);
        $data['cod_freguesia'] = htmlspecialchars($_POST['cod_freguesia']);
        $data['cod_distrito'] = strip_tags($data['cod_distrito']);
        $data['cod_concelho'] = strip_tags($data['cod_concelho']);
        $data['cod_freguesia'] = strip_tags($data['cod_freguesia']);
    //para cada valor do pos tratar e adicionar a uma array associativa
        $result = RegisterVoluntario($data);   ## OBTER ID ## mudar a função de registro
         
        if($result){
            //caso o resultado seja positivo ir para o index
            session_start();
            $_SESSION["tipo"]="Voluntario";
            $_SESSION["id"]=1;    #### POR ID"#####
            $_SESSION["logged"]=true;

        
             header('Location: index.php');
                 die();

          }else{
              //caso contrario adicionar a array erros
          $erros['submit'] = TRUE;

        }
    }
    // fazer chamada a função para registar
    
    }   
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
if(isset($erros['pass'])) echo "<p class=\"alerta\">". $erros['pass'] ."</p>"; 
if(isset($erros['Cconducao'])) echo "<p class=\"alerta\">". $erros['Cconducao'] ."</p>"; 
if(isset($erros['email'])) echo "<p class=\"alerta\">". $erros['email'] ."</p>"; 
 ?>


<div class=" justify-content-center">


    <form action="" method="POST" id="registro" >




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
                        echo " is-invalid";?> " name="nome" id="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'] ?>" >

        </div>
        <div class="col">
            <label for="email">Email:
                <?php // Caso o campo email esteja na lista de missing 
                if (in_array('email', $missing) ) 
                    echo "<span class=\"alerta\" > Introduza Email*</span>";?>

            </label>
            <input type="text"  class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>">
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
            <input type="password"  class="form-control" name="password" id="password">
        
        </div>
        <div class="col">
            <label for="tel">Telefone:
                <?php
                ## TO DO , Caso ja exista um user com o mesmo telefone mostrar um erro a dizer que um user ja tem este contacto
                if (in_array('tel', $missing))
                    echo " Telefone em falta";?>
            </label>
            <input  type="text" pattern="\d*" maxlength="9"  class="form-control  <?php if (in_array('tel', $missing))
                echo " isIis-invalid";?>" id="tel" name="tel" value="<?php
            if(isset($_POST['tel'])) echo $_POST['tel'] ?>">
        </div>
        <div class="col">


            <label for="cc">Cartão de Cidadão
                <?php  ## TO DO ,Caso exista um utilizador com o mesmo numero de cartão de cidadão dar erro e mostra lo
                if (in_array('cc', $missing) )
                    echo "<span class=\"alerta\" > Em Falta Cartão de Cidadão*</span>";?>

            </label>
            <input type="number" type="text" pattern="\d*" maxlength="8"  class="form-control" name="cc" id="cc" value="<?php
            if(isset($_POST['cc']) && !in_array("cc",$erros)) echo $_POST['cc'] ?>">
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
            <input type="password"  class="form-control" name="password2" id="password2">
        </div>


        <div class="col">

            <label for="Cconducao">Carta de Condução
            <?php if (in_array('Cconducao', $missing) ) 
                    echo "<span class=\"alerta\" > Em Falta *</span>";?>
            </label>

            <input type="number"  type="text" pattern="\d*" maxlength="8"  class="form-control" name="Cconducao" id="Cconducao" value="<?php 
                       if(isset($_POST['Cconducao']) && !in_array("Cconducao",$erros)) echo $_POST['Cconducao'] ?>">

        </div>
        <div class="col">

            <label for="dob">Data de Nascimento
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
        <script type="text/javascript" src="./js/locations.js"></script>

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
                <input class="form-check-input" type="radio" name="genero" id="masculino">
                <label class="form-check-label" for="masculino">
                    Masculino  <?php if (in_array('genero', $missing) ) 
                        echo "<span class=\"alerta\" > Em Falta *</span>";?>
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="feminino" >
                <label class="form-check-label" for="flexRadioDefault2">
                Feminino
                </label>
                </div>
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="outro" >
                <label class="form-check-label" for="outro">
                Outro
                </label>
                </div>

        </div>

        <div class="col">
            <label class="form-label" for="inputFile" >Foto de Perfil</label>
                    <input type="file" class="form-control-file" id="inputFile"  lang="pt">



    
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