 <?php 
include_once("../conf.php");

$perslid=$_REQUEST["personalcargado"];

$sqlacademia=mysql_query("select * from gad_personal where id_personal='$perslid'",$conectar);
$regpersacademia=mysql_fetch_array($sqlacademia);

if($_REQUEST["valblock"]==true and $_REQUEST["variable"]<>"")
{
	$aleiminart=$_REQUEST["variable"];
	mysql_query("DELETE FROM gad_academico WHERE id_academico = '$aleiminart'",$conectar)or die("Error.");
	
	$_GET['avisomensaje']='Se ha Eliminado un título académico';
	 $_GET['avisotipo']='rojo';
	 $_GET['automatico']='si';
	 include("../ventanas_avisos.php");
}
else
{
if($_REQUEST["activate"]==true)
{
	#guarda o actualiza
	
	$id_academico=$_REQUEST["id_academico"];
	$id_personal=$_REQUEST["personalcargado"];
	$tipo_titulo=$_REQUEST["tipo_titulo"];
	$titulo=$_REQUEST["titulo"];
	$institucion=$_REQUEST["institucion"];
	$numeroregistro=$_REQUEST["numeroregistro"];
	$observaciones=$_REQUEST["observaciones"];
	$areaconocimiento=$_REQUEST["areaconocimiento"];
	$anios=$_REQUEST["anioestudio"];
	$pais=$_REQUEST["pais"];

	$nuevo_ingreso=mysql_query("select numeroregistro from gad_academico where numeroregistro='$numeroregistro'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	if(mysql_num_rows($nuevo_ingreso)>0 and $_POST['id_academico']=="" and $numeroregistro!="")
	{
		$_GET['avisomensaje']='Ya existe un registro con ese número';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../ventanas_avisos.php");
	}
	else
	{
			
		$mysqlinsert=mysql_query("
		INSERT INTO gad_academico (
		id_academico,
		id_personal,
		tipo_titulo,
		titulo,
		institucion,
		numeroregistro,
		observaciones,
		areaconocimiento,
		anios,
		pais)
VALUES (
'$id_academico',
'$id_personal',
'$tipo_titulo',
'$titulo',
'$institucion',
'$numeroregistro',
'$observaciones',
'$areaconocimiento',
'$anios',
'$pais')		
ON DUPLICATE KEY UPDATE
tipo_titulo='$tipo_titulo',
titulo='$titulo',
institucion='$institucion',
numeroregistro='$numeroregistro',
observaciones='$observaciones',
areaconocimiento='$areaconocimiento',
		anios='$anios',
		pais='$pais'")or die("Error: ".mysql_error());
		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../ventanas_avisos.php");
	}
		
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
       
        <input type="hidden" name="id_academico" id="id_academico" value="">
        <input type="hidden" name="personalcargado" id="personalcargado" value="<?php echo $perslid;?> ">
       
        <table width="" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%" align="right"><strong>* Nivel de Instrucción:</strong></td>
    <td width="75%"> 
    <select name="tipo_titulo" id="tipo_titulo">
    	<option value="">.:Seleccione:.</option>
        <option value="Bachillerato">Bachillerato</option>
        <option value="Técnico Técnológico">Técnico Técnológico</option>
        <option value="Tercer Nivel">Tercer Nivel</option>
        <option value="Cuarto Nivel">Cuarto Nivel</option>
    </select>
    </td>
  </tr>
  <tr>
    <td width="25%" align="right"><strong>* Título Académico:</strong></td>
    <td width="75%">
    <textarea name="titulo"  id="titulo" type="text" value="sssssss" style="width:200px"></textarea> </td>
  </tr>
  <tr>
    <td align="right"><strong>* Institución Educativa:</strong></td>
    <td>
    
    <textarea name="institucion"  id="institucion" type="text" style="width:200px" size="40" ></textarea></td>
  </tr>
  <tr>
    <td align="right"><strong>Área de Conocimiento:</strong></td>
    <td><input name="areaconocimiento"  id="areaconocimiento" type="text" value="" onBlur="$('#areaconocimiento').val(ucFirstAllWords($('#areaconocimiento').val()))" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Número de Registro:</strong></td>
    <td><input name="numeroregistro"  id="numeroregistro" type="text" value="" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Años de Estudio:</strong></td>
    <td><input name="anioestudio" size="2" maxlength="2"  id="anioestudio" type="text" value="" onkeypress="return soloNumerosm1(event)" ></td>
  </tr>
  <tr>
    <td align="right"><strong>País:</strong></td>
    <td><input name="pais"  id="pais" type="text" value="" onBlur="$('#pais').val(ucFirstAllWords($('#pais').val()))"></td>
  </tr>
  <tr>
    <td align="right"><strong>Observaciones:</strong></td>
    <td>
    <textarea name="observaciones" style="width:200px" id="observaciones"></textarea>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <a href="#" class="btn_azul" onClick="guarda_titulo_Ac()">Guardar</a>&nbsp;&nbsp;<a href="#" onClick="cerrar_abrir('nuevotitulo','tituloscontenidos')"  class="btn_rojo">Cancelar</a>
<br>
    </td>
    </tr>
</table>

        </form>
    </div>
    
    <div id="tituloscontenidos">
    <table width="" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla_jre" style="font-size:14px; margin:12px;  position:relative">
    <thead>
  <tr>
    <th width="75" align="center"><strong>&nbsp;</strong></th>
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
	$queryexperiencia=mysql_query("select concat_ws('.*.',id_academico,tipo_titulo,titulo,institucion,numeroregistro,observaciones,areaconocimiento,anios,pais) as todos,gad_academico.* from gad_academico where id_personal='$perslid'",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td align="center">
     <a href="javascript:void()" onClick="editar_titulos('<?php echo $regexperiencia["todos"]?>')" class="imgboton tooltipjrojas"><span>Editar</span><img src="imag/pencil2.png" style="vertical-align:middle"></a>
     
     <a href="javascript:void()" onClick="ventana_eliminar('<?php echo $regexperiencia["id_academico"]?>')" class="imgboton tooltipjrojas"><span>Eliminar</span><img src="imag/binb.png" style="vertical-align:middle"></a>
     
     </td>
    <td><?php echo $regexperiencia["tipo_titulo"]?></td>
    <td><?php echo $regexperiencia["titulo"]?></td>
    <td><?php echo $regexperiencia["institucion"]?></td>
    <td><?php echo $regexperiencia["numeroregistro"]?></td>
    <td><?php echo $regexperiencia["areaconocimiento"]?></td>
    <td><?php echo $regexperiencia["anios"]?></td>
    <td><?php echo $regexperiencia["pais"]?></td>
    <td><?php echo $regexperiencia["observaciones"];?></td>
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
    <p align="center" style="padding:10px;" >Está seguro que desea Eliminar el Título Académico?.<strong><span id="dsitribubloquear"></span></strong>.<br>
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

function envia_eliminar()
{	
	var filedis='mod_talento_humano/mostrar_titulo.php';
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
$('#id_academico').val(array[0]);
$('#tipo_titulo').val(array[1]);
$('#titulo').val(array[2]);
$('#institucion').val(array[3]);
$('#numeroregistro').val(array[4]);
$('#observaciones').val(array[5]);
$('#areaconocimiento').val(array[6]);
$('#anioestudio').val(array[7]);
$('#pais').val(array[8]);

}
 function guarda_titulo_Ac()
 {
	 /**validar antes de guardar**/
	 $('#titulo').val($.trim($('#titulo').val()));
	 $('#institucion').val($.trim($('#institucion').val()));
	 
	 if($('#tipo_titulo').val()!='' && $('#titulo').val().length>3 && $('#institucion').val().length>3)
	 {
	 
	 
	  /**guardar*
 	cerrar_abrir('nuevo_personal','funcionarios_load');*/
	cargardiv_form('mod_talento_humano/mostrar_titulo.php','#titulos_academicos','#frmnuevotitulo')
	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
</script>