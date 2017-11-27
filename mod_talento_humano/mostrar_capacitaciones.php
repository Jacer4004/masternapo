 <?php 
include_once("../conf.php");

$perslid=$_REQUEST["personalcargado"];

$sqlacademia=mysql_query("select * from gad_personal where id_personal='$perslid'",$conectar);
$regpersacademia=mysql_fetch_array($sqlacademia);

if($_REQUEST["valblock"]==true and $_REQUEST["variable"]<>"")
{
	$aleiminart=$_REQUEST["variable"];
	mysql_query("DELETE FROM gad_capacitaciones WHERE id_capacitaciones = '$aleiminart'",$conectar)or die("Error.");
	
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
	$id_capacitaciones=$_REQUEST["id_capacitaciones"];
	$id_personal=$_REQUEST["personalcargado"];
	$evento=$_REQUEST["evento"];
	$tipoevento=$_REQUEST["tipoevento"];
	$auspiciante=$_REQUEST["auspiciante"];
	$duracion=$_REQUEST["duracion"];
	$tipocertificado=$_REQUEST["tipocertificado"];
	$f_inicio=$_REQUEST["f_inicio"];
	$f_terminacion=$_REQUEST["f_terminacion"];
	$pais=$_REQUEST["pais"];

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
		INSERT INTO gad_capacitaciones (
		id_capacitaciones,
		id_personal,
		evento,
		tipoevento,
		auspiciante,
		duracion,
		tipocertificado,
		f_inicio,
		f_terminacion,
		pais)
VALUES (
'$id_capacitaciones',
'$id_personal',
'$evento',
'$tipoevento',
'$auspiciante',
'$duracion',
'$tipocertificado',
'$f_inicio',
'$f_terminacion',
'$pais')		
ON DUPLICATE KEY UPDATE
evento='$evento',
tipoevento='$tipoevento',
auspiciante='$auspiciante',
duracion='$duracion',
tipocertificado='$tipocertificado',
f_inicio='$f_inicio',
f_terminacion='$f_terminacion',
pais='$pais'
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
       
        <input type="hidden" name="id_capacitaciones" id="id_capacitaciones" value="">
        <input type="hidden" name="personalcargado" id="personalcargado" value="<?php echo $perslid;?> ">
       
        <table width="" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%" align="right" valign="top"><strong>* Evento:</strong></td>
    <td width="75%"><textarea name="evento"  id="evento" type="text" style="width:250px" size="50" ></textarea></td>
  </tr>
  <tr>
    <td width="25%" align="right" valign="top"><strong>* Tipo de Evento:</strong></td>
    <td width="75%"><select name="tipoevento" id="tipoevento" style="max-width:220px">
      <option value="">.:Seleccione:.</option>
      <?php 
		$mysqltipoevento=mysql_query("SELECT * FROM gad_tipoeventocap order by tipoevento",$conectar);
		while($regtipoevento=mysql_fetch_array($mysqltipoevento))
		{
		?>
      <option value="<?=$regtipoevento["tipoevento"]?>">
        <?=$regtipoevento["tipoevento"]?>
        </option>
      <?php 
		}
		?>
    </select></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>* Institución Auspiciante:</strong></td>
    <td><textarea name="auspiciante"  id="auspiciante" type="text" style="width:250px" ></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Número de Horas:</strong></td>
    <td><input name="duracion"  id="duracion" type="text" value="" size="5" maxlength="5" onkeypress="return soloNumerosm1(event)"></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Tipo de Certificado:</strong></td>
    <td>
    <select name="tipocertificado" id="tipocertificado" style="max-width:220px">
    	<option value="">.:Seleccione:.</option>
        
        <option value="Aprobación">Aprobación</option>
        <option value="Asistencia">Asistencia</option>
      
        
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Fecha de Inicio:</strong></td>
    <td><input name="f_inicio"  id="f_inicio" type="text" value="" readonly></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Fecha de Terminación:</strong></td>
    <td><input name="f_terminacion"  id="f_terminacion" type="text" value="" readonly></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>País:</strong></td>
    <td><input name="pais"  id="pais" type="text" value="Ecuador"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <a href="#" class="btn_azul" onClick="guarda_titulo_CP()">Guardar</a>&nbsp;&nbsp;<a href="#" onClick="cerrar_abrir('nuevotitulo','tituloscontenidos')"  class="btn_rojo">Cancelar</a>
<br>
    </td>
    </tr>
</table>

        </form>
    </div>
    
    <div id="tituloscontenidos" style="text-align:center;" align="center">
    <table width="" border="0" align="center" cellpadding="0" cellspacing="0" class="tabla_jre" style="font-size:14px; margin:12px;  position:relative" >
    <thead>
  <tr>
    <th width="75" align="center"><strong>&nbsp;</strong></th>
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
	$queryexperiencia=mysql_query("select concat_ws('.*.',id_capacitaciones,
evento,
tipoevento,
auspiciante,
duracion,
tipocertificado,
f_inicio,
f_terminacion,
pais) as todos,gad_capacitaciones.* from gad_capacitaciones where id_personal='$perslid'
ORDER BY f_inicio DESC
",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td align="center">
     <a href="javascript:void()" onClick="editar_titulos('<?php echo $regexperiencia["todos"]?>')" class="imgboton tooltipjrojas"><span>Editar</span><img src="imag/pencil2.png" style="vertical-align:middle"></a>
     
     <a href="javascript:void()" onClick="ventana_eliminar('<?php echo $regexperiencia["id_capacitaciones"]?>')" class="imgboton tooltipjrojas"><span>Eliminar</span><img src="imag/binb.png" style="vertical-align:middle"></a>
     
     </td>
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
                
                $('#f_inicio').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
				$('#f_terminacion').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            });
			

function envia_eliminar()
{	
	var filedis='mod_talento_humano/mostrar_capacitaciones.php';
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
$('#id_capacitaciones').val(array[0]);
$('#evento').val(array[1]);
$('#tipoevento').val(array[2]);
$('#auspiciante').val(array[3]);
$('#duracion').val(array[4]);
$('#tipocertificado').val(array[5]);
$('#f_inicio').val(array[6]);
$('#f_terminacion').val(array[7]);
$('#pais').val(array[8]);
}

 function guarda_titulo_CP()
 {
	 /**validar antes de guardar**/
	 $('#evento').val($.trim($('#evento').val()));
	 $('#auspiciante').val($.trim($('#auspiciante').val()));
	 $('#duracion').val($.trim($('#duracion').val()));
	 $('#pais').val($.trim($('#pais').val()));
	 
	 if($('#evento').val().length>=3 && $('#auspiciante').val().length>=3)
	 {
	 
	 
	  /**guardar*
 	cerrar_abrir('nuevo_personal','funcionarios_load');*/
	cargardiv_form('mod_talento_humano/mostrar_capacitaciones.php','#titulos_academicos','#frmnuevotitulo')
	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
</script>