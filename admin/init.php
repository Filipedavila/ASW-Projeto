<?php
//Inicia todas as opções essenciais e opcionais do website
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Lisbon');
include  '../init.php';

include ADMIN_ROOT . '/resources/auth.php';
include ADMIN_ROOT . '/resources/search.php';



