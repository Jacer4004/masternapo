<?php
session_start();
#GRABA SESION
#$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
#include("val_sesiones.php");


#CONFIGURACINES DEL CONEXIONES AL SEVIDOR 
/*$servidor="localhost:3306";
$usuario_servidor="us_gadpnapo";
$pass_servidor="6fSQgA1t7LbpaBQ3";
$bd_servidor="gadpnapo";
*/
$servidor="localhost:3306";
$usuario_servidor="MySQL";
$pass_servidor="admin";
$bd_servidor="test";

$correoprincipal="jrojas@napo.gob.ec"; #para envios de administrador del sistema tales como recuperar contraseña
$tiempoexpira='+60 day'; #tiempo fijado para expirar la contraseña

$conectar=mysql_connect($servidor,$usuario_servidor,$pass_servidor);
mysql_select_db($bd_servidor, $conectar);
mysql_query("SET NAMES 'utf8'");

#establece fecha en español
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

#establece zona horaria
date_default_timezone_set('America/Guayaquil');

require_once("val_sesiones.php");

#CONEXION CON QUIPUX
// Conectando y seleccionado la base de datos  
#$dbconn = pg_connect("host=quipux.napo.gob.ec dbname=quipux user=postgres password=postgres port=5432")
 #   or die('No se ha podido conectar: ' . pg_last_error());
 
 #permite utfo iso
# header('Content-Type: text/html; charset=ISO-8859-15');
 header("Content-type: text/html; charset=utf-8");
 function mysql_escape($cadena) {
    
        $cadena = stripslashes($cadena);
    	$cadena= str_replace ( array("^","%","#"), "" , $cadena);
    return addslashes($cadena);
 }
?>