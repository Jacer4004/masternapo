
<?php 
include("conf.php");

$id_personal=$_POST["id_personal"];
$apellidos=$_POST["apellidos"];
$nombres=$_POST["nombres"];
$cedula=$_POST["cedula"];
$area_personal=$_POST["area_personal"];
$correo_personal=$_POST["correo"];
$observaciones=$_POST["observaciones"];
$tratamiento=$_POST["tratamiento"];
$genero=$_POST["genero"];
$cargo=$_POST["cargo"];


$sql=mysql_query("insert into gad_personal (
id_personal,
id_dependencia,
nombres,
apellidos,
cedula,
correo,
observaciones,
puesto,
tratamiento,
genero) values (
'$id_personal',
'$area_personal',
'$nombres',
'$apellidos',
'$cedula',
'$correo_personal',
'$observaciones',
'$cargo',
'$tratamiento',
'$genero') 
ON DUPLICATE KEY UPDATE 
id_dependencia='$area_personal',
nombres='$nombres',
apellidos='$apellidos',
cedula='$cedula',
correo='$correo_personal',
observaciones='$observaciones',
puesto='$cargo',
tratamiento='$tratamiento',
genero='$genero'",$conectar) or die ("ERROR_");

echo "SE HA GUARDADO CORRECTAMENTE";
echo "<script type='text/javascript'>
						js_general_guardados('pag_personal','','$tiempo_cookie');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
?>

</div>
