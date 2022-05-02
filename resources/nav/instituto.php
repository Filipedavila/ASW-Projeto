<?php
?>
<li class="nav-item">
    <a class="nav-link" href="<?php echo 'logout.php' . '?id=' . $_SESSION['id']  ?>"><span class="navbar-text text-light"> Logout</span></a>
</li>
<!-- Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
        Procurar Voluntarios
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo 'search.php' . '?id=' . $_SESSION['id'] . '&search=local'  ?>">Voluntarios Perto</a>
        <a class="dropdown-item" href="<?php echo 'search.php' . '?id=' . $_SESSION['id'] . '&search=choose'  ?>">Voluntarios por Local </a>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="#">Mensagens</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "instituto_settings" . "&id=". $_SESSION['id']  ?>">Preferências</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "perfil_instituto" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
</li>
