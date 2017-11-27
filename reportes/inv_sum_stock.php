<?php 
include("../conf.php");
$fechaadquisiciondesde=$_REQUEST["fechaadquisiciondesde"];
$fechaadquisicionhasta=$_REQUEST["fechaadquisicionhasta"];

$sql_ver="select * from  inv_suministros
where fechaadquisicion>='$fechaadquisiciondesde' and fechaadquisicion<='$fechaadquisicionhasta' order by marca asc,stock desc ";
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
    <td align="center"><img src="../plantillas/subdireccion_GT_2015.jpg" width="822" height="98" alt=""/></td>
  </tr>
  <tr>
    <td>
    
    <h3 align="center">STOCK DE SUMINISTROS <br>
      CON FECHA DE COMPRA: <?php 
	  
	  if($fechaadquisiciondesde==$fechaadquisicionhasta){
		   echo $fechaadquisiciondesde;
	  }
		else
		{  
			echo $fechaadquisiciondesde;
			echo " - ";
		    echo $fechaadquisicionhasta;
		  } 
	 ?></h3>
<table width="822" border="1" align="center" cellpadding="0" cellspacing="0" rules="all" >
  <tr>
    <td width="97" align="center"><strong>FECHA DE COMPRA</strong></td>
    <td width="97" align="center"><strong>CÓDIGO</strong></td>
    <td width="91" align="center"><strong>MARCA</strong></td>
    <td width="366" align="center"><strong>SUMINISTRO</strong></td>
    <td width="63" align="center"><strong>CANT. COMPRA</strong></td>
    <td align="center"><strong>CANT. ENTREGADOS</strong></td>
    <td width="71" align="center"><strong>CANT. STOCK</strong></td>
    
  </tr>
  <?php 
  while($reg_s=mysql_fetch_array($sql_query))
  { 
  	$tstock=$tstock+$reg_s["stock"];
	$tcompra=$tcompra+$reg_s["cantidad"];
  ?>
  <tr>
    <td align="center" valign="middle"><?php echo $reg_s["fechaadquisicion"];?></td>
    <td align="center" valign="middle"><?php echo $reg_s["cod_bodega"];?></td>
    <td><?php echo $reg_s["marca"];?></td>
    <td><?php echo $reg_s["suministro"];?></td>
    <td align="center"><?php echo $reg_s["cantidad"];?></td>
    <td align="center"><?php echo $reg_s["cantidad"]-$reg_s["stock"];?></td>
    <td align="center"><?php echo $reg_s["stock"];?></td>
  </tr>
  <?php 
  }
  ?>
  
</table><br>

<div>
<table width="401" border="1" align="center" cellpadding="0" cellspacing="0" rules="all">
  <tr>
    <td height="31" colspan="2" align="center"><strong>RESUMEN DE SUMINSITROS 
      DE ESTA COMPRA</strong></td>
    </tr>
  <tr>
    <td width="329" height="32">SUMINISTROS EN STOCK</td>
    <td width="66" align="right"><strong style="padding-right:10px"><?php echo $tstock;?></strong></td>
  </tr>
  <tr>
    <td height="32">SUMINISTROS ENTREGADOS</td>
    <td align="right"><strong style="padding-right:10px"><?php echo $tcompra-$tstock;?></strong></td>
  </tr>
  <tr>
    <td height="33">SUMINISTROS ADQUIRIDOS</td>
    <td align="right"><strong style="padding-right:10px"><?php echo $tcompra;?></strong></td>
  </tr>
</table>
</div>
    
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>