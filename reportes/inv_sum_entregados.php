<?php 
include("../conf.php");
$desde=$_REQUEST["fedesde"];
$hasta=$_REQUEST["fhasta"];
$sql_ver="select inv_sum_entregados.id_dependencia,inv_sum_entregados.id_personal,
inv_sum_entregados.cantidad,inv_sum_entregados.fecha,inv_sum_entregados.observaciones,
inv_sum_entregados.n_transaccion,inv_suministros.suministro, 
gad_dependencia.nombre, concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres,gad_personal.apellidos) as personal, 
inv_sum_actas.nacta,inv_suministros.cod_bodega
from inv_sum_entregados
inner join inv_suministros on inv_sum_entregados.id_suministro=inv_suministros.id_invsuministros
inner join gad_dependencia on inv_sum_entregados.id_dependencia=gad_dependencia.id_dependencia
inner join gad_personal on inv_sum_entregados.id_personal=gad_personal.id_personal
inner join inv_sum_actas on inv_sum_entregados.n_transaccion=inv_sum_actas.n_transaccion
where inv_sum_entregados.fecha>='$desde' and inv_sum_entregados.fecha<='$hasta' and inv_sum_entregados.estado='Entregado' order by nombre";
$sql_query=mysql_query($sql_ver,$conectar)or die("ERROR_");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Suministros Entregados</title>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="../plantillas/subdireccion_GT_2015.jpg" width="946" height="84" alt=""/></td>
  </tr>
  <tr>
    <td>
    
    <h3 align="center">SUMINISTROS ENTREGADOS<br>
DESDE: <?php echo $desde;?> &nbsp;&nbsp;&nbsp;HASTA: <?php echo $hasta;?></h3>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" rules="all" >
  <tr>
    <td align="center"><strong>CANT</strong></td>
    <td align="center"><strong>CÓDIGO</strong></td>
    <td align="center"><strong>SUMINISTRO</strong></td>
    <td align="center"><strong>DEPENDENCIA</strong></td>
    <td align="center"><strong>RESPONSABLE</strong></td>
    <td align="center"><strong>N°- ACTA</strong></td>
    <!--<td align="center"><strong>OBSERVACIONES</strong></td>-->
  </tr>
  <?php 
  while($reg_s=mysql_fetch_array($sql_query))
  {
	  $total=$total+$reg_s["cantidad"];
  ?>
  <tr>
    <td align="center" valign="middle"><?php echo $reg_s["cantidad"];?></td>
    <td align="center" valign="middle"><?php echo $reg_s["cod_bodega"];?></td>
    <td><?php echo $reg_s["suministro"];?></td>
    <td><?php echo $reg_s["nombre"];?></td>
    <td><?php echo $reg_s["personal"];?></td>
    <td><?php echo $reg_s["nacta"];?></td>
   <!-- <td><?php //echo $reg_s["observaciones"];?></td>-->
  </tr>
  <?php 
  }
  ?>
  
</table><br>

<div>Total de Suministros entregados en este periodo: <strong><?php echo $total;?></strong></div>
    
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>