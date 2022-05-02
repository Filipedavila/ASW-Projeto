<?php
$tipo;
$erros= array();
$missing = array();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // e caso a variavel submit esteja assignada
    if(array_key_exists('login',$_POST)){
    if(empty($_POST['tipo'])){
        array_push($missing ,"tipo");
        }else{
            $data['tipo'] = htmlspecialchars($_POST['tipo']);
            $data['tipo'] = stripcslashes($data['tipo']);

        }
   // e caso a variavel name não esteja assignada
        if(empty($_POST['userId'])){
        array_push($missing, 'userId');    
        
        }else{
            $data['id'] = htmlspecialchars($_POST['userId']);
            $data['id'] = stripcslashes($data['id']);

    }   
    

    if(empty($missing) && empty($erros)){
            if($data['tipo']==="Voluntario"){
             $result = existsVoluntarioID($data['id']);
              
             
               if($result){
                  header('Location: Location: index.php?page=voluntario_settings?id='. $data['id']);
                  die();
               }else{
                 $erros = "Usuario não existe";
               }
            }
              
            if($data['tipo']==="Instituto"){
                
              $result = existsInstitutoID($data['id']);
              
             
              if($result){
                 header('Location: index.php?page=perfil_instituto&id='. $data['id']);
                 die();
              }else{
                $erros = "Usuario não existe";
              }
           }
      
    }
  
    
    

    }
    




    
}

?>
    
    <article class="row mt-5 justify-content-center">
    <?php if (count($erros) >0  || count($missing) >0){ echo "
<p class=\"alerta\">Dados Invalidos</p>";}

 ?>
    <form action="" method="POST" >
  <fieldset >
    <legend>Ver Perfil</legend>
    <div class="mb-3">
      <label for="disabledTextInput" name="userId" class="form-label">Digite o ID</label>
      <input type="text" id="userId" name="userId" class="form-control" placeholder="ID">
    </div>
    <div class="mb-3">
      <label for="disabledSelect" class="form-label">Tipo de Utilizador</label>
      <select id="disabledSelect" name="tipo"  class="form-select">
        <option>Instituto</option>
        <option>Voluntario</option>
      </select>
    </div>
    <button type="submit" id="login" name="login" class="btn btn-primary">Entrar</button>
  </fieldset>
</form>
    

    
    </article>
</body>
