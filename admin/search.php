<<<<<<< HEAD
<?php
//if(checkLogin()==Null){ 
//header('Location: index.php');
//exit();
//}
$user = array();
?>

    
=======

<?php 
$data= array();
if(!isLoggedIn()){ 
  header( "Location: /asw/admin/index.php?page=login" );
}
if(isset($_GET['search'])){ 
  
  
    if($_GET['search']==='all'){
    
    $data = getAllUsers();

    }

}else{

    header( "Location: /asw/admin/index.php");
}

print_r($data);
?>






>>>>>>> origin/filipeNovo
<article class="row mt-5">
    <div class="col ml-5">
        
    <h1>Procura</h1>
    <table class="table table-striped table-hover">
<<<<<<< HEAD
=======
      <!--- 
        ?>-->
>>>>>>> origin/filipeNovo
    <tr>
          <td class="table-light">...</td>
    </tr>
    </table>
    </div>
    </article>
<<<<<<< HEAD
</body>
=======
</body>






    
>>>>>>> origin/filipeNovo
