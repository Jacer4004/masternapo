<?php 

#include("conf.php");
$id_us_ad=$_POST["id_us_ad"];
$dependencia=$_POST["dependencia"];
$id_personal=$_POST["usuarios_area"];
$nom_usu_ad=$_POST["usuario"];
$perfilusuario=$_POST["perfilusuario"];
$contrasenia=$_POST["contrasenia"];
$f_creacion=$_POST["fecharegistro"];
$estado=$_POST["estado"];
#$f_inactivo_us=$_POST["dns1"];
$observaciones=$_POST["otros"];
#$historial_us_ad=$_POST["fecharegistro"];


if($nom_usu_ad<>"")
{	
	if($estado=="Inactivo")
	{
		$f_inactivo_us=date("Y-m-d");
	}
	else
	{
		$f_inactivo_us="";
	}
	#$f_inactivo_ip=$_POST["fechainactivo"];
	#dependencia
	$querydependencia=mysql_query("select * from gad_dependencia where id_dependencia='$dependencia'",$conectar) or die("ERROR_ok").mysql_error();
	$regdependencia=mysql_fetch_array($querydependencia);
	$dependencia=$regdependencia["nombre"];
	
	#VERIFICACION DE CAMBIOS EFECTUADOS APRA CONTROL DE CAMBIOS E HISTORIAL DE CAMBIOS
	$time = time();
	$fechahora= date("Y-m-d [H:i:s]", $time);
	$id_login=$_SESSION['userid'];
	$default=$id_login.")*".$fechahora;
		
	if($id_us_ad<>"")
	{
		$queryctrlcambios=mysql_query("select * from m5sts_us_ad where id_us_ad='$id_us_ad'",$conectar) or die ("Error al buscar para control de cambios");
		
		$regcrtl=mysql_fetch_array($queryctrlcambios);	
		
		#$historialdb=explode(")*(",$regcrtl["historial_dir_ip"]);
			
		#if($regcrtl["dependencia"]<>$dependencia){$historialdb=$historialdb."*(".$regcrtl["dependencia"].")#(".$dependencia;}
		#if($regcrtl["id_personal"]<>$id_personal){$historialdb=$historialdb."*(".$regcrtl["id_personal"].")#(".$id_personal;}
		if($regcrtl["nom_usu_ad"]<>$nom_usu_ad){$historialdb=$historialdb."*(".$regcrtl["nom_usu_ad"].")#(".$nom_usu_ad;}
		if($regcrtl["contrasenia"]<>$contrasenia){$historialdb=$historialdb."*(".$regcrtl["contrasenia"].")#(".$contrasenia;}
		if($regcrtl["f_creacion"]<>$f_creacion){$historialdb=$historialdb."*(".$regcrtl["f_creacion"].")#(".$f_creacion;}
		if($regcrtl["estado"]<>$estado){$historialdb=$historialdb."*(".$regcrtl["estado"].")#(".$estado;}
		if($regcrtl["observaciones"]<>$observaciones){$historialdb=$historialdb."*(".$regcrtl["observaciones"].")#(".$observaciones;}
		
		if($regcrtl["f_inactivo_us"]<>$f_inactivo_ip and $regcrtl["f_inactivo_us"]<>"0000-00-00"){$historialdb=$historialdb."*(".$regcrtl["f_inactivo_us"].")#(".$f_inactivo_us;}
		
		if($historialdb<>"")
		{
			$default=$default.$historialdb;
			$default=$regcrtl["historial_us_ad"].")+".$default;
		}else
		{
			$default=$regcrtl["historial_us_ad"];
		}
	}
	else
	{
		$default=$default.")+ Creación del Registro";
		$id_us_ad="";
	}
	

	####HASTA AQUI VERIFICA CTRL DE CAMBIO#####
		
	$sql=mysql_query("insert into m5sts_us_ad (
	id_us_ad,
	dependencia,
	id_personal,
	nom_usu_ad,
	perfilusuario,
	contrasenia,
	f_creacion,
	estado,
	f_inactivo_us,
	observaciones,
	historial_us_ad) values (
	'$id_us_ad',
	'$dependencia',
	'$id_personal',
	'$nom_usu_ad',
	'$perfilusuario',
	'$contrasenia',
	'$f_creacion',
	'$estado',
	'$f_inactivo_us',
	'$observaciones',
	'$default')
	ON DUPLICATE KEY UPDATE 
	
	nom_usu_ad='$nom_usu_ad',
	perfilusuario='$perfilusuario',
	contrasenia='$contrasenia',
	f_creacion='$f_creacion',
	estado='$estado',
	f_inactivo_us='$f_inactivo_us',
	observaciones='$observaciones',
	historial_us_ad='$default'",$conectar) or die("Error_:".mysql_error()."".mysql_errno());
	
	//echo "SE HA GUARDADO CORRECTAMENTE";
	
	echo "<script type='text/javascript'>
							js_general_guardados('mod_soporte_sistemas/sub_us_ad','','$tiempo_cookie');
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
	echo "<script type='text/javascript'>
							js_general_guardados('home','','$tiempo_cookie');
							function redireccionar(){
			  window.location='inicio.php';
			} 
			setTimeout ('redireccionar()', 1000); 
							
			</script>";
}


	?>