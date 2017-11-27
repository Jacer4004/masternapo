
<?php 
include("../../conf.php");
$distrivutivo=$_REQUEST["id_distributivo"];
$id_distributivo_dep=$_REQUEST["id_distributivo_dep"];
$mod_contrato=$_REQUEST["mod_contrato"];
$mod_cargo=$_REQUEST["mod_cargo"];
$nivelestructural=$_REQUEST["nivelestructural"];

$sqlfinal="select gad_personal.cedula, gad_personal.genero, concat_ws(' ',gad_personal.tratamiento,
		gad_personal.apellidos,gad_personal.nombres)as nomina,
		th_distributivo_dep.nivel_estructural,
		th_distributivo_dep.dependencia_nom,
		th_distributivo_per.*  
		from th_distributivo_per
		inner join gad_personal on th_distributivo_per.id_personal=gad_personal.id_personal
		inner join th_distributivo_dep on th_distributivo_per.id_distributivo_dep=th_distributivo_dep.id_distributivo_dep ";

#PARA LA DEPENDENCIA
if($id_distributivo_dep=="todos")
{
	$sqldistributivo="where th_distributivo_per.id_distributivo='$distrivutivo' ";	
}
else
{
	$sqldistributivo="where th_distributivo_per.id_distributivo='$distrivutivo' and th_distributivo_dep.id_distributivo_dep= '$id_distributivo_dep' ";	
}

#PARA MODALIDAD DE COTRATO
if($mod_contrato=="todos")
{
	$sqldistributivo.=" and mod_contrato like '%' ";	
}
else
{
	$sqldistributivo.=" and mod_contrato like '$mod_contrato%' ";	
}

#PARA imprimir tipo de cargo
if($mod_cargo=="todos")
{
	$sqldistributivo.=" and denominacion_puesto like '%' ";	
}
else
{
	$sqldistributivo.="and denominacion_puesto like '$mod_cargo%' ";	
}

#PARA CON NIVEL ESTRUCTURAL
if($nivelestructural=="todos")
{
	$sqldistributivo.=" and nivel_estructural like '%' ";	
}
else
{
	$sqldistributivo.="and nivel_estructural like '$nivelestructural%' ";	
}

	$sqlfinal.=$sqldistributivo."
	order by dependencia_nom";

$query=mysql_query($sqlfinal,$conectar);

/*
#pdf

#ob_start();

##MPDF
require_once('../../mpdf/mpdf.php');
ob_start();*/
 ?>
 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Distributivo</title>
<style type="text/css">
body {

	text-align:justify
	}
	
    @page { margin: 10px 20px 20px 20px}
    #header 
	{ 
	position: fixed; 
	left: 0px; 
	top: 0px; 
	right: 0px;  
	border-bottom:4px solid rgba(16,39,176,1.00); 
	text-align: center; 
	}
	
    #footer { position: fixed; left: 0px; bottom: 0px; right: 0px; height: 56px;
	border-top:5px solid rgba(0,0,0,1.00);
	 }
    #footer .page:after { content: "page " counter(page) " of " counter(pages); }
  </style>
</head>

<body>
<div id="headaer">
    <h3 align="center" style="margin:0px; padding:0px;">GOBIERNO AUTÓNOMO DESCENTRALIZADO </h3>
	<h2 align="center" style="margin:0px; padding:0px;"> PROVINCIAL DE NAPO</h2>
    <H3 align="center" style="margin:0px; padding:0px">NÓMINA GENERAL DEL PERSONAL
<?php 
$distrbgeneral=mysql_query("select * from th_distributivo where id_distributivo='$distrivutivo'",$conectar);
$regdistr=mysql_fetch_array($distrbgeneral);

echo $regdistr["dis_periodo"];
?>
</H3><hr>
</div>
	
    <table style="font-size:14px" width="100%" border="1" rules="all" cellspacing="0" cellpadding="2">
  <tr>
    <td width="10" align="center"><strong>N°-</strong></td>
    <td width="50" align="center"><strong>CÉDULA</strong></td>
    <td width="200" align="center"><strong>NÓMINA</strong></td>
    <td width="200" align="center"><strong>DEPENDENCIA</strong></td>
    <td width="200" align="center"><strong>MODALIDAD</strong></td>
    <td width="200" align="center"><strong>CARGO</strong></td>
    <td width="200" align="center"><strong>GENERO</strong></td>
    </tr>
  
  <?php 
  while($regpersonal=mysql_fetch_array($query))
  {
	  $contar=$contar+1;
  ?>
  <tr>
    <td align="center"><?=$contar?></td>
    <td align="left"><?php echo $regpersonal["cedula"]?></td>
    <td align="left"><?php echo $regpersonal["nomina"]?></td>
    <td align="left"><?php echo $regpersonal["dependencia_nom"]?></td>
    <td align="left"><?php echo $regpersonal["mod_contrato"]?></td>
    <td align="left"><?php echo $regpersonal["rol_de_puesto"]?></td>
    <td align="left"><?php 
	#acumula para conteo
	if($regpersonal["genero"]=="Masculino")
	{$masculino=$masculino+1;}
	if($regpersonal["genero"]=="Femenino")
	{
		$femenino=$femenino+1;	
	}
	if($regpersonal["genero"]=="")
	{
		$singenero=$singenero+1;	
	}
	echo $regpersonal["genero"]?></td>
    </tr>
  <?php 
  }
  
 
  ?>
  
  
</table>
<br>

<table width="264" align="center" rules="all" cellpadding="5" style="border:1px solid;border-collapse: collapse;">
  
    <tr>
      <td colspan="2" align="center" valign="middle" scope="col"><strong>RESUMEN FINAL </strong></td>
    </tr>
    <tr>
      <td><strong>MUJERES</strong></td>
      <td width="52" align="center"><?php echo $femenino;?></td>
    </tr>
    <tr>
      <td><strong>HOMBRES</strong></td>
      <td align="center" valign="middle"><?php echo $masculino;?></td>
    </tr>
    <tr>
      <td><strong>SIN GENERO</strong></td>
      <td align="center" valign="middle"><?php echo $singenero;?></td>
    </tr>
    <tr>
      <td><strong>TOTAL</strong></td>
      <td align="center" valign="middle"><?php echo $masculino+$femenino+$singenero;?></td>
    </tr>

</table>



</body>
</html>
<?php 
/*
$html = ob_get_clean();
$nombrearchivo="TH_AP_".$registro["accion_n"]."_".str_replace(" ","_",$registro["nomina"])."_".$registro["cedula"].".pdf";

$pie='<table class="bordes" style=" margin-left:10px; font-size:12px; margin-top:6px; margin-bottom:6px; " width="350" border="1" cellspacing="0" cellpadding="0" rules="all">
          <tr>
            <td width="220" height="20">Elabrado por Lcda. Palmira Paredes</td>
            <td width="130">&nbsp;</td>
          </tr>
          <tr>
            <td>Revisado por Ing. Zoraida Cabrera V.</td>
            <td>&nbsp;</td>
          </tr>
    </table>
	<img style="float:right; margin-top:-70px; height:80px;width:80px " src="../../../masternapo/plantillas/qrcode.png" >
<span style="font-size:12px">Página {nb} de {nbpg}</span><br>
';
 
// Define a document with default left-margin=30 and right-margin=10
$mpdf=new mPDF('','A4-L', 0, '', 30,15,5,15,'',10);
#$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie);
$mpdf->WriteHTML($html);
$mpdf->Output($nombrearchivo,'I'); #modos de salida
#F
#I en el mismo explorador
#S
#D descargar
*/
?>