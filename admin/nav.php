<?php




?>
<body>



       <!-- Caso seja Admin --> 
   <?php if(isLoggedInAdmin()): ?>

       <header>
           <nav class=" navbar-expand-sm sticky-top bg-primary navbar-dark  ">
               <div class="row container-fluid ">
                   <ul class="col d-flex align-items-center">
                       <!-- Links -->
                       <ul class="nav navbar-nav ">

    <li class="nav-item ">
      <a class="nav-link text-light" href="<?php echo 'logout.php' ?>">Logout</a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
        Pesquisa
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo 'index.php?page=home'?>">Todos os Usuários</a>
          <a class="dropdown-item" href="<?php echo 'index.php?page=search_voluntarios'  ?>">Todos os Voluntários</a>

          <a class="dropdown-item" href="<?php echo 'index.php?page=search_institutos'  ?>">Todos os Institutos</a>

          <a class="dropdown-item" href="<?php echo 'index.php?page=region_search'  ?>">Pesquisa com Critérios </a>

      
      </div>
    </li>



  </ul>
                       <div class="col d-flex justify-content-end"">
                       <div class="navbar-brand "><a href="index.php"><img src="img/header.png" height="80" width="150"> </a></div>
               </div>
               </div>

    
</nav>

<?php else: ?>
   <header>

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

        </header>
