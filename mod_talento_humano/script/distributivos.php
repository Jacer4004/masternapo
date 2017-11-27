<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecha_desde').datepicker({
                    format: "yyyy-mm-dd"
                });  
				 $('#fecha_hasta').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			
</script>
<div id="frmnuevodis" style="display:none" >
  <form name="formnuevo" id="formnuevo" class="formularios">
    <h4 align="center">EDICIÓN DE DISTRIBUTIVOS</h4>
    
    <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="middle">*Periodo </td>
    <td><input type="text" size="33" name="dis_periodo" id="dis_periodo" class="caja_textos">
    <input type="hidden" name="idprincipal" id="idprincipal" value="">
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">Fecha Inicia </td>
    <td><input type="text" size="10" name="fecha_desde" id="fecha_desde" class="caja_textos" placeholder="aaaa-mm-dd">
    
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">Fecha Finaliza </td>
    <td><input type="text" size="10" name="fecha_hasta" id="fecha_hasta" class="caja_textos" placeholder="aaaa-mm-dd">
    
    </td>
  </tr>

  <tr>
    <td align="right" valign="top">Descripción</td>
    <td><textarea name="dis_descripcion" id="dis_descripcion" cols="30" class="caja_textos" rows="3" style="font-size:13px"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td><div  style="padding:3px;" > 
      <a href="#" class="botocuadrado color_azul" onClick="validar_fordepa()"><img src="imag/salvar.png" class="imagenes"><p>Guardar</p></a>
        
        <a href="#" class="botocuadrado color_rojo" onClick="cambiar_vetana('#contenidosinternosdis','#frmnuevodis')"><img src="imag/cancel2.png" class="imagenes"><p>Cancelar</p></a>
     </div></td>
  </tr>
</table>

  </form>
</div>

<div align="center" id="contenidosinternosdis" style="text-align:center !important">
<a href="#" class="botocuadrado color_blue2" onClick="cambiar_vetana('#frmnuevodis','#contenidosinternosdis'); Reset_fomulario('formnuevo'); $('#idprincipal').val('');"><img src="imag/add3.png" class="imagenes">Nuevo&nbsp;&nbsp;</a>
<div id="cargaraquidistrib">

<?php 
include("mostrar_distributivos.php");
?>

</div>

</div>
<script>
   function validar_fordepa()
{
	$('#dis_periodo').val($.trim($('#dis_periodo').val()));
	

	if($('#dis_periodo').val().length==0){ var validadordep=false;$('#dis_periodo').addClass("error")}else{var validadordep=true;$('#dis_periodo').removeClass("error")}
	
	
if(validadordep==true)
{
	
	cambiar_vetana('#contenidosinternosdis','#frmnuevodis');
	cargardiv_form('mod_talento_humano/script/mostrar_distributivos.php','#cargaraquidistrib','#formnuevo')
	
}
else
{
	alert ("Revise que los campos obligatorios esten llenos correctamente_");
}
}
   </script>