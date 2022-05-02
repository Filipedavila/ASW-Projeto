<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data= array();
if(!isLoggedInAdmin()){
    header( "Location: /asw/admin/index.php?page=login" );
}
const ID_SELECT_DISTRITO = "codigo_distrito";
const ID_SELECT_CONCELHO = "codigo_concelho";
const RADIO_INSTITUTO = "Instituicao";
const RADIO_VOLUNTARIO = "Voluntario";
const ID_SEARCH_OPTIONS = "searchOptions";
const SELECT_DEFAULT_VALUE = "Selecione";
const BTN_SEARCH = "btn_search";
const ID_FORM_ADVANCED_SEARCH = "searchForm";
const FORM_METHOD = "POST";
$dataUtilizador = array();
$dataInstituto = array();
$result=array();
if($_SERVER["REQUEST_METHOD"] == FORM_METHOD){
    // e caso a variavel submit esteja assignada
    if(array_key_exists(BTN_SEARCH,$_POST)){

       if(!empty($_POST[ID_SELECT_DISTRITO])&& $_POST[ID_SELECT_DISTRITO]!== SELECT_DEFAULT_VALUE){
            $dataUtilizador[ID_SELECT_DISTRITO]= htmlspecialchars($_POST[ID_SELECT_DISTRITO]);
           $dataUtilizador[ID_SELECT_DISTRITO]= stripcslashes( $dataUtilizador[ID_SELECT_DISTRITO]);
        }
        if(!empty($_POST[ID_SELECT_CONCELHO])&& $_POST[ID_SELECT_CONCELHO]!== SELECT_DEFAULT_VALUE){
            $dataUtilizador[ID_SELECT_CONCELHO]= htmlspecialchars($_POST[ID_SELECT_CONCELHO]);
            $dataUtilizador[ID_SELECT_CONCELHO]= stripcslashes( $dataUtilizador[ID_SELECT_CONCELHO]);
        }
        if($_POST['tipo']===RADIO_INSTITUTO){

            $result = searchUsuarioByLocal($dataUtilizador, RADIO_INSTITUTO);

        }else if( $_POST['tipo']===RADIO_VOLUNTARIO){

            $result = searchUsuarioByLocal($dataUtilizador, RADIO_VOLUNTARIO);

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
            <h2>Pesquisa por Região</h2>

        </div>
    </div>


      <div class="row">


            <div class="col d-flex justify-content-center">
                <p>Pesquisa por região para institutos ou voluntarios</p>
            </div>
    </div>

    <form action="" method="<?= FORM_METHOD ?>" id="<?= ID_FORM_ADVANCED_SEARCH ?>" >
        <div class="row d-flex justify-content-center">

            <div class="col-auto">

                <label for="dist" class="" >
                    Distrito
                </label>

                <select name="<?= ID_SELECT_DISTRITO ?>"  class="form-control-sm"  id="dist">
                    <option value="<?= SELECT_DEFAULT_VALUE?>" selected> Selecione </option>

                </select>

            </div>

            <div class="col-auto">
                <label for="conc" class="" >
                    Concelho
                </label>
                <select name="<?= ID_SELECT_CONCELHO ?>" class="form-control-sm"  id="conc" >
                    <option value="<?= SELECT_DEFAULT_VALUE?>" selected> Selecione </option>
                </select>

            </div>

        </div>


        <div class="row input-group d-flex justify-content-center">


        <div class="col-sm-3 mt-4">
            <input class="form-check-input" type="radio" name="tipo" id="radioInstituto" value="<?= RADIO_INSTITUTO ?>" checked>
            <label class="form-check-label" for="radioInstituto">
                Instituto
            </label>
        </div>
        <div class="col-sm3 mt-4">
            <input class="form-check-input" type="radio" name="tipo" id="radioVoluntario" value="<?= RADIO_VOLUNTARIO ?>">
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





