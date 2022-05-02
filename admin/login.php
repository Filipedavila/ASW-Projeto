<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  // e caso a variavel submit esteja assignada
    $missing= array();
<<<<<<< HEAD
    $loginError;
=======

>>>>>>> origin/filipeNovo
    $loginState =False;

    // se foi post e  a var login está posta foi uma tentativa de login
    if(isset($_POST['login'])){
      // se o login e password foram assignados
<<<<<<< HEAD
       if(isset($_POST['username']) && isset($_POST['password'])){
          $user = htmlspecialchars($_POST['username']);
          $user = strip_tags($user);

          $password = md5($_POST['password']);
          
          $login = loginAdmin($user,$password);
              if($login){
                 
                 header('Location: index.php');
                 
            /// redirecionar para outra pagina, temos de arranjar forma de permanecer com login
               
              }else{
                 $loginError =TRUE;

             }
        }else{
          $loginError =TRUE;
        
        }



  

    }
  




=======
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
  
>>>>>>> origin/filipeNovo
  }


?>
<<<<<<< HEAD
=======
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
    
>>>>>>> origin/filipeNovo
    
        
<<<<<<< HEAD
    <h1>Index</h1>
    <?php echo print_r($_POST); ?>
        <?php echo print_r($_SESSION);?> 
    echo "<br>";
    echo "\n";?>
    
    
   
    <form action="#" id="loginUser"method="POST">
        <?php if (isset($loginError)){ echo "
  <p>Dados de Login Inválidos</p>";}
 ?>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label"  for="username">Nome de Usuário</label>
            <input type="text" name="username" id="username" class="form-control form-control-lg" />
            
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4"> 
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-lg" />
           
          </div>

          <!-- Submit button -->
          <button type="submit" form="loginUser" name="login" class="btn btn-primary btn-lg btn-block">Entrar</button>


        </form>
    </div>
    </article>
</body>
=======
      </body>
    </html>
       
>>>>>>> origin/filipeNovo
