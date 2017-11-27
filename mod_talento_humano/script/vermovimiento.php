<?php 
include_once("../../conf.php");
?>
<div id="nuevorealizado" style="display:none; padding:15px">
<form name="movimientopersonal" id="movimientopersonal" class="formularios">
<input type="hidden" value="" name="id_cambio_adm" id="id_cambio_adm">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
   <tr>
     <td colspan="2" align="right" style="background-color:rgba(240,143,20,1.00); color:rgba(255,255,255,1.00)">
     <h4 align="center">Registro de Movimiento de Personal</h4>
     </td>
     </tr>
   <tr>
     <td align="right"><strong>Fecha de elaboración:</strong></td>
     <td><input type="text" name="fecha_elaboracion" id="fecha_elaboracion" readonly value="<?php echo ucfirst(strftime("%A, %d de %B de %Y"));?>" style="width:250px"></td>
   </tr>
   <tr>
     <td align="right"><strong>Acción N°-:</strong></td>
     <td><input type="text" name="accionn" id="accionn" onKeyPress="return soloNumeros(event,'rmu_pr')"  ></td>
   </tr>
   <tr>
     <td align="right" valign="top"><strong>Explicación:</strong></td>
     <td><textarea name="explicación" id="explicación" style="width:400px; min-height:70px"></textarea></td>
   </tr>
   <tr>
     <td align="right" valign="top"><strong>Referencias:</strong></td>
     <td><textarea name="referencias" id="referencias" style="width:400px; min-height:70px"></textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center" style="background-color:rgba(240,143,20,1.00); color:rgba(255,255,255,1.00)"><strong>Situación Actual</strong></td>
   </tr>
   <tr>
    <td width="167" align="right"><strong>Periodo</strong></td>
    <td width="457"><select name="periodo"   id="periodo" style="width:250px" onChange="cargar_general(periodo.value,'mod_talento_humano/script/cbo.distrib.dep.cambios.php','area_dep');" >
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqldistri=mysql_query("select * from th_distributivo where bloqueo=0 order by dis_periodo desc",$conectar)or die("Error".mysql_error());
	  while($redistri=mysql_fetch_array($sqldistri))
	  {
	  ?>
      <option value="<?php echo $redistri["id_distributivo"];?>"><?php echo $redistri["dis_periodo"];?></option>
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td width="167" align="right"><strong>Dependencia</strong></td>
    <td>
   
    <select name="area_dep" style="width:250px"   id="area_dep" onChange="cargar_general(area_dep.value,'mod_talento_humano/script/cbo.distrib.per.conf.php','funcionariosac');">
      <option	value="">.: Seleccione :.</option>
      
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Funcionario</strong></td>
    <td><select name="funcionariosac" style="width:250px"   id="funcionariosac" onChange="cargar_general(funcionariosac.value,'mod_talento_humano/script/cbo.distrib.per.datos.php','sitactualrows');">
      <option	value="">.: Seleccione :.</option>
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Motivo de salida:</strong></td>
    <td><select name="motivocambio" id="motivocambio" style="max-width:250px">
      <option value="">.:Seleccione:.</option>
      <?php 
		$mysqlmotivosalida=mysql_query("SELECT * FROM gad_personal_m_salida order by motivo_salida",$conectar);
		while($regmotivosalida=mysql_fetch_array($mysqlmotivosalida))
		{
		?>
      <option value="<?=$regmotivosalida["motivo_salida"]?>">
        <?=$regmotivosalida["motivo_salida"]?>
        </option>
      <?php 
		}
		?>
    </select></td>
  </tr>
  
  <tr >
    <td colspan="2" align="right">
    <div id="sitactualrows">
    <table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr >
    <td width="167" align="right"><strong>Mod. Contrato</strong></td>
    <td width="457">
    <input type="text" readonly name="mod_contrato_ac" id="mod_contrato_ac">
    </td>
  </tr>
  <tr> 
    <td align="right"><strong>Denominación de Puesto</strong></td>
    <td><input type="text" readonly name="puestoactual" id="puestoactual">
   
    </td>
  </tr>
  <tr>
    <td align="right"><strong>Rol de Puesto</strong></td>
    <td>
    <input type="text" name="rol_de_puesto_ac" id="rol_de_puesto_ac" readonly style="width:250px">
    </td>
  </tr>
  <tr>
    <td align="right"><strong>R.M.U</strong></td>
    <td>
    <input type="text" name="rmu_ac" id="rmu_ac" readonly onKeyPress="return soloNumeros(event,'rmu_ac')" onChange="dosdecimales('#rmu_ac')">
    </td>
  </tr>
   <tr>
    <td align="right"><strong>N°- Partida</strong></td>
    <td>
    <input type="text" name="partida" id="partida" readonly style="width:250px">
    </td>
  </tr>
   <tr>
    <td align="right"><strong>Fecha de Ingreso</strong></td>
    <td>
    <input type="text" name="fecha_ing_ac" id="fecha_ing_ac" placeholder="aaaa-mm-dd" readonly>
    </td>
  </tr>
</table>

    </div>
    </td>
    </tr>
  
  
   <tr>
     <td colspan="2" align="center" style="background-color:rgba(240,143,20,1.00); color:rgba(255,255,255,1.00)"><strong>Situación Propuesta</strong></td>
     </tr>
   <tr>
     <td align="right"><strong>Periodo</strong></td>
     <td><select name="periodo2"   id="periodo2" style="width:250px" onChange="cargar_general(periodo2.value,'mod_talento_humano/script/cbo.distrib.dep.cambios.php','area_dep2');" >
       <option	value="">.: Seleccione :.</option>
       <?php 
	  $sqldistri=mysql_query("select * from th_distributivo where bloqueo=0 order by dis_periodo desc",$conectar)or die("Error".mysql_error());
	  while($redistri=mysql_fetch_array($sqldistri))
	  {
	  ?>
       <option value="<?php echo $redistri["id_distributivo"];?>"><?php echo $redistri["dis_periodo"];?></option>
       <?php 
	  }
	  ?>
     </select></td>
   </tr>
   <tr>
     <td align="right"><strong>Dependencia</strong></td>
     <td><select name="area_dep2" style="width:250px"   id="area_dep2" >
       <option	value="">.: Seleccione :.</option>
     </select></td>
   </tr>
   <tr >
     <td colspan="2" align="right"><div id="sitactualrows2">
       <table border="0" cellspacing="0" cellpadding="2" width="100%">
         <tr >
           <td align="right"><strong>Motivo de ingreso:</strong></td>
           <td><select name="ingresopor" id="ingresopor" style="max-width:220px">
             <option value="">.:Seleccione:.</option>
               <?php 
		$mysqlingresopor=mysql_query("SELECT * FROM gad_personal_m_ingreso order by motivo",$conectar);
		while($regmotivoingreso=mysql_fetch_array($mysqlingresopor))
		{
		?>
               <option value="<?=$regmotivoingreso["motivo"]?>">
                 <?=$regmotivoingreso["motivo"]?>
                 </option>
               <?php 
		}
		?>
           </select></td>
         </tr>
         <tr >
           <td width="167" align="right"><strong>Mod. Contrato</strong></td>
           <td width="457"><select name="mod_contrato"   id="mod_contrato" style="width:250px" >
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
           <td><select name="denominacion_puesto"   id="denominacion_puesto"  onChange="pasar_cargo(denominacion_puesto.selectedIndex)" style="width:250px">
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
           <td><input type="text" name="rol_de_puesto_pr" id="rol_de_puesto_pr"  style="width:250px"></td>
           </tr>
         <tr>
           <td align="right"><strong>R.M.U</strong></td>
           <td><input type="text" name="rmu_pr" id="rmu_pr" onKeyPress="return soloNumeros(event,'rmu_pr')" onChange="dosdecimales('#rmu_pr')" ></td>
           </tr>
         <tr>
           <td align="right"><strong>N°- Partida</strong></td>
           <td><input type="text" name="partida2" id="partida2"  style="width:250px"></td>
           </tr>
         <tr>
           <td align="right"><strong>Fecha que Rige:</strong></td>
           <td><input type="text" name="fecha_ing_ing_pr" id="fecha_ing_ing_pr" placeholder="aaaa-mm-dd" ></td>
           </tr>
           <tr>
           <td align="right"><strong>Fecha que finaliza:</strong></td>
           <td><input type="text" name="fecha_finaliza" id="fecha_finaliza" placeholder="aaaa-mm-dd" ></td>
           </tr>
         </table>
       </div></td>
   </tr>
   <tr>
     <td align="right" valign="top"><strong>Observaciones:</strong></td>
     <td><textarea name="observaciones" id="observaciones" style="width:400px; min-height:70px"></textarea></td>
   </tr>
   <tr>
     <td align="right">&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td align="right"><strong></strong></td>
     <td>
       <a href="javascript:void()" onClick="guarda_personal_cambios()" class="botocuadrado color_blue2" >&nbsp;Guardar&nbsp;</a>
       
       
       &nbsp;&nbsp; <a href="javascript:void()" class="botocuadrado color_rojo" onClick="cerrar_abrir('nuevorealizado','mostrarmovimientos')">Cancelar</a>
       </td>
   </tr>
</table>
</form>
<br>
<br>

</div>

<div id="mostrarmovimientos" style="padding:15px">
<?php  include_once("mostrar_cambios_personal.php");?>
</div>

<script language="javascript">
    	
		$(document).ready(function () {
                
                $('#fecha_ing_ing_pr').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                }); 
				$('#fecha_finaliza').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            
            });	
	
		
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
			
			dosdecimales($('#rmu_pr').val(rmu[valorcarg-1]));
			$('#rol_de_puesto_pr').val(cargo[valorcarg-1]);
		}
		
		
function guarda_personal_cambios()
 {
	 /**validar antes de guardar**/
	 $('#apellidos').val($.trim($('#apellidos').val()));
	 $('#partida2').val($.trim($('#partida2').val()));
	 $('#rol_de_puesto_pr').val($.trim($('#rol_de_puesto_pr').val()));
	 $('#denominacion_puesto').val($.trim($('#denominacion_puesto').val()));
	 $('#rmu_pr').val($.trim($('#rmu_pr').val()));
	 $('#accionn').val($.trim($('#accionn').val()));
	 $('#explicación').val($.trim($('#explicación').val()));
	 $('#referencias').val($.trim($('#referencias').val()));
	 $('#observaciones').val($.trim($('#observaciones').val()));
	 	 
	 
	 if($('#funcionariosac').val()!='' && $('#area_dep2').val()!='' && $('#mod_contrato').val()!='' && $('#denominacion_puesto').val()!='' && $('#rol_de_puesto_pr').val()!='' && $('#partida2').val()!='' && $('#fecha_ing_ing_pr').val()!='' && $('#rmu_pr').val()!='' && $('#accionn').val()!='') 
	 {
	 
	// alert('ok');
	  
 	cerrar_abrir('nuevorealizado','mostrarmovimientos');
	cargardiv_form('mod_talento_humano/script/mostrar_cambios_personal.php','#mostrarmovimientos','#movimientopersonal')
	 }
	 else
	 {
		alert('Revise que los todos los campos este llenos'); 
		//alert($('#funcionariosac').val()+"<1>"+$('#area_dep2').val()+"<2>"+$('#mod_contrato').val()+"<3>"+$('#denominacion_puesto').val()+"<4>"+$('#rol_de_puesto_pr').val()+"<5>"+$('#partida2').val()+"<6>"+$('#fecha_ing_ing_pr').val()+"<7>"+$('#rmu_pr').val()+"<8>"+$('#accionn').val()+"<9>");	 
	 }
	
 }

    </script>