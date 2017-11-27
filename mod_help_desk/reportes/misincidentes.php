<?php 
session_start();
include("../../conf.php");
$idusuario=$_SESSION['userid'];
$query=mysql_query("select concat_ws(' ',gad_personal.tratamiento, gad_personal.nombres,gad_personal.apellidos)as creador, gad_incidencias.* from gad_incidencias
INNER JOIN gad_personal on gad_incidencias.id_usuario_crea=gad_personal.id_personal
where id_usuario='$idusuario'",$conectar);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mis Incidentes</title>
</head>

<body>
<div>
	<h3 align="center">Mis Incidencias</h3>
  <table width="99%" border="1">
  <tr>
    <td>#</td>
    <td>N°- INCIDENCIA</td>
    <td>CATEGORIA</td>
    <td>FECHA INICIO<br>
      FECHA FINALIZACIÓN</td>
    <td>REQUIRIENTE</td>
    <td>REQUERIMIENTO</td>
    <td>SOLUCIÓN</td>
    <td>ATENCIÓN</td>
    <td>IP-DONDE SOLICITA</td>
    <td>ESTADO</td>
    <td>PRIORIDAD</td>
    <td>OTROS DATOS</td>
    <td>TIEMPOS</td>
    <td>USUARIO&nbsp; CREA</td>
  </tr>
  <?php 
  while($reg=mysql_fetch_array($query))
  {
	  $cont=$cont+1;
  ?>
  <tr>
    <td><?php echo $cont;?></td>
    <td><?php echo $reg["num_insidencia"];?></td>
    <td><?php echo $reg["tipoinsidencia"];?></td>
    <td><?php echo $reg["fech_h_peticion"]."<br>".$reg["fecha_h_finatencion"];?></td>
    <td><?php echo $reg["requiriente"];?></td>
    <td><?php echo $reg["problema"];?></td>
    <td><?php echo $reg["solucion"];?></td>
    <td><?php echo $reg["atendio"];?></td>
    <td><?php echo $reg["ips_incidencias"];?></td>
    <td><?php echo $reg["estado"];?></td>
    <td><?php echo $reg["prioridad"];?></td>
    <td><?php echo $reg["insotros"];?></td>
    <td>
    <?php 
		$imprimetiempo="";
	$fecha1 = new DateTime($reg["fech_h_peticion"]);
	$fecha2 = new DateTime($reg["fecha_h_finatencion"]);
	$fecha = $fecha1->diff($fecha2);
	#printf('%d años, %d meses, %d días, %d horas, %d minutos, %d segundos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i, $fecha->s);
	// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos
	#if($fecha->y>0){echo "Si hay";}else{echo "no hay año<br>";}
	if($fecha->y>0){$imprimetiempo= $fecha->y." Años<br>";}
	if($fecha->m>0){$imprimetiempo.= $fecha->m." Meses<br>";}
	if($fecha->d>0){$imprimetiempo.= $fecha->d." Días<br>";}
	if($fecha->h>0){$imprimetiempo.= $fecha->h." horas<br>";}
	if($fecha->i>0){$imprimetiempo.= $fecha->i." Minutos<br>";}
	if($fecha->s>0){$imprimetiempo.= $fecha->s." Segundos";}
	
	echo $imprimetiempo;
	 ?>
    </td>
    <td><?php echo $reg["id_usuario_crea"];?></td>
  </tr>
  <?php 
  }
  ?>
</table>

</div>
</body>
</html>