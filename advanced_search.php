<?php

if(!isLoggedIn()){
header('Location: index.php');
exit();
}

$user = array();
$data = getCompatibleInstitutes($_SESSION['id']);

// pagina inicial do voluntario ou do instituto,
// se for voluntario mostra uma lista dos institutos da sua area
// se for instituto mostra uma lista de voluntarios da sua area
echo '<script type="text/javascript">',
'getDistritos();',
'</script>';


?>

    <?php if(isLoggedInInstitute() && isLoggedIn()): ?>
        <article class="row mt-5">

        <h1>Bem Vindo  <?php  echo $_SESSION['user']; ?></h1>
        <p> Obrigado por se registar como Instituto</p>
    <p>Site em construção, mais funcionalidades em breve</p>

            </div>
    <div class="col">
        <div class="text-center">
            <img src="img/food-donate.jpg" class="rounded" alt="..."height="350px">
          </div>
    </div>
    </article>
<?php endif;?>


<?php if(isLoggedInVoluntario() && isLoggedIn()) : ?>


<article class="container ">
    <div class="row ">
        <div class="col d-flex justify-content-center">
            <h1>Pesquisa Avançada</h1>

        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <p>Utiliza esta ferramenta para procurares institutos ao teu critério</p>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <p>Botão que permite escolher as opções que vão estar visiveis</p>
        </div>
    </div>
        <div class="row ">
            <div class="col ">
                    <label class = "checkbox-inline">
                        <input type = "checkbox" id = "inlineCheckbox1" value = "option1"> NetBeans IDE
                    </label>
            </div>
            <div class="col ">
                    <label class = "checkbox-inline">
                        <input type = "checkbox" id = "inlineCheckbox2" value = "option2"> Eclipse IDE
                    </label>
                </div>
            <div class="col ">
                <label class = "checkbox-inline">
                    <input type = "checkbox" id = "inlineCheckbox2" value = "option2"> Eclipse IDE
                </label>
            </div>
            <div class="col ">
                <label class = "checkbox-inline">
                    <input type = "checkbox" id = "inlineCheckbox2" value = "option2"> Eclipse IDE
                </label>
            </div>
            </div>
        </div>
<div class="row">
    <div class="input-group mt-3 mb-3 d-flex justify-content-center">
        <div class="input-group-prepend">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                Tipo Pesquisa
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Tipo Instituição</a>
                <a class="dropdown-item" href="#">Tipo Doação</a>
            </div>
        </div>
        <input type="text" class="form-control-md" >
        <button type="search" class="btn bg-primary" placeholder="Procurar">Procurar</button>
    </div>
</div>





     <div class="row d-flex justify-content-center">
        <div class="col">

                 <label for="dist" class="" >
                     Distrito
                 </label>

                 <select name="cod_distrito"  class="form-control-sm"  id="dist">
                     <option> Selecione </option>

                 </select>
        </div>

         <div class="col">
                 <label for="conc" class="" >
                     Concelho
                 </label>
                 <select name="cod_concelho" class="form-control-sm"  id="conc" >
                     <option> Selecione </option>
                 </select>

         </div>
         <div class="col">
           <label for="freg" class="" >
                     Freguesia
           </label>
          <select name="cod_freguesia" class="form-control-sm"  id="freg" >
                     <option> Selecione </option>
          </select>

         </div>
     </div>
    <div class="row">
    <div class="col">


         <table class="d-flex justify-content-center table table-striped  table-hover" id="tabela">
             <tr class="thead-dark">
                     <th>Nome Instituição</th>
                     <th>Tipo Instituição</th>
                     <th>Distrito</th>
                     <th>Concelho</th>
                     <th>Freguesia</th>
                     <th>Perfil</th>
             </tr>
                 <?php foreach($data as $user ): ?>
                     <?php if(count($user) > 0): ?>
                         <tr>
                             <td><?= $user['nome'] ?></td>
                             <td><?= $user['tipo_inst'] ?></td>
                             <td><?= $user['nome_distrito'] ?></td>
                             <td><?= $user['nome_concelho'] ?></td>
                             <td><?= $user['nome_freguesia'] ?></td>
                             <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>


                         </tr>
                     <?php endif;?>
                 <?php endforeach; ?>
             </table>
     </div>
    </div>
</article>
         <?php endif;?>


</body>





