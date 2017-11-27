<?php
include("../conf.php");
$nactaa=$_REQUEST["acta"];

$acta_abrir=mysql_query("select * from inv_sum_actas where nacta='$nactaa'",$conectar)or die ("ERROR_");
$reg_acta_abrir=mysql_fetch_array($acta_abrir);

#configuracion basica para PDF
ob_start ();
$texto_HTML_a_PDF=$reg_acta_abrir["texto_acta"];

$nombre_archi="Acta-".$reg_acta_abrir["nacta"].".pdf";

#===========================================================================================
#configuraciond e la clase para general los pdf

require_once('../tcpdf/tcpdf.php');

// clase extendedia
class MYPDF extends TCPDF {

	//encabezado
public function Header() {
			
		//$image_file = K_PATH_IMAGES.'logo_example.jpg';
		$image_file = '../plantillas/subdireccion_GT_2015.jpg';
	
		#$this->Image($image_file, 10, 6, 185, '', '', '', '', false, 3600, '', false, false,0, false, false, false);
		$this->Image($image_file, 10, 6, 185, '', 'jpg', '', '', false, 3200, '', false, false,0, false, false, false);

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
		$image_file = '../plantillas/subdireccion_GT_PIE_2015.png';
		//$this->Image($image_file, 10, 50, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->Image($image_file, 10, 270, 185, '', '', '', '', false, 3200, '', false, false,0, false, false, false);

	}
}

// crea la instancia PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
$pdf->SetMargins(35, 28, 25);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(20);


// salto de pagina automatico y margen inferior
$pdf->SetAutoPageBreak(TRUE, 20);


// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

#mensajes de error en español
require_once('../tcpdf/lang/spa.php');
// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

if($reg_acta_abrir["estado"]<>"")
{
$pdf->Image('../plantillas/anulado.png', 20, 40, 0, 0, 'png', '', '', true, 100, '', false, false, 0, false, false, true);
}
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
