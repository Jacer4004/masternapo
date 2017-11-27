
<div id="frmnuevo" style="display:none" >
  <form name="formnuevo" id="formnuevo" class="formularios">
    <h4 align="center">EDICIÓN DE DEPENDENCIAS</h4>
    
    <input type="hidden" name="idprincipal" id="idprincipal" value="">
    <input type="hidden" name="dis_periodo" id="dis_periodo" value="">
    
    <table border="0" align="center" cellpadding="0" cellspacing="0">
  
  
  
  <tr>
    <td align="right" valign="middle">*Nombre </td>
    <td><input type="text" size="33" name="dependencia_nom" id="dependencia_nom" class="caja_textos" >
    </td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">*Dependencia Padre </td>
    <td>
    <select name="nivel_padre" id="nivel_padre" style="max-width:230px">
  <option value="">.: Seleccione :. </option>
  </select>
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
        
        <a href="#" class="botocuadrado color_rojo" onClick="cambiar_vetana('#contenidosinternosdis','#frmnuevo')"><img src="imag/cancel2.png" class="imagenes"><p>Cancelar</p></a>
     </div></td>
  </tr>
</table>

  </form>
</div>


<div id="cargaraquidistrib">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<?php 
include("mostrar_distributivos_depen.php");
?>
</td>
    <td width="50%" valign="top">&nbsp;</td>
  </tr>
</table>


</div>

</div>
