<?php 
include_once("../../conf.php");
$aut=$_REQUEST["aut"];

?>
<div class="formularios">
<form name="guardapersonal" id="guardapersonal">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width="167" align="right"><strong>Perido</strong></td>
    <td width="457"><input type="text" readonly value="<?php echo $_REQUEST["autnom"];?>" name="periodo">
    <input type="hidden" name="id_distributivo_dis" value="<?php echo $_REQUEST["aut"];?>" id="id_distributivo_dis">
    <input type="hidden" name="idprincipal" value="" id="idprincipal">
    </td>
  </tr>
  <tr>
    <td width="167" align="right"><strong>Dependencia</strong></td>
    <td>
   
    <select name="area" style="width:250px"   id="area" onChange="cargar_general(area.value,'mod_talento_humano/script/mostrar_distriv_dep_pers.php','cargperarea'); $('#id_dependencia').val(area.value)">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqlareas_sum=mysql_query("select * from th_distributivo_dep where id_distributivo='$aut' order by dependencia_nom ",$conectar)or die("Error".mysql_error());
	  while($re_areas_sum=mysql_fetch_array($sqlareas_sum))
	  {
	  ?>
      <option	value="<?php echo $re_areas_sum["id_distributivo_dep"];?>"><?php echo $re_areas_sum["dependencia_nom"];?></option>
      
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Funcionario</strong></td>
    <td>
    <input type="text" name="textss" class="cajas_texto" id="funcionario" style="width:250px" readonly>
    <input type="hidden" name="id_personal" id="id_personal" value=""><span id="fuzsncionario"></span><a href="javascript:void()" onClick="$('#fun_heldesk').fadeIn(1000)" title="Funcionario del Gad"><img id="bscusuario" src="imag/usualogin.png" style="vertical-align:middle"></a></td>
  </tr>
  <tr>
    <td align="right"><strong>Mod. Contrato</strong></td>
    <td><select name="mod_contrato"   id="mod_contrato" style="width:250px" >
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqlmodcontrato=mysql_query("select * from gad_tipocontrato",$conectar)or die("Error".mysql_error());
	  while($reg_modcontrato=mysql_fetch_array($sqlmodcontrato))
	  {
	  ?>
      <option	value="<?php echo $reg_modcontrato["nom_tipocontrato"];?>"><?php echo $reg_modcontrato["nom_tipocontrato"];?></option>
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr> 
    <td align="right"><strong>Denominación de Puesto</strong></td>
    <td>
    <script language="javascript">
    	
			
	
		
		function pasar_cargo(valorcarg)
		{
			<?php $sqlcargosrmu=mysql_query("select * from gad_cargos",$conectar)or die("Error".mysql_error());
	  while($reg_sqlcargosrmu=mysql_fetch_array($sqlcargosrmu))
	  {
		  $rmu[]=$reg_sqlcargosrmu["sueldo"];
		  $cargo[]=$reg_sqlcargosrmu["cargo"];
		  
	  }
		  ?>
			var cargo=[<?php echo '"'.implode('","',$cargo).'"';?>];
			var rmu=[<?php echo '"'.implode('","',$rmu).'"';?>];
			
			dosdecimales($('#rmu').val(rmu[valorcarg-1]));
			$('#rol_de_puesto').val(cargo[valorcarg-1]);
		}
		
		
    </script>
    <select name="denominacion_puesto"   id="denominacion_puesto"  onChange="pasar_cargo(denominacion_puesto.selectedIndex)" style="width:250px">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqlcargos=mysql_query("select * from gad_cargos",$conectar)or die("Error".mysql_error());
	  while($reg_sqlcargos=mysql_fetch_array($sqlcargos))
	  {
	  ?>
      <option	value="<?php echo $reg_sqlcargos["cargo"];?>"><?php echo $reg_sqlcargos["cargo"];?></option>
     
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Rol de Puesto</strong></td>
    <td>
    <input type="text" name="rol_de_puesto" id="rol_de_puesto" style="width:250px">
    </td>
  </tr>
  <tr>
    <td align="right"><strong>R.M.U</strong></td>
    <td>
    <input type="text" name="rmu" id="rmu" onKeyPress="return soloNumeros(event,'rmu')" onChange="dosdecimales('#rmu')">
    </td>
  </tr>
   <tr>
    <td align="right"><strong>N°- Partida</strong></td>
    <td>
    <input type="text" name="partida" id="partida" style="width:250px">
    </td>
  </tr>
   <tr>
    <td align="right"><strong>Fecha de Ingreso</strong></td>
    <td>
    <input type="text" name="fecha_ing" id="fecha_ing" placeholder="aaaa-mm-dd" readonly>
    </td>
  </tr>
   <tr>
    <td align="right"><strong>Fecha de Salida</strong></td>
    <td>
    <input type="text" name="fecha_salida" id="fecha_salida" placeholder="aaaa-mm-dd" readonly>
    </td>
  </tr>
  <tr>
    <td align="right"><strong>Observaciones</strong></td>
    <td>
    <textarea name="otros" id="otros" style="width:250px"></textarea>
    </td>
  </tr>
   <tr>
    <td align="right"><strong></strong></td>
    <td>
    <a href="javascript:void()" onClick="validar_formpersonal()" class="botocuadrado color_blue2" >&nbsp;Guardar&nbsp;</a>
    
    
    &nbsp;&nbsp; <a href="javascript:void()" class="botocuadrado color_rojo" onClick="cargarContenido('mod_talento_humano/script/distributivos.php','#Contneidointernodis');">Cancelar</a>
    </td>
  </tr>
</table>
</form>
</div>

<div>

<div id="cargperarea">
<h4 align="center">Seleccione una Dependencia para mostrar el personal</h4>
</div>
</div>
<!--VENTAN EMERGENTE PARA MOSTRAR BUSCAR FUNCIOANRIOS-->
<div align="center" id="fun_heldesk"  class="emergentepadre" style="display:none !important; background:rgba(12,97,199,0.77);">
   
    <div class="emergentehijo" id="fun_heldesk2" style=" width:80% !important; transform: translate(-50%, -80%);">
    <?php 
	include_once("funcionariosbuscar.php");
	?>
    </div>
</div>
<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecha_ing').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            
            });
			$(document).ready(function () {
                
                $('#fecha_salida').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            
            });
//funcion valida y guarda
 function validar_formpersonal()
{
	var validador=0;
		
	$('#id_personal').val($.trim($('#id_personal').val()));
	$('#rol_de_puesto').val($.trim($('#rol_de_puesto').val()));
	$('#rmu').val($.trim($('#rmu').val()));
	$('#partida').val($.trim($('#partida').val()));
	$('#fecha_ing').val($.trim($('#fecha_ing').val()));

	
	
	if($('#area').val().length==0){ var validador=false;$('#area').addClass("error")}else{var validador=validador+1;$('#area').removeClass("error")}
	
	if($('#id_personal').val().length==0){ var validador=false;$('#funcionario').addClass("error")}else{var validador=validador+1;$('#funcionario').removeClass("error")}
	
	if($('#mod_contrato').val().length==0){ var validador=false;$('#mod_contrato').addClass("error")}else{var validador=validador+1;$('#mod_contrato').removeClass("error")}
	
	if($('#denominacion_puesto').val().length==0){ var validador=false;$('#denominacion_puesto').addClass("error")}else{var validador=validador+1;$('#denominacion_puesto').removeClass("error")}
	
	if($('#rol_de_puesto').val().length==0){ var validador=false;$('#rol_de_puesto').addClass("error")}else{var validador=validador+1;$('#rol_de_puesto').removeClass("error")}
	
	if($('#rmu').val().length==0){ var validador=false;$('#rmu').addClass("error")}else{var validador=validador+1;$('#rmu').removeClass("error")}
	
	if($('#partida').val().length==0){ var validador=false;$('#partida').addClass("error")}else{var validador=validador+1;$('#partida').removeClass("error")}
	
	if($('#fecha_ing').val().length==0){ var validador=false;$('#fecha_ing').addClass("error")}else{var validador=validador+1;$('#fecha_ing').removeClass("error")}
	
	
if(validador==8)
{
	
	//cambiar_vetana('#contenidosinternos','#frmnuevo');
	

cargardiv_form('mod_talento_humano/script/mostrar_distriv_dep_pers.php?aut=<?=$aut?>&autnom=<?=$_REQUEST["autnom"]?>','#Contneidointernodis','#guardapersonal');
	
}
else
{
	alert ("Revise que los campos obligatorios esten llenos correctamente_");
}
}
			
</script>