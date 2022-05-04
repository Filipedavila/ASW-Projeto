<?php
date_default_timezone_set('Europe/Lisbon');
$now = date("Y-m-d");
$nowNovo = strtotime($now,' -18 years');
print_r( $nowNovo);

?>