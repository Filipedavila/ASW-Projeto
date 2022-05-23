<?php

if(!isLoggedIn()){
header('Location: index.php');
exit();
}
const ID_SELECT_DISTRITO = "codigo_distrito";
const ID_SELECT_CONCELHO = "codigo_concelho";
const  ID_SELECT_FREGUESIA ="codigo_freguesia";
const ID_OPTION_TIPO_INSTITUTO = "tipo_inst";
const ID_OPTION_TIPO_DOACAO = "tipo_doacao";
const ID_INPUT_PESQUISA = "input_Search";
const SELECT_DEFAULT_VALUE = "Selecione";
const ID_SEARCH_OPTIONS = "searchOptions";
const BTN_SEARCH = "btn_search";
const ID_FORM_ADVANCED_SEARCH = "searchForm";
const FORM_METHOD = "POST";
$dataUtilizador = array();
$dataInstituto = array();
$result=array();
if($_SERVER["REQUEST_METHOD"] == FORM_METHOD){
    // e caso a variavel submit esteja assignada
    if(array_key_exists(BTN_SEARCH,$_POST)){

       if(!empty($_POST[ID_SELECT_DISTRITO])&& ($_POST[ID_SELECT_DISTRITO]!== SELECT_DEFAULT_VALUE)){
            $dataUtilizador[ID_SELECT_DISTRITO]= htmlspecialchars($_POST[ID_SELECT_DISTRITO]);
           $dataUtilizador[ID_SELECT_DISTRITO]= stripcslashes( $dataUtilizador[ID_SELECT_DISTRITO]);
        }
        if(!empty($_POST[ID_SELECT_CONCELHO])&& ($_POST[ID_SELECT_CONCELHO]!== SELECT_DEFAULT_VALUE)){
            $dataUtilizador[ID_SELECT_CONCELHO]= htmlspecialchars($_POST[ID_SELECT_CONCELHO]);
            $dataUtilizador[ID_SELECT_CONCELHO]= stripcslashes( $dataUtilizador[ID_SELECT_CONCELHO]);
        }
        if(!empty($_POST[ID_SELECT_FREGUESIA]) && $_POST[ID_SELECT_FREGUESIA]!== SELECT_DEFAULT_VALUE ){
            $dataUtilizador[ID_SELECT_FREGUESIA]= htmlspecialchars($_POST[ID_SELECT_FREGUESIA]);
            $dataUtilizador[ID_SELECT_FREGUESIA]= stripcslashes( $dataUtilizador[ID_SELECT_FREGUESIA]);
        }
        if(!empty($_POST[ID_SEARCH_OPTIONS])){
            if($_POST[ID_SEARCH_OPTIONS]=== ID_OPTION_TIPO_INSTITUTO){
              $dataInstituto[ID_OPTION_TIPO_INSTITUTO] = htmlspecialchars($_POST[ID_INPUT_PESQUISA]);
              $dataInstituto[ID_OPTION_TIPO_INSTITUTO]= stripcslashes( $dataInstituto[ID_OPTION_TIPO_INSTITUTO]);

            }else if($_POST[ID_SEARCH_OPTIONS] === ID_OPTION_TIPO_DOACAO){
                $doacao  = htmlspecialchars($_POST[ID_INPUT_PESQUISA]);
                $doacao= stripcslashes( $doacao);

            }

             }






        // se não houve[r erros ou valores vazios
        if(count($dataUtilizador)>0 || count($dataInstituto)>0 || isset($doacao)){


            if(isset($doacao)){
                $result = searchInstitutionsByConditionsAndDonations($dataUtilizador, $doacao);

            }else {
                //para cada valor do pos tratar e adicionar a uma array associativa
                $result = searchInstitutionsByConditions($dataUtilizador, $dataInstituto);

            }

        }


    }

}

echo '<script type="text/javascript">'.
'getDistritos();'.
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
            <h2>Pesquisa Avançada</h2>

        </div>
    </div>


      <div class="row">


            <div class="col d-flex justify-content-center">
                <p>Utiliza esta ferramenta para procurares institutos ao teu critério</p>
            </div>
    </div>

    <form action="" method="<?= FORM_METHOD ?>" id="<?= ID_FORM_ADVANCED_SEARCH ?>" >
        <div class="row d-flex justify-content-center">

            <div class="col-auto">

                <label for="dist" class="" >
                    Distrito
                </label>

                <select name="<?= ID_SELECT_DISTRITO ?>"  class="form-control"  id="dist">
                    <option value="<?= SELECT_DEFAULT_VALUE?>" selected> Selecione </option>

                </select>
            </div>

            <div class="col-auto">
                <label for="conc" class="" >
                    Concelho
                </label>
                <select name="<?= ID_SELECT_CONCELHO ?>" class="form-control"  id="conc" >
                    <option value="<?= SELECT_DEFAULT_VALUE?>" selected> Selecione </option>
                </select>

            </div>
            <div class="col-auto">
                <label for="freg" class="" >
                    Freguesia
                </label>
                <select name="<?= ID_SELECT_FREGUESIA ?>" class="form-control"  id="freg" >
                    <option value="<?= SELECT_DEFAULT_VALUE?>" selected> Selecione </option>
                </select>

            </div>
        </div>

<div class="row">
    <div class="input-group mt-3 mb-3 d-flex justify-content-center">

        <select name="<?= ID_SEARCH_OPTIONS ?>" class="input-group-prepend" id="pesquisa_parametros">
            <option type="button" value="Selecione" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" selected>
                Tipo Pesquisa
            </option>
            <option value="<?= ID_OPTION_TIPO_INSTITUTO ?>" class="form-control" > Tipo de Instituição
            </option>
            <option value="<?= ID_OPTION_TIPO_DOACAO ?>" class="form-control"  > Tipo de Doação
            </option>

        </select>
        <input type="text" name="<?= ID_INPUT_PESQUISA ?>" class="form-control-lg" placeholder="Pesquisa por parametros">

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
                <tr class="thead-dark">
                    <th>Nome Instituição</th>
                    <th>Tipo Instituição</th>
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Perfil</th>
                    <th>chat</th>
                </tr>
                 <?php foreach($result as $user ): ?>
                     <?php if(count($user) > 0): ?>

                         <tr>
                             <td><?= $user['nome'] ?></td>
                             <td><?= $user['tipo_inst'] ?></td>
                             <td><?= $user['nome_distrito'] ?></td>
                             <td><?= $user['nome_concelho'] ?></td>
                             <td><?= $user['nome_freguesia'] ?></td>
                             <td><a href="index.php?page=perfil_instituto&id=<?= $user['id'] ?>"> perfil</a></td>
                             <td><a href="index.php?page=mensagem&chatId=<?= $user['id'] ?>"> enviar msg</a></td>


                         </tr>
                     <?php endif;?>
                 <?php endforeach; ?>
             </table>
     </div>
        </div>




         <?php endif;?>
<?php endif;?>

</article>
</body>





