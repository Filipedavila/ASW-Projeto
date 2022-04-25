<?php

?>

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
        <a class="dropdown-item" href="index.php?page=voluntario_settings">Dados Pessoais</a>
        <a class="dropdown-item" href="#">Disponibilidade</a>

    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?php echo 'index.php' . '?page=' . "perfil_voluntario" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
</li>