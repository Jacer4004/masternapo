 <?php 
include_once("../conf.php");
function CalculaEdad_f( $fecha_nc ) {
    list($Y,$m,$d) = explode("-",$fecha_nc);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

$perslid=$_REQUEST["personalcargado"];

$sqlacademia=mysql_query("select * from gad_personal where id_personal='$perslid'",$conectar);
$regpersacademia=mysql_fetch_array($sqlacademia);

if($_REQUEST["valblock"]==true and $_REQUEST["variable"]<>"")
{
	$aleiminart=$_REQUEST["variable"];
	mysql_query("DELETE FROM gad_hijos WHERE id_hijos = '$aleiminart'",$conectar)or die("Error.");
	
	$_GET['avisomensaje']='Se ha Eliminado el registro de capacitación';
	 $_GET['avisotipo']='rojo';
	 $_GET['automatico']='si';
	 include("../ventanas_avisos.php");
}
else
{
if($_REQUEST["activate"]==true)
{
	#guarda o actualiza

	$id_hijos=$_REQUEST["id_hijos"];
	$id_personal=$_REQUEST["personalcargado"];
	$parentesco=$_REQUEST["parentesco"];
	$cedula_h=$_REQUEST["cedula_h"];
	$genero_h=$_REQUEST["genero_h"];
	$apellidos_h=$_REQUEST["apellidos_h"];
	$nombres_h=$_REQUEST["nombres_h"];
	$f_nacimiento_h=$_REQUEST["f_nacimiento_h"];
	$nivelinstruc_h=$_REQUEST["nivelinstruc_h"];


	/*$nuevo_ingreso=mysql_query("select numeroregistro from gad_academico where numeroregistro='$numeroregistro'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	if((mysql_num_rows($nuevo_ingreso)>0 and $_POST['id_academico']==""))
	{
		$_GET['avisomensaje']='Ya existe un registro con ese número';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../ventanas_avisos.php");
	}
	else
	{*/#NO SE VALIDA DUPLICIDAD
			
		$mysqlinsert=mysql_query("
		INSERT INTO gad_hijos (
		id_hijos,
		id_personal,
		parentesco,
		cedula_h,
		genero_h,
		apellidos_h,
		nombres_h,
		f_nacimiento_h,
		nivelinstruc_h)
VALUES (
'$id_hijos',
'$id_personal',
'$parentesco',
'$cedula_h',
'$genero_h',
'$apellidos_h',
'$nombres_h',
'$f_nacimiento_h',
'$nivelinstruc_h')		
ON DUPLICATE KEY UPDATE
parentesco='$parentesco',
cedula_h='$cedula_h',
genero_h='$genero_h',
apellidos_h='$apellidos_h',
nombres_h='$nombres_h',
f_nacimiento_h='$f_nacimiento_h',
nivelinstruc_h='$nivelinstruc_h'
")or die("Error: ".mysql_error());
		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../ventanas_avisos.php");
	
		
}
else
{
	#solo muestra
}
}
?>


<table  width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" style="padding:5px"><h2 align="center">
     <?php echo $regpersacademia["tratamiento"]." ".$regpersacademia["nombres"]." ".$regpersacademia["apellidos"]?> 
     </h2>
</td>
    </tr>
  <tr>
    <td>
    
    <div id="nuevotitulo" style="display:none">
    	<form name="frmnuevotitulo" id="frmnuevotitulo" class="formularios">
        <input type="hidden" name="id_hijos" id="id_hijos" value="">
        <input type="hidden" name="personalcargado" id="personalcargado" value="<?php echo $perslid;?> ">
       
        <table width="" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
    <td width="25%" align="right" valign="top"><strong>* Parentezco:</strong></td>
    <td width="75%"><select name="parentesco" id="parentesco" style="max-width:220px">
      <option value="">.:Seleccione:.</option>
          <option value="Hijos">Hijos</option>
          <option value="Nietos">Nietos</option>
          <option value="Padres">Padres</option>
          <option value="Hermanos">Hermanos</option>
          <option value="Sobrinos">Sobrinos</option> 
    </select>
    
    </td>
  </tr>
  <tr>
    <td width="25%" align="right" valign="top"><strong>* Cédula:</strong></td>
    <td width="75%"><input type="text" name="cedula_h" class="caja_textos" id="cedula_h"  required onBlur="validar_cedula('#cedula_h','#errorcedula')"  maxlength="10" value="<?php echo $regpersonaldata["cedula"]?>"  onkeypress="return soloNumerosm1(event)">
    <span id="errorcedula" style="color:red; display:none"><br>
Cédula Incorrecta</span>
    </td>
  </tr>
  <tr>
    <td width="25%" align="right" valign="top"><strong>* Genero:</strong></td>
    <td width="75%"><select name="genero_h" id="genero_h" style="max-width:220px">
      <option value="">.:Seleccione:.</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
    </select>
    
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>*  Apellidos:</strong></td>
    <td><input type="text" class="requerido" id="apellidos_h" name="apellidos_h" size="40" title="Apellidos" required  onBlur="$('#apellidos_h').val(ucFirstAllWords($('#apellidos_h').val()))"></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>*Nombres:</strong></td>
    <td><input type="text" name="nombres_h" id="nombres_h" size="40" class="requerido" required  onBlur="$('#nombres_h').val(ucFirstAllWords($('#nombres_h').val()))"></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Fecha de Nacimiento:</strong></td>
    <td><input name="f_nacimiento_h"  id="f_nacimiento_h" type="text" value="" readonly></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Nivel de Instrucción:</strong></td>
    <td> <select name="nivelinstruc_h" id="nivelinstruc_h">
    	<option value="Sin Instrucción">Sin Instrucción</option>
        <option value="Educación Inicial">Educación Inicial</option>
        <option value="Educación Básica">Educación Básica</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="Técnico Técnológico">Técnico Técnológico</option>
        <option value="Tercer Nivel">Tercer Nivel</option>
        <option value="Cuarto Nivel">Cuarto Nivel</option>
    </select>
    
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <a href="#" class="btn_azul" onClick="guarda_titulo_p()">Guardar</a>&nbsp;&nbsp;<a href="#" onClick="cerrar_abrir('nuevotitulo','tituloscontenidos')"  class="btn_rojo">Cancelar</a>
<br>
    </td>
    </tr>
</table>

        </form>
    </div>
    
    <div id="tituloscontenidos" style="text-align:center !important;" align="center">
    <table width="" border="0" align="center" cellpadding="3" cellspacing="0" class="tabla_jre" style="font-size:14px; margin:12px;" >
    <thead>
  <tr>
    <th width="75" align="center"><strong>&nbsp;</strong></th>
    <th align="center"><strong>PARENTESCO</strong></th>
    <th align="center"><strong>CÉDULA</strong></th>
    <th align="center"><strong>GENERO</strong></th>
    <th align="center"><strong>APELLIDOS Y NOMBRES</strong></th>
    <th align="center"><strong>FECHA DE NACIMIENTO</strong></th>
    <th align="center"><strong>EDAD</strong></th> 
    <th align="center"><strong>NIVEL DE INSTRUCCIÓN</strong></th>    
    </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryexperiencia=mysql_query("select concat_ws('.*.',id_hijos,
parentesco,
cedula_h,
genero_h,
apellidos_h,
nombres_h,
f_nacimiento_h,
nivelinstruc_h) as todos,gad_hijos.* from gad_hijos where id_personal='$perslid'",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td align="center">
     <a href="javascript:void()" onClick="editar_titulos('<?php echo $regexperiencia["todos"]?>')" class="imgboton tooltipjrojas"><span>Editar</span><img src="imag/pencil2.png" style="vertical-align:middle"></a>
     
     <a href="javascript:void()" onClick="ventana_eliminar('<?php echo $regexperiencia["id_hijos"]?>')" class="imgboton tooltipjrojas"><span>Eliminar</span><img src="imag/binb.png" style="vertical-align:middle"></a>
     
     </td>
    <td><?php echo $regexperiencia["parentesco"]?></td>
    <td><?php echo $regexperiencia["cedula_h"]?></td>
    <td><?php echo $regexperiencia["genero_h"]?></td>
    <td align="left"><?php echo $regexperiencia["apellidos_h"]." ".$regexperiencia["nombres_h"]?></td>
    <td><?php echo $regexperiencia["f_nacimiento_h"]?></td>
    <td><?php echo CalculaEdad_f($regexperiencia["f_nacimiento_h"])." Años"?></td>
    <td><?php echo $regexperiencia["nivelinstruc_h"]?></td>
    </tr>
    <?php 
	}
	?>
</table>
</div>
<br>
    </td>
    </tr>
</table>
<!--ELIMINAR-->
<div id="eliminaracademico" class="emergentepadre">
	<div class="emergentehijo" style="background:rgba(255,255,255,1.00); min-height:200px; min-width:350px">
    <h4 align="center" id="color_red" style="margin:0px; color:rgba(255,255,255,1.00); padding:2px">Eliminar Título Académico</h4>
    <input type="hidden" name="idtituloeliminar"  id="idtituloeliminar" value="">
    <p align="center" style="padding:10px;" >Está seguro que desea Eliminar este Registro?.<strong><span id="dsitribubloquear"></span></strong>.<br>
Una vez eliminado no se podrá recuperar. </p>
    <div align="center" style="text-align:center !important">
    <a href="javascript:void()" onClick="envia_eliminar()" class="btn_azul" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a href="javascript:void()" onClick="$('#eliminaracademico').fadeOut(800);$('#idtituloeliminar').val('');" class="btn_rojo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>
<br>

    </div>
    </div>
</div>
<!--ACABA ELIMINAR-->
<script>
 // calnedario bootstrap
            $(document).ready(function () {
                
                $('#f_nacimiento_h').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
				  
            });
			

function envia_eliminar()
{	
	var filedis='mod_talento_humano/mostrar_familiares.php';
	var obje="#titulos_academicos";
	var aeliminar=$('#idtituloeliminar').val();
	
	$(obje).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');//id del select

	$.post(filedis, {variable: aeliminar,valblock:'true',personalcargado:'<?php echo $perslid;?>'}, function(data){
	$(obje).html(data);
	});			
}
function ventana_eliminar(vardelete)
{
	$('#idtituloeliminar').val("");
	
	$('#eliminaracademico').fadeIn(800);
	$('#idtituloeliminar').val(vardelete);
	
}

function editar_titulos(datoseditar)
{
	cerrar_abrir('tituloscontenidos','nuevotitulo');
	var string = datoseditar;
var array = string.split(".*.");
$('#id_hijos').val(array[0]);
$('#parentesco').val(array[1]);
$('#cedula_h').val(array[2]);
$('#genero_h').val(array[3]);
$('#apellidos_h').val(array[4]);
$('#nombres_h').val(array[5]);
$('#f_nacimiento_h').val(array[6]);
$('#nivelinstruc_h').val(array[7]);
}

 function guarda_titulo_p()
 {
	 /**validar antes de guardar**/
	 $('#apellidos_h').val($.trim($('#apellidos_h').val()));
	 $('#nombres_h').val($.trim($('#nombres_h').val()));
	
	 
	 if($('#parentesco').val()!='' && $('#cedula_h').val().length>=3 && $('#genero_h').val()!='' && $('#apellidos_h').val().length>=1 && $('#nombres_h').val().length>=3)
	 {
	 
	 
	  /**guardar*
 	cerrar_abrir('nuevo_personal','funcionarios_load');*/
	cargardiv_form('mod_talento_humano/mostrar_familiares.php','#titulos_academicos','#frmnuevotitulo')
	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
</script>