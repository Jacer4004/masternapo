
<div id="frmnuevotrata" style="display:none" >
  <form name="formnuevo" id="formnuevo" class="formularios">
    <h4 align="center">EDICIÓN DE TRATAMIENTOS</h4>
    
    <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="middle">*Abreviatura </td>
    <td><input type="text" size="33" name="nombre" id="nombre" placeholder="Ejemplo: Ing." class="caja_textos">
    <input type="hidden" name="idprincipal" id="idprincipal" value="">
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">Descripción </td>
    <td><input type="text" size="33" name="tratamiento" id="tratamiento" class="caja_textos" placeholder="Ejemplo: Ingeniero"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Observaciones</td>
    <td><textarea name="otros" id="otros" cols="30" class="caja_textos" rows="3" style="font-size:13px"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td><div  style="padding:3px;" > 
      <a href="#" class="botocuadrado color_azul" onClick="validar_fordepa()"><img src="imag/salvar.png" class="imagenes"><p>Guardar</p></a>
        
        <a href="#" class="botocuadrado color_rojo" onClick="cambiar_vetana('#contenidosinternostrata','#frmnuevotrata')"><img src="imag/cancel2.png" class="imagenes"><p>Cancelar</p></a>
     </div></td>
  </tr>
</table>

  </form>
</div>
<div align="center" id="contenidosinternostrata"  style="text-align:center !important">
<a href="#" class="botocuadrado color_blue2" onClick="cambiar_vetana('#frmnuevotrata','#contenidosinternostrata'); Reset_fomulario('formnuevo');$('#idprincipal').val('');"><img src="imag/add3.png" class="imagenes">Nuevo&nbsp;&nbsp;</a>
<div id="cargaraqui">

<?php 
include("mostrar_tratamientos.php");
?>

</div>
</div>
<script>
   function validar_fordepa()
{
	$('#nombre').val($.trim($('#nombre').val()));
	

	if($('#nombre').val().length==0){ var validador=false;$('#nombre').addClass("error")}else{var validadordep=true;$('#nombre').removeClass("error")}
	
	
if(validadordep==true)
{
	
	cambiar_vetana('#contenidosinternostrata','#frmnuevotrata');
	cargardiv_form('mod_talento_humano/script/mostrar_tratamientos.php','#cargaraqui','#formnuevo')
	
}
else
{
	alert ("Revise que los campos obligatorios esten llenos correctamente_");
}
}
   </script>