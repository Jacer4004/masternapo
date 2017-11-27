<?php 
$sqlareas_sum=mysql_query("select * from gad_dependencia order by nombre",$conectar) or die("ERROR_");

?>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
   
<div class="ventanas" style="width:600px">
<form name="addsuministro" id="addsuministro" class="formularios">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="175" align="right">Suministro: </td>
    <td width="175" align="left"><input type="text" id="suministro_selecto" disabled style="width:250px;">
    <input type="hidden" name="id_suministro_selecto" id="id_suministro_selecto" value="">
    </td>
  <tr>
  <tr>
    <td align="right">Cantidad:</td>
    <td><select name="cantidad_selecto" id="cantidad_selecto" required>
      <option	value="">.: Seleccione :.</option>

    </select></td>
  </tr>
  <tr>
    <td width="175" align="right">Area: </td>
    <td width="258"><select name="area_suminisitro" id="area_suminisitro" required onChange="cargarcombo(area_suminisitro.value,'combos/cb_usuarios_area.cbo.php','usuarios_area');">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  while($re_areas_sum=mysql_fetch_array($sqlareas_sum))
	  {
	  ?>
      <option	value="<?php echo $re_areas_sum["id_dependencia"];?>"><?php echo $re_areas_sum["nombre"];?></option>
      
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Usuario:</td>
    <td>
    <?php 
	#SELECCIONADE ACUERDO AL AREA
	?>
    <select name="usuarios_area" id="usuarios_area" required>
      <option	value="">.: Seleccione :.</option>
    
    </select></td>
  </tr>
  
  <tr>
    <td align="right">Fecha de entrega:</td>
    <td>
      <input type="text" name="fecha_entrega_sum"  id="fecha_entrega_sum" placeholder="aaaa-mm-dd" required value="<?php echo date('Y-m-d');?>">
      
      </td>
  <tr>
    <td align="right" valign="top">Observaciones:</td>
    <td><textarea name="observaciones_sum" id="observaciones_sum" style="width:300px">Requerimiento solicitado con </textarea></td>
  </tr>
</table>

<br>
<div align="center" style="text-align:center">
<input type="button" class="boton color_btn_azul" value="Aceptar" onClick="javascript:Actualiza_entrega(); ">

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('formulario_agr_sum','formulario_suministros');"> 
</div>

  </form>

</div>

<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecha_entrega_sum').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            });
</script>


<script>
function Actualiza_entrega()
{
		

 
	/*var codigo=document.getElementById('codigo').value;*/
	var suministro_selecto=$("#id_suministro_selecto").val();
	var nom_sumi_selecot=$("#suministro_selecto").val();
	var cantidad_selecto=$("#cantidad_selecto option:selected").val();
	var area_suminisitro=$("#area_suminisitro option:selected").val();
	var nom_area_suministro=$("#area_suminisitro option:selected").text();
	var usuarios_area=$("#usuarios_area option:selected").val();
	var nom_usuarios_area=$("#usuarios_area option:selected").text();
	var fecha_entrega_sum=$("#fecha_entrega_sum").val();
	
	var fecha_entrega_sum=$("#fecha_entrega_sum").val();
	
	var observaciones_sum=$("textarea#observaciones_sum").val();
	
	if(cantidad_selecto!='' && area_suminisitro!='' && usuarios_area!='' && fecha_entrega_sum !='')
	{

	var agregarfilasum='<tr style="border:1px solid #E1EEF4"><td align="center">'+cantidad_selecto+'<input type="hidden" name="g_cantidad[]" id="contador_sum" value="'+cantidad_selecto+'"></td><td>'+nom_sumi_selecot+'<input type="hidden" name="g_id_suminsitro[]" value="'+suministro_selecto+'"><input type="hidden" name="g_nombre_suministro[]" value="'+nom_sumi_selecot+'"></td><td>'+nom_area_suministro+'<input type="hidden" name="g_area[]" value="'+area_suminisitro+'"><input type="hidden" name="g_nom_area[]" value="'+nom_area_suministro+'"></td><td>'+nom_usuarios_area+'<input type="hidden" name="g_id_responsable[]" value="'+usuarios_area+'"><input type="hidden" name="g_nombre_responsable[]" value="'+nom_usuarios_area+'"></td><td>'+fecha_entrega_sum+'<input type="hidden" name="g_fecha[]" value="'+fecha_entrega_sum+'"></td> <td>'+observaciones_sum+'<input type="hidden" name="g_observacioes[]" value="'+observaciones_sum+'"></td><td align="center"><a href="#" class="link_simple boteliminar" onClick="eliminar_fila($(this))"><img src="imag/eliminar2.png" style="vertical-align:middle"> Borrar</a><input type="hidden" name="fecha_entrega_sum[]" id="fecha_entrega_sumOK" value="'+fecha_entrega_sum+'"></td></tr>';
	
$('#tabla_entrega_suministros >tbody').append(agregarfilasum);
document.getElementById('grabar').disabled='';
cerrar_abrir('formulario_agr_sum','formulario_suministros');
	}
else
{
	
	alert('Faltan datos');
}
}



function eliminar_fila(fila)
    {
		$total=document.getElementsByName('g_cantidad[]');
		$total=$total.length;
		if($total<=1)
		{ document.getElementById('grabar').disabled="disabled";}
		
        fila.closest('tr').remove();
		
    }
	

</script>
