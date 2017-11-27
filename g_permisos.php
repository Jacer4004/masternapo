<?php 
include("conf.php");

$permisos=$_POST["perm"];
$usuario=$_POST["user"];

$sqlupdate=mysql_query("update gad_usuarios set acceso='$permisos' where id_personal='$usuario'", $conectar)or die("Error: No se pudo guardar los permisos");

echo "Guardado Correctamente"
?>