<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  // e caso a variavel submit esteja assignada
    $missing= array();

    $loginState =False;

    // se foi post e  a var login está posta foi uma tentativa de login
    if(isset($_POST['login'])){
      // se o login e password foram assignados
       if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))){
          $user = htmlspecialchars($_POST['username']);
          $user = strip_tags($user);

          
          
          $login = loginAdmin($user,$_POST['password']);
         
              if($login){

                 echo "<p> LOGIN COM SUCESS</p>";
                 header( "Location:index.php?page=home" );   /// NO FINAL TEMOS QUE ALTERAR
                 die();
            /// redirecionar para outra pagina, temos de arranjar forma de permanecer com login
               
              }else{
                // mensagem de erro quando os dados de login forem invalidos
                 $loginError ="Dados Inválidos";

             }
        }else{
          // mensagem de erro quando não houverem os dados todos no post
          $loginError ="Por favor insira todos os dados";
        
        }

    }
  
  }


?>
  <body class="text-center">
    
    <main class="form-signin">
 
    


<?php if (isset($loginError)){ echo $loginError;}
 ?>
    <form action="" id="loginAdmin"method="POST">
        <img class="mb-4" src="../admin/img/header.png" alt="fcul logo"  height="80" width="150">
        <h1 class="h3 mb-3 fw-normal">Digite os seus dados</h1>
    
        <div class="form-floating"> 
          <label for="username">Usuário</label>
          <input type="text" class="form-control" name="username" id="username"  placeholder="Nome Usuário">
         
        </div>
        <div class="form-floating">   
          <label for="floatingPassword">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
       
        </div>
    
       
        </div>
        <button class="w-100 btn btn-lg btn-primary" form="loginAdmin" name="login" id="login" type="submit">Entrar</button>
        <pre class="mt-5 mb-3 text-muted">Projeto ASW 2022/2023 <br><br> Universidade  de  Lisboa <br> Faculdade de Ciências</pre>
       
      </form>
    </main>
    
    
        
      </body>
    </html>
       