<?php 
include_once("../../conf.php");
$activate=$_POST["activate"];
if($activate==true)
{ 
	$idprincipal=trim($_POST["idprincipal"]);
	$nombre= trim($_POST["nombre"]);
	$nivelestructural=trim($_POST["nivelestructural"]);
	$abreviatura=trim($_POST["abreviatura"]);
	$organicoestructural=trim($_POST["organicoestructural"]);
	$otros= trim($_POST["otros"]);
	$nivel= trim($_POST["area"]);
	
	$nuevo_ingreso=mysql_query("select * from gad_dependencia where nombre='$nombre'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	if((mysql_num_rows($nuevo_ingreso)>0 and $_POST['idprincipal']==""))
	{
		$_GET['avisomensaje']='Ya existe un registro con este nombre';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include_once("../../ventanas_avisos.php");
	}
	else
	{
			
		$mysqlinsert=mysql_query("
		insert into gad_dependencia
		 (id_dependencia,
			nombre,
			abreviatura,
			nivel,
			organico,
			observaciones,
			nivel_estructural
		 )values
		 (
		 '$idprincipal',
		 '$nombre',
		 '$abreviatura',
		 '$nivel',
		 '$organicoestructural',
		 '$otros',
		 '$nivelestructural'
		 )ON DUPLICATE KEY UPDATE
		 nombre='$nombre',
			abreviatura='$abreviatura',
			nivel='$nivel',
			nivel_estructural='$nivelestructural',
			organico='$organicoestructural',
			observaciones='$otros'")or die("Error: ".mysql_error());
		
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
    <th width="20"><strong>COD</strong></th>
    <th><strong>NIVEL ESTRUCTURAL</strong></th>
    <th><strong>DEPENDENCIA</strong></th>
    <th><strong>ESTRUCTURA</strong></th>
    <th>OBSERVACIONES</th>
  </tr>
  </thead>
  <tbody>
  <?php 
	$querycargo=mysql_query("select concat_ws('.*.',id_dependencia,nombre,abreviatura,nivel_estructural,organico,observaciones,nivel) as todos,gad_dependencia.* from  gad_dependencia order by nivel_estructural", $conectar)or die("Error_".mysql_error());
	
	while($regcargo=mysql_fetch_array($querycargo))
	{
	?>
  <tr>
  	<td align="center" ><a href="javascript:void()" onClick="pasardep('<?=$regcargo["todos"];?>')" class="btn_azul"><img src="imag/editarbtn.png" style="vertical-align:middle"></a></td>
    <td align="center" valign="middle"><?=$regcargo["id_dependencia"]?></td>
    <td><?=$regcargo["nivel_estructural"]?></td>
    <td><?=$regcargo["nombre"]." (".$regcargo["abreviatura"].")"?></td>
    <td><?=$regcargo["organico"]?></td>
    <td><?=$regcargo["observaciones"]?></td>
  </tr>
  <?php 
	}
	?>
    </tbody>
</table>
</div>



<!--CARGA LAS DEPENCIAS EN MODO DE ÁRBOL-->
<?php 
include_once("../../conf_mysqli.php");

?>


<link rel="stylesheet" href="dist/themes/default/style.min.css" />

<script src="dist/jstree.min.js"></script>
	
	<script>
	// html demo
	$('#html').jstree();
	// inline data demo
	
	</script>
<br>

<div style="min-height:300px;  overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >
<h4 align="center" style="margin:2px; padding:0px">Estructura tipo Árbol</h4>
<div id="html" class="demo">
		<!--<ul style="margin:0px; padding:0px; list-style:none">
			<li data-jstree='{ "opened" : true }'>0-->
<?php 
//call the recursive function to print category listing
category_tree(0);

//Recursive php function
function category_tree($catid){
global $conn;


$sql = "select * from gad_dependencia where nivel='".$catid."'";
$result = $conn->query($sql) or die(mysql_error());

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0) echo '<ul> ';


 echo '<li>'. $row->nombre;
 
 category_tree($row->id_dependencia);
 
 echo '</li>';
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
?>
</div>
</div>
<!--LA CARGA DE DEPENDENCIAS EN MODO DE ARBOL-->



<script>
function pasardep(valores_dep)
{
	cambiar_vetana('#frmnuevodepen','#contenidosinternosdepen')
	var string = valores_dep;
	var array = string.split(".*.");
	$('#idprincipal').val(array[0]);
	$('#nombre').val(array[1]);
	$('#abreviatura').val(array[2]);
	$('#nivelestructural').val(array[3]);
	//$("#nivelestructural> option[value="+ array[3] +"]").attr("selected",true);
	//$("#organicoestructural>option[value="+ array[4] +"]").attr("selected",true);
	$('#organicoestructural').val(array[4]);
	$('#otros').val(array[5]);
	$('#area').val(array[6]);
	
}
</script>

