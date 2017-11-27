
<?php 
#ONFIGURACINES DEL CONEXIONES AL SEVIDOR 
$servidor="localhost";
$usuario_servidor="root";
$pass_servidor="";
$bd_servidor="dompdf";

$correoprincipal="jrojas@napo.gob.ec"; #para envios de administrador del sistema tales como recuperar contraseña
$tiempoexpira='+60 day'; #tiempo fijado para expirar la contraseña

$conectar=mysql_connect($servidor,$usuario_servidor,$pass_servidor);
mysql_select_db($bd_servidor, $conectar);
mysql_query("SET NAMES 'utf8'");

$mysql=mysql_query("select * from datos where id=2",$conectar)or die ("Error");
$fth=mysql_fetch_array($mysql);
$okok=$fth["datos"];
# Cargamos la librería dompdf.
require_once 'dompdf_config.inc.php';
 
# Contenido HTML del documento que queremos generar en PDF.
ob_start();
 ?>
 
 
<html>
<head>
  <style>
  body{text-align:justify}
    @page { margin: 236px 177px 236px 236px}
    #header { position: fixed; left: 0px; top: -230px; right: 0px; height: 200px;  border-bottom:4px solid rgba(16,39,176,1.00); text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -116px; right: 0px; height: 116px;
	border-top:2px solid rgba(0,0,0,1.00);
	 }
    #footer .page:after { content: "page " counter(page) " of " counter(pages); }
  </style>
<body>
  <div id="header"><br>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10"><img height="127" width="225" src="plantillas/logo.png"></td>
    <td><h3 align="center" style="margin:0px; padding:0px;"><?php echo $okok?></h3>
	<h2 align="center" style="margin:0px; padding:0px;"> PROVINCIAL DE NAPO</h2></td>
    
  </tr>
</table>
  
  </div>
  <div id="footer">
    <p class="page">Página </p>
  </div>
 
    <div >

  <div >

   
   

  </div>

</div>
	<div >

		<h1 align="center">Smooth Page Scrolling</h1>

		<ul>
		  <li>Scroll to Section Two</li>
		  <li>Scroll to Section Three</li>
		</ul>

		<h1 >Section One</h1>

		<p align="justify" style="background-image:rgba(102,187,191,1.00)">Pellentesq stue habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

	  <p style="background:url(plantillas/logoocapc.png)">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
        <table width="100%" border="1" rules="all" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="background:rgba(209,34,37,1.00);color:
    rgba(255,255,255,1.00)"><strong>nombres</strong></td>
    <td align="center"><strong>apellisos</strong></td>
    <td align="center"><strong>direccion</strong></td>
  </tr>
  <?php 
  for($r=0;$r<100;$r++)
  {
	  $total=$total+$r;
  ?>
  <tr>
    <td><?php echo "Item: ".$r;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  }
  ?>
  
    <tr>
    <td>TOTAL</td>
    <td><?=$total;?></td>
    <td>&nbsp;</td>
  </tr>
      </table>


		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h1 >Section Two</h1>


        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h1 >>Section Three</h1>

     
        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
		
	</div>

 
</body>
</html>
<?php 

$html = ob_get_clean();
 
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 # Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));


# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
 

 
# Renderizamos el documento PDF.
$mipdf ->render();
#$mipdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

// add the header numero de paginas
$canvas = $mipdf->get_canvas();
$font = Font_Metrics::get_font("Arial", "bold","italic");

// the same call as in my previous example
$canvas->page_text(512, 818, "Página {PAGE_NUM} de {PAGE_COUNT}",
                   $font, 8, array(0,0,0));
				   
#nombre de archivo				   
 $filename = "Archivo_genrado_".date("Y-n-j H_i_s").'.pdf';
# Enviamos el fichero PDF al navegador.
 #header('Content-type: application/pdf'); //Ésta es simplemente la cabecera para que el navegador interprete todo como un PDF
 

#$mipdf ->stream($filename,array('Attachment'=>0));
#$mipdf->stream("dompdf_out.pdf", array("Attachment" => false));

#para que se guarde en un lugar del servidor el archivo
#$output = $mipdf->output();
#file_put_contents($filename, $output); 

#para que se muestre en el mismo navegar
#$mipdf->stream($filename, array("Attachment" => false));


#para que se descarge 
$mipdf->stream($filename);

?>