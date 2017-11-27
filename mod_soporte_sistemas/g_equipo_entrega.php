
<?php 
include("../conf.php");

$id_ent_equi=$_POST["el_id"];
$dependenciaee=$_POST["dependencia"];
$id_personal=$_POST["usuarios_area"];
$denominacion=$_POST["denominacion"];
$dir_ip=$_POST["dir_ip"];
$us_ad=$_POST["us_ad"];
$fecha_entrega=$_POST["fechaentrega"];
#$fecha_devolucion=$_POST["&"];
$obs_devolucion="";#$_POST["&"];

#####comoponetes del sofware###########arrays paralelos
$softwaresw=implode("<>",$_POST["g_sw"]);
##$softwaredes=$_POST["g_swdes"];


############componentes de hardware###########arrays paralelos
$g_codigoequipo=$_POST["id_equipoid"];
#############

$estadoee=$_POST["estado"];
$otros=$_POST["otros2"];
$fecha_devolucion="";

if($dependenciaee<>""and $id_personal<>"")
{
	//*** iniciar la Transaccion ***//  
/*mysql_query("BEGIN"); */

$sql=mysql_query("insert into m5sts_entrega_equipos (
id_ent_equi,
dependenciaee,
id_personal,
denominacion,
dir_ip,
us_ad,
fecha_entrega,
fecha_devolucion,
obs_devolucion,
software,
estadoee,
otros) values (
'$id_ent_equi',
'$dependenciaee',
'$id_personal',
'$denominacion',
'$dir_ip',
'$us_ad',
'$fecha_entrega',
'$fecha_devolucion',
'$obs_devolucion',
'$softwaresw',
'$estadoee',
'$otros') 
",$conectar) or die ("ERROR_");

###guardar los componentes
$id_ent_equi=mysql_insert_id();

for($i=0;$i<count($g_codigoequipo);$i++)
{
	
	$id_componente_e=$g_codigoequipo[$i];
	
	$sqlcomponentes=mysql_query("
	insert into m5sts_e_e_componentes (
	id_ee_componetes,
	id_ent_equi,
	id_equipo,
	fecha_entrega
	)values
	(
	'null',
	'$id_ent_equi',
	'$id_componente_e',
	'$fecha_entrega'
	)
	",$conectar);	
}

/*
if(($sql) and ($sqlcomponentes) and (count($g_codigoequipo)>0))  
{
	// Commit Transaction //  
	mysql_query("COMMIT");  
*/
//echo "SE HA GUARDADO CORRECTAMENTE";


echo "<script type='text/javascript'>
						js_general_guardados('mod_soporte_sistemas/sub_equipos_computo_entrega','','$tiempo_cookie');
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
<img src="imag/loading.gif" height="35" width="38">
</div>

</div>

</div>
<?php 
/*}
else  
{  
 
mysql_query("ROLLBACK");  
echo "Error al guardar".count($g_codigoequipo);  
}*/  
mysql_close($conectar); 


}
else
{
	echo "<script type='text/javascript'>
						js_general_guardados('home','','$tiempo_cookie');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
}
?>