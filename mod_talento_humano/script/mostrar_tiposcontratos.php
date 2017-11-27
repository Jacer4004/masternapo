<?php 
include_once("../../conf.php");
$activate=$_POST["activate"];
if($activate==true)
{ 
	$idprincipal=trim($_POST["idprincipal"]);
	$nombre= trim($_POST["nombre"]);
	$otros= trim($_POST["otros"]);
	
	$nuevo_ingreso=mysql_query("select * from gad_tipocontrato where nom_tipocontrato='$nombre'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	
	if(mysql_num_rows($nuevo_ingreso)>0 and $_POST['idprincipal']=="")
	{
		$_GET['avisomensaje']='Ya existe un registro con este nombre';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include_once("../../ventanas_avisos.php");
	}
	else
	{
			
		$mysqlinsert=mysql_query("
		insert into gad_tipocontrato
		 (id_tipocontrato,
			nom_tipocontrato,
			descripcion_tipoc
		 )values
		 (
		 '$idprincipal',
		 '$nombre',
		 '$otros'
		 )ON DUPLICATE KEY UPDATE
		 nom_tipocontrato='$nombre',
			descripcion_tipoc='$otros'")or die("Error: ".mysql_error());
		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include_once("../../ventanas_avisos.php");
	}
	
}
else
	{
	#	echo "Solo muestra";
	}
?>

<div style="height:300px; overflow-y:scroll; overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" >
<table border="0" cellspacing="0" cellpadding="0" class="tabla1" width="100%" align="center">
<thead>
  <tr>
    <th width="10">&nbsp;</th>
    <th width="20" align="center"><strong>#</strong></th>
    <th align="center"><strong>TIPO DE CONTRATO</strong></th>
    <th>OBSERVACIONES</th>
    
  </tr>
  </thead>
  <tbody>
  <?php 
	$querycargo=mysql_query("select concat_ws('.*.',id_tipocontrato,nom_tipocontrato,descripcion_tipoc) as todos,gad_tipocontrato.* from  gad_tipocontrato", $conectar)or die("Error_".mysql_error());
	
	while($regcargo=mysql_fetch_array($querycargo))
	{
	?>
  <tr>
  	<td><a href="javascript:void()" onClick="pasardep('<?=$regcargo["todos"];?>')" class="btn_azul"><img src="imag/editarbtn.png" style="vertical-align:middle"></a></td>
    <td align="center" valign="middle"><?=$regcargo["id_tipocontrato"]?></td>
    <td><?=$regcargo["nom_tipocontrato"]?></td>
    <td><?=$regcargo["descripcion_tipoc"]?></td>
    
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
	cambiar_vetana('#frmnuevocontrat','#contenidosinternoscontrat')
	var string = valores_dep;
	var array = string.split(".*.");
	$('#idprincipal').val(array[0]);
	$('#nombre').val(array[1]);
	$('#otros').val(array[2]);	
}
</script>

