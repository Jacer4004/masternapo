 <?php 
include_once("../conf.php");

$perslid=$_REQUEST["personalcargado"];

$sqlacademia=mysql_query("select * from gad_personal where id_personal='$perslid'",$conectar);
$regpersacademia=mysql_fetch_array($sqlacademia);

?>

<div class="ventanas" id="personal_academicos" style="display:; text-align:justify !important">
<h3> <a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('principalsecundarios','principalpersonal');" ><span>Regresar</span><img src="imag/atras_vt.png"></a>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('tituloscontenidos','nuevotitulo'); Reset_fomulario('nuevotitulo');$('#id_academico').val('');"><span>Registrar Nuevo</span><img style="" src="imag/new_vt.png"></a>
&nbsp;&nbsp;&nbsp;
 <span id="titlosinternosper">Estructura Familiar: <?php echo $regpersacademia["tratamiento"]." ".$regpersacademia["nombres"]." ".$regpersacademia["apellidos"]?> </span> </h3>

<div id="titulos_academicos">

<?php include("mostrar_familiares.php"); ?>

</div>
</div>
