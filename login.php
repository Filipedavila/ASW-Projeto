<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  // e caso a variavel submit esteja assignada
    $missing= array();

    $loginState =False;
  if(isset($_POST['login'])){
    // se o login e password foram assignados
    if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))){
        $user = htmlspecialchars($_POST['username']);
        $user = strip_tags($user);

        
        
        $login = loginUser($user,$_POST['password']);
      
            if($login){

              echo "<p> LOGIN COM SUCESSO</p>";
              header( "Location: index.php?page=home" );
              die();

            
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

<article class="container">

    <div class="row d-flex justify-content-center mt-4 ">
        <div class="col-sm-4 mr-5 ">
            <form action="" id="loginUser" method="POST">
                <?php if (isset($loginError)){ echo "
  <p>Dados de Login Inválidos</p>";}
                ?>
                <!-- Email input -->
                <div class="form-outline mb-5">
                    <input type="email"  name="username" id="email" class="form-control" />
                    <label class="form-label" for="form2Example1">Endereço Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password"  id="password" name="password" " class="form-control" />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="savePassword" checked />
                            <label class="form-check-label" for="form2Example31"> Lembrar-me </label>
                        </div>
                    </div>


                </div>

                <!-- Submit button -->
                <button type="submit" form="loginUser" name="login" class="btn btn-primary btn-block mb-4">Entrar</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>não estás registado? </p>
                    <p>Regista-te como <a  href="./index.php?page=register">Voluntário</a></p>
                    <p>ou Regista-te como <a href="./index.php?page=registerInst">Instituto</a></p>



                </div>
            </form>

        </div>
        <div class="col col-sm-6" >


            <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade carousel-dark" data-ride="carousel">

                <div class="carousel-inner">

                    <div class="carousel-item active ">
                        <img  class="d-block w-100" src="img/food-donate.jpg" class="rounded img-fluid " alt="First slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class=" w-100  bg-dark">Refood, o Nosos lema é ajudar o próximo</h5>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img  class="d-block w-100" src="img/volunteer.jpg" class="rounded img-fluid" alt="Second slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">

                            <h5 class=" w-100  bg-dark">Junta te a nós nesta missão</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img  class="d-block w-100" src="img/volunterGivingFood.jpeg" class="rounded img-fluid" alt="Second slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class=" w-100  bg-dark">Refood, o Nosos lema é ajudar o próximo</h5>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img  class="d-block w-100" src="img/volunterFoodBox.jpeg" class="rounded img-fluid" alt="Second slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">

                            <h5 class=" w-100  bg-dark">Junta te a nós nesta missão</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img  class="d-block w-100" src="img/help.jpeg" class="rounded img-fluid" alt="Second slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class=" w-100  bg-dark">Refood, o Nosos lema é ajudar o próximo</h5>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img  class="d-block w-100" src="img/food-donate.jpg" class="rounded img-fluid" alt="Second slide"width="20vw">
                        <div class="carousel-caption d-none d-md-block">

                            <h5 class=" w-100  bg-dark">Junta te a nós nesta missão</h5>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        </div>

        </div>
    </div>
</article>
</body>