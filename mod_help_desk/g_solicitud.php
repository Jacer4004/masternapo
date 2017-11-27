<?php 
$id_usuario=$_SESSION['userid'];#usuario actual que asiste
$nuevoreq=$_POST["nuevoreq"];
#include("../conf.php");
$id_incidencia=$_POST["id_incidencia"];
$fech_h_peticion=$_POST["fech_h_peticion"];
$tipoinsidencia=$_POST["tipoinsidente"];
$requiriente=$_POST["requiriente"];
$problema=$_POST["problema"];
$solucion=$_POST["solucion"];
$atendio=$_POST["tomasolicitud"];
$fech_h_iniatencion="";
$fecha_h_finatencion="";
$estado=$_POST["estado"];
$ips_incidencias=$_POST["ips_incidencias"];
$insotros=$_POST["otros"];
$prioridad=$_POST["prioridad"];
$id_usuario_crea=$_SESSION['userid']; #usuario que crea la insidencia

#si no hexiste insidencia
#########################
if($fech_h_peticion<>"")
{
#GENERA NUMERO DE INSIDENCIA
#
#calcula el ultimo numero
$actualnum=mysql_query("SELECT num_insidencia as ultimo FROM gad_incidencias ORDER BY id_incidencia DESC LIMIT 1",$conectar)or die("Error");
$queryultimo=mysql_fetch_array($actualnum);

if($queryultimo["ultimo"]<>"")
{
	$anio_num=explode("-", $queryultimo["ultimo"]);
	if($anio_num[1]==date("Y"))
	{
		$secuencia=$anio_num[2]+1;
		
		$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-".$secuencia;
	}
	else
	{
		$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-1";
	}
}
else
{
	$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-1";
}

#######################fin obtener numero#####

if($atendio=="" or $estado=="PENDIENTE"){$id_usuario="";$fech_h_iniatencion="";}#para verificar si fue tomado por algun usuario la peticion de asistencia
if($estado=="FINALIZADO"){$fecha_h_finatencion=date ("Y-m-j H:i:s");}
if($estado=="FINALIZADO" and $fech_h_iniatencion==""){$fech_h_iniatencion=date ("Y-m-j H:i:s");}
#echo $ips_incidencias."aaaaaaaaaaaa<br>";

mysql_query("insert into gad_incidencias (
	id_incidencia,
	num_insidencia,
tipoinsidencia,
fech_h_peticion,
requiriente,
problema,
solucion,
atendio,
fech_h_iniatencion,
fecha_h_finatencion,
ips_incidencias,
estado,
insotros,
id_usuario,
id_usuario_crea,
prioridad) values (
	'$id_incidencia',
	'$num_insidencia',
	'$tipoinsidencia',
	'$fech_h_peticion',
	'$requiriente',
	'$problema',
	'$solucion',
	'$atendio',
	'$fech_h_iniatencion',
	'$fecha_h_finatencion',
	'$ips_incidencias',
	'$estado',
	'$insotros',
	'$id_usuario',
	'$id_usuario_crea',
	'$prioridad')
	ON DUPLICATE KEY UPDATE 
	problema='$problema',
	solucion='$solucion',
	estado='$estado',
	insotros='$insotros',
	id_usuario='$id_usuario',
	fech_h_iniatencion='$fech_h_iniatencion',
	fecha_h_finatencion='$fecha_h_finatencion',
	atendio='$atendio',
	prioridad='$prioridad'
	 ",$conectar) or die ("ERROR_".mysql_error());
$id=mysql_insert_id();
###GUARDA COMO NOTIFICACION
$usuariosGT=mysql_query("select id_personal from gad_personal where gad_personal.id_dependencia=17 and gad_personal.per_estado='activo'",$conectar);


#si es incidencia nuevo
if($id_incidencia=="")
{
	#UTIMO ID INSERTADO
	
	$titulonotifi="HELP & DESK: ".$tipoinsidencia;
	$obtarr=explode(';',$requiriente);
	$objetivonooti=$obtarr[0].". ".$problema;
	$f_creada=date("Y-m-d H:i:s");
	while($RegusuGT=mysql_fetch_array($usuariosGT))
	{
		$destino= $RegusuGT["id_personal"];
		$id_accion="MHD.".$id;
		mysql_query("INSERT INTO gad_notificaciones(
		id_notificacion,
		id_accion,
		titulo,
		destino ,
		autor,
		objetivo ,
		tipo,
		vista_emergente ,
		f_creada ,
		f_vista,
		f_lectura ,
		accion,
		observaciones)
		VALUES (
		NULL , '$id_accion', '$titulonotifi', '$destino',
		 '$nombres_us', '$objetivonooti', 'helpdesk', '', '$f_creada', '', '', '', ''
		)",$conectar);			
	}
}
	
	#SI LA INCIDENCIA YA FINALIZO SE ELIMINAN LAS NOTIFICAICONES
	if($estado=="FINALIZADO")
	{
		$id_accion="MHD.".$id_incidencia;
		mysql_query("DELETE FROM gad_notificaciones WHERE id_accion = '$id_accion' and accion=''",$conectar)or die("error");	
	}
	//echo "SE HA GUARDADO CORRECTAMENTE";
	
	echo "<script type='text/javascript'>
							js_general_guardados('mod_help_desk/home_help_desk','','$tiempo_cookie');
							function redireccionar(){
			  window.location='inicio.php';
			} 
			setTimeout ('redireccionar()', 1000); 
							
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
}
else
{
	?>
	<div class="ventanas" id="nuevo" style="width:600px">
	<h3 id="<?php echo $colorfondo?>"align="center">Guardar</h3>
	
    <div align="center" style="margin-top:20px;  text-align:center">
    <img src="imag/advertencia.png" style="vertical-align:middle">
    No se guardó, Valores incompletos.<?php echo $tipoinsidencia.">>";?><br>
	<br>
	<img src="imag/loading.gif" height="35" width="38">
	</div>
	
	</div>
	
	</div>
<?php 
echo "<script type='text/javascript'>
							js_general_guardados('mod_help_desk/home_help_desk','','$tiempo_cookie');
							function redireccionar(){
			  window.location='inicio.php';
			} 
			setTimeout ('redireccionar()', 1000); 
							
			</script>";
}
?>