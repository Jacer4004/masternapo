<?php

#CONFIGURACINES DEL CONEXIONES AL SEVIDOR 
$servidor="localhost:3306";
$usuario_servidor="us_gadpnapo";
$pass_servidor="6fSQgA1t7LbpaBQ3";
$bd_servidor="gadpnapo";

$conectar=mysql_connect($servidor,$usuario_servidor,$pass_servidor);
mysql_select_db($bd_servidor, $conectar);
mysql_query("SET NAMES 'utf8'");
?>