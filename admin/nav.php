<?php




?>
<body>
    <div class="container-fluid ">
    <header class="row ">
        
    <div class="col "><h1><a href="index.php"><img src="img/header.png" height="80" width="150"> </a></h1></div>

    </header>




       <!-- Caso seja Admin --> 
   <?php if(isLoggedIn()): ?>

      <nav class=" navbar-expand-sm bg-primary navbar-dark">
  <!-- Brand -->
  

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'logout.php' ?>">Logout</a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Pesquisa
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo 'index.php?page=pesquisa_all&pesquisa=ALL'?>">Todos os Usuários</a>
        <a class="dropdown-item" href="<?php echo 'search.php?users=all'  ?>">Pesquisa com Critérios </a>

      
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Mensagens</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'settings.php' . '?id=' . $_SESSION['id']  ?>">Preferências</a>
    </li>

  </ul>
  

    
</nav>

<?php else: ?>


  <nav class=" navbar-expand-sm bg-primary navbar-dark">
  <!-- Brand -->
  

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo 'index.php' . '?page=' . "login" ?>">Login</a>
    </li>
  </ul>
  

    
</nav>

     <?php endif;?>


