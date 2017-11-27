<?php
include("../../conf.php");

$tipoarchivo=$_REQUEST["tipoarchivo"];
if($tipoarchivo=="EXCEL")
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=reporte.xls");

}


$categoria=$_REQUEST["/cate"];
$previa=$_REQUEST["previaareas"];
#recupera datos de la dependcia
$querydependencia=mysql_query("select * from gad_dependencia where id_dependencia='$previa'",$conectar);
$dependencia=mysql_fetch_array($querydependencia);
#consulta y genera el numero de acta
if($previa=="")
{
	#todas las dependencias titulos
	$titulodependencia="TODAS LAS DEPENDENCIAS";
		
	
	$querygeneral=mysql_query("select concat_ws(' ',gad_personal.nombres, gad_personal.apellidos)as nomina, 
gad_dependencia.id_dependencia,gad_dependencia.nombre as dependencia,
m5sts_ip.ip,m5sts_us_ad.nom_usu_ad,
m5sts_entrega_equipos.* from m5sts_entrega_equipos
inner join gad_personal on m5sts_entrega_equipos.id_personal=gad_personal.id_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
left join m5sts_ip on m5sts_entrega_equipos.dir_ip=m5sts_ip.id_ip
left join m5sts_us_ad on m5sts_entrega_equipos.us_ad=m5sts_us_ad.id_us_ad
order by nomina",$conectar) or die("ERROR_");
}
else
{
	
	$titulodependencia=$dependencia["nombre"]." (".$dependencia["abreviatura"].")";
	$tituloabreviado=$dependencia["abreviatura"];
	
$querygeneral=mysql_query("select concat_ws(' ',gad_personal.nombres, gad_personal.apellidos)as nomina, 
gad_dependencia.id_dependencia,gad_dependencia.nombre as dependencia,
m5sts_ip.ip,m5sts_us_ad.nom_usu_ad,
m5sts_entrega_equipos.* from m5sts_entrega_equipos
inner join gad_personal on m5sts_entrega_equipos.id_personal=gad_personal.id_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
left join m5sts_ip on m5sts_entrega_equipos.dir_ip=m5sts_ip.id_ip
left join m5sts_us_ad on m5sts_entrega_equipos.us_ad=m5sts_us_ad.id_us_ad
where gad_dependencia.id_dependencia='$previa'
order by nomina",$conectar) or die("ERROR_");
}

$nombre_archi="Equipos (".$categoria.").pdf";
#######################################para la fecha
###fecha 
$fecha=date("Y-m-d");
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

#configuracion basica para PDF
$modo=$_REQUEST["/modo"];

switch($modo)
{
	case"pdf":
	ob_start ();
$texto_HTML_a_PDF='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>

<h3 align="center">LISTADO DE EQUIPOS Y PARTES CATEGORIA '.$categoria.'</h3>
<p>Tena, '.date('d',strtotime($fecha)).' de '.$meses[date('n',strtotime($fecha))]. ' del '.date('Y',strtotime($fecha)).' </p>
<table border="1" rules="all">
  <tr>
    <td width="25" valign="middle" align="center"><strong>N°</strong></td>
    <td width="100" valign="middle" align="center"><strong>CÓd.ACTIVO</strong></td>
    <td width="80" valign="middle" align="center"><strong>MARCA</strong></td>
    <td width="90" valign="middle" align="center"><strong>MODELO</strong></td>
    <td width="115" valign="middle" align="center"><strong>SERIE</strong></td>
    <td width="535" valign="middle" align="center"><strong>ESPECIFÍCACIONES</strong></td>
  </tr>';
   
  while($resultados=mysql_fetch_array($nactaasql))
  {
	  $contador=$contador+1;
  $texto_HTML_a_PDF.='
  <tr>
    <td>'.$contador.'</td>
    <td>'.$resultados["codigoactivo"].'</td>
    <td>'.$resultados["marca"].'</td>
    <td>'.$resultados["modelo"].'</td>
    <td>'.$resultados["serie"].'</td>
    <td>'.$resultados["especificaciones"].'</td>
    
  </tr>';
  }
   $texto_HTML_a_PDF.='
</table>

</body>
</html>';

#$nombre_archi="Acta-".$reg_acta_abrir["nacta"].".pdf";

#===========================================================================================
#configuraciond e la clase para general los pdf

require_once('../../tcpdf/tcpdf.php');

// clase extendedia
class MYPDF extends TCPDF {

	//encabezado
public function Header() {
			
		//$image_file = K_PATH_IMAGES.'logo_example.jpg';
		$image_file = '../../plantillas/subdireccion_GT_2015.jpg';
	
		#$this->Image($image_file, 10, 6, 185, '', '', '', '', false, 3600, '', false, false,0, false, false, false);
		$this->Image($image_file, 56, 6, 185, '', 'jpg', '', '', false, 3200, '', false, false,0, false, false, false);

		// fuente por defecto
		$this->SetFont('helvetica', 'B', 14);
		// titulo
		//$this->Cell(0, 15, 'GADPNAPO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
	}

	// pie de pagina
	public function Footer() {
		// posicion inferiro de 15mm
		$this->SetY(-15);
		// funte por defecto 
		$this->SetFont('helvetica', 'I', 8);
		// pone nueros de páginas
		$this->Cell(0, 12, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		
		// imagene de plantilla
		$image_file = '../../plantillas/subdireccion_GT_PIE_2015.png';
		//$this->Image($image_file, 10, 50, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->Image($image_file, 10, 270, 185, '', '', '', '', false, 3200, '', false, false,0, false, false, false);

	}
}

// crea la instancia PDF
$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// informaciongeneral del documento 
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GADPNAPO-SDGT_Ing. Diego Rojas');
$pdf->SetTitle('Reportes');
$pdf->SetSubject('GENERADOR PDF TCPDF');
$pdf->SetKeywords('GADPNAPO');

// ebcabezado por defecto
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// ipos de letras encabezados y pie de pagina
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15, 30, 10);
$pdf->SetHeaderMargin(20);
$pdf->SetFooterMargin(24);


// salto de pagina automatico y margen inferior
$pdf->SetAutoPageBreak(true, 24);


// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

#mensajes de error en español
require_once('../../tcpdf/lang/spa.php');
// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// recupera codigo html 

$html = $texto_HTML_a_PDF;
// escribe el codigo html
$pdf->writeHTML($html, true, 0, true, 0);

// reset configuración de páginas
$pdf->lastPage();

//visualiza el archivo
#$pdf->Output('example_003.pdf', 'I');
$pdf->Output($nombre_archi, 'I');
#$pdf->Output(__DIR__ . '/acta_001.pdf', 'F');##enviar a un directorio

exit();
#finaliza el primer case
break;

case "html":

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>

<h3 align="center">LISTADO DE EQUIPOS ENTREGADOS <br>
<?php echo "DEPENDENCIA: ".$titulodependencia;?></h3>
<?php echo '<p>Tena, '.date('d',strtotime($fecha)).' de '.$meses[date('n',strtotime($fecha))]. ' del '.date('Y',strtotime($fecha)).' </p>';?>
<table border="1" align="center" rules="all" style="font-size:13px" width="95%">
  <tr>
    <td width="25" valign="middle" align="center"><strong>#</strong></td>
    <td width="100" valign="middle" align="center"><strong>DEPENDENCIA</strong></td>
    <td width="100" valign="middle" align="center"><strong>CUSTODIO</strong></td>
    <td width="80" valign="middle" align="center"><strong>USUARIOS Y CONFIGURACIONES</strong></td>
    <td width="90" valign="middle" align="center"><strong>TIPO</strong></td>
    <td align="center" valign="middle"><strong>COD.ACTIVO</strong></td>
    <td align="center" valign="middle"><strong>EQUIPO</strong></td>
    <td align="center" valign="middle"><strong>MARCA</strong></td>
    <td align="center" valign="middle"><strong>MODELO</strong></td>
    <td align="center" valign="middle"><strong>PROPIETARIO</strong></td>
    <td align="center" valign="middle"><strong>ESPECIFICACIONES</strong></td>
  </tr>
   
 <?php 
  while($resultados=mysql_fetch_array($querygeneral))
  {
	  $contador=$contador+1;
	  $rowspan=0;
		$identregado=$resultados["id_ent_equi"] ;
		
		$querycomponentes=mysql_query("select * from m5sts_e_e_componentes
left join m5sts_equipos on m5sts_e_e_componentes.id_equipo=m5sts_equipos.id_equipo
where id_ent_equi='$identregado'",$conectar) or die("error");
$rowspan=mysql_num_rows($querycomponentes); 

$rowspan=$rowspan+1;

	?>
      
   <tr>
    <td rowspan="<?php echo $rowspan;?>"><?php echo $contador?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php
	if($previa=="")
	{
	echo $resultados["dependencia"];
	}
	else
	{
	echo $tituloabreviado;
	}
	?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo $resultados["nomina"]?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo "IP: ".$resultados["ip"]."<br>AD: ".$resultados["nom_usu_ad"]?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo $resultados["denominacion"]?></td>
    
  </tr>
    <?php 
	
while($resultadoscomp=mysql_fetch_array($querycomponentes))
{
	?>
   <tr>
     <td><?php echo $resultadoscomp["codigoactivo"];?></td>
     <td><?php echo $resultadoscomp["nombre"];?></td>
     <td><?php echo $resultadoscomp["marca"];?></td>
     <td><?php echo $resultadoscomp["modelo"];?></td>
     <td><?php echo $resultadoscomp["propietario"];?></td>
     <td><?php echo $resultadoscomp["especificaciones"];?></td>
   </tr>
  <?php 
}
  ?>
  
  <?php 
  }
  ?> 
</table>

</body>
</html>

<?php 
break;
}
?>

