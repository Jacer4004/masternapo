<?php 
include("../../conf.php");
	$id =$_POST["variable"];
$id=mysql_real_escape_string($id);

$sql_cbo=mysql_query("select * from th_distributivo_dep where th_distributivo_dep.id_distributivo='$id' order by dependencia_nom",$conectar)or die("NO SE PUDO CONSULTAR A LA BASE DE DATOS /n==>".mysql_error());
	echo '
	<select name="id_distributivo_dep" id="id_distributivo_dep" style="width:270px !important">
	<option value="todos">Todos</option>';     	
while($reg_istro= mysql_fetch_array($sql_cbo))
	{
		echo '<option value="'.$reg_istro["id_distributivo_dep"].'">'.$reg_istro["dependencia_nom"].'</option>';
	}
	echo '</select>';
?>