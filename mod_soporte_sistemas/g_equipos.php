
<?php 
include("../conf.php");
$id_equipo=$_POST["id_equipo"];
$codigo=$_POST["codigo"];
$nombre=$_POST["nombre"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$serie=$_POST["serie"];
$IUequipo=$_POST["IUequipo"];
$estado=$_POST["estado"];
$fecharegistro=$_POST["fecharegistro"];
$propiedad=$_POST["propiedad"];
$especificaciones=$_POST["especificaciones"];
$otros=$_POST["otros"];

if($codigo<>"" and $nombre<>"" and $estado<>"")
{
$sql=mysql_query("insert into m5sts_equipos (
id_equipo,
codigoactivo,
nombre,
marca,
modelo,
serie,
IUequipo,
estado,
fecha_registro,
propietario,
especificaciones,
otros) values (
'$id_equipo',
'$codigo',
'$nombre',
'$marca',
'$modelo',
'$serie',
'$IUequipo',
'$estado',
'$fecharegistro',
'$propiedad',
'$especificaciones',
'$otros') 
ON DUPLICATE KEY UPDATE 
codigoactivo='$codigo',
nombre='$nombre',
marca='$marca',
modelo='$modelo',
serie='$serie',
IUequipo='$IUequipo',
estado='$estado',
fecha_registro='$fecharegistro',
propietario='$propiedad',
especificaciones='$especificaciones',
otros='$otros'",$conectar) or die ("ERROR_1");

//echo "SE HA GUARDADO CORRECTAMENTE";


echo "<script type='text/javascript'>
						js_general_guardados('mod_soporte_sistemas/sub_equipos_computo','','$tiempo_cookie');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
?>
<div class="ventanas" id="nuevo" style="width:600px">
<h3 id="<?php echo $colorfondo?>"align="center">Guardar</h3>
<div align="center" style="margin-top:20px; text-align:center">Se ha guardado correctamente.<br>
<br>
<img src="imag/loading.gif" height="55" width="58">
</div>

</div>

</div>
<?php 
}
else
{
	echo "No se registro actividad previa";
	echo "<script type='text/javascript'>
						js_general_guardados('mod_soporte_sistemas/sub_equipos_computo','','$tiempo_cookie');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
}
?>