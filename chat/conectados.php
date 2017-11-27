<?php 
include("../conf.php");
$variablechat=$_POST["variablechat"];
$variablemostrar=$_POST["variablemostrar"];



$actual = date("Y-m-j H:i:s");

$nuevafecha = strtotime ( '-1 minute' , strtotime ( $actual ) ) ;
$nuevafechades = date ( 'Y-m-j H:i:s' , $nuevafecha );

$totalconectados=mysql_query("select count(gad_usuarios.usuario)as total from gad_usuarios
where online>='$nuevafechades'",$conectar) or die ("Error".mysql_error()) ;
$regtotalc=mysql_fetch_array($totalconectados);

$nomconectados=mysql_query("select gad_usuarios.*, concat_ws('',gad_personal.nombres,gad_personal.apellidos)as enlinea from gad_usuarios
inner join gad_personal on gad_usuarios.usuario=gad_personal.cedula
where online>='$nuevafechades'",$conectar) or die ("Error".mysql_error()) ;
while($reconectados=mysql_fetch_array($nomconectados))
{
	$daocon[]=$reconectados["enlinea"];
}
$strdatos=implode("<br>", $daocon);

?>
<span style="text-align:left !important"><?php echo "Usuarios conectados: <br>".$strdatos;?></span><img   src="imag/users.png"><sup id=""><?php echo $regtotalc["total"];?></sup>