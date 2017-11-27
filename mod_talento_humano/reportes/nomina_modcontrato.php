
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
	$sql_tipo_contrato=$sqldistributivo;
}
else
{
	$sqldistributivo="where th_distributivo_per.id_distributivo='$distrivutivo' and th_distributivo_dep.id_distributivo_dep= '$id_distributivo_dep' ";
	$sql_tipo_contrato=$sqldistributivo;
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
	$sql_cargos=" and denominacion_puesto like '%' ";
}
else
{
	$sqldistributivo.="and denominacion_puesto like '$mod_cargo%' ";
	$sql_cargos=" and denominacion_puesto like '$mod_cargo%' ";	
}

#PARA CON NIVEL ESTRUCTURAL
if($nivelestructural=="todos")
{
	$sqldistributivo.=" and nivel_estructural like '%' ";	
	$sqlnivelestructural=" and nivel_estructural like '%' ";
}
else
{
	$sqldistributivo.="and nivel_estructural like '$nivelestructural%' ";	
	$sqlnivelestructural=" and nivel_estructural like '$nivelestructural%' ";
}


	$sqlfinal.=$sqldistributivo."
	order by dependencia_nom";

$query=mysql_query($sqlfinal,$conectar);



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
    <td align="left"><?php echo $regpersonal["mod_contrato"];
	#cuenta las modalidades
	#MODALIDADDES DE CONTRATO
	for($i=0;$i<count($array_tipocontrato);$i++)
	{
		
	
	}
	?></td>
    <td align="left"><?php echo $regpersonal["rol_de_puesto"]?></td>
    </tr>
  <?php 
  }
  
 
  ?>
  
  
</table>
<br>

<table width="422" border="1" align="center" cellpadding="5">
  <tbody>
    <tr>
      <th colspan="2" align="center" valign="middle" scope="col">RESUMEN FINAL </th>
    </tr>
    <?php 
	#RECUPERA LAS MODALIDADES DE CONTRATO A UN ARREGLO PARA IR COMPARANDO LUEGO
$SQL_mod_contrato=mysql_query("SELECT *
FROM gad_tipocontrato",$conectar)or die("Error");
while($reg_tipo_c=mysql_fetch_array($SQL_mod_contrato))
{
	$tipocontratob=$reg_tipo_c["nom_tipocontrato"];

	?>
    <tr>
      <td><?php 
	  echo strtoupper($reg_tipo_c["nom_tipocontrato"]);
	  ?></td>
      <td width="52" align="center">
      <?php 
	  $nsql="select count(mod_contrato)AS totales   
		from th_distributivo_per
		inner join gad_personal on th_distributivo_per.id_personal=gad_personal.id_personal
		inner join th_distributivo_dep on th_distributivo_per.id_distributivo_dep=th_distributivo_dep.id_distributivo_dep  ";
		$nsql.=$sql_tipo_contrato."and mod_contrato like '$tipocontratob%'".$sql_cargos.$sqlnivelestructural; #echo $nsql;
		
	  $SQL_tot_mo=mysql_query($nsql,$conectar) or die(mysql_error());
	  $array_to=mysql_fetch_array($SQL_tot_mo);
	 
	  echo $array_to["totales"];
	  ?>
      </td>
    </tr>
    <?php 
	}
	?>
    <tr>
      <td><strong>TOTAL</strong></td>
      <td align="center" valign="middle">&nbsp;</td>
    </tr>
  </tbody>
</table>



</body>
</html>
<?php 

?>