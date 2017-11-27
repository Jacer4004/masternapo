
<?php 
include("../../conf.php");
$validar=$_POST["variable"];

$query=mysql_query("select m5sts_entrega_equipos.id_ent_equi,m5sts_entrega_equipos.us_ad,m5sts_us_ad.* from m5sts_us_ad
left join m5sts_entrega_equipos on m5sts_us_ad.id_us_ad=m5sts_entrega_equipos.us_ad
where m5sts_us_ad.id_personal='$validar'",$conectar)or die("ERROR_AL VALIDAR USUARIOS");

#$query=mysql_query("select * from m5sts_us_ad  where id_personal='$validar' ",$conectar)or die("ERROR_AL VALIDAR IP");
#$resultado=mysql_num_rows($query);

	/*if($resultado>=1)
	{*/

	echo '<option value="">.: Seleccione :.</option>';     	
while($reg_ip= mysql_fetch_array($query))
	{
		if($reg_ip["estado"]=="Inactivo" or $reg_ip["us_ad"]==$reg_ip["id_us_ad"] ){$estadoip="Disabled";$inactivo="-[No disponible]";}else{$estadoip="";$inactivo="";}
		echo '<option '.$estadoip.' value="'.$reg_ip["id_us_ad"].'">'.$reg_ip["nom_usu_ad"].$inactivo.'</option>';
	}
/*	}
	else
	{
	echo '<option value="">.: No existe IP :.</option>';
	
	}*/

?>