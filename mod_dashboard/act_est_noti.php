<?php 
include_once("../conf.php");


$accion=$_POST["estado"]; #echo $accion."<hr>";
	$idnoti=$_POST["id_notis"]; #echo "<".$idnoti."<hr>";
	$flectura=date("Y-m-d H:i:s"); #echo $flectura."<hr>";

if($accion=="Aceptar")
{
	mysql_query("UPDATE gad_notificaciones SET accion= '$accion',f_lectura='$flectura' WHERE id_notificacion='$idnoti'",$conectar) or die("Error");
echo "Acción Realizada con Éxito";

}
else
{
	mysql_query("DELETE FROM gad_notificaciones WHERE id_notificacion='$idnoti'",$conectar) or die("Error");
echo "Acción Realizada con Éxito ";
	
}
?>