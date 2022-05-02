<?php
?>
<li class="nav-item">
      <a class="nav-link " href="<?= $loginPage ?>"><span class="navbar-text text-light">Login</span></a>
    </li>
    <!-- Dropdown -->
    <li class="nav-item">
      <a class="nav-link dropdown-toggle " href="#" id="navbardrop" data-toggle="dropdown">
          <span class="navbar-text text-light">Registar</span>
      </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?= $registerInstituto ?>">Instituto</a>
          <a class="dropdown-item" href="<?=  $registerVoluntario ?>">Voluntario</a>

        </div>
    </li>