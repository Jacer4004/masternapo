<?php 
$sqlpersonal=mysql_query("select m5sts_us_ad.*,concat_ws(' ',gad_personal.apellidos,gad_personal.nombres) as nomina,gad_personal.puesto,gad_personal.correo, gad_dependencia.nombre as dependencia  from m5sts_us_ad
left join gad_personal on m5sts_us_ad.id_personal=gad_personal.id_personal
left join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia",$conectar) or die ("ERROR_");

?><head>
<link rel="stylesheet" href="../estilos/css.css" type="text/css" charset="utf-8"/>

</head>
<?php if (in_array("M5SUA_NUEVO", $accesos)) {?>
<div class="ventanas" id="nuevo" style="width:650px; display:none">
<h3 id="color_blue" align="center">Usuarios de la Red [Active Directory]</h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" method="post" onSubmit="javascript:js_general('mod_soporte_sistemas/g_us_AD','color_cyan','<?php echo $tiempo_cookie;?>')">
<input type="hidden" name="id_us_ad" id="id_us_ad" value="">       	 

<table width="596" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="218" align="right">Dependencia: </td>
    <td width="378">
    <select name="dependencia" required id="dependencia" style="width:290px" onChange="cargarcombo(dependencia.value,'combos/cb_usuarios_permisos.cbo.php','usuarios_area');">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  $sqlareas_sum=mysql_query("select * from gad_dependencia order by nombre",$conectar) or die("ERROR_");
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
    <td align="right">Funcionario:</td>
    <td>
    <select style="width:290px" name="usuarios_area" id="usuarios_area" required>
      <option	value="">.: Seleccione :.</option>
    
    </select></td>
  </tr>
  <tr>
    <td align="right">Usuario:</td>
    <td><input type="text" name="usuario" id="usuario" size="40" required value=""  onBlur="javascript:Validar_usuario(usuario.value);"><img src="imag/loading2.gif" height="26" width="26" style="vertical-align:middle;display:none" id="preloadimg"><div id="resultadovalip" style="color:rgba(14,45,167,1.00); "></div>
      </td>
  </tr>
  <tr>
    <td align="right">Contraseña</td>
    <td><input type="text" name="contrasenia" id="contrasenia" size="40" required value=""></td>
  </tr>
  <tr>
    <td align="right">Fecha de Asignación:</td>
    <td><input type="text" name="fecharegistro"  id="fecharegistro" placeholder="aaaa-mm-dd" required></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Perfil de Cuenta</td>
    <td><select name="perfilusuario" id="perfilusuario" required>
      <option	value="">.:Seleccione:.</option>
      <option	value="Administrador">Administrador</option>
      <option	value="Estandar">Estandar</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Estado:</td>
    <td><select name="estado" id="estado" required>
      <option	value="">.:Seleccione:.</option>
      <option	value="Activo">Activo</option>
      <option	value="Inactivo">Inactivo</option>
    </select><span id="finactivo" style="display:none">Inactivo desde:</span> </td>
  </tr>
  <tr>
    <td align="right">Otros datos:</td>
    <td><textarea name="otros" id="otros" cols="40"></textarea></td>
  </tr>
</table>
<br>
<br>
<div align="center" style="text-align:center">
<input type="submit" id="btnguardar" class="boton color_btn_azul" value="Guardar"> 

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>

  </form>
</div>
<?php }#cierrar seguridad para validar accesos?>
<div class="ventanas" id="contenedor" style="width:98% !important; margin-left:0px; padding-left:0px;" >
<h3 id="<?php echo $colorfondo?>"align="center">Usuarios y Configuraciones</h3>

<ul class="menusecundario">
	  
 </ul>
<div align="center" style="text-align:center">
<div align="left" class="menu_exploracion">

<a href="inicio.php" onClick="javascript:js_general('mod_soporte_sistemas','');"><img  style="vertical-align:middle" src="imag/atras.png" ></a>
<?php if (in_array("M5SUA_NUEVO", $accesos)) {?>
<a href="javascript:void();" title="Agregar Dirección IP" onClick="javascript:Reset_form('fomulariook');cerrar_abrir('contenedor','nuevo');  "><img  style="vertical-align:middle" src="imag/usad.png" ></a>
<?php }?>
<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>

</div>
<div class="" style="margin:5px; margin-left:0px; width:100%; font-size:15px" align="center">
  <table align="center" id="report" style="width:98%;">
  <thead>
        <tr>
            <th width="1" align="center" >#</th>
            <th align="center" >FUNCIONARIO</th>
            <th align="center" ><div align="center" style="text-align:center">USUARIO</div> </th>
            <th align="center" >PERFIL</th>
            <th align="center" >ESTADO</th>
            <th align="center" ></th>
        </tr>
  </thead>
  <tbody>      
<?php 
  while($regpersonal=mysql_fetch_array($sqlpersonal))
  {
	  $cont=$cont+1;
  ?>        
  
        <tr id="buscaraqui" >
            <td width="1" ><?php echo $cont; ?></td>
            <td align="left"><?php echo $regpersonal["nomina"]; ?></td>
            <td align="center"><?php echo $regpersonal["nom_usu_ad"]; ?></td>
            <td align="center"><?php echo $regpersonal["perfilusuario"]; ?></td>
            <td><?php echo $regpersonal["estado"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="6"><h4>Información complementaria</h4>
              <ul style="list-style:square">
                    <li><strong style="font-size:13px">FUNCIONARIO:</strong><?php echo $regpersonal["nomina"]?></li>
                    <li><strong style="font-size:13px">DEPENDENCIA: </strong><?php echo $regpersonal["dependencia"]?></li>
                    <li><strong style="font-size:13px">CARGO: </strong><?php echo $regpersonal["puesto"]?></li>
                    <li><strong style="font-size:13px">CORREO: </strong><?php echo $regpersonal["correo"]?></li>
                    <li><div style=" padding-top:5px; padding-bottom:5px; padding-right:5px; background:rgba(255,255,255,1.00); display:inline-block; border-radius:5px"><strong style="font-size:13px; vertical-align:middle; padding-left:5px">USUARIO ACTIVE DIRECTORY</strong>&nbsp;&nbsp;&nbsp;<?php if (in_array("M5SUA_NUEVO", $accesos)) {?><a href="javascript:void();" title="Agregar Dirección IP" onClick="javascript:cerrar_abrir('contenedor','nuevo'); Editar_usuario(<?php echo $cont;?>) "><img style="vertical-align:middle; cursor:pointer" src="imag/edit.png" height="20" width="20">
                 </a><?php }?></div>
<ul> 
                  <li><strong style="font-size:13px">USUARIO: </strong><?php echo $regpersonal["nom_usu_ad"]; ?> &nbsp;</li>
                  <li><strong style="font-size:13px">PERFIL: </strong><?php echo $regpersonal["perfilusuario"]; ?> &nbsp;</li>
                  <li><strong style="font-size:13px">CONTRASEÑA: </strong><?php echo $regpersonal["contrasenia"]; ?>&nbsp; </li>
                  <li><strong style="font-size:13px">FECHA DE CREACIÓN: </strong><?php echo $regpersonal["f_creacion"]; ?> &nbsp;</li>
                  
                  <li><strong style="font-size:13px">ESTADO: </strong><?php if($regpersonal["estado"]=="Inactivo")
				  {
					  echo "Inactivo desde: ".$regpersonal["f_inactivo_us"];
				  }else
				  {
				   echo $regpersonal["estado"]; 
				  }
				   ?></li>
                  <li><strong style="font-size:13px">OBSERVACIONES:</strong> <?php echo $regpersonal["observaciones"]; ?></li>
                    
                  </ul>
<br>
 <input type="hidden" value="<?php 
				 echo $regpersonal["id_us_ad"].")#(".
				 $regpersonal["dependencia"].")#(".
				 $regpersonal["nomina"].")#(".
				 $regpersonal["nom_usu_ad"].")#(".
				 $regpersonal["contrasenia"].")#(".
				 $regpersonal["f_creacion"].")#(".
				 $regpersonal["estado"].")#(".
				 $regpersonal["f_inactivo_us"].")#(".
				 $regpersonal["observaciones"].")#(".
				 $regpersonal["perfilusuario"];
				 
				 ?>" name="auxiliar[<?php echo $cont?>]" id="auxiliar[<?php echo $cont;?>]">
          </li>
          </ul></td>
        </tr>
       
 <?php 
  }
  ?>       
      </tbody> 
       
  </table>
</div>

<hr>

</div>
</div>


<script>


document.getElementById('nuevo').style.display="none";

</script>
<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecharegistro').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
		

function Validar_usuario(valip)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	
	var archivo='mod_soporte_sistemas/script/verificar_us.php'; 
	var result="#resultadovalip";
	$(result).css("display", "none");//id del select
	$("#preloadimg").css("display", "inline");
	//hasta aqui para mostrar el loading
	
	
	var variable_post=valip;
	$.post(archivo, { variable: variable_post }, function(data){
	$(result).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	$(result).css("display", "inline");
	$("#preloadimg").css("display", "none");
	});		
	
	
}
function varduplicado()
{
	if(document.getElementById('valduplicado').value=="")
	{
		$("#btnguardar").css("display", "inline");
	}
	else
	{
		$("#btnguardar").css("display", "none");
	}
}
function Editar_usuario(dato)
{
	
	valor="auxiliar["+dato+"]";
	document.getElementById("fomulariook").reset();
	//$('#area_personal > option[value=""]').attr('selected', 'selected');

	var DATOS=document.getElementById(valor).value;
	
	var DATOS=DATOS.split(')#(');
	
	$('#dependencia option').remove()
	$('#dependencia').append(new Option(DATOS[1], DATOS[1], true, true));
	
	$('#usuarios_area option').remove()
	$('#usuarios_area').append(new Option(DATOS[2], DATOS[2], true, true));
	
	//$('#ugeografica option').remove()
	//$('#ugeografica').append(new Option(DATOS[3], DATOS[3], true, true));
	
	$('#id_us_ad').val(DATOS[0]);
	$('#usuario').val(DATOS[3]);
	
	$('#contrasenia').val(DATOS[4]);
	$('#fecharegistro').val(DATOS[5]);
	$('#estado').val(DATOS[6]);
	$('#otros').val(DATOS[8]);
	$('#perfilusuario').val(DATOS[9]);
	
	
	if(DATOS[7]=="Inactivo")
	{ 
		document.getElementById('finactivo').style.display="inline";
		document.getElementById('finactivo').innerHTML="Inactivo desde: "+DATOS[7];
	}
}

function Reset_form(formulario)
{
	$('#dependencia option').remove();
	$('#usuarios_area option').remove();
	document.getElementById(formulario).reset();
	
	Recargar_combo('dependecnias','dependencia');

}

</script>
        