
<?php 
include("../../conf.php");
$validar=$_POST["variable"];
$query=mysql_query("select * from m5sts_us_ad where  nom_usu_ad='$validar' and estado='Activo'",$conectar)or die("ERROR_AL VALIDAR USUARIO");


$resutlado=mysql_num_rows($query);

	if($resutlado>=1)
	{
	echo '<div id="resultadovalip" style="color:rgba(255,0,4,1.00); "><img src="imag/advertencia.png" height="19" width="19" style="vertical-align:middle;" id="okimg"> El Usuario ya se encuentra en uso</div><input type="hidden" value="duplicado" id="valduplicado">';
	}
	else
	{
	echo '<img src="imag/s_success.png" height="16" width="16" style="vertical-align:middle;" id="okimg"><input type="hidden" value="" id="valduplicado">';
	
	}
echo '
<script type="text/javascript">

 varduplicado();

 </script>
 ' ;
?>
 