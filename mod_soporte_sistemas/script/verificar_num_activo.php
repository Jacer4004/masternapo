
<?php 
include("../../conf.php");
$validar=$_POST["variable"];
$personal=$_POST["variable2"];

if($validar=="Personal")
{
$query=mysql_query("select * from m5sts_equipos where propietario='$validar'",$conectar)or die("ERROR_AL VALIDAR");
$resutlado=mysql_num_rows($query);
$secuencia=sprintf('%05d', $resutlado+1);

#año:date ("Y")
#area: SGT: Subdireccion de Gestion Tecnologica 
#tipo de equipo: P-Personal
#nombre presona: ejemplo jr (juan rojas)
#secuancia: ####

echo $personal."-".date ("Y")."-"."SGT-"."PER-".$secuencia;
}
else
{
	echo "";
}
?>
 