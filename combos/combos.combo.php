<?php 
include("../conf.php");
	$id =$_POST["variable"];

switch($id)
{
	case "dependecnias":
	$sql_cbo=mysql_query("select * from  gad_dependencia order by nombre",$conectar)or die("NO SE PUDO CONSULTAR A LA BASE DE DATOS /n==>".mysql_error());
	echo '<option value="">.: Seleccione :.</option>';     	
while($reg_istro= mysql_fetch_array($sql_cbo))
	{
		echo '<option value="'.$reg_istro["id_dependencia"].'">'.$reg_istro["nombre"].'</option>';
	}
	exit;
	break;	
}

	 

	
?>