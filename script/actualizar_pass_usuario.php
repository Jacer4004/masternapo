
<?php 
include("../conf.php");
$valuser=$_POST["variable"];
$valpass=$_POST["variable2"];

$query=mysql_query("UPDATE gad_usuarios SET contrasena= '$valpass' WHERE id_personal = '$valuser';",$conectar)or die("ERROR_EN_UPDATE");
 /*   	
if(!$query){

	
/*}
else
{
	echo "Se ha producido un error y no se ha guardado";
}

echo '<img src="imag/s_success.png">';
	echo 'Se ha gurdado correctamente, los cambios se daran al volver a ingresar';*/

echo '
<div id="mensajeok" class="confirmacion_guardado">
<img src="imag/s_success.png">
Se ha guardado correctamente, se cerrara la sesion para que los cambios surtan efectos.
</div>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $("#mensajeok").fadeOut(1500);
    },4000);
	
	setTimeout(function() {
        window.location="login.php";
    },2000);
	
	
});

</script>
';

?>
