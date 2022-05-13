<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data= array();
if(!isLoggedInAdmin()) {
    header("Location: /admin/index.php?page=login");
}
    const RADIO_INSTITUTO = "Instituicao";
    const RADIO_VOLUNTARIO = "Voluntario";
    const ID_IDADE_MINIMA = "idade_minima";
    const ID_IDADE_MAXIMA = "idade_maxima";
    const BTN_SEARCH = "btn_search";
    const ID_FORM_ADVANCED_SEARCH = "searchForm";
    const FORM_METHOD = "POST";
    $dataUtilizador = array();
    $dataInstituto = array();
    $result = array();
    if ($_SERVER["REQUEST_METHOD"] == FORM_METHOD) {
        // e caso a variavel submit esteja assignada
        if (array_key_exists(BTN_SEARCH, $_POST)) {
            if (isset($_POST[ID_IDADE_MINIMA])) {
                $data[ID_IDADE_MINIMA] = htmlspecialchars($_POST[ID_IDADE_MINIMA]);
                $data[ID_IDADE_MINIMA] = stripcslashes($data[ID_IDADE_MINIMA]);
            }
            if (isset($_POST[ID_IDADE_MAXIMA])) {
                $data[ID_IDADE_MAXIMA] = htmlspecialchars($_POST[ID_IDADE_MAXIMA]);
                $data[ID_IDADE_MAXIMA] = stripcslashes($data[ID_IDADE_MAXIMA]);
            }


            if ($_POST['tipo'] === RADIO_VOLUNTARIO) {

                $result = searchVoluntarioByAge($data);

            }




    }

}
echo '<script type="text/javascript">',
'getDistritos();',
'</script>';

?>


<?php if(isLoggedInAdmin()) : ?>

<article class="container ">

    <div class="row ">
        <div class="col d-flex justify-content-center">
            <h2>Pesquisa por faixa etária</h2>

        </div>
    </div>


      <div class="row">


            <div class="col d-flex justify-content-center">
                <p>Pesquisa por faixa etária para  voluntarios</p>
            </div>
    </div>

    <form action="" method="<?= FORM_METHOD ?>" id="<?= ID_FORM_ADVANCED_SEARCH ?>" >
        <div class="row d-flex justify-content-center">

            <div class="col-auto">
                <label for="idadeMin">Idade Minima</label>
                <input type="Number" id="idadeMin" name="<?= ID_IDADE_MINIMA ?>"   class="form-control" min="16" max="80">

            </div>
            <div class="col-auto">
                <label for="idadeMax">Idade Minima</label>
                <input type="Number" id="idadeMax" name="<?= ID_IDADE_MAXIMA ?>" class="form-control"  min="16" max="80">

            </div>
        </div>


        <div class="row input-group d-flex justify-content-center">


        <div class="col-sm-3 mt-4">
            <input class="form-check-input" type="radio" name="tipo" id="radioInstituto" value="<?= RADIO_INSTITUTO ?>" disabled>
            <label class="form-check-label" for="radioInstituto">
                Instituto
            </label>
        </div>
        <div class="col-sm3 mt-4">
            <input class="form-check-input" type="radio" name="tipo" id="radioVoluntario" value="<?= RADIO_VOLUNTARIO ?>" checked>
            <label class="form-check-label" for="radioVoluntario">
                Voluntario
            </label>
        </div>



</div>
    <div class="row d-flex justify-content-end">
    <div class="col-auto ">
        <button name="<?= BTN_SEARCH ?>"   type="submit" form="<?= ID_FORM_ADVANCED_SEARCH ?>"class="btn bg-primary text-light" placeholder="Procurar">Procurar</button>
    </div>
</div>


    </form>
</div>

    <?php if(!empty($result)): ?>

    <div class="row">
        <div class="col">
            <table class="d-flex justify-content-center table table-striped  table-hover" id="tabela">



            <?php if($_POST['tipo']== RADIO_VOLUNTARIO): ?>
            <tr class="thead-dark">
                <th>Nome </th>
                <th>Email </th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Perfil</th>
            </tr>
            <?php foreach($result as $user ): ?>
                <?php if(count($user) > 0): ?>

                    <tr>
                        <td><?= $user['nome'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['nome_distrito'] ?></td>
                        <td><?= $user['nome_concelho'] ?></td>
                        <td><?= $user['nome_freguesia'] ?></td>
                        <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>


                    </tr>
                <?php endif;?>
            <?php endforeach; ?>
            </table>


             <?php elseif($_POST['tipo']== RADIO_INSTITUTO): ?>




                <tr class="thead-dark">
                    <th>Nome Instituição</th>
                    <th>Tipo Instituição</th>
                    <th>Email </th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Perfil</th>
                </tr>
                 <?php foreach($result as $user ): ?>
                     <?php if(count($user) > 0): ?>

                         <tr>
                             <td><?= $user['nome'] ?></td>
                             <td><?= $user['tipo_inst'] ?></td>
                             <td><?= $user['email'] ?></td>
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




         <?php endif;?>
<?php endif;?>
    <?php endif;?>
</article>
</body>





