<?php 

echo '
<page backtop="35mm" backbottom="15mm" backleft="20mm" backright="20mm">
    <page_header>
    <img src="res/encabezado_sub_gt_2015.png">
    </page_header>
    <page_footer>
        <table align="center" ><!--style="width: 100%; border: solid 1px black;"-->
            <tr>
                <td style="text-align: left; "><img src="res/pie_sub_gt_2015.png" width=""></td>
                <td style="text-align: right; ">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
  </page_footer>
  <p>
    <div align="center">
    <span style="font-size: 20px; font-weight: bold;"><strong>ACTA  DE ENTREGA – RECEPCIÓNSGT-SUM-2015-00000016</strong></span>
	</div>
</p>
    <div align="justify" style="font-size:16px;">
    En la ciudad de Tena provincia de Napo, a los2015-06-19comparece por una parte el Sr. Vinicio Aguinda, <strong>Técnico del Área de Soporte de la Subdirección de Gestión Tecnológica </strong> y por otra   parte el Victor Hugo Chávez Salazar funcionario del área <strong>SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</strong>, para proceder a firmar el acta de entrega recepción del siguiente suministro de impresión: </div>
    <br>
<br>
<br>
<br><table width="573" border="1" align="center" cellpadding="0" cellspacing="0" rules="all">
     <tr>
        <td width="81" height="11" valign="bottom"><p align="center"><strong>CODIGO</strong></p></td>
        <td width="46" valign="bottom"><p align="center"><strong>CANT.</strong></p></td>
        <td width="268" valign="bottom"><p align="center"><strong>DETALLE</strong></p></td>
        <td width="136" valign="top"><p align="center"><strong>OBSERVACIÓN</strong></p></td>
      </tr><tr valign="top">
        <td width="81" height="23">04837</td>
        <td width="46">1</td>
        <td width="268">TONER HP COLOR  LASERJET-CB543A (MAGENTA) - HP</td>
        <td width="136">&nbsp;</td>
      </tr></table>
<p align="justify">Para  constancia de lo indicado las partes firman.</p><br>
<br>
<div align="center">
Autorizado por
   <br>
<br>
<br>
<br>.......................................<br>
Ing. Fausto Claudio <br>
SUBDIRECTOR DE GESTIÓN ECOLÓGICA 
</div><br>
<br>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
 
    <td align="center">
    Entregue conforme
   <br>
<br>
<br>
<br>.......................................<br>
Sr. Vinicio Aguinda <br>
ASISTENTE 2
    </td>
	<td align="center">
    Recibí Conforme
   <br>
<br>

<br>
<br>.......................................<br>Victor Hugo Chávez Salazar <br>Servicios Profesionales
</td> 
</tr> 
</table>

</page>';

/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
   /*
    include(dirname(__FILE__).'/res/exemple03.php');
    */
$content = ob_get_clean();
    // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);#array(mL, mT, mR, mB));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple03.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
