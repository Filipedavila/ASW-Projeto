<?php

?>

<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'logout.php' . '?id=' . $_SESSION['id']  ?>">Logout</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "home"   ?>">Home</a>
</li>
<!-- Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
        Procurar Institutos
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="index.php?page=home">Institutos Disponiveis</a>
        <a class="dropdown-item " href="index.php?page=advanced_search">Pesquisa Avançada</a>

    </div>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "mensagem"   ?>">Mensagens</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
        Preferências
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="index.php?page=voluntario_settings">Dados Pessoais</a>
        <a class="dropdown-item" href="index.php?page=voluntario_disponibilidade">Disponibilidade</a>

    </div>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="<?php echo 'index.php' . '?page=' . "perfil_voluntario" . "&id=". $_SESSION['id']  ?>">Meu Perfil</a>
</li>