<?php

$data = array();

if($_GET['pesquisa']=== 'ALL'){
    $data = getAllUsers_();

}

?>

<body>
<div class="container">
    <br>
    <table class="table table-striped  table-hover">
        <tr class="thead-dark">
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Telefone</th>
        </tr>
        <?php foreach($data as $user ): ?>
            <tr>
                <td><?= $user[0] ?></td>
                <td><?= $user[1] ?></td>
                <td><?= $user[2] ?></td>
                <td><?= $user[3] ?></td>
                <td><?= $user[4] ?></td>



            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>







<article class="row mt-5">
    <div class="col ml-5">
        
    <h1>Procura</h1>
    <table class="table table-striped table-hover">
      <!--- 
        ?>-->
    <tr>
          <td class="table-light">...</td>
    </tr>
    </table>
    </div>
    </article>
</body>






    
