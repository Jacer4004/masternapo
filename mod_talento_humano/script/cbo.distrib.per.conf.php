<?php 
include("../../conf.php");
$id_buscado=explode(":",$_POST["variable"]);
$id =$id_buscado[0];
	
	
$querydepadre=mysql_query("select concat_ws(' ',
	gad_personal.tratamiento,
	gad_personal.nombres,
	gad_personal.apellidos)as nomina,
concat_ws('.*.',
th_distributivo_per.id_distributivo_per,
th_distributivo_per.id_personal,
th_distributivo_per.id_distributivo_dep,
th_distributivo_per.mod_contrato,
th_distributivo_per.rol_de_puesto,
th_distributivo_per.denominacion_puesto,
th_distributivo_per.rmu,
th_distributivo_per.partida,
th_distributivo_per.fecha_ing,
th_distributivo_per.fecha_salida,
th_distributivo_per.otros,
gad_personal.nombres,
gad_personal.apellidos)as todos,
 th_distributivo_per.* from th_distributivo_per 
inner join gad_personal on th_distributivo_per.id_personal=gad_personal.id_personal
where th_distributivo_per.id_distributivo_dep='$id'")or die("Error: ".mysql_error()) ;	
 	
echo '<option value="">.: Seleccione :. </option>';  	
while($reg_cu= mysql_fetch_array($querydepadre)){
$regok=$reg_cu["nomina"];
	echo '<option value="'.$reg_cu["id_personal"].':'.$reg_cu["id_distributivo_per"].'">'.$regok.'</option>';
	 
	}
	
?>
