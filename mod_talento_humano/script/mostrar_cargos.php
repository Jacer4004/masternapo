<?php 
include("../../conf.php");
$activate=$_POST["activate"];
if($activate==true)
{ 
	$idprincipal=trim($_POST["idprincipal"]);
	$nombre= trim($_POST["nombre"]);
	$sueldo=trim($_POST["sueldo"]);
	$otros= trim($_POST["otros"]);
	
	$nuevo_ingreso=mysql_query("select * from gad_cargos where cargo='$nombre'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	if(mysql_num_rows($nuevo_ingreso)>0 and $_POST['idprincipal']=="")
	{
		$_GET['avisomensaje']='Ya existe un registro con este nombre';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../../ventanas_avisos.php");
	}
	else
	{
			
		$mysqlinsert=mysql_query("
		insert into gad_cargos
		 (id_cargo, 
		 cargo,
		 sueldo,
		 observaciones
		 )values
		 (
		 '$idprincipal',
		 '$nombre',
		 '$sueldo',
		 '$otros'
		 )ON DUPLICATE KEY UPDATE
		 cargo='$nombre',
		 sueldo='$sueldo',
		 observaciones='$otros'
		")or die("Error: ".mysql_error());
		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../../ventanas_avisos.php");
	}
	
}
else
	{
	#	echo "Solo muestra";
	}
?>


<div style="height:300px; overflow-y:scroll; overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >
<table border="0" cellspacing="0" cellpadding="0" class="tabla1" width="100%" align="center">
<thead>
  <tr>
  	<th width="10">&nbsp;</th>
    <th width="30"><strong>#</strong></th>
    <th width="250"><strong>CARGO</strong></th>
    <th width="10"><strong>REMUNERACIÓN</strong></th>
    <th><strong>DESCRIPCIÓN</strong></th>
    
  </tr>
  </thead>
  <tbody>
  <?php 
	$querycargo=mysql_query("select concat_ws('.*.',id_cargo,cargo,sueldo,observaciones) as todos,gad_cargos.* from  gad_cargos order by cargo ", $conectar)or die("Error_".mysql_error());
	while($regcargo=mysql_fetch_array($querycargo))
	{
	?>
  <tr>
  	<td ><a href="javascript:void()" onClick="pasardep('<?=$regcargo["todos"];?>')" class="btn_azul"><img src="imag/editarbtn.png" style="vertical-align:middle"></a></td>
    <td  align="center" valign="middle"><?=$regcargo["id_cargo"]?></td>
    <td ><?=$regcargo["cargo"]?></td>
    <td align="right" ><?=$regcargo["sueldo"]?></td>
    <td ><?=$regcargo["observaciones"]?></td>
    
  </tr>
  <?php 
	}
	?>
    </tbody>
</table>
</div>
<script>
function pasardep(valores_dep)
{
	
	cambiar_vetana('#frmnuevocargos','#contenidosinternos')
	var string = valores_dep;
var array = string.split(".*.");
$('#idprincipal').val(array[0]);
$('#nombre').val(array[1]);
$('#sueldo').val(array[2]);
$('#otros').val(array[3]);

}
</script>

