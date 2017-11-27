<?php 
/*$usuario_servidor="us_gadpnapo";
$pass_servidor="6fSQgA1t7LbpaBQ3";
$bd_servidor="gadpnapo";
*/
$servidor="localhost:3306";
$usuario_servidor="MySQL";
$pass_servidor="admin";
$bd_servidor="gadpnapo";
//connect to mysql and select db
$conn = mysqli_connect($servidor, $usuario_servidor, $pass_servidor,$bd_servidor) or die("Error:_".mysqli_error());

mysqli_set_charset($conn,"utf8");

#establece fecha en español
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

#establece zona horaria
date_default_timezone_set('America/Guayaquil');


#CONEXION CON QUIPUX
// Conectando y seleccionado la base de datos  
#$dbconn = pg_connect("host=quipux.napo.gob.ec dbname=quipux user=postgres password=postgres port=5432")
 #   or die('No se ha podido conectar: ' . pg_last_error());
 
 #permite utfo iso
# header('Content-Type: text/html; charset=ISO-8859-15');
 header("Content-type: text/html; charset=utf-8");
 
?>