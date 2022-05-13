<?php
/**
 * @param $id
 * @return mixed
 */
function getDistritoNomeById($id)
{
    $query = "SELECT nome FROM Distrito  WHERE Distrito.cod_distrito = '{$id}'";
    $result = getOneResultQuery($query);
    return $result['nome'];
}

/**
 * @param $idConcelho
 * @param $idFreguesia
 * @return mixed
 */
function getFreguesiaNomeById($idConcelho,$idFreguesia)
{
    $query = "SELECT nome FROM Freguesia  WHERE Freguesia.cod_freguesia = '{$idFreguesia}' AND Freguesia.cod_concelho = '{$idConcelho}' ";
    $result = getOneResultQuery($query);
    $nome = $result['nome'];
    return $nome;
}
function getConcelhosNomeById($idDistrito,$idConcelho)
{
    $query = "SELECT nome FROM Concelho  WHERE Concelho.cod_concelho = '{$idConcelho}' AND Concelho.cod_distrito = '{$idDistrito}' ";

    $result = getOneResultQuery($query);
    return $result['nome'];
}
function RegisterVoluntario($dados)
{
    $conn = getConnection();

    $queryUser = "INSERT INTO Utilizador (email, tipo, telefone, pass, nome, codigo_distrito, codigo_concelho, codigo_freguesia) ";
    $queryUser .= " VALUES ( \"{$dados['email']}\" , \"Voluntario\" ,
                                {$dados['tel']} , '{$dados['password']}' , \"{$dados['nome']}\" , 
                                {$dados['cod_distrito']} , {$dados['cod_concelho']}, {$dados['cod_freguesia']}); ";

    $queryVoluntario ="INSERT INTO Voluntario (id_U ,cc, carta_conducao, genero, dob,imgPath)";
    $queryVoluntario .=  "VALUES (LAST_INSERT_ID(), \"{$dados['cc']}\" ,  \"{$dados['Cconducao']}\" ,   \"{$dados['genero']}\" ,   \"{$dados['dob']}\",   \"{$dados['imgPath']}\"  );";

    $result = mysqli_query($conn,  $queryUser);
    $result2 = mysqli_query($conn, $queryVoluntario);
    $sucess =false;
    if ($result && $result2) {
        echo "Um novo registo inserido com sucesso";

        $sucess = true;

    } else {
        echo "Erro: insert failed" . $queryUser . "<br>" . mysqli_error($conn);

    }
    // mysqli_free_result($result2);
    mysqli_close($conn);
    return   $sucess ;
}   // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE


function RegisterInstitution($dados)
{
    $conn = getConnection();
    $queryUser = "INSERT INTO Utilizador (email, tipo, telefone, pass, nome, codigo_distrito, codigo_concelho, codigo_freguesia,nome_distrito,nome_concelho,nome_freguesia) ";
    $queryUser .= " VALUES ( \"{$dados['email']}\" , \"Instituto\" , {$dados['tel']} , '{$dados['password']}' ,
                            \"{$dados['nome']}\" , {$dados['cod_distrito']} , {$dados['cod_concelho']}, {$dados['cod_freguesia']}); ";
    $queryInst = "INSERT INTO Instituicao (id_U, 	tipo_inst, descricao, morada, n_contacto, nome_contacto)";
    $queryInst .= "VALUES ( LAST_INSERT_ID(), \"{$dados['tipo']}\" ,  \"{$dados['description']}\" , \"{$dados['morada']}\" , {$dados['contatoR']} , \"{$dados['nomeR']}\");";


    $result = mysqli_query($conn,  $queryUser);
    $result2 = mysqli_query($conn, $queryInst);
    $sucess =false;
    if ($result && $result2) {
        echo "Um novo registo inserido com sucesso";
        mysqli_close($conn);
        $sucess = True;
        mysqli_free_result($result);
        mysqli_free_result($result2);
    } else {
        echo "Erro: insert failed" . $queryUser . "<br>" . mysqli_error($conn);

    }
    // mysqli_free_result($result2);
    mysqli_close($conn);
    return   $sucess ;
}   // SE OCORREU COM SUCESSO VAMOS TER QUE DEVOLVER UM TRUE OU FALSE


function uploadPhoto($path){

    $target_dir = SITE_ROOT ."/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


}


?>