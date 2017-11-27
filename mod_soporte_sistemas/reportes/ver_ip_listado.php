<?php
include("../../conf.php");
$identificador=$_REQUEST["/identificador"];
#consulta y genera el numero de acta
$nactaasql=mysql_query("select * from m5sts_ip where ugeografica='$identificador' order by ip asc",$conectar) or die("ERROR_");
$nombre_archi="ip (".$categoria.").pdf";
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

<h3 align="center">LISTADO DE EQUIPOS Y PARTES CATEGORIA <?php echo $categoria?></h3>
<?php echo '<p>Tena, '.date('d',strtotime($fecha)).' de '.$meses[date('n',strtotime($fecha))]. ' del '.date('Y',strtotime($fecha)).' </p>';?>
<table border="1" align="center" rules="all">
  <tr>
    <td width="25" valign="middle" align="center"><strong>N°</strong></td>
    <td width="100" valign="middle" align="center"><strong>DIRECCIÓN IP</strong></td>
    <td width="80" valign="middle" align="center"><strong>MARCA</strong></td>
    <td width="90" valign="middle" align="center"><strong>MODELO</strong></td>
    <td width="115" valign="middle" align="center"><strong>SERIE</strong></td>
    <td width="535" valign="middle" align="center"><strong>ESPECIFÍCACIONES</strong></td>
  </tr>
   
 <?php 
  while($resultados=mysql_fetch_array($nactaasql))
  {
	  $contador=$contador+1;?>
   <tr>
    <td><?php echo $contador?></td>
    <td><?php echo $resultados["ip"]?></td>
    <td><?php echo $resultados["marca"]?></td>
    <td><?php echo $resultados["modelo"]?></td>
    <td><?php echo $resultados["serie"]?></td>
    <td><?php echo $resultados["especificaciones"]?></td>
    
  </tr>
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

