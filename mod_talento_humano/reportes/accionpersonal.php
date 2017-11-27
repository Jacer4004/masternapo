<?php 
include_once("../../conf.php");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	
#buscar el cambiosolicitado
$id_buscado=$_REQUEST["cuota"];
$sqlcambio=mysql_query("SELECT concat_ws(' ',gad_personal.apellidos,gad_personal.nombres)as nomina, gad_personal.cedula,th_cambio_admin.* FROM th_cambio_admin 
INNER JOIN gad_personal on th_cambio_admin.id_personal=gad_personal.id_personal
where th_cambio_admin.id_cambio_adm='$id_buscado'",$conectar)or die("Error...".mysql_error());
$registro=mysql_fetch_array($sqlcambio);

#pdf

#ob_start();

##MPDF
require_once('../../mpdf/mpdf.php');
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ACCION DE PERSONAL</title>
<style>

.bordes {
    border-collapse: collapse;
    width: 100% !important;
}

.bordes th, bordes td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <td width="127" align="center" ><img src="../../img/logo2015.png" width="127" height="126"></td>
    <td width="714" align="center" >
    <h1 style="padding:0px; margin-bottom:0px; font-size:25px">Gobierno Autónomo Descentralizado Provincial de Napo</h1>
      <strong>      SUBDIRECCIÓN DE TALENTO HUMANO
      </strong>
    <h2>ACCIÓN DE PERSONAL N° <span style="color:red; border:1px solid rgba(255,0,0,1);padding:0px 10px 0px 10px; border-radius:3px;">&nbsp;&nbsp;<?php echo $registro["accion_n"];?>&nbsp;&nbsp;</span></h2>
    </td>
    <td width="105" align="center" ><img src="../../img/escudo_napo.png"></td>
  </tr>
  <tr>
    <td colspan="3">
    
    <table  width="950" class="bordes"  border="1"  style="border-left:none !important; border-right:none !important;" rules="all" cellspacing="0" cellpadding="8">
      <tr>
        <td align="center"><strong>Fecha de Elaboración: </strong><?php echo $registro["fecha_creacion"];?></td>
        <td align="center"><strong>Fecha que Rige: </strong><?php echo $registro["fecha_ini"]?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table class="bordes" width="950" rules="all" border="1" cellspacing="0" cellpadding="8" style="border-left:none !important; border-right:none !important">
      <tr>
        <td width="50%" align="center"><strong style="text-decoration:underline; text-transform:uppercase; font-size:20px"><?php echo $registro["nomina"]?></strong><br>
          <span style="font-size:12px !important;">Apellidos y Nombres</span></td>
        <td width="50%" align="center">
        <strong style="text-decoration:underline; font-size:20px"><?php echo $registro["cedula"]?></strong><br>
        <span style="font-size: 12px">Cédula de Ciudadanía</span></td>
      </tr>
    </table></td>
  </tr>
 
  <tr>
    <td colspan="3">
    
    <table class="bordes" width="950"  border="1" cellspacing="0" cellpadding="8" rules="all" style="border-left:none !important; border-right:none !important">
      <tr>
        <td colspan="2" align="center">
        <h2 style="margin:3px" align="center">EXPLICACIÓN</h2>
        </td>
        </tr>
      <tr>
        <td width="50%" valign="top"><strong>Motivo: <br>
        </strong >
        <?php echo $registro["motivo"]?>
        </td>
        <td width="50%" align="justify">
        <span style="text-transform:uppercase">
        <?php echo $registro["explicacion"];?>
        </span>
        </td>
      </tr>
    </table>
    
    </td>
  </tr>
  <tr>
    <td colspan="3"><table class="bordes" width="100%" border="1" cellspacing="0" cellpadding="8" rules="all" style="border-left:none !important; border-right:none !important">
      <tr>
        <td width="50%" align="center"><strong>SITUACIÓN ACTUAL</strong></td>
        <td width="50%" align="center"><strong>SITUACIÓN PROPUESTA</strong></td>
      </tr>
      <tr>
        <td><strong>Dirección o Departamento:</strong><?php echo $registro["ac_dependencia"]?></td>
        <td><strong>Dirección o Departamento:</strong><?php echo $registro["depe_nueva"]?></td>
        </tr>
      <tr>
        <td><strong>Denominación del puesto:</strong><?php echo $registro["ac_denominacion"];?></td>
        <td><strong>Denominación del puesto:</strong><?php echo $registro["denominacion_nuevo"]?></td>
        </tr>
      <tr>
        <td><strong>Lugar de Trabajo:</strong>TENA-PROVINCIA DE NAPO</td>
        <td><strong>Lugar de Trabajo:</strong>TENA-PROVINCIA DE NAPO</td>
        </tr>
      <tr>
        <td><strong>Remuneración Mensual Unificada USD:</strong><?php echo $registro["ac_rmu"];?></td>
        <td><strong>Remuneración Mensual Unificada USD:</strong><?php echo $registro["rmu_nuevo"]?></td>
        </tr>
      <tr>
        <td width="38%"><strong>Partida Presupuestaria General:</strong><?php echo $registro["ac_partida"]?></td>
        <td width="38%"><strong>Partida Presupuestaria General:</strong><?php echo $registro["partida_nuevo"]?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table class="bordes" width="950" style="border-left:none !important; border-right:none !important" border="1" cellpadding="8" cellspacing="0" rules="all" >
      <tr>
        <td><strong>REFERENCIA: <br>
        </strong><?php echo $registro["referencias"]?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table class="bordes" width="950" border="1" align="center" cellpadding="8" cellspacing="0" style="border-left:none !important; border-right:none !important">
      <tr>
        <td width="50%" align="center"><strong>SUBDIRECCIÓN DE TALENTO HUMANO<br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </strong>Ing. Zoraida Cabrera Vega<br>
        <strong>SUBDIRECTORA DE TALENTO HUMANO</strong></td>
        <td width="50%" align="center"><strong>PREFECTURA<br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </strong>Dr. Sergio  Enrique Chacon Padilla<br>
        <strong>PREFECTO PROVINCIAL </strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><table class="bordes" style="border-left:none !important; border-right:none !important" width="950" border="1" cellspacing="0" cellpadding="3" rules="all">
      <tr>
        <td colspan="3" align="center" width="100%"><strong>REGISTRO</strong></td>
        </tr>
      <tr>
        <td align="center">N°. ............................................. </td>
        <td align="center">Fecha: .........................................</td>
        <td align="center">Lcda. Palmira Paredes LL.<br>
          <strong>RESPONSABLE DE REGISTRO</strong></td>
      </tr>
  </table></td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
 
</table>

</body>
</html>

<?php 

$html = ob_get_clean();
$nombrearchivo="TH_AP_".$registro["accion_n"]."_".str_replace(" ","_",$registro["nomina"])."_".$registro["cedula"].".pdf";

$pie='<table class="bordes" style=" margin-left:10px; font-size:12px; margin-top:6px; margin-bottom:6px; " width="350" border="1" cellspacing="0" cellpadding="0" rules="all">
          <tr>
            <td width="220" height="20">Elabrado por Lcda. Palmira Paredes</td>
            <td width="130">&nbsp;</td>
          </tr>
          <tr>
            <td>Revisado por Ing. Zoraida Cabrera V.</td>
            <td>&nbsp;</td>
          </tr>
    </table>
	<img style="float:right; margin-top:-70px; height:80px;width:80px " src="../../../masternapo/plantillas/qrcode.png" >
<span style="font-size:12px">Página {nb} de {nbpg}</span><br>
';
 
// Define a document with default left-margin=30 and right-margin=10
$mpdf=new mPDF('','A4', 0, '', 30,15,5,15,'',10);
#$mpdf->SetHTMLHeader($cabecera);
$mpdf->SetHTMLFooter($pie);
$mpdf->WriteHTML($html);
$mpdf->Output($nombrearchivo,'D'); #modos de salida
#F
#I
#S
#D descargar

?>

<?php 
}
else
{
	header('Location: ../');
}
?>