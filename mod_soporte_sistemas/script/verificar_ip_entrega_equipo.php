
<?php 
include("../../conf.php");
$ipvalidar=$_POST["variable"];

$query=mysql_query("select m5sts_entrega_equipos.id_ent_equi,m5sts_entrega_equipos.dir_ip,m5sts_ip.* from m5sts_ip
	left join m5sts_entrega_equipos on m5sts_ip.id_ip=m5sts_entrega_equipos.dir_ip
	where m5sts_ip.id_personal='$ipvalidar'",$conectar)or die("ERROR_AL VALIDAR IP");

#$query=mysql_query("select * from m5sts_ip  where id_personal='$ipvalidar' ",$conectar)or die("ERROR_AL VALIDAR IP");
$resultado=mysql_num_rows($query);


	/*if($resultado>=1)
	{*/

	echo '<option value="">.: Seleccione :.</option>';     	
while($reg_ip= mysql_fetch_array($query))
	{
		if($reg_ip["estado_ip"]=="Inactivo" or $reg_ip["dir_ip"]==$reg_ip["id_ip"]){$estadoip="Disabled";$inactivo="-[No disponible]";}else{$estadoip="";$inactivo="";}
		echo '<option '.$estadoip.' value="'.$reg_ip["id_ip"].'">'.$reg_ip["ip"].$inactivo.'</option>';
	}
/*	}
	else
	{
	echo '<option value="">.: No existe IP :.</option>';
	
	}*/

?>
