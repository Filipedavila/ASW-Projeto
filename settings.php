<?php
if(checkLogin()==Null){ 
header('Location: index.php');
exit();
}
$user = array();
?>


    <article class="row mt-5">
    <div class="col ml-5">
    <?php if(checkLogin()==="Instituto") : ?>
    

      <?php endif?>
      <?php if(checkLogin()==="Voluntario") : ?>



      <?php endif?>
 
    <?php if(checkLogin()==NULL) : ?>

    <?php endif?>

    </article>
</body>
