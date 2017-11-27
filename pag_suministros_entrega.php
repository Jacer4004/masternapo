
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
   
<div class="ventanas" id="nuevo" style="width:">
<h3 id="<?php echo $colorfondo?>"align="center">Registro de Entrega de Suministros </h3>
<div id="formulario_agr_sum">
<?php include("pag_suministros_agregar.php");?>
</div>
<div id="formulario_Agregar">
<?php include("subpag_suministros.php");?>
</div>

<div id="formulario_suministros">

<form name="addsuministros" id="addsuministros" class="formularios " onSubmit="return false">
  <br>
<div align="center" style="text-align:center">

<div class="bloque_de_menus">

<input type="button" class="boton_pequenio color_btn_verde" value="Agregar" onClick="javascript:cerrar_abrir('formulario_suministros','formulario_Agregar');">
&nbsp;&nbsp;&nbsp;<input type="submit" class="boton_pequenio color_btn_azul" value="Guardar" onClick="javascript:enviar_datos_entrega_suministro('addsuministros','g_sum_entrega.php','mensajes'); $('#grabar').fadeOut(200);" disabled id="grabar">
&nbsp;&nbsp;&nbsp;<input class="boton_pequenio color_btn_rojo" type="button" value="Cancelar" onClick="javascript:location.reload();"> 
</div>
</div>

<div align="center" class="datagrid" style="margin:10px;">

<table id="tabla_entrega_suministros" border="1" >
<thead><tr>
  <th align="center">CANT</th>
  <th align="center">SUMINISTROS</th>
  <th align="center">ÁREA DESTINADA</th>
  <th align="center">RESPOSABLE</th>
  <th align="center">FECHA</th>
  <th align="center">OBSERVACIONES</th>
  <th align="center">&nbsp;</th>
  </tr>
  
  </thead>
<tbody>

</tbody>
</table>
</div>

  </form>
</div>

</div>


<script>
document.getElementById('formulario_Agregar').style.display="none";
document.getElementById('formulario_agr_sum').style.display="none";
</script>
<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecharegistro').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			$(document).ready(function () {
                
                $('#fechaadd').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			
			
		 	
function enviar_datos_entrega_suministro(formulario_g_s,archivo_g_s,resultado_g_s) {
   
	var el_form_g_s="#"+formulario_g_s;
	var salida_mensaje_g_s="#"+resultado_g_s;
	
    $(el_form_g_s).validate({
        /*rules: {
            name: { required: true, minlength: 2},
            lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            //message: { required:true, minlength: 2}
        },
        messages: {
            name: '<span style="background:#FF0308; color:#FFFFFF; padding:4px">Debe introducir su nombre.</span>',
            lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
           // message : "El campo Mensaje es obligatorio.",
        },*/
        submitHandler: function(form){
			var dataString= $(el_form_g_s).serialize();//recoge todo del fomulario			
            $.ajax({
                type: "POST",
                url:archivo_g_s,
                data: dataString,
                success: function(data){
                    $(salida_mensaje_g_s).html(data);
					$(salida_mensaje_g_s).fadeIn(1000);                   
					//cierra despues 3segundos
					setTimeout(function(){
					$(salida_mensaje_g_s).fadeOut(1500);
					},3000);
					//cierra
					
                },
				error: function() {
         		 alert(" ERROR \n Ha ocurrido un problema \n Comuniquese con el administrador del sistema");
				}
            });
        }
    });
}
        </script>