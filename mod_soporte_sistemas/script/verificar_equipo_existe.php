
<?php 
include("../../conf.php");
$codigo=$_POST["variablea"];
$tipoequipo=$_POST["variableb"];
$query=mysql_query("select * from m5sts_equipos where  codigoactivo='$codigo' and nombre='$tipoequipo'",$conectar)or die("ERROR_AL VALIDAR EQUIPO");
$resutlado=mysql_num_rows($query);
if($resutlado>=1)
{

	echo 'ESTE EQUIPO YA FUE REGISTRADO ANTERIORMENTE';
	echo "
<script>
alert('Revise las Advertencias');

document.getElementById('nombre').selectedIndex =0;

 </script>
 ";	
	}
	else
	{
	echo '<img src="imag/s_success.png" height="16" width="16" style="vertical-align:middle;" id="okimg"><input type="hidden" value="" id="valduplicado">';

	
}
/**/
?>