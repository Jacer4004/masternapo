 <?php 
include_once("../conf.php");

$perslid=$_REQUEST["personalcargado"];

$sqlacademia=mysql_query("select * from gad_personal where id_personal='$perslid'",$conectar);
$regpersacademia=mysql_fetch_array($sqlacademia);

if($_REQUEST["valblock"]==true and $_REQUEST["variable"]<>"")
{
	$aleiminart=$_REQUEST["variable"];
	mysql_query("DELETE FROM gad_tray_laboral WHERE id_trayectoria = '$aleiminart'",$conectar)or die("Error.");
	
	$_GET['avisomensaje']='Se ha Eliminado el registro laboral';
	 $_GET['avisotipo']='rojo';
	 $_GET['automatico']='si';
	 include("../ventanas_avisos.php");
}
else
{
if($_REQUEST["activate"]==true)
{
	#guarda o actualiza
	
	$id_trayectoria=$_REQUEST["id_trayectoria"];
	$id_personal=$_REQUEST["personalcargado"];
	$institucion=$_REQUEST["institucion"];
	$t_tipo=$_REQUEST["t_tipo"];
	$unidadadmin=$_REQUEST["unidadadmin"];
	$denonpuesto=$_REQUEST["denonpuesto"];
	$ingresopor=$_REQUEST["ingresopor"];
	$motivosalida=$_REQUEST["motivosalida"];
	$fingreso=$_REQUEST["fingreso"];
	$fsalida=$_REQUEST["fsalida"];
	$actividades=$_REQUEST["actividades"];
	
	$elgad=$_REQUEST["elgad"];
	$tactual=$_REQUEST["t_actual"];


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
		INSERT INTO gad_tray_laboral (
		id_trayectoria,
		id_personal,
		institucion,
		t_tipo,
		unidadadmin,
		denonpuesto,
		ingresopor,
		motivosalida,
		fingreso,
		fsalida,
		actividades,
		elgad,
		tactual)
VALUES (
'$id_trayectoria',
'$id_personal',
'$institucion',
'$t_tipo',
'$unidadadmin',
'$denonpuesto',
'$ingresopor',
'$motivosalida',
'$fingreso',
'$fsalida',
'$actividades',
'$elgad',
'$tactual')		
ON DUPLICATE KEY UPDATE
institucion='$institucion',
t_tipo='$t_tipo',
unidadadmin='$unidadadmin',
denonpuesto='$denonpuesto',
ingresopor='$ingresopor',
motivosalida='$motivosalida',
fingreso='$fingreso',
fsalida='$fsalida',
actividades='$actividades',
elgad='$elgad',
tactual='$tactual'")or die("Error: ".mysql_error());
		
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
       
        <input type="hidden" name="id_trayectoria" id="id_trayectoria" value="">
        <input type="hidden" name="personalcargado" id="personalcargado" value="<?php echo $perslid;?> ">
       
        <table width="73%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="37%" align="right" valign="top"><strong>* Institutción:</strong></td>
    <td width="63%" valign="top"><label><input type="checkbox" name="elgad" id="elgad" value="Si">
      GADP-NAPO</label><br>
<textarea name="institucion"  id="institucion" type="text" style="width:250px" size="50" ></textarea>
      </td>
  </tr>
  <tr>
    <td width="37%" align="right" valign="top"><strong>* Tipo de Institución:</strong></td>
    <td width="63%">
    <select name="t_tipo" id="t_tipo">
    	<option value="">.:Seleccione:.</option>
        <option value="Privada">Privada</option>
        <option value="Pública">Pública</option>
        <option value="Pública Otra">Pública Otra</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>* Unidad Administrativa:</strong></td>
    <td><textarea name="unidadadmin"  id="unidadadmin" type="text" style="width:250px" ></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>*Denominación del Puesto:</strong></td>
    <td><input name="denonpuesto"  id="denonpuesto" type="text" value="" onBlur="$('#denonpuesto').val(ucFirstAllWords($('#denonpuesto').val()))" ></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>*Ingreso por:</strong></td>
    <td>
    <select name="ingresopor" id="ingresopor" style="max-width:220px">
    	<option value="">.:Seleccione:.</option>
        <?php 
		$mysqlingresopor=mysql_query("SELECT * FROM gad_personal_m_ingreso order by motivo",$conectar);
		while($regmotivoingreso=mysql_fetch_array($mysqlingresopor))
		{
		?>
        <option value="<?=$regmotivoingreso["motivo"]?>"><?=$regmotivoingreso["motivo"]?></option>
        <?php 
		}
		?>
        
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Motivo de Salida:</strong></td>
    <td>
    <select name="motivosalida" id="motivosalida" style="max-width:220px">
    	<option value="">.:Seleccione:.</option>
        <?php 
		$mysqlmotivosalida=mysql_query("SELECT * FROM gad_personal_m_salida order by motivo_salida",$conectar);
		while($regmotivosalida=mysql_fetch_array($mysqlmotivosalida))
		{
		?>
        <option value="<?=$regmotivosalida["motivo_salida"]?>"><?=$regmotivosalida["motivo_salida"]?></option>
        <?php 
		}
		?>
        
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>*Fecha de Ingreso:</strong></td>
    <td><input name="fingreso"  id="fingreso" type="text" value="" readonly></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Fecha de Salida:</strong></td>
    <td><input name="fsalida"  id="fsalida" type="text" value="" readonly> <label onClick="gadpnapo_ok()"><input type="checkbox" name="t_actual" id="t_actual" value="Si">Trabajo Actual</label></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Responsabilidades o Funciones:</strong><br>
<span style="color:#F77620; font-size:13px">Separe cada actividad<br>
con un punto y coma (;)</span></td>
    <td>
    
<textarea name="actividades" style="width:250px" rows="6" id="actividades"></textarea>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <a href="#" class="btn_azul" onClick="guarda_titulo_EL()">Guardar</a>&nbsp;&nbsp;<a href="#" onClick="cerrar_abrir('nuevotitulo','tituloscontenidos')"  class="btn_rojo">Cancelar</a>
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
    <th align="center"><strong>INSTITUCIÓN</strong></th>
    <th align="center"><strong>UNIDAD ADMINISTRATIVA/PUESTO</strong></th>
    <th align="center"><strong>INGRESO POR</strong></th>
    <th align="center"><strong>MOTIVO DE SALIDA</strong></th>
    <th align="center"><strong>F.INGRESO<br>
    F.SALIDA</strong></th>
    <th align="center"><strong>ACTIVIDADES</strong></th>
    <th align="center">GAD</th>
    <th align="center">ACTUAL</th>
    </tr>
    <thead>
    <?php 
	#seleciona<?php  la experiencia
	$queryexperiencia=mysql_query("select concat_ws('.*.',id_trayectoria,
institucion,
t_tipo,
unidadadmin,
denonpuesto,
ingresopor,
motivosalida,
fingreso,
fsalida,
actividades,elgad,tactual) as todos,gad_tray_laboral.* from gad_tray_laboral where id_personal='$perslid'",$conectar);
	while($regexperiencia=mysql_fetch_array($queryexperiencia))
	{
		
	?>
  <tr>
    <td align="center">
     <a href="javascript:void()" onClick="editar_titulos('<?php echo $regexperiencia["todos"]?>')" class="imgboton tooltipjrojas"><span>Editar</span><img src="imag/pencil2.png" style="vertical-align:middle"></a>
     
     <a href="javascript:void()" onClick="ventana_eliminar('<?php echo $regexperiencia["id_trayectoria"]?>')" class="imgboton tooltipjrojas"><span>Eliminar</span><img src="imag/binb.png" style="vertical-align:middle"></a>
     
     </td>
    <td align="left"><?php echo $regexperiencia["institucion"]?></td>
    <td align="left"><strong>U.A.: </strong><?php echo $regexperiencia["unidadadmin"]?><br>
      <strong>Puesto: </strong><?php echo $regexperiencia["denonpuesto"]?></td>
    <td align="left"><?php echo $regexperiencia["ingresopor"]?></td>
    <td align="left"><?php echo $regexperiencia["motivosalida"]?></td>
    <td align="left"><?php echo $regexperiencia["fingreso"]."<br>".$regexperiencia["fsalida"]?></td>
    <td align="left">
    <ul style="padding-left:15px">
    <?php 
	$actividadesexp = explode(";", $regexperiencia["actividades"]);
	for($r=0;$r<count($actividadesexp);$r++)
	{
	echo "<li>".$actividadesexp[$r]."</li>";
	}
	?>
    </ul>
    </td>
    <td align="center">
    
    <?php 
	if($regexperiencia["elgad"]=="Si")
	{
	echo '<img src="imag/s_success.png">';
	}
	
	?>
    </td>
    <td align="center"><?php 
	if($regexperiencia["tactual"]=="Si")
	{
	echo '<img src="imag/s_success.png">';
	}
	
	?></td>
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
	<div class="emergentehijo" style="background:rgba(255,255,255,1.00); min-height:200px; min-width:350px; max-width:60;">
    <h4 align="center" id="color_red" style="margin:0px; color:rgba(255,255,255,1.00); padding:2px">Eliminar Título Académico</h4>
    <input type="hidden" name="idtituloeliminar"  id="idtituloeliminar" value="">
    <p align="center" style="padding:10px;" >Está seguro que desea Eliminar este Registro?.<strong><span id="dsitribubloquear"></span></strong>.<br>
Una vez eliminado no se podrá recuperar. </p>
    <div align="center" style="text-align:center !important">
    <a href="javascript:void()" onClick="envia_eliminar()" class="btn_rojo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a href="javascript:void()" onClick="$('#eliminaracademico').fadeOut(800);$('#idtituloeliminar').val('');" class="btn_azul" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>
<br>

    </div>
    </div>
</div>
<!--ACABA ELIMINAR-->
<script>
 // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fingreso').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
				$('#fsalida').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            });
			

function envia_eliminar()
{	
	var filedis='mod_talento_humano/mostrar_experiencia.php';
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
$('#id_trayectoria').val(array[0]);
$('#institucion').val(array[1]);
$('#t_tipo').val(array[2]);
$('#unidadadmin').val(array[3]);
$('#denonpuesto').val(array[4]);
$('#ingresopor').val(array[5]);
$('#motivosalida').val(array[6]);
$('#fingreso').val(array[7]);
$('#fsalida').val(array[8]);
$('#actividades').val(array[9]);

if(array[10]=="Si")
{
$("#elgad").prop("checked", true);	
}

if(array[11]=="Si")
{
$("#t_actual").prop("checked", true);	
}


}

 function guarda_titulo_EL()
 {
	 /**validar antes de guardar**/
	 $('#institucion').val($.trim($('#institucion').val()));
	 $('#unidadadmin').val($.trim($('#unidadadmin').val()));
	 $('#denonpuesto').val($.trim($('#denonpuesto').val()));
	 $('#actividades').val($.trim($('#actividades').val()));
	 
	 if($('#institucion').val().length>3 && $('#t_tipo').val()!="" && $('#unidadadmin').val().length>3 && $('#denonpuesto').val().length>3 && $('#t_tipo').val()!="" && $('#ingresopor').val()!=""  && $('#fingreso').val().length>5 )
	 {
	 
	 
	  /**guardar*
 	cerrar_abrir('nuevo_personal','funcionarios_load');*/
	cargardiv_form('mod_talento_humano/mostrar_experiencia.php','#titulos_academicos','#frmnuevotitulo')
	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
 
 function gadpnapo_ok()
 {
	 if($("#t_actual").prop("checked"))
	 {
		$('#fsalida').val('');
	 }
 }
</script>