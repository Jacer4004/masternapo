<?php 

include("../conf.php");
$id_ip=$_POST["id_ip"];
$dependencia=$_POST["dependencia"];
$id_personal=$_POST["usuarios_area"];
$ugeografica=$_POST["ugeografica"];
$dispositivo=$_POST["dispositivo"];
$ip=$_POST["direccionip"];
$mascara=$_POST["mascara"];
$gateway=$_POST["gateway"];
$dnsprimario=$_POST["dns1"];
$dnssecundario=$_POST["dns2"];
$f_creacion_ip=$_POST["fecharegistro"];
$estado_ip=$_POST["estado"];
$historial_ip=$_POST["otros"];

$hostname=strtoupper($_POST["hostname"]);

if($ip<>"")
{	
	if($estado_ip=="Inactivo")
	{
		$f_inactivo_ip=date("Y-m-d");
	}
	else
	{
		$f_inactivo_ip="";
	}
	#$f_inactivo_ip=$_POST["fechainactivo"];
	#dependencia
	$querydependencia=mysql_query("select * from gad_dependencia where id_dependencia='$dependencia'",$conectar) or die("ERROR_");
	$regdependencia=mysql_fetch_array($querydependencia);
	$dependencia=$regdependencia["nombre"];
	
	#VERIFICACION DE CAMBIOS EFECTUADOS APRA CONTROL DE CAMBIOS E HISTORIAL DE CAMBIOS
	$time = time();
	$fechahora= date("Y-m-d [H:i:s]", $time);
	$id_login=$_SESSION['userid'];
	$default=$id_login.")*".$fechahora;
		
	if($id_ip<>"")
	{
		$queryctrlcambios=mysql_query("select * from m5sts_ip where id_ip='$id_ip'",$conectar) or die ("Error al buscar para control de cambios");
		
		$regcrtl=mysql_fetch_array($queryctrlcambios);	
		
		#$historialdb=explode(")*(",$regcrtl["historial_dir_ip"]);
			
		#if($regcrtl["dependencia"]<>$dependencia){$historialdb=$historialdb."*(".$regcrtl["dependencia"].")#(".$dependencia;}
		#if($regcrtl["id_personal"]<>$id_personal){$historialdb=$historialdb."*(".$regcrtl["id_personal"].")#(".$id_personal;}
		if($regcrtl["ugeografica"]<>$ugeografica){$historialdb=$historialdb."*(".$regcrtl["ugeografica"].")#(".$ugeografica;}
		if($regcrtl["ip"]<>$ip){$historialdb=$historialdb."*(".$regcrtl["ip"].")#(".$ip;}
		if($regcrtl["mascara"]<>$mascara){$historialdb=$historialdb."*(".$regcrtl["mascara"].")#(".$mascara;}
		if($regcrtl["gateway"]<>$gateway){$historialdb=$historialdb."*(".$regcrtl["gateway"].")#(".$gateway;}
		if($regcrtl["dnsprimario"]<>$dnsprimario){$historialdb=$historialdb."*(".$regcrtl["dnsprimario"].")#(".$dnsprimario;}
		if($regcrtl["dnssecundario"]<>$dnssecundario){$historialdb=$historialdb."*(".$regcrtl["dnssecundario"].")#(".$dnssecundario;}
		if($regcrtl["f_creacion_ip"]<>$f_creacion_ip){$historialdb=$historialdb."*(".$regcrtl["f_creacion_ip"].")#(".$f_creacion_ip;}
		if($regcrtl["estado_ip"]<>$estado_ip){$historialdb=$historialdb."*(".$regcrtl["estado_ip"].")#(".$estado_ip;}
		if($regcrtl["f_inactivo_ip"]<>$f_inactivo_ip and $regcrtl["f_inactivo_ip"]<>"0000-00-00"){$historialdb=$historialdb."*(".$regcrtl["f_inactivo_ip"].")#(".$f_inactivo_ip;}
		if($regcrtl["historial_ip"]<>$historial_ip){$historialdb=$historialdb."*(".$regcrtl["historial_ip"].")#(".$historial_ip;}
		
		if($historialdb<>"")
		{
			$default=$default.$historialdb;
			$default=$regcrtl["historial_dir_ip"].")+".$default;
		}else
		{
			$default=$regcrtl["historial_dir_ip"];
		}
	}
	else
	{
		$default=$default.")+ Creación del Registro";
	}
	####HASTA AQUI VERIFICA CTRL DE CAMBIO#####
	
	
	
	$sql=mysql_query("insert into m5sts_ip (
	id_ip,
	dependencia,
	id_personal,
	ugeografica,
	dispositivo,
	ip,
	mascara,
	gateway,
	dnsprimario,
	dnssecundario,
	f_creacion_ip,
	estado_ip,
	f_inactivo_ip,
	historial_ip,
	hostname) values (
	'$id_ip',
	'$dependencia',
	'$id_personal',
	'$ugeografica',
	'$dispositivo',
	'$ip',
	'$mascara',
	'$gateway',
	'$dnsprimario',
	'$dnssecundario',
	'$f_creacion_ip',
	'$estado_ip',
	'$f_inactivo_ip',
	'$historial_ip',
	'$hostname') 
	ON DUPLICATE KEY UPDATE 
	ugeografica='$ugeografica',
	dispositivo='$dispositivo',
	ip='$ip',
	mascara='$mascara',
	gateway='$gateway',
	dnsprimario='$dnsprimario',
	dnssecundario='$dnssecundario',
	f_creacion_ip='$f_creacion_ip',
	estado_ip='$estado_ip',
	f_inactivo_ip='$f_inactivo_ip',
	historial_ip='$historial_ip',
	historial_dir_ip='$default',
	hostname='$hostname'",$conectar) or die ("ERROR_");
	
	//echo "SE HA GUARDADO CORRECTAMENTE";
	
	echo "<script type='text/javascript'>
							js_general_guardados('mod_soporte_sistemas/sub_dir_ip','','$tiempo_cookie');
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
	echo "<script type='text/javascript'>
							js_general_guardados('home','','$tiempo_cookie');
							function redireccionar(){
			  window.location='inicio.php';
			} 
			setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
							
			</script>";
}


	?>