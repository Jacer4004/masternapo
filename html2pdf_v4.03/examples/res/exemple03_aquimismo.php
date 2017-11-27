<page backtop="35mm" backbottom="15mm" backleft="20mm" backright="20mm">
    <page_header>
    <img src="encabezado_sub_gt_2015.png"/>
        <!--<table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 33%">html2pdf</td>
                <td style="text-align: center;    width: 34%"><img src="res/encabezado_sub_gt_2015.png"></td>
                <td style="text-align: right;    width: 33%"><?php  echo date('d/m/Y'); ?></td>
            </tr>
        </table>-->
    </page_header>
    <page_footer>
        <table align="center" ><!--style="width: 100%; border: solid 1px black;"-->
            <tr>
                <td style="text-align: left; "><img src="pie_sub_gt_2015.png" width=""/></td>
                <td style="text-align: right; ">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
  </page_footer>
    <div align="center">
    <span style="font-size: 20px; font-weight: bold;">ACTA N° 00001-SGT-2015</span>
    </div>
    <br>
    <br>
    <br>
  <div align="justify" style="font-size:16px;">
    En la ciudad de Tena provincia de Napo, al uno de enero del 2015, comparece por una parte el Sr. Vinicio Aguinda-Técnico del Área de Soporte de la Subdirección de Gestión Tecnológica y por otra parte el Ing. Fausto Claudio - Subdirector de Gestión Tecnológica para proceder a firmar el acta de entrega recepción del siguiente suministro de impresión para utilizar en la Subdirección de Gestión Tecnológica
    </div>
    <br>
<br>
<br>
<br>
    
   
    


</page>
<?php
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
   $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/../../html2pdf.class.php');
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
