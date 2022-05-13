<?php
/*
$teste = date("Y-m-d",strtotime("-10 years"));
*/
$idade['idade_maximoa'] = 20;
$data_maxima = date("Y-m-d", strtotime("-".$idade['idade_maximoa']." years"));
echo $data_maxima;
/*
$date = date_create('2000-01-01');
echo date_format($date, 'Y-m-d H:i:s');
*/

?>