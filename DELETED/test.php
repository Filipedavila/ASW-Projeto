<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('SITE_ROOT', dirname(__FILE__));
include SITE_ROOT . "/resources/voluntario/search.php";
include SITE_ROOT . "/functions/dbconnections.php";

$query = "SELECT dia,hora_inicio,hora_fim FROM Disponibilidade  WHERE id_U = '9' ";
$data = getCompatibleInstitutes(9);

print_r($data);


?>