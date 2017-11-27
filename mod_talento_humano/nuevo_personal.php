<?php 
include_once("../conf.php");

$personalid=$_REQUEST["personalcargado"];


$sqlselecpersonal=mysql_query("select * from gad_personal where id_personal='$personalid'",$conectar);
$regpersonaldata=mysql_fetch_array($sqlselecpersonal);
?>
<form style="display:table !important; margin:0 auto"  name="fomulariopersonal" id="fomulariopersonal" class="formularios">
<input type="hidden" value="<?php echo $regpersonaldata["id_personal"]?>" name="id_personal" id="id_personal">

<div style="width:600px; min-height:490px; float:left; background:rgba(255,255,255,1.00); margin:5px;">
<h4 align="center" style="background:rgba(147,25,25,1.00); color:rgba(255,255,255,1.00); padding:4px; margin:0px">Identificación General</h4><br>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong>* Cédula:</strong></td>
    <td>
<input type="text" name="cedula" class="caja_textos" id="cedula"  required onBlur="validar_cedula('#cedula','#errorcedula')"  maxlength="10" value="<?php echo $regpersonaldata["cedula"]?>"  onkeypress="return soloNumerosm1(event)">
<a href="javascript:void();" class=" boton color_btn_rojo" style="padding:2px !important; border-radius:50%;">GT+</a>
      
      <span id="errorcedula" style="color:red; display:none"><br>
Cédula Incorrecta</span>
    </td>
  </tr>
  <tr >
    <td width="149" align="right"><strong>* Apellidos: </strong></td>
    <td width="331">
    <input type="text" class="requerido" id="apellidos" name="apellidos" size="40" title="Nombres" required value="<?php echo $regpersonaldata["apellidos"]?>" onBlur="$('#apellidos').val(ucFirstAllWords($('#apellidos').val()))"> </td>
    </tr>
  <tr>
    <td align="right"><strong>* Nombres:</strong></td>
    <td><input type="text" name="nombres" id="nombres" size="40" class="requerido" required value="<?php echo $regpersonaldata["nombres"]?>" onBlur="$('#nombres').val(ucFirstAllWords($('#nombres').val()))"></td>
  </tr>
   <tr>
    <td align="right"><strong>Tratamiento:</strong></td>
    <td><select name="tratamiento" id="tratamiento" required  style="width:170px">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqltrata=mysql_query("select * from gad_tratamientos order by tratamiento",$conectar) or die("ERROR_");

	  while($re_trata=mysql_fetch_array($sqltrata))
	  {
	  ?>
      <option <?php if($regpersonaldata["tratamiento"]==$re_trata["tratamiento"]) echo "selected";?> 	value="<?php echo $re_trata["tratamiento"];?>"><?php echo $re_trata["tratamiento"]."-".$re_trata["descripcion"];?></option>
      <?php 
	  }
	  ?>
    </select></td>
   </tr>
  <tr>
    <td align="right"><strong>Genero:</strong></td>
    <td><select name="genero" id="genero" required  style="width:170px">
      <option 	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["genero"]=="Femenino") echo "selected";?>	value="Femenino">Femenino</option>
      <option <?php if($regpersonaldata["genero"]=="Masculino") echo "selected";?>	value="Masculino">Masculino</option>
    </select></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Fecha de Nacimiento:</strong></td>
    <td><input type="text" placeholder="aaaa-mm-dd" name="fnacimiento" id="fnacimiento" size="13" readonly onChange="calcular_edad()" value="<?php echo $regpersonaldata["fecha_naci"]?>">  
      &nbsp;&nbsp;<strong>Edad:&nbsp;</strong><span id="Edad"></span></td>
  </tr>
  <tr>
    <td align="right"><strong>Lugar de Nacimiento:</strong></td>
    <td><input type="text" placeholder="Provincia - Cantón" name="lugarnacimiento" id="lugarnacimiento" size="40" class="requerido"  value="<?php echo $regpersonaldata["lug_naci"]?>"></td>
  </tr>
  <tr>
    <td align="right"><strong>Estado Civil:</strong></td>
    <td><select name="ecivil" id="ecivil" required  style="width:170px">
      <option 	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Soltero") echo "selected";?>	value="Soltero">Soltero</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Casado") echo "selected";?>	value="Casado">Casado</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Divorciado") echo "selected";?>	value="Divorciado">Divorciado</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Voiudo") echo "selected";?>	value="Voiudo">Viudo</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Unión Libre") echo "selected";?>	value="Unión Libre">Unión Libre</option>
      <option <?php if($regpersonaldata["estadocivil"]=="Unión de Hecho") echo "selected";?>	value="Unión de Hecho">Unión de Hecho</option>
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Tipo de Sangre:</strong></td>
    <td><select name="tiposangre" id="tiosangre" required  style="width:170px">
      <option	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["tiposangre"]=="A-") echo "selected";?>	value="A-">A-</option>
      <option <?php if($regpersonaldata["tiposangre"]=="A+") echo "selected";?>	value="A+">A+</option>
      <option <?php if($regpersonaldata["tiposangre"]=="AB-") echo "selected";?>	value="AB-">AB-</option>
      <option <?php if($regpersonaldata["tiposangre"]=="AB+") echo "selected";?>	value="AB+">AB+</option>
      <option <?php if($regpersonaldata["tiposangre"]=="B-") echo "selected";?>	value="B-">B-</option>
      <option <?php if($regpersonaldata["tiposangre"]=="B+") echo "selected";?>	value="B+">B+</option>
      <option <?php if($regpersonaldata["tiposangre"]=="O-") echo "selected";?>	value="O-">O-</option>
      <option <?php if($regpersonaldata["tiposangre"]=="O+") echo "selected";?>	value="O+">O+</option>
    </select></td>
  </tr>
 
  <tr>
    <td align="right"><strong>Nacionalidad:</strong></td>
    <td><input type="text" name="nacionalidad" id="nacionalidad" size="40"  value="<?php echo $regpersonaldata["nacionalidad"]?>" onBlur="$('#nacionalidad').val(ucFirstAllWords($('#nacionalidad').val()))"></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Grupo Étnico:</strong></td>
    <td><select name="grupoetnico" id="grupoetnico"  style="width:170px">
      <option	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Blanco") echo "selected";?>	value="Blanco">Blanco</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Índigena") echo "selected";?>	value="Índigena">Índigena</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Mestizo") echo "selected";?>	value="Mestizo">Mestizo</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Montubio") echo "selected";?>	value="Montubio">Montubio</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Mulato") echo "selected";?>	value="Mulato">Mulato</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Negro") echo "selected";?>	value="Negro">Negro</option>
      <option <?php if($regpersonaldata["grupoetnico"]=="Otro") echo "selected";?>	value="Otro">Otro</option>
      
    </select></td>
  </tr>
  
   
    <tr>
    <td align="right"><strong>Discapacidad:</strong></td>
    <td><select name="discapacidad" id="discapacidad"  style="width:170px">
      <option	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["discapacidad"]=="Si") echo "selected";?>	value="Si">Si</option>
      <option <?php if($regpersonaldata["discapacidad"]=="No") echo "selected";?>	value="No">No</option>
      </select></td>
  </tr>
  <tr>
    <td align="right"><strong>Tipo:</strong></td>
    <td><select name="tipodiscapacidad" id="tipodiscapacidad"  style="width:170px">
      <option	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["tipodiscapacidad"]=="Auditiva") echo "selected";?>	value="Auditiva">Auditiva</option>
      <option <?php if($regpersonaldata["tipodiscapacidad"]=="Física") echo "selected";?>	value="Física">Física</option>
      <option <?php if($regpersonaldata["tipodiscapacidad"]=="Intelectual") echo "selected";?>	value="Intelectual">Intelectual</option>
      <option <?php if($regpersonaldata["tipodiscapacidad"]=="Visual") echo "selected";?>	value="Visual">Visual</option> 
    </select></td>
  </tr>
  <tr>
    <td align="right"><strong>N°- Conadis:</strong></td>
    <td><input type="text" name="numeroconadis" id="numeroconadis" size="13" value="<?php echo $regpersonaldata["numeroconadis"]?>">
    <input type="text" name="porcentaje" id="porcentaje" size="2" value="<?php echo $regpersonaldata["porcentajeconadis"]?>" onkeypress="return soloNumerosm1(event)" >
    %
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <h4 align="center" style="background:rgba(147,25,25,1.00); color:rgba(255,255,255,1.00); padding:4px; margin:0px">Datos de Contacto y Domicilio</h4><br>
    </td>

    </tr>
 
   <tr>
    <td align="right" valign="top"><strong>Teléfonos:</strong></td>
    <td><input type="text" name="telefonocasa" placeholder="Casa" id="telefonocasa" size="10" value="<?php echo $regpersonaldata["telfcasa_gp"]?>" onkeypress="return soloNumerosm1(event)">
      <br>
      <?php 
	  #recupera telefonos
	  $telefonosmovil = explode(":", $regpersonaldata["movil_per_gp"]);
	  list($movil1, $movil2, $movil3)=$telefonosmovil;
	  ?>
      <input type="text" name="telefonos[]" placeholder="Celular" id="telefono1" size="10" value="<?php echo $movil1;?>" onkeypress="return soloNumerosm1(event)"><input type="text" name="telefonos[]" placeholder="Celular" id="telefono2" size="10" value="<?php echo $movil2;?>" onkeypress="return soloNumerosm1(event)"><input type="text" name="telefonos[]" placeholder="Otro" id="telefono3" size="10" value="<?php echo $movil3;?>" onkeypress="return soloNumerosm1(event)">  
      
    </td>
  </tr>
  <tr>
    <td align="right"><strong>Correo Personal:</strong></td>
    <td><input type="text" name="correopersonal" id="correopersonal" size="40" value="<?php echo $regpersonaldata["correo_per_gp"]?>" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Correo Institucional:</strong></td>
    <td><input type="text" name="correo" id="correo" size="40" value="<?php echo $regpersonaldata["correo"]?>" ></td>
  </tr>
  <tr>
    <td width="153" align="right"><strong>Calle Principal:</strong></td>
    <td width="327"><input type="text" name="calleprincipal" id="calleprincipal" size="40" class="requerido" value="<?php echo $regpersonaldata["dir_domicilio_gp"]?>" ></td>
  </tr>
   <tr>
    <td align="right"><strong>Calle Secundaria:</strong></td>
    <td><input type="text" name="callesecundaria" id="callesecundaria" size="40" class="requerido" value="<?php echo $regpersonaldata["callesecundaria"]?>" ></td>
   </tr>
  <tr>
    <td align="right"><strong>N°- de Casa:</strong></td>
    <td><input type="text" name="numcasa" id="numcasa" size="13" value="<?php echo $regpersonaldata["ncasa"]?>" onkeypress="return soloNumerosm1(event)"></td>
  </tr>
  <tr>
    <td align="right"><strong>Provincia:</strong></td>
    <td><input type="text" name="provincia" id="provincia" size="40" class="requerido" value="<?php echo $regpersonaldata["provinciadomic"]?>" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Cantón:</strong></td>
    <td><input type="text" name="canton" id="canton" size="40" class="requerido" value="<?php echo $regpersonaldata["cantondomic"]?>" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Parroquía:</strong></td>
    <td><input type="text" name="parroquia" id="parroquia" size="40" class="requerido" value="<?php echo $regpersonaldata["parroquiadomic"]?>" ></td>
  </tr>
  <tr>
    <td align="right"><strong>Años de Residencia:</strong></td>
    <td><input type="text" name="aniosresidencia" id="aniosresidencia" size="13" value="<?php echo $regpersonaldata["aniosresidente"]?>" onkeypress="return soloNumerosm1(event)"></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#931919" style="color:rgba(255,255,255,1.00)"><h4 align="center" style="background:rgba(147,25,25,1.00); color:rgba(255,255,255,1.00); padding:4px; margin:0px">Datos del Cónyuge</h4></td>
    </tr>
    <tr>
    <td align="right"><strong>Tipo de relación:</strong></td>
    <td><select name="conyuge" id="conyuge" required  style="width:170px">
      <option 	value="">.: Seleccione :.</option>
      <option <?php if($regpersonaldata["conyuge"]=="Cónyugue") echo "selected";?>	value="Cónyugue">Cónyugue</option>
      <option <?php if($regpersonaldata["conyuge"]=="Conviviente") echo "selected";?>	value="Conviviente">Conviviente</option>
    </select></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Cédula:</strong></td>
    <td><input type="text" name="cedulaconyuge" class="caja_textos" id="cedulaconyuge"  required onBlur="validar_cedula('#cedulaconyuge','#errorcedulaconyugue')"  maxlength="10" value="<?php echo $regpersonaldata["cedulaconyuge"]?>"  onkeypress="return soloNumerosm1(event)">
    <span id="errorcedulaconyugue" style="color:red; display:none"><br>
Cédula Incorrecta</span>
    </td>
  </tr>
  
  <tr>
    <td align="right"><strong>Apellidos:</strong></td>
    <td><input type="text" class="requerido" id="apellidosconyugue" name="apellidosconyugue" size="40" title="Nombres" required value="<?php echo $regpersonaldata["apellidosconyugue"]?>" onBlur="$('#apellidosconyugue').val(ucFirstAllWords($('#apellidosconyugue').val()))"></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Nombres:</strong></td>
    <td><input type="text" name="nombresconyuge" id="nombresconyuge" size="40" class="requerido" required value="<?php echo $regpersonaldata["nombresconyuge"]?>" onBlur="$('#nombresconyuge').val(ucFirstAllWords($('#nombresconyuge').val()))"></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Teléfono:</strong></td>
    <td><input type="text" name="telefonosconyuge" id="telefonosconyuge" size="10" value="<?php echo $regpersonaldata["telefonosconyuge"];?>" onkeypress="return soloNumerosm1(event)">
      </td>
  </tr>
  
  <tr>
    <td colspan="2" align="right" bgcolor="#931919" style="color:rgba(255,255,255,1.00)"><h4 align="center" style="background:rgba(147,25,25,1.00); color:rgba(255,255,255,1.00); padding:4px; margin:0px">Otros Datos del funcionario</h4></td>
    </tr>
   <tr>
     <td align="right" valign="middle"><strong>N° Afiliación del Seguro:</strong></td>
     <td><input type="text" name="nafiliacion" id="nafiliacion" size="10" value="<?php echo $regpersonaldata["nafiliacion"];?>" ></td>
   </tr>
   <tr>
     <td align="right" valign="middle"><strong>Contacto emergencia:</strong></td>
     <td><input type="text" class="requerido" id="nombreemergencia" name="nombreemergencia" size="40" title="Contacto en caso de emergencia"  value="<?php echo $regpersonaldata["nombreemergencia"]?>" onBlur="$('#nombreemergencia').val(ucFirstAllWords($('#nombreemergencia').val()))"></td>
   </tr>
   <tr>
     <td align="right" valign="middle"><strong>Telefono:</strong></td>
     <td><input type="text" name="telefonoemergencia" id="telefonoemergencia" size="10" value="<?php echo $regpersonaldata["telefonoemergencia"];?>" ></td>
   </tr>
   <tr>
     <td align="right" valign="top"><strong>Observaciones:</strong></td>
     <td><textarea name="observaciones" id="observaciones" style="width:260px;height:63px; margin-top:5px;"><?php echo $regpersonaldata["observaciones"]?></textarea></td>
   </tr>
 
</table><br>


</div>



<div align="center" style="text-align:center; clear:both;">
<input type="button" class="boton color_btn_azul" value="Guardar" onClick="guarda_personal()">

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo_personal','funcionarios_load');"> 
&nbsp;&nbsp;&nbsp;
</div>
    

<br>

 </form>
 <script>
 // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fnacimiento').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            });
 
 function guarda_personal()
 {
	 /**validar antes de guardar**/
	 $('#apellidos').val($.trim($('#apellidos').val()));
	 $('#nombres').val($.trim($('#nombres').val()));
	 
	 if($('#cedula').val().length==10 && $('#apellidos').val().length>3 && $('#nombres').val().length>3)
	 {
	 
	 
	  /**guardar**/
 	cerrar_abrir('nuevo_personal','funcionarios_load');
	cargardiv_form('mod_talento_humano/script/mostrar_personal.php','#funcionarios_load','#fomulariopersonal')
	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
 calcular_edad();
 
 function MaysPrimera(string){
	

  return texto.charAt(0).toUpperCase() + texto.slice(1);
}

function ucFirstAllWords( str )
{
	
	texto = str.toLowerCase();
	
    var pieces = texto.split(" ");
    for ( var i = 0; i < pieces.length; i++ )
    {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    return pieces.join(" ");
}
 </script>
