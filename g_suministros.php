
<?php 
include_once("conf.php");
$codigo=$_POST["codigo"];
$nombre=$_POST["nombre"];
$marca=$_POST["marca"];
$cantidad=$_POST["cantidad"];
$vunitario=$_POST["vunitario"];
$vtotal=$_POST["vtotal"];
$presentacion=$_POST["presentacion"];
$fecharegistro=$_POST["fecharegistro"];
$fechacompra=$_POST["fechacompra"];
$otros=$_POST["otros"];

$sql=mysql_query("insert into inv_suministros (
id_invsuministros,
suministro,
cod_bodega,
cantidad,
stock,
val_uni,
val_total,
marca,
presentacion,
fecharegistro,
fechaadquisicion,
otros) values ('null','$nombre', '$codigo',  '$cantidad', '$cantidad', '$vunitario', '$vtotal', '$marca', '$presentacion', '$fecharegistro','$fechacompra','$otros') 
ON DUPLICATE KEY UPDATE 
suministro='$nombre',
cod_bodega='$codigo',
cantidad='$cantidad',
stock='$cantidad',
val_uni='$vunitario',
val_total='$vtotal',
marca='$marca',
presentacion='$presentacion',
fecharegistro='$fecharegistro',
fechaadquisicion='$fechacompra',
otros='$otros'",$conectar) or die ("ERROR_");

//echo "SE HA GUARDADO CORRECTAMENTE";
echo "<script type='text/javascript'>
						js_general_guardados('pag_suministros','','$tiempo_cookie');
						function redireccionar(){
		  window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
?>
<div class="ventanas" id="nuevo" style="width:600px">
<h3 id="<?php echo $colorfondo?>"align="center">Guardar</h3>
<div align="center" style="margin-top:20px; text-align:center">Se ha guardado correctamente.<br>
<br>
<img src="imag/loading.gif" height="70" width="69">
</div>

</div>

</div>
