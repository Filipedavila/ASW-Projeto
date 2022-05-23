<?php
?>

<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'logout.php' . '?id=' . $_SESSION['id']  ?>">Logout</a>
</li>

<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "home"   ?>">Pesquisar Voluntários</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "mensagem"   ?>">Mensagens</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "instituto_settings" . "&id=". $_SESSION['id']  ?>">Preferências</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "perfil_instituto" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
</li>
