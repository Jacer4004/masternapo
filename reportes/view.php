<?php 
include("../conf.php");
$nactaa=$_REQUEST["acta"];
$valid="";
$valid=$_REQUEST["valid"];

if($valid=="TRUE")
{
	$nuacta=$_REQUEST["numeroacta"];
	$nuevotexto=$_REQUEST["editor1"];
	$actuacta=mysql_query("UPDATE inv_sum_actas SET texto_acta='$nuevotexto' WHERE  nacta='$nuacta'",$conectar) or die("ERROR ACTUALIZAR ACTA");
	echo "sE actualizo los cambios";
}
else
{

$acta_abrir=mysql_query("select * from inv_sum_actas where nacta='$nactaa'",$conectar)or die ("ERROR_");
$reg_acta_abrir=mysql_fetch_array($acta_abrir);
 ob_start();
echo $reg_acta_abrir["texto_acta"];

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
    require_once(dirname(__FILE__).'/../html2pdf_v4.03/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);#array(mL, mT, mR, mB));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($nactaa.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
}