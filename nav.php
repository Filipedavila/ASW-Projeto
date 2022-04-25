<?php
require SITE_ROOT . '/resources/link_urls.php';



?>


  <header>


      <nav class=" navbar-expand-sm sticky-top bg-primary navbar-dark  ">
  <!-- Brand -->

          <div class="row container-fluid ">
              <ul class="col d-flex align-items-center">
  <!-- Links -->
  <ul class="nav navbar-nav ">
<?php

if(isLoggedInVoluntario()){

 require  SITE_ROOT . '/resources/nav/voluntario.php';
}elseif (isLoggedInInstitute()){
    require  SITE_ROOT . '/resources/nav/instituto.php';
}else{
    require  SITE_ROOT . '/resources/nav/guest.php';
}

    ?>

      </ul>




     <div class="col d-flex justify-content-end"">
              <div class="navbar-brand "><a href="index.php"><img src="img/header.png" height="80" width="150"> </a></div>
</div>
      </div>
</nav>
    </header>


