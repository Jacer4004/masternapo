<?php 
include("../../conf.php");
$id =$_POST["variable"];
	
	
$querydepadre=mysql_query("select * from th_distributivo_dep where id_distributivo='$id' order by dependencia_nom ")or die("Error: ".mysql_error()) ;	
 	
echo '<option value="">.: Seleccione :. </option>';  	
while($reg_cu= mysql_fetch_array($querydepadre)){
$regok=$reg_cu["dependencia_nom"];
	echo '<option value="'.$reg_cu["nivel_dependencia"].'">'.$regok.'</option>';
	 
	}
	
?>
