
<?php 
include("../conf.php");
$ussactu=$_POST["ussactu"];
$dir_domicilio_gp=$_POST["dirdomicilio"];
$correo_per_gp=$_POST["correopersonal"];
$movil_per_gp=$_POST["movil1"].":".$_POST["movil2"].":".$_POST["movil3"];
$telfcasa_gp=$_POST["telfcasa"];


$query=mysql_query("UPDATE gad_personal SET 
dir_domicilio_gp= '$dir_domicilio_gp', 
correo_per_gp='$correo_per_gp',
movil_per_gp='$movil_per_gp',
telfcasa_gp='$telfcasa_gp'
WHERE id_personal = '$ussactu'",$conectar)or die("ERROR_EN_UPDATE");


 /*   	
if(!$query){

	
/*}
else
{
	echo "Se ha producido un error y no se ha guardado";
}

echo '';
	echo 'Se ha gurdado correctamente';
	
*/

?>
<div id="mensajeok" class="confirmacion_guardado">
<img src="imag/s_success.png">
Se ha guardado sus datos correctamente.
</div>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $("#mensajeok").fadeOut(1500);
    },4000);
});

</script>
