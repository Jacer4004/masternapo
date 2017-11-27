<?php 
$excepcion=true;
include_once("../conf.php");
$id_empleado=$_REQUEST["var"];
$sqlreporte=mysql_query("select * from gad_personal 
left join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where id_personal='$id_empleado'",$conectar)or dier("Error");
$regreporte=mysql_fetch_array($sqlreporte);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ficha de Personal</title>
<style>
	p{margin:0px; padding:0px;  padding-top:10px; margin-left:7px; margin-bottom:10px; font-size:13px }
	strong
	{
		margin-bottom:0px !important;
		padding-bottom:0px; 
		margin:7px; 
		font-style:oblique  !important; 
		
		color:rgba(0,0,0,1.00);
	}
	
	@page {
  size: A4 portrait;
  margin-top: 1cm;
 margin-right: 1cm;
 margin-left:3cm;
}
	
	@media print 
	{
		.datosper{background-color:	gba(216,213,213,1.00);
		
	}

	}
	
</style>
</head>

<body>
<div style="font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="594" valign="bottom"><span style="font-weight:bold">COD: <?php echo $regreporte["cedula"]?></span></td>
    <td width="106" height="128" rowspan="2" style="border-bottom:3px double rgba(21,98,39,1.00)"><img style="border-radius:5px" src="<?php if($regreporte["codigoempleado"]==""){echo "../imag/usuario2.gif";}else{echo $base.$regreporte["fotografia"];}?>" width="106" height="128"></td>
  </tr>
  <tr>
    <td valign="bottom" style="border-bottom:3px  double rgba(21,98,39,1.00)"><H1 style="padding-bottom:0px; margin-bottom:0px; color:rgba(21,98,39,1.00); text-transform:uppercase"><?php echo $regreporte["nombres"]." ".$regreporte["apellidos"]?></H1>
    <h3 style="margin:0px; padding:0px; text-transform:uppercase"><?php echo $regreporte["nombre"]?></h3>
</td>
  </tr>
  <tr>
    <td colspan="2">
    <h3 class="datosper" style="background-color:rgba(216,213,213,1.00); vertical-align:middle; padding:5px; border-radius:5px;">      DATOS PERSONALES</h3>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    
    <table rules="rows" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="405" height="0" valign="top">
        <strong>Apellidos</strong>
          <p><?php echo $regreporte["apellidos"]?></p></td>
        <td width="211" height="0" valign="top">
        <strong>Nombres</strong>
          <p><?php echo $regreporte["nombres"]?></p></td>
      </tr>
      <tr>
        <td width="405" height="0" valign="top"><strong>Cédula de  Ciudadanía </strong>
          <p><?php echo $regreporte["cedula"]?></p></td>
        <td width="211" height="0" valign="top">
        <strong>Genero</strong>
        <p><?php echo $regreporte["genero"]?></p></td>
      </tr>
      <tr>
        <td width="405" height="0" valign="top">
        <strong>Fecha de Nacimiento </strong>
        <p><?php echo $regreporte["fecha_naci"]?></p></td>
        <td width="211" height="0" valign="top">
        <strong>Estado Civil </strong>
        <p><?php echo $regreporte["estadocivil"]?></p></td>
      </tr>
      <tr>
        <td width="405" height="0" valign="top">
        <strong>Dirección    Domiciliaria</strong>
        	
          <p style="font-size:13px">
          <strong>PROVINCIA:</strong><?php echo $regreporte["provinciadomic"]?>&nbsp;<strong>CANTÓN:</strong><?php echo $regreporte["cantondomic"]?>&nbsp;<strong>PARROQUIA:</strong><?php echo $regreporte["parroquiadomic"]?><br>
          <strong>CALLE PRINCIPAL:</strong><?php echo $regreporte["dir_domicilio_gp"]?> &nbsp;<strong>CALLE SECUNDARIA:</strong><?php echo $regreporte["callesecundaria"]?><br>
          <strong>CASA N°-:</strong><?php echo $regreporte["ncasa"]?><br>
</p></td>
        <td width="211" height="0" valign="top"><strong>Correo</strong>
          <p><?php echo $regreporte["correo"]?></p></td>
      </tr>
      <tr>
        <td width="405" height="0" valign="top">
        <strong>Nacionalidad</strong>
          <p><?php echo $regreporte["nacionalidad"]?></p>
          </td>
        <td width="211" height="0" valign="top"><strong>Tipo de    Sangre</strong>
          <p><?php echo $regreporte["tiposangre"]?></p></td>
      </tr>
      <tr>
        <td height="0" colspan="2" valign="top"><strong>Teléfonos</strong>          
        <p><?php
		list($movi,$claro,$cnt)=explode(":",$regreporte["movil_per_gp"]);
		 echo $regreporte["telfcasa_gp"]."&nbsp;&nbsp; ".$movi."&nbsp;&nbsp;&nbsp;".$claro."&nbsp;&nbsp;&nbsp;".$cnt;?></p>
          </td>
        </tr>
        <tr>
          <td height="0" colspan="2" valign="top"><strong>Número de Afiliación al Seguro</strong>
          <p><?php echo $regreporte["nafiliacion"]?></p>
          </td>
        </tr>
        <tr>
          <td height="0" colspan="2" valign="top">
          <strong>Contacto en caso de Emergencia:</strong>
          <p><strong>Nombres: </strong><?php echo $regreporte["nombreemergencia"]?>
          <br>
			<strong>Teléfono: </strong><?php echo $regreporte["telefonoemergencia"]?>
</p>
          </td>
        </tr>
        <tr>
        <td height="0" colspan="2" valign="top">
          <strong>Observaciones</strong>
          <p><?php echo $regreporte["otros"]?></p>
          </td>
        </tr>
    </table>
    <tr>
    <td colspan="2">
    <h3 class="datosper" style="background-color:rgba(216,213,213,1.00); vertical-align:middle; padding:5px; border-radius:5px;">COMPOSICIÓN FAMILIAR</h3>
    </td>
  </tr>
  <tr>
        <td height="0" colspan="2" valign="top">
          <strong>Conyugue:</strong></strong>
          <p><strong>Nombres: </strong><?php echo $regreporte["nombresconyuge"]." ".$regreporte["apellidosconyugue"]?><br>
			<strong>Cédula: </strong><?php echo $regreporte["cedulaconyuge"];?><strong>&nbsp; |&nbsp;&nbsp; Teléfono: </strong><?php echo $regreporte["telefonosconyuge"];?>
			</p>
          
          </td>
    </tr>
 <tr>
    <td colspan="2">
    <table width="" border="1" rules="all" align="center" cellpadding="5" cellspacing="0" class="tabla_jre" style="font-size:13px; margin:0px; position:relative">
    <thead>
  <tr>
    <th align="center"><strong>PARENTESCO</strong></th>
    <th align="center"><strong>CÉDULA</strong></th>
    <th align="center"><strong>GÉNERO</strong></th>
    <th align="center"><strong>APELLIDOS Y NOMBRES</strong></th>
    <th align="center"><strong>FECHA DE NACIMIENTO</strong></th>
    <th align="center"><strong>NIVEL DE INSTRUCCIÓN</strong></th>
    
  </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryhijos=mysql_query("select gad_hijos.* from gad_hijos where id_personal='$id_empleado'",$conectar);
	while($regehijos=mysql_fetch_array($queryhijos))
	{
		
	?>
  <tr>
    <td><?php echo $regehijos["parentesco"];?></td>
    <td><?php echo $regehijos["cedula_h"];?></td>
    <td><?php echo $regehijos["genero_h"];?></td>
    <td><?php echo $regehijos["apellidos_h"]." ".$regehijos["nombres_h"];?></td>
    <td><?php echo $regehijos["f_nacimiento_h"];?></td>
    <td><?php echo $regehijos["nivelinstruc_h"];?></td>
    
    </tr>
    <?php 
	}
	?>
</table>
    </td>
  </tr> 
    <tr>
    <td colspan="2">
    <h3 class="datosper" style="background-color:rgba(216,213,213,1.00); vertical-align:middle; padding:5px; border-radius:5px;">FORMACIÓN ACADÉMICA</h3>
    </td>
  </tr>
  
  
  
  <tr>
    <td  colspan="2">
    <table width="" border="1" rules="all" align="center" cellpadding="5" cellspacing="0" class="tabla_jre" style="font-size:13px; margin:0px; position:relative">
    <thead>
  <tr>
    <th align="center"><strong>NIVEL</strong></th>
    <th align="center"><strong>TÍTULO</strong></th>
    <th align="center"><strong>INSTITUCIÓN DE EDUCACIÓN SUPERIOR</strong></th>
    <th align="center"><strong>NÚMERO DE REGISTRO</strong></th>
    <th align="center"><strong>ÁREA DE CONOCIMIENTO</strong></th>
    <th align="center"><strong>AÑOS DE ESTUDIO</strong></th>
    <th align="center"><strong>PAÍS</strong></th>
    <th align="center"><strong>OBSERVACIONES</strong></th>
    </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryexperiencia=mysql_query("select gad_academico.* from gad_academico where id_personal='$id_empleado'",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td><?php echo $regexperiencia["tipo_titulo"]?></td>
    <td><?php echo $regexperiencia["titulo"]?></td>
    <td><?php echo $regexperiencia["institucion"]?></td>
    <td><?php echo $regexperiencia["numeroregistro"]?></td>
    <td><?php echo $regexperiencia["areaconocimiento"]?></td>
    <td align="center" valign="middle"><?php echo $regexperiencia["anios"]?></td>
    <td ><?php echo $regexperiencia["pais"]?></td>
    <td><?php echo $regexperiencia["observaciones"];?></td>
    </tr>
    <?php 
	}
	?>
</table>
    
    
    </td>
  </tr>
   <tr>
    <td colspan="2">
    <h3 class="datosper" style="background-color:rgba(216,213,213,1.00); vertical-align:middle; padding:5px; border-radius:5px;">      EXPERIENCIA LABORAL</h3>
    </td>
  </tr>
  
  <tr>
    <td colspan="2">
    
    <table width="" border="1" rules="all" align="center" cellpadding="5" cellspacing="0" class="tabla_jre" style="font-size:13px; margin:0px;  position:relative" >
    <thead>
  <tr>
    <th align="center"><strong>INSTITUCIÓN</strong></th>
    <th align="center"><strong>UNIDAD ADMINISTRATIVA</strong></th>
    <th align="center"><strong>DENOMINACIÓN DEL PUESTO</strong></th>
    <th align="center"><strong>INGRESO POR</strong></th>
    <th align="center"><strong>MOTIVO DE SALIDA</strong></th>
    <th align="center"><strong>F.INGRESO<br>
    F.SALIDA</strong></th>
    <th align="center"><strong>ACTIVIDADES</strong></th>
    </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryexperiencia=mysql_query("select gad_tray_laboral.* from gad_tray_laboral where id_personal='$id_empleado'",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td><?php echo $regexperiencia["institucion"]?></td>
    <td><?php echo $regexperiencia["unidadadmin"]?></td>
    <td style="text-transform:uppercase"><?php echo $regexperiencia["denonpuesto"]?></td>
    <td><?php echo $regexperiencia["ingresopor"]?></td>
    <td><?php echo $regexperiencia["motivosalida"]?></td>
    <td><?php echo $regexperiencia["fingreso"]."<br>".$regexperiencia["fsalida"]?></td>
    <td>
	 <ul style="margin:0px; padding-left:12px; list-style:square">
	<?php 
	$actividadesexp = explode(";", $regexperiencia["actividades"]);
	for($r=0;$r<count($actividadesexp);$r++)
	{
	echo "<li>".$actividadesexp[$r]."</li>";
	}
	?>
    </ul>
	
	</td>
    </tr>
    <?php 
	}
	?>
</table>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    <h3 class="datosper" style="background-color:rgba(216,213,213,1.00); vertical-align:middle; padding:5px; border-radius:5px;"> CURSOS DE CAPACITACIÓN   </h3>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    <table width="" border="1" rules="all" align="center" cellpadding="5" cellspacing="0" class="tabla_jre" style="font-size:13px; margin:0px;  position:relative" >
    <thead>
  <tr>
    
    <th align="center"><strong>EVENTO</strong></th>
    <th align="center"><strong>TIPO</strong></th>
    <th align="center"><strong>AUSPICIANTE</strong></th>
    <th align="center"><strong>DURACIÓN</strong></th>
    <th align="center"><strong>TIPO DE CETIFICADO</strong></th>
    <th align="center"><strong>F.INICIO<br>
    F.TERMINACIÓN</strong></th>
    <th align="center"><strong>PAÍS</strong></th>
    </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryexperiencia=mysql_query("select gad_capacitaciones.* from gad_capacitaciones where id_personal='$id_empleado'
	ORDER BY f_inicio DESC
	",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td><?php echo $regexperiencia["evento"]?></td>
    <td><?php echo $regexperiencia["tipoevento"]?></td>
    <td><?php echo $regexperiencia["auspiciante"]?></td>
    <td><?php echo $regexperiencia["duracion"]?></td>
    <td><?php echo $regexperiencia["tipocertificado"]?></td>
    <td><?php echo $regexperiencia["f_inicio"]."<br>".$regexperiencia["f_terminacion"]?></td>
    <td><?php echo $regexperiencia["pais"]?></td>
    </tr>
    <?php 
	}
	?>
</table>
    </td>
  </tr>
    
    </td>
  </tr>
   <tr>
    <td colspan="2">&nbsp;
    
    </td>
  </tr>
  <tr>
    <td colspan="2" align="right"><br>

    <?php 
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

echo "Tena, ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; ?>
    
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;<br>
<br>
<br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
f..............................................................<strong><br>

    RESPONSABLE DE TALENTO HUMANO
    </strong></td>
    <td align="center">f..............................................................<strong><br>

    FUNCIONARIO DEL GADPNAPO
    </strong></td>
  </tr>
</table>

    </td>
  </tr>
  
</table><br>
<br>
<br>

</div>
</body>
</html>