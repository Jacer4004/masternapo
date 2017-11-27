
<?php 
include("../../conf.php");
$distrivutivo=$_REQUEST["id_distributivo"];
$id_distributivo_dep=$_REQUEST["id_distributivo_dep"];
$mod_contrato=$_REQUEST["mod_contrato"];
$mod_cargo=$_REQUEST["mod_cargo"];
$nivelestructural=$_REQUEST["nivelestructural"];

$sqlfinal="select gad_personal.cedula, concat_ws(' ',gad_personal.tratamiento,
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

# Cargamos la librería dompdf.
#require_once '../../dompdf/dompdf_config.inc.php';
 
# Contenido HTML del documento que queremos generar en PDF.
#ob_start();
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
    <H3 align="center" style="margin:0px; padding:0px">NOMINA GENERAL DEL PERSONAL
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
    <td width="200" align="center"><strong>FIRMA</strong></td>
    <td width="200" align="center"><strong>OBSERVACIONES</strong></td>
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
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    </tr>
  <?php 
  }
  
 
  ?>
  
  
</table>




</body>
</html>
<?php 

/*$html = ob_get_clean();
 
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 # Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));


# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
 #portrait=verticla
#landscape=horizontal
 
# Renderizamos el documento PDF.
$mipdf ->render();
#$mipdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

// add the header numero de paginas
$canvas = $mipdf->get_canvas();
$font = Font_Metrics::get_font("Arial", "bold","italic");

// the same call as in my previous example poisision vertical=512,818
$canvas->page_text(750, 522, "Página {PAGE_NUM} de {PAGE_COUNT}",
                   $font, 8, array(0,0,0));
				   
#nombre de archivo				   
 $filename = "GADP_NAPO_".date("Y-m-d H_i_s").'.pdf';
# Enviamos el fichero PDF al navegador.
 #header('Content-type: application/pdf'); //Ésta es simplemente la cabecera para que el navegador interprete todo como un PDF
 

#$mipdf ->stream($filename,array('Attachment'=>0));
#$mipdf->stream("dompdf_out.pdf", array("Attachment" => false));

#para que se guarde en un lugar del servidor el archivo
#$output = $mipdf->output();
#file_put_contents($filename, $output); 

#para que se muestre en el mismo navegar
$mipdf->stream($filename, array("Attachment" => false));


#para que se descarge 
#$mipdf->stream($filename);

*/?>