<?php 
session_start();
include("../../conf.php");
$idusuario=$_SESSION['userid'];
$id_incidencia=$_REQUEST['id_incidencia'];
$idesde=$_REQUEST['idesde']." 00:00:00";
$ihasta=$_REQUEST['ihasta']." 23:59:59";


if ($_REQUEST['idesde']==""){$idesde="2016-03-01 00:00:00";}
if ($_REQUEST['ihasta']==""){$ihasta=date ("Y-m-j H:i:s");}
#echo $id_incidencia."-".$idesde."-".$ihasta."";

$idusuarioreportaear="%".$_REQUEST["id_usasistente"];

switch($id_incidencia)
{
	case "Todos":
	$titulo= mb_strtoupper($id_incidencia." las Incidencias");
		$query=mysql_query("select concat_ws(' ',gad_personal.tratamiento, gad_personal.nombres,gad_personal.apellidos)as creador, gad_incidencias.* from gad_incidencias
	INNER JOIN gad_personal on gad_incidencias.id_usuario_crea=gad_personal.id_personal
	where id_usuario like '$idusuarioreportaear' and fech_h_peticion>='$idesde' and fech_h_peticion<='$ihasta'",$conectar);
	break;
	default:
	$titulo= mb_strtoupper("Incidencias de ".$id_incidencia);
	$query=mysql_query("select concat_ws(' ',gad_personal.tratamiento, gad_personal.nombres,gad_personal.apellidos)as creador, gad_incidencias.* from gad_incidencias
	INNER JOIN gad_personal on gad_incidencias.id_usuario_crea=gad_personal.id_personal
	where tipoinsidencia='$id_incidencia' and id_usuario like '$idusuarioreportaear' and fech_h_peticion>='$idesde' and fech_h_peticion<='$ihasta' ",$conectar);
	break;
	
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Incidentes</title>
</head>

<body>
<div>
	<h3 align="center"><?php echo $titulo;?></h3>
  <table width="99%" border="1" style="font-size:13px">
  <tr>
    <td align="center"><strong>#</strong></td>
    <td align="center"><strong>ASISTENTE</strong></td>
    <td align="center"><strong>N°- INCIDENCIA</strong></td>
    <td align="center"><strong>CATEGORIA</strong></td>
    <td align="center"><strong>FECHA INICIO<br>
    </strong></td>
    <td align="center"><strong>FECHA FINALIZACIÓN</strong></td>
    <td align="center"><strong>REQUIRIENTE</strong></td>
    <td align="center"><strong>REQUERIMIENTO</strong></td>
    <td align="center"><strong>SOLUCIÓN</strong></td>
    <td align="center"><strong>ESTADO</strong></td>
    <td align="center"><strong>TIEMPOS</strong></td>
    </tr>
  <?php 
  while($reg=mysql_fetch_array($query))
  {
	  $cont=$cont+1;
  ?>
  <tr>
    <td><?php echo $cont;?></td>
    <td><?php echo $reg["atendio"];?></td>
    <td><?php echo $reg["num_insidencia"];?></td>
    <td><?php echo $reg["tipoinsidencia"];?></td>
    <td><?php 
		#$arraydesde=explode(" ", $reg["fech_h_peticion"]);
		#echo $arraydesde[0];
		echo $reg["fech_h_peticion"];
		?></td>
    <td><?php
	#$arrayhasta=explode(" ", $reg["fecha_h_finatencion"]);
	#	echo $arrayhasta[0];
	echo $reg["fecha_h_finatencion"];?>
    
    </td>
    <td><?php echo $reg["requiriente"];?></td>
    <td><?php echo $reg["problema"];?></td>
    <td><?php echo $reg["solucion"];?></td>
    <td><?php echo $reg["estado"];
	#contar insidencias
	if($reg["estado"]=="FINALIZADO"){$FINALIZADO=$FINALIZADO+1;}
	if($reg["estado"]=="EN ATENCIÓN"){$atencion=$atencion+1;}
	
	#CAPTURAS DE INCIDENCIAS
	if($reg["capturas"]<>"")
	{
	$capturas[]=$reg["capturas"];
	$capturasinc[]=$reg["num_insidencia"];
	}
	?></td>
    <td>
      <?php 
		$imprimetiempo="";
	$fecha1 = new DateTime($reg["fech_h_peticion"]);
	$fecha2 = new DateTime($reg["fecha_h_finatencion"]);
	$fecha = $fecha1->diff($fecha2);
	#printf('%d años, %d meses, %d días, %d horas, %d minutos, %d segundos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i, $fecha->s);
	// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos
	#if($fecha->y>0){echo "Si hay";}else{echo "no hay año<br>";}
	if($fecha->y>0){$imprimetiempo= $fecha->y."A&nbsp;";}
	if($fecha->m>0){$imprimetiempo.= $fecha->m."M&nbsp;";}
	if($fecha->d>0){$imprimetiempo.= $fecha->d."D&nbsp;";}
	if($fecha->h>0){$imprimetiempo.= $fecha->h."h&nbsp;";}
	if($fecha->i>0){$imprimetiempo.= $fecha->i."m&nbsp;";}
	if($fecha->s>0){$imprimetiempo.= $fecha->s."s";}
	
	echo $imprimetiempo;
	 ?>
    </td>
    </tr>
  <?php 
  }
  ?>
</table>
<br>
 
  <table width="337" border="1" cellpadding="0" cellspacing="0" rules="all">
  <tr>
    <td width="246"><strong>TIPO INCIDENCIA</strong></td>
    <td width="85" align="center"><?php echo $id_incidencia?></td>
    </tr>
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align="center"><?php echo $FINALIZADO+$atencion?></td>
    </tr>
  <tr>
    <td><strong>ATENDIDAS</strong></td>
    <td align="center"><?php echo $FINALIZADO?></td>
    </tr>
  <tr>
    <td><strong>EN ATENCIÓN</strong></td>
    <td align="center"><?php echo $atencion;?></td>
    </tr>
    <tr>
    <td><strong>CAPTURAS DE PANTALLA</strong></td>
    <td align="center"><?php echo count($capturas);?></td>
    </tr>
</table>
</div>

<div style="page-break-before:always;"></div>
<div>
<h3 align="center">CAPTURAS</h3>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" rules="all">
<?php 
for($t=0;$t<count($capturas);$t++)
{
	
?>
  <tr>
    <td align="center"><strong>INCIDENCIA: <?php echo $capturasinc[$t];?> </strong></td>
  </tr>
  <tr>
    <td align="center">
    <?php
	$capturashelp = explode(";", $capturas[$t]);
	for($r=1;$r<count($capturashelp);$r++)
	{
	echo '<img src="../../'.$capturashelp[$r].'"><br>';
	}
	 ?>
    </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
<?php 
}
?>
</table>

</div>
</body>
</html>