<?php 
include("../conf.php");
	$id =$_POST["variable"];
	//echo "id del curso es".$id;
	
$sql_asig="select * from gad_personal where gad_personal.id_dependencia='$id'";
	
$res_cu=mysql_query($sql_asig,$conectar)or die("NO SE PUDO CONSULTAR A LA BASE DE DATOS /n==>".mysql_error());
 

$total=$reg_cu["stock"];
echo '<option value="">.: Seleccione :.</option>';     	
while($reg_cu= mysql_fetch_array($res_cu))
	{
		echo '<option value="'.$reg_cu["id_personal"].'">'.$reg_cu["tratamiento"]." ".$reg_cu["nombres"]." ".$reg_cu["apellidos"].'</option>';
	}
	
?>