
<?php 

include("../../conf.php");
$hostvalidar=$_POST["variablehost"];
$query=mysql_query("select * from m5sts_ip where  hostname='$hostvalidar' and estado_ip='Activo'",$conectar)or die("ERROR_AL VALIDAR: ".mysql_error());
$resutlado=mysql_num_rows($query);
$reghost=mysql_fetch_array($query);
if($hostvalidar<>"compu")
{
	if($resutlado>=1)
	{
	echo '<img src="imag/advertencia.png" height="19" width="19" style="vertical-align:middle;" id="okimghost"> Esta nombre de host esta en uso en IP '.$reghost["ip"];
	}
	else
	{
	echo '<img src="imag/s_success.png" height="16" width="16" style="vertical-align:middle;" id="okimghost">';
	
	}
}
else
{
echo '<img src="imag/advertencia.png" height="19" width="19" style="vertical-align:middle;" id="okimghost"> No puede ir nombres predeterminados: '.$hostvalidar;	
}
?>