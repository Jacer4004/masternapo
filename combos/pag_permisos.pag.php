<?php 
include("../conf.php");
$id =$_POST["variable"];
if($id<>"")
{
#echo $id."___";
$datosusuario=mysql_query("select * from gad_usuarios where id_personal='$id'",$conectar)or die("Error al recoger los datos del usuario");
$reg_dato_usuario=mysql_fetch_array($datosusuario);
#echo $reg_dato_usuario["acceso"];
$accesos_p=explode(',',$reg_dato_usuario["acceso"]);

?>

<div class="ventanas">
<label><input type="checkbox" name="todos" id="todos">Seleccionar Todos</label>
<ul style="margin-left:0px;" id="seleccionar_permisos">
<?php 
$sql_subarea=mysql_query("SELECT *
    FROM   gad_accesos where id_id_acceso='x'",$conectar) or die("ERROR");
	while($reg_areas=mysql_fetch_array($sql_subarea))
	{
				
?>
	<li style="list-style-image:url(imag/list1.png);"><label><input type="checkbox" value="<?php echo $reg_areas["codigo"]?>"  <?php if (in_array($reg_areas["codigo"], $accesos_p)) { echo "checked";}?> name="accesonivel[]">
	<?php echo $reg_areas["acc_nombre"];?></label>
    	<ul>
        	<?php 
			$id_submodulo=$reg_areas["id_acceso"];
			$sql_submodulo=mysql_query("SELECT *
   			FROM   gad_accesos where id_id_acceso='$id_submodulo'",$conectar) or die("ERROR");
			while($reg_submodulo=mysql_fetch_array($sql_submodulo))
			{
				
			?>
				<li><input type="checkbox" value="<?php echo $reg_submodulo["codigo"]?>" <?php if (in_array($reg_submodulo["codigo"], $accesos_p)) { echo "checked";}?> name="accesonivel[]">
				<?php echo $reg_submodulo["acc_nombre"];?>
                	<ul>
                    	<?php 
						$id_pagina=$reg_submodulo["id_acceso"];
						$sql_pagina=mysql_query("SELECT *
						FROM   gad_accesos where id_id_acceso='$id_pagina'",$conectar) or die("ERROR");
						while($reg_pagina=mysql_fetch_array($sql_pagina))
						{
						?>
                        	<li><input type="checkbox" value="<?php echo $reg_pagina["codigo"]?>" <?php if (in_array($reg_pagina["codigo"], $accesos_p)) { echo "checked";}?> name="accesonivel[]">
							<?php echo $reg_pagina["acc_nombre"];?></li>
                        <?php 
						}
						?>
                        
                    </ul>
                </li>
            <?php 
			}
			?>
            
        </ul>
    </li>
    
    <?php 
	}
	?>
    
</ul>
<input name="" type="button" class="boton color_btn_azul" onClick="javascript:recoger_selectos()" value="Guardar">
<span id="guardando" style="color:#FF0004">&nbsp;</span>
</div>
<script language="javascript">
$("#todos").change(function () {
        if ($(this).is(':checked')) {
            //$("input[type=checkbox]").prop('checked', true); //todos los check
            $("#seleccionar_permisos input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {
            //$("input[type=checkbox]").prop('checked', false);//todos los check
            $("#seleccionar_permisos input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }
    });
	
	
function recoger_selectos()
{
	if(document.getElementById('area_').value!="" && document.getElementById('usuarios_area').value!="")
	{
		var checkboxValues = "";
		$('input[name="accesonivel[]"]:checked').each(function() {
			checkboxValues += $(this).val() + ",";});
		//eliminamos la última coma.
		checkboxValues = checkboxValues.substring(0, checkboxValues.length-1);
				
		//$("#cargando2").css("display", "inline");//para mostrar el loadin 
		var mensaje_p="#guardando";
		$(mensaje_p).css("display", "none");//id del select
		//hasta aqui para mostrar el loading
		
		var var_usuario=document.getElementById('usuarios_area').value;
		var var_permisos=checkboxValues;
		$.post('g_permisos.php', { user: var_usuario,perm:var_permisos }, function(data){
		$(mensaje_p).html(data);
		//cierra el loading despues de cargar 
		//$("#cargando2").css("display", "none");
		$(mensaje_p).css("display", "inline");
		//$("#botonguardar").css("display", "inline");
		});			
		
	}
	else
	{
	alert("Debe seleccionar un usuario antes de continuar");
	}
}

/*function selectodos()
{
	$("input:checkbox").prop('checked', true);
$("input[type=checkbox]").prop('checked', true);
}*/
	
</script>
<?php 
}
?>