<?php 
include_once("../../conf.php");
?>
<div id="frmnuevodepen" style="display:none" >
  <form name="formnuevo" id="formnuevo" class="formularios">
    <h4 align="center">EDICIÓN DE DEPENDENCIA</h4>
    
    <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="middle">Nivel Estructural</td>
    <td>
    <select name="nivelestructural" id="nivelestructural" style="width:270px">
    	<option value="">Seleccione</option>
		<?php 
		$querynivel=mysql_query("select * from gad_nivel",$conectar)or die("Error ".mysql_error());
		while($regnivel=mysql_fetch_array($querynivel))
		{
		?>
        <option value="<?php echo $regnivel["nivel"]?>"><?=$regnivel["nivel"]?></option>
        <?php 
		}
		?>
        
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">*Nombre </td>
    <td><input type="text" size="33" name="nombre" id="nombre" placeholder="Ejemplo: Talento Humano" class="caja_textos">
    <input type="hidden" name="idprincipal" id="idprincipal" value="">
    </td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">Abreviatura</td>
    <td><input type="text" size="33" name="abreviatura" id="abreviatura" class="caja_textos" placeholder="Ejemplo: TH"></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Orgánico</td>
    <td>
    <select name="organicoestructural" id="organicoestructural">
    	<option value="SI">SI</option>
        <option value="NO">NO</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">Dependencia Padre</td>
    <td><select name="area" style="width:270px"   id="area" onChange="cargar_general(area.value,'mod_talento_humano/script/mostrar_distriv_dep_pers.php','cargperarea')">
      <option	value="0">.: Ninguna :.</option>
      <?php 
	  $sqlareas_sum=mysql_query("select * from gad_dependencia order by nombre ",$conectar)or die("Error".mysql_error());
	  while($re_areas_sum=mysql_fetch_array($sqlareas_sum))
	  {
	  ?>
      <option	value="<?php echo $re_areas_sum["id_dependencia"];?>"><?php echo $re_areas_sum["nombre"];?></option>
      <?php 
	  }
	  ?>
    </select>
    
    </td>
  </tr>
  
  <tr>
    <td align="right" valign="top">Observaciones</td>
    <td><textarea name="otros" id="otros" cols="30" class="caja_textos" rows="3" style="font-size:13px"></textarea></td>
  </tr>
  
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td><div  style="padding:3px;" > 
      <a href="#" class="botocuadrado color_azul" onClick="validar_fordepa()"><img src="imag/salvar.png" class="imagenes"><p>Guardar</p></a>
        
        <a href="#" class="botocuadrado color_rojo" onClick="cambiar_vetana('#contenidosinternosdepen','#frmnuevodepen')"><img src="imag/cancel2.png" class="imagenes"><p>Cancelar</p></a>
     </div></td>
  </tr>
</table>

  </form>
</div>
<div align="center" id="contenidosinternosdepen" style="text-align:center !important">
<a href="#" class="botocuadrado color_blue2" onClick="cambiar_vetana('#frmnuevodepen','#contenidosinternosdepen'); Reset_fomulario('formnuevo');$('#idprincipal').val('');"><img src="imag/add3.png" class="imagenes">Nuevo&nbsp;&nbsp;</a>
<div id="cargaraqui">

<?php 
include_once("mostrar_dependencias.php");
?>



</div>

</div>
<script>
   function validar_fordepa()
{
	$('#nombre').val($.trim($('#nombre').val()));
	

	if($('#nombre').val().length==0){ var validadordep=false;$('#nombre').addClass("error")}else{var validadordep=true;$('#nombre').removeClass("error")}
	
	
if(validadordep==true)
{
	
	cambiar_vetana('#contenidosinternosdepen','#frmnuevodepen');
	cargardiv_form('mod_talento_humano/script/mostrar_dependencias.php','#cargaraqui','#formnuevo')
	
}
else
{
	alert ("Revise que los campos obligatorios esten llenos correctamente_");
}
}
   </script>