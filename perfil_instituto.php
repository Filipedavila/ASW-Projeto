<?php

if(!isLoggedIn() ){
    header('Location: index.php');
    exit();
}
  $data = array();


   if(isset($_GET['id'])){
        $id =$_GET['id'];
        $data = getInstitutionById( $id );
    }



?>

<article  class="form-group  justify-content-center">

    <div class="justify-content-center">



            <!--  verificar se esta em falta o nome -->
            <div class=" row">
                <div class="col">
                  Nome:<?php echo $data[0]['nome'] ?>
                </div>
              
            </div>
            <div class="row">

                <div class="col">
                 Telefone:<?php echo $data[0]['telefone'] ?>
                </div>
            </div>

            <div class="row">
               
                <div class="col">

                    Morada:
                        <?php echo $data[0]['morada'] ?>
                    
                    </div>


            </div>



            <div class="row">
                <div class="col">

                    Nome Responsavel:<?php echo $data[0]['nome_contacto'] ?>


                </div>
                <div class="col">
                   Contacto Responsavel:
                       <?php echo $data[0]['n_contacto'] ?>
                           </div>

            </div>


    </div>


    <div class="row">
        <div class="col">

            <label for="tipo_inst">Tipo de Instituição: <?php echo $data[0]['tipo_inst'] ?>
        </div>

    </div>


    <div class="row">

        <div class="col">

        <div class="callout"> <h1> Descrição </h1> 
        <?php echo $data[0]['descricao'] ?></div>





        </div>
    </div>
    
    </div>
    </div>


    </div>
    </form>



    </div>

</article>