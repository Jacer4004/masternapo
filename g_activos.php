
<?php 
include("conf.php");
$codigo=$_POST["codigo"];
$nombre=$_POST["nombre"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$serie=$_POST["serie"];
$estado=$_POST["estado"];
$fecharegistro=$_POST["fecharegistro"];
$procedencia=$_POST["procedencia"];
$otros=$_POST["otros"];

$sql=mysql_query("insert into ac_equipos (id_ac_equipos, codigoactivo, nombre, marca, modelo, serie, estado, fecha_registro, procedencia, otros) values ('null', '$codigo', '$nombre', '$marca', '$modelo', '$serie', '$estado', '$fecharegistro', '$procedencia', '$otros') 
ON DUPLICATE KEY UPDATE codigoactivo='$codigo', nombre='$nombre', marca='$marca', modelo='$modelo', serie='$serie', estado='$estado', fecha_registro='$fecharegistro', procedencia='$procedencia', otros='$otros'",$conectar) or die ("ERROR_");

echo "SE HA GUARDADO CORRECTAMENTE";
/*echo "<script type='text/javascript'>
						js_general('pag_activos','');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";*/
?>
<div><h3>Guardado</h3>
</div>
