<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './functions/crud.php';
include './functions/dbconnections.php';

$teste =getInstitution(52);

print_r($_SERVER['DOCUMENT_ROOT']);
print_r(dirname(__DIR__));
print_r((__FILE__) );
?>