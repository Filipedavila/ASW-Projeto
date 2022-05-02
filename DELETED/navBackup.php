<?php
require SITE_ROOT . '/resources/link_urls.php';



?>

    <div class="container-fluid ">
    <header class="row ">
        
    <div class="col ">
     <?php if(isLoggedInInstitute()) : ?>

      <?php endif;?>
      <?php if(isLoggedInVoluntario()) : ?>



      <?php endif;?>
    </header>




       <!-- Caso seja instituto --> 
    <?php if( isLoggedIn() && isLoggedInInstitute()) : ?>

      <nav class=" navbar-expand-sm bg-primary navbar-dark">
  <!-- Brand -->
  

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo 'logout.php' . '?id=' . $_SESSION['id']  ?>"><span class="navbar-text" Logout</span></a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Procurar Voluntarios
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo 'search.php' . '?id=' . $_SESSION['id'] . '&search=local'  ?>">Voluntarios Perto</a>
        <a class="dropdown-item" href="<?php echo 'search.php' . '?id=' . $_SESSION['id'] . '&search=choose'  ?>">Voluntarios por Local </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Mensagens</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'index.php' . '?page=' . "instituto_settings" . "&id=". $_SESSION['id']  ?>">Preferências</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'index.php' . '?page=' . "perfil_instituto" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
    </li>
  </ul>


          <h1><a href="../index.php"><img src="../img/header.png" height="80" width="150"> </a></h1></div>
</nav>


    <!-- Caso seja voluntario -->
     <?php elseif(isLoggedIn() && isLoggedInVoluntario()): ?>

      <nav class=" navbar-expand-sm bg-primary navbar-dark">
  <!-- Brand -->
  

  <!-- Links -->
          <div class="row">
          <div class="col">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'logout.php' . '?id=' . $_SESSION['id']  ?>">Logout</a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Procurar Institutos
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Institutos Perto</a>
        <a class="dropdown-item" href="#">Institutos por Local </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Mensagens</a>
    </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Prefências
          </a>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="../index.php?page=voluntario_settings">Dados Pessoais</a>
              <a class="dropdown-item" href="#">Disponibilidade</a>

          </div>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'index.php' . '?page=' . "perfil_voluntario" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
    </li>
  </ul>


          <h1><a href="../index.php"><img src="../img/header.png" height="80" width="150"> </a></h1></div>
</nav>
  


    <?php else : ########### CASO NÃO ESTEJA AUTENTICADO #################?>

      <nav class=" navbar-expand-sm sticky-top bg-primary navbar-dark  ">
  <!-- Brand -->

          <div class="row container-fluid ">
              <div class="col d-flex align-items-center">
  <!-- Links -->
  <ul class="nav navbar-nav ">
    <li class="nav-item">
      <a class="nav-link" href="<?= $loginPage ?>"><span class="navbar-text">Login</span></a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          <span class="navbar-text">Registar</span>
      </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?= $registerInstituto ?>">Instituto</a>
          <a class="dropdown-item" href="<?=  $registerVoluntario ?>">Voluntario</a>

        </div>
    </li>

      </div>




     <div class="col d-flex justify-content-end"">
              <div class="navbar-brand "><a href="../index.php"><img src="../img/header.png" height="80" width="150"> </a></div>
</div>
      </div>
</nav>
    <?php endif?>

