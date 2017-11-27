<?php 
include("../conf.php");
	$id =$_POST["variable"];
	
$sql_asig="select * from inv_suministros where id_invsuministros='$id'";
	
$res_cu=mysql_query($sql_asig,$conectar)or die("NO SE PUDO CONSULTAR A LA BASE DE DATOS /n==>".mysql_error());
 
$reg_cu= mysql_fetch_array($res_cu);
$total=$reg_cu["stock"];
echo '<option value="">.: Seleccione :.</option>';     	
for($t=1;$t<=$total;$t++)
	{
		echo '<option value="'.$t.'">'.$t.'</option>';
	}
	
?>