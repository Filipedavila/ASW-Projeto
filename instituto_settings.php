<?php

if(!isLoggedIn() || !isLoggedInInstitute()){
    header('Location: index.php');
    exit();
    }

$erros = array();
$missing = array();
$utilizador = array();
  $data = array();


    if(isset($_SESSION['id'])){

        $data =  getInstitutionById($_SESSION['id']);



}

//Caso tenha sido feito um pedido Post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // e caso a variavel submit esteja assignada
    if(array_key_exists('submit',$_POST)){

   // e caso a variavel name não esteja assignada
    if(empty($_POST['nome'])){
    array_push($missing, 'nome');    
    
    }else{
        $utilizador['nome'] = htmlspecialchars($_POST['nome']);
        $utilizador['nome'] = stripcslashes($utilizador['nome']);
    }   
   
   // e caso a variavel cc não esteja assignada
     if(empty($_POST['telefone'])){
        array_push($missing ,"telefone");
    } else{
        $utilizador['telefone'] = htmlspecialchars($_POST['telefone']);
        $utilizador['telefone'] = stripcslashes($utilizador['telefone']);  
    }
  
     // e caso a variavel Cconducao não esteja assignada
    if(empty($_POST['morada'])){
        array_push($missing ,"morada");
    } else{
        // caso contrario trata a informação e pede a função da database para ver se já existe,
        // caso existe adiciona a array erros;
        $instituto['morada'] = htmlspecialchars($_POST['morada']);
        $instituto['morada']  = stripcslashes(  $instituto['morada'] );
      
       // e caso a variavel gen não esteja assignada  
    }if(empty($_POST['nome_contacto'])){
        array_push($missing ,"nome_contacto");
    }else{
        $instituto['nome_contacto'] = htmlspecialchars($_POST['nome_contacto']);
        $instituto['nome_contacto']  = stripcslashes(  $instituto['nome_contacto'] );
       
    }
    if(empty($_POST['n_contacto'])){
        array_push($missing ,"n_contacto");
    }else{
        $instituto['n_contacto'] = htmlspecialchars($_POST['n_contacto']);
        $instituto['n_contacto']  = stripcslashes(  $instituto['n_contacto'] );
    
    }
    if(empty($_POST['descricao'])){
        array_push($missing ,"descricao");

    }else{
        $instituto['descricao'] = htmlspecialchars($_POST['descricao']);
        $instituto['descricao']  = stripcslashes(  $instituto['descricao'] );
        
    }

    if(empty($_POST['tipo_inst'])){
        array_push($missing ,"tipo_inst");

    }else{
        $instituto['tipo_inst'] = htmlspecialchars($_POST['tipo_inst']);
        $instituto['tipo_inst']  = stripcslashes(  $instituto['tipo_inst'] );
        
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
   $result2 = updateValuesInstituto($instituto,$_SESSION['id']);
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
    




    
}




?>

<article  class="form-group  justify-content-center">
    <br>
<!--  verificar se existem erros ou dados em falta -->
<?php if (count($erros) >0  || count($missing) >0){ echo "
<p class=\"alerta\">Registro Invalido, por favor corrija os dados</p>";}
if(isset($erros['pass'])) echo "<p class=\"alerta\">". $erros['pass'] ."</p>";  // secalhar no futuro metemos um foreach dos erros
?>
    <div class="justify-content-center">


        <form action="" method="POST" id="registro">




            <!--  verificar se esta em falta o nome -->
            <div class=" row">
                <div class="col">
                    <label for="nome">Nome:
                    </label>
                    <input type="text" value="<?php echo $data[0]['nome'] ?> "  class="form-control <?php if (in_array('nome', $missing)) 
                                                                    echo " is-invalid";?> " name="nome" id="nome" value="">

                </div>
              
            </div>
            <div class="row">

                <div class="col">
                    <label for="telefone">Telefone:
                        <?php if (in_array('tel', $missing)) 
echo " Telefone em falta";?>
                    </label>
                    <input type="number" value="<?php echo $data[0]['telefone'] ?>" class="form-control  <?php if (in_array('telefone', $missing)) 
echo " isIis-invalid";?>" id="telefone" name="telefone" value="<?php 
if(isset($_POST['tel'])) echo $_POST['tel'] ?>">
                </div>
            </div>

            <div class="row">
               
                <div class="col">

                    <label for="morada">Morada
                        <?php if (in_array('morada', $missing)) 
echo " Nome em falta";?>

                    </label>

                    <input type="text" value="<?php echo $data[0]['morada'] ?>" class="form-control" id="morada" name="morada"
                        value="<?php if(isset($_POST['morada'])) echo $_POST['morada'] ?>">
                </div>


            </div>



            <div class="row">
                <div class="col">
                    <label for="dist" class="">
                        Distrito
                    </label>
                    <select name="codigo_distrito" class="form-control" id="dist">
                    <?php

                    $distritos = getDistritos();
                    if($distritos > 0 ){
                    foreach($distritos as $key => $valor ){
                       $option =  "<option ";
                        if($valor == $data[0]['codig_distrito']){
                            $option .= " selected='selected' ";
                        }
                    echo  $option ." value=" . $valor['cod_distrito'] . ">". $valor['nome']   . "</option>" ; 
                    }

                    }
                    ?>

                </select>

                </div>
                <div class="col">
                    <label for="conc" class="">
                        Concelho
                    </label>
                    <select name="codigo_concelho" class="form-control" id="conc">
                        <?php

                    $concelho = getConcelhos();
                    if($concelho > 0 ){
                    foreach($concelho as $valor ){
                        $option =  "<option ";
                        if($valor == $data[0]['codigo_concelho']){
                            $option .= " selected='selected' ";
                        }
                    echo  $option ." value=" . $valor['codigo_concelho'] . ">". $valor['nome']   . "</option>" ; 
                    

                    }
                }

                ?>
                    </select>

                </div>
                <div class="col">
                    <label for="freg" class="">
                        Freguesia
                    </label>
                   <select name="codigo_freguesia" class="form-control" id="freg">
                    <?php

                        $freguesias = getFreguesias();
                        if($freguesias > 0 ){
                            foreach($freguesias as $freg ){
                                $option =  "<option ";
                                if($freg == $data[0]['codigo_freguesia']){
                                    $option .= " selected='selected' ";
                                }
                            echo  $option ." value=" . $freg['cod_freguesia'] . ">".$freg['nome']   . "</option>" ; 
                            }
        


                        }
                
                        ?>
                    </select>

                </div>

            </div>

            <div class="row">
                <div class="col">

                    <label for="nome_contacto">Nome Responsavel:
                        <?php if (in_array('nome_contacto', $missing)) 
                echo " Nome em falta";?>
                    </label>
                    <input type="text" value="<?php echo $data[0]['nome_contacto'] ?> " class="form-control" id="nome_contacto" name="nome_contacto"
                        value="<?php if(isset($_POST['nome_contacto'])) echo $_POST['nome_contacto'] ?>">
                </div>
                <div class="col">
                    <label for="contatoR">Contacto Responsavel:
                        <?php if (in_array('name', $missing)) echo " Contacto em falta";?>
                    </label>
                    <input type="number"  value="<?php echo $data[0]['n_contacto'] ?>" class="form-control" id="n_contacto" name="n_contacto"
                        value="<?php if(isset($_POST['n_contacto'])) echo $_POST['n_contacto'] ?>">
                </div>

            </div>


    </div>


    <div class="row">
        <div class="col">

            <label for="tipo_inst">Tipo de Instituição:
                <?php if (in_array('tipo_inst', $missing)) 
                echo " Nome em falta";?>
            </label>
            <input type="text"  value="<?php echo $data[0]['tipo_inst'] ?>" class="form-control" id="tipo_inst" name="tipo_inst"
                value="<?php if(isset($_POST['tipo_inst'])) echo $_POST['tipo_inst'] ?>">
        </div>

    </div>


    <div class="row">

        <div class="col">

            <label for="descricao"></label>
            <textarea  class="form-control" name="descricao" cols="10" rows="4"
                value="<?php if(isset($_POST['descricao'])) echo $_POST['descricao'] ?>"> <?php echo $data[0]['descricao'] ?>
</textarea>





        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <br>
            <label for="inputFile" class="col-form-label">Foto de perfil</label>
        </div>

        <div class="col">
            <div class="custom-file">
                <br>

                <input type="file" class="form-control-file" id="inputFile" lang="pt">
                <span id="passwordHelpInline" class="form-text">
                    Ficheiro max 2mb

            </div>


        </div>
    </div>
    </div>

    <div class="row justify-content-center">


        <button type="submit" class="btn btn-primary btn-lg" form="registro" name="submit"
            value="submit">Alterar</button>


    </div>
    </div>
    </form>



    </div>

</article>