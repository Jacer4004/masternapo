<?php
include("../../conf.php");

#consulta y genera el numero de acta
$nactaasql=mysql_query("select * from m5sts_equipos_acta_entrega order by id_ent_equi_acta desc limit 1",$conectar) or die("ERROR_");
$regnactaa=mysql_fetch_array($nactaasql);
$nactaarreglo=split("-",$regnactaa["nacta"]);#descompone el numero de acta
#verifica el año para reinicial conteo automatico cada año 
if($nactaarreglo[1]==date("Y"))
{
	$nactaa=$nactaarreglo[2]+1;#incrementa el numero de acta
}else
{
	$nactaa=1;#inicia el conteo
}
$nactaa="SGT-".date("Y")."-".sprintf("%05d", $nactaa);
#################################################################

#CONFIGURACION PARA PLANTILLAS 
$plantillasql=mysql_query("select * from conf_plantillas where nombre_plantilla='ACENEQUIPOS' and estado='1' order by id_plantilla desc limit 1 ",$conectar)or die ("error plantilla no existe");
$plantillareg=mysql_fetch_array($plantillasql);
$plantilla=explode("+",$plantillareg["ubicacion"]);

#echo $plantilla_encabezado."++";
	$plantilla_encabezado=$plantilla[0];
	$plantilla_pie=$plantilla[1];
###################################################################
#$acta_abrir=mysql_query("select * from inv_sum_actas where nacta='$nactaa'",$conectar)or die ("ERROR_");
#$reg_acta_abrir=mysql_fetch_array($acta_abrir);
#ob_start ();
#configuracion basica para PDF
$texto_HTML_a_PDF='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
<div>
<h3 align="center">ACTA DE ENTREGA DE EQUIPO N°- '.$nactaa.'</h3>
<p>Tena, '.date('d',strtotime($fecha)).' de '.$meses[date('n',strtotime($fecha))]. ' del '.date('Y',strtotime($fecha)).' </p>
<p align="justify">Se procede a la entrega del equipo informático con las características, software y aplicaciones unicamente autorizadas por la Sibdirección de Gestión Técnológica del GADPNAPO, por lo tanto queda bajo responsabilidad el buen uso de lo especificado a continucación:</p>
<ol>
	<li><strong>INFORMACIÓN DEL CUSTODIO</strong><br>
	  <table width="573" border="0">
  <tr>
    <td width="87"><strong>Nombre</strong></td>
    <td width="476"><strong>:</strong></td>
  </tr>
  <tr>
    <td><strong>Cargo</strong></td>
    <td><strong>:</strong></td>
  </tr>
  <tr>
    <td><strong>Dependencia</strong></td>
    <td><strong>:</strong></td>
  </tr>
</table>
<br>

	</li>
	<li><strong>ESPECIFICACIONES/CARACTERÍSTICAS <br>
	</strong>
	  <table border="1" rules="all">
  <tr>
    <td align="center"><strong>EQUIPO</strong></td>
    <td align="center"><strong>CARACTERÍSTICAS</strong></td>
    <td align="center"><strong>OBSERVACIONES</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
	  <br>
	</li>
	<li><strong>CONFIGURACIONES</strong>
	  <br>
	  <table border="1" rules="all">
	    <tr>
    <td align="center"><strong>CONECTIVIDAD </strong></td>
    <td align="center"><strong>ACCESO AL EQUIPO</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
	  <br>
	</li>
	<li><strong>SOFTWARE AUTORIZADO</strong><br>

	  <table border="1" rules="all">
	    <tr>
    <td align="center"><strong>NOMBRE DE LA APLICACIÓN</strong></td>
    <td align="center"><strong>OBSERVACIONES</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
	  <br>
	</li>
	<li><strong>OBSERVACIONES GENERALES</strong>
	  <p align="justify">La Subdirección de Gestión Tecnológica realizará el monitoreo del equipo, enc umplimiento de las normas y politicas de seguridad informáticas por lo que queda terminantemente prohibido la instalación de software no autorizado. 
      </p>
	</li>
	<li><strong>FIRMAS</strong>
    <br>
    <br>
    <br>
<br>
<table border="0">
  <tr>
    <td width="301">...................................</td>
    <td width="273">...................................</td>
  </tr>
  <tr>
    <td>Tlg. ....................<br>
    ENTREGA
    </td>
    <td>Sr.....................<br>
      CUSTODIO</td>
  </tr>
</table>

    </li>
</ol>
</div>
</body>
</html>';

#$nombre_archi="Acta-".$reg_acta_abrir["nacta"].".pdf";
$nombre_archi="Acta-666.pdf";
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
		$image_file = '../../plantillas/subdireccion_GT_PIE_2015.png';
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
$pdf->Output($nombre_archi, 'D');
#$pdf->Output(__DIR__ . '/acta_001.pdf', 'F');##enviar a un directorio

exit();
?>
