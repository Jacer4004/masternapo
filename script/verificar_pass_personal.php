
<?php 
include("../conf.php");
$valuser=$_POST["variable"];
$valpass=$_POST["variable2"];

$query=mysql_query("select * from gad_usuarios  where id_personal='$valuser' and  contrasena='$valpass'",$conectar)or die("ERROR_AL VALIDAR");
    	
$reg_total= mysql_num_rows($query);
if($reg_total==1)
{
	echo '<img src="imag/s_success.png">';
	echo '<input type="hidden" name="ok_useract" id="ok_useract" value="suse">
	';
}
else
{
	echo "La contraseña actual no es correcta";
	echo '<input type="hidden" name="ok_useract" id="ok_useract" value="no">
	';
}


?>


</script>