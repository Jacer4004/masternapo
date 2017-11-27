<?php 
$sqlpersonal=mysql_query("select m5sts_ip.*,concat_ws(' ',gad_personal.apellidos,gad_personal.nombres) as nomina,gad_personal.puesto,gad_personal.correo, gad_dependencia.nombre as dependencia,gad_personal.id_personal as gad_id_personal  from m5sts_ip
left join gad_personal on m5sts_ip.id_personal=gad_personal.id_personal
left join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia",$conectar) or die ("ERROR_");

?><head>
<link rel="stylesheet" href="../estilos/css.css" type="text/css" charset="utf-8"/>

</head>

<?php if (in_array("M5SDIPAE", $accesos)) {?> <div class="ventanas" id="nuevo" style="width:650px; display:none">
<h3 id="<?php echo $colorfondo?>"align="center">Configuración de Red</h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" method="post" onSubmit="javascript:js_general('mod_soporte_sistemas/g_ip','color_cyan','<?php echo $tiempo_cookie;?>')">
<input type="hidden" name="id_ip" id="id_ip" value="">       	 

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
    
    </select>
    
    </td>
  </tr>
  <tr>
    <td align="right">Ubicación Geográfica</td>
    <td><select style="width:290px" name="ugeografica" id="ugeografica" required>
      <option	value="">.: Seleccione :.</option>
      <option	value="Zona 1 - Planta Central">Zona 1 - Planta Central</option>
      <option	value="Zona 2 - Ambiente">Zona 2 - Ambiente</option>
      <option	value="Zona 3 - Planificación">Zona 3 - Planificación</option>
      <option	value="Zona 4 - Desarrollo Socioeconómico">Zona 4 - Desarrollo Socioeconómico</option>
      <option	value="Zona 5 - Ally TV">Zona 5 - Ally TV</option>
      <option	value="Zona 6 - Talleres">Zona 6 - Talleres</option>
  
    </select></td>
  </tr>
  <tr>
    <td align="right">Dispositivo:</td>
    <td><select style="width:290px" name="dispositivo" id="dispositivo" required>
      <option	value="">.: Seleccione :.</option>
      <?php
	  $querydenoinacion=mysql_query("select * from conf_nom_equipo order by nom_config",$conectar) or die ("No se pudo conectar a la BD");
	  while($regconfig=mysql_fetch_array($querydenoinacion))
	  {
	  ?>
      <option	value="<?php echo $regconfig["nom_config"]?>"><?php echo $regconfig["nom_config"]?></option>
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Nombre de host:</td>
    <td>
    
    <input type="text" name="hostname" id="hostname" size="40" required value="compu"  onBlur="javascript:Validar_host(hostname.value);" placeholder="Ejmp: compu100">
<img src="imag/loading2.gif" height="26" width="26" style="vertical-align:middle;display:none" id="preloadimghost"><br><div id="resultadoshost" style="color:rgba(14,45,167,1.00); "></div>
    </td>
  </tr>
  <tr>
    <td align="right">Direccíón IP:</td>
    <td>
    
    <input type="text" name="direccionip" id="direccionip" size="40" required value="172.16."  onBlur="javascript:Validar_IP(direccionip.value);"><img src="imag/loading2.gif" height="26" width="26" style="vertical-align:middle;display:none" id="preloadimg"><br><div id="resultadovalip" style="color:rgba(14,45,167,1.00); "></div>
    </td>
  </tr>
  <tr>
    <td align="right">Mascara de subred:</td>
    <td><input type="text" name="mascara" id="mascara" size="40" required value="255.255.252.000"></td>
  </tr>
  <tr>
    <td align="right">Gateway:</td>
    <td><input type="text" name="gateway" id="gateway" size="40" required value="172.16.0.254"></td>
  </tr>
  <tr>
    <td align="right">DNS Preferido:</td>
    <td><input type="text" name="dns1" id="dns1" size="40" required value="172.16.0.253"></td>
    
     <tr>
    <td align="right">DNS Alternativo:</td>
    <td><input type="text" name="dns2" id="dns2" size="40" required value="172.16.0.254"></td>
    <tr>
    <td align="right">Fecha de Asignación:</td>
    <td><input type="text" name="fecharegistro"  id="fecharegistro" placeholder="aaaa-mm-dd" required></td>
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
<input id="btnguardar" type="submit" class="boton color_btn_azul" value="Guardar"> 

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>

  </form>
</div><?php }?>


<!--formulario de reportes-->
<?php if (in_array("M5SDIPREP28", $accesos)) {?>
<div class="ventanas" id="reportes_ip28" style="width:95%; display:none;  text-align:center !important" align="center">
<h3 id="<?php echo $colorfondo?>"align="center">Resportes de direcciones IP </h3>
<div class="menu_exploracion" align="center">
    
  <a href="#"onClick="javascript:cerrar_abrir('reportes_ip28','contenedor')"><img style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a></div>
  <hr>
  <h4 style="margin:0px; padding:0px" align="center">
  <div class="tablas_reportes" align="center" style="text-align:center">
  
  <table border="0" align="center" width="500">
  <tr>
    <td width="81%" align="center"><strong>NOMBRE</strong></td>
    <td width="19%" align="center"><strong>OPERACIONES</strong></td>
  </tr>
  <tr>
    <td>Zona 
    <select name="ipzona">
    	<option value="todas">Todas</option>
        <option	value="Zona 1 - Planta Central">Zona 1 - Planta Central</option>
      <option	value="Zona 2 - Ambiente">Zona 2 - Ambiente</option>
      <option	value="Zona 3 - Palnificación">Zona 3 - Planificación</option>
      <option	value="Zona 4 - Desarrollo Socioeconómico">Zona 4 - Desarrollo Socioeconómico</option>
      <option	value="Zona 5 - Ally TV">Zona 5 - Ally TV</option>
      <option	value="Zona 6 - Talleres">Zona 6 - Talleres</option>
        
    </select>
    </td>
    <td><div align="center">#<!--<a href="mod_soporte_sistemas/reportes/ver_equipos_listado.php?/cate=&/modo=pdf" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=800,height=600'); return false;"><img src="imag/doc_pdf.png"></a>&nbsp;&nbsp;--><a href="mod_soporte_sistemas/reportes/ver_ip_listado.php?/identificador=&/modo=html" onclick="window.open(this.href, '', 'scrollbars=Yes,location=no,menubar=Yes,fullscreen=no,width=800,height=600'); return false;"><img src="imag/buscardoc.png"></a></div>
    </td>
  </tr>

</table>
</div>
</h4>
</div>
<?php }?>


<div class="ventanas" id="contenedor" style="width:98% !important; margin-left:0px; padding-left:0px;" >
<h3 id="<?php echo $colorfondo?>"align="center">Usuarios y Configuraciones</h3>

<ul class="menusecundario">
	  
 </ul>
<div align="center" style="text-align:center">
<div align="left" class="menu_exploracion">

<a href="inicio.php" onClick="javascript:js_general('mod_soporte_sistemas','');"><img  style="vertical-align:middle" src="imag/atras.png" ></a>

<?php if (in_array("M5SDIPAE", $accesos)) {?>
<a href="javascript:void();" title="Agregar Dirección IP" onClick="javascript:cerrar_abrir('contenedor','nuevo');  "><img  style="vertical-align:middle" src="imag/dirip.png" ></a><?php }?>

<?php if (in_array("M5SDIPREP28", $accesos)) {?>
<a href="javascript:void();" title="Reportes Dirección IP" onClick="javascript:cerrar_abrir('contenedor','reportes_ip28');  "><img style="vertical-align:middle;" src="imag/report.png"> Reportes</a><?php }?>


<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>

</div>
<div class="" style="margin:5px; margin-left:0px; width:100%; font-size:15px" align="center">
  <table align="center" id="report" style="width:98%; border:1px solid #77BEEC !important ; font-size:14px" >
  <thead>
        <tr style="font-size:12px">
            <th width="1" align="center" >#</th>
            <th align="center" >FUNCIONARIO</th>
            <th align="center" >HOSTNAME</th>
            <th align="center" ><div align="center" style="text-align:center">DIRECCIÓN IP</div> </th>
            <th align="center" >DISPOSITIVO</th>
            <th align="center" >ESTADO</th>
            <th align="center" >UBICACIÓN GEOGRAFICA</th>
            <th align="center" ></th>
        </tr>
  </thead>
  <tbody style="border:1px solid #77BEEC !important">      
<?php 
  while($regpersonal=mysql_fetch_array($sqlpersonal))
  {
	  $cont=$cont+1;
  ?>        
  
        <tr id="buscaraqui" style="border:1px solid #77BEEC !important" >
            <td width="1" ><?php echo $cont; ?></td>
            <td align="left"><?php echo $regpersonal["nomina"]; ?></td>
            <td align="center"><?php echo $regpersonal["hostname"]; ?></td>
            <td align="center"><?php echo $regpersonal["ip"]; ?></td>
            <td align="center"><?php echo $regpersonal["dispositivo"]; ?></td>
            <td align="center"><?php echo $regpersonal["estado_ip"]; ?></td>
            <td><?php echo $regpersonal["ugeografica"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui" style="display:none">
            <td colspan="8" align="center">
            <div style="background:rgba(103,190,232,1.00); display:table; width:100%; text-align:center" align="center"  >
            <div style="width:45%; margin:10px; padding:10px; float:left; background:rgba(103,190,232,1.00)" >
    <h4>Información complementaria</h4>
              <ul style="list-style:square">
                    <li><strong style="font-size:13px">FUNCIONARIO:</strong><?php echo $regpersonal["nomina"]?></li>
                    <li><strong style="font-size:13px">DEPENDENCIA: </strong><?php echo $regpersonal["dependencia"]?></li>
                    <li><strong style="font-size:13px">CARGO: </strong><?php echo $regpersonal["puesto"]?></li>
                    <li><strong style="font-size:13px">CORREO: </strong><?php echo $regpersonal["correo"]?></li>
                    <li><strong style="font-size:13px">UBICACIÓN: </strong><?php echo $regpersonal["ugeografica"]; ?></li>
                    <li><div style=" padding-top:5px; padding-bottom:5px; padding-right:5px !important; background:rgba(255,255,255,1.00); display:inline-block;border-radius:5px !important; padding-left:5px"><strong style="font-size:13px;vertical-align:middle;">DIRECCIÓN FISICA</strong>&nbsp;&nbsp;&nbsp;<?php if (in_array("M5SDIPAE", $accesos)) {?><a href="javascript:void();" title="Agregar Dirección IP" onClick="javascript:cerrar_abrir('contenedor','nuevo'); Editar_ip(<?php echo $cont;?>) "><img style="vertical-align:middle; cursor:pointer" src="imag/edit.png" height="20" width="20">
                 </a><?php }?></div>
<ul> 
                  <li><strong style="font-size:13px">DISPOSITIVO: </strong><?php echo $regpersonal["dispositivo"]; ?> &nbsp;</li>
                  <li><strong style="font-size:13px">IP: </strong><?php echo $regpersonal["ip"]; ?> &nbsp;</li>
                  
                  <li><strong style="font-size:13px">MASCARA: </strong><?php echo $regpersonal["mascara"]; ?>&nbsp; </li>
                  <li><strong style="font-size:13px">GATEWAY: </strong><?php echo $regpersonal["gateway"]; ?> &nbsp;</li>
                  <li><strong style="font-size:13px">DNS 1: </strong><?php echo $regpersonal["dnsprimario"]; ?>&nbsp; &nbsp;</li>
                  <li><strong style="font-size:13px">DNS 2: </strong><?php echo $regpersonal["dnssecundario"]; ?> &nbsp;&nbsp;</li>
                  <li><strong style="font-size:13px">ESTADO: </strong><?php if($regpersonal["estado_ip"]=="Inactivo")
				  {
					  echo "Inactivo desde: ".$regpersonal["f_inactivo_ip"];
				  }else
				  {
				   echo $regpersonal["estado_ip"]; 
				  }
				   ?></li>
                  <li><strong style="font-size:13px">OBSERVACIONES:</strong> <?php echo $regpersonal["historial_ip"]; ?></li>
                    
                  </ul> 
                    </li>
              </ul>
               <input type="button" value="Ver Dependencias" onClick="Validar_Dependencias('<?php echo $regpersonal["ip"];?>','<?php echo $cont;?>','<?php echo $regpersonal["gad_id_personal"];?>')" class="boton color_btn_negro">
              <br>
 <input type="hidden" value="<?php 
				 echo $regpersonal["id_ip"].")#(".
				 $regpersonal["dependencia"].")#(".
				 $regpersonal["nomina"].")#(".
				 $regpersonal["ugeografica"].")#(".
				 $regpersonal["ip"].")#(".
				 $regpersonal["mascara"].")#(".
				 $regpersonal["gateway"].")#(".
				 $regpersonal["dnsprimario"].")#(".
				 $regpersonal["dnssecundario"].")#(".
				 $regpersonal["f_creacion_ip"].")#(".
				 $regpersonal["estado_ip"].")#(".
				 $regpersonal["f_inactivo_ip"].")#(".
				 $regpersonal["historial_ip"].")#(".
				 strtoupper($regpersonal["dispositivo"]).")#(".
				 $regpersonal["hostname"];
				 ?>" name="alldata_ip[<?php echo $cont?>]" id="alldata_ip[<?php echo $cont;?>]">
    </div>
       <div style="float:left; width:45%; margin-left:10px; padding:10px; text-align:left">
       <div id="verdependencias<?php echo $cont;?>">
       
       </div>
       <img id="idloading<?php echo $cont;?>" src="imag/Loading5.gif" style="display:none">
       </div>
  
</div>
            

          </td>
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
		
jQuery(function($){
$("#direccionip").mask("999.999.999.999",{placeholder:"_"});
$("#mascara").mask("999.999.999.999",{placeholder:"255.255.252.000"});
$("#gateway").mask("999.999.999.999",{placeholder:"172.016.000.254"});
$("#dns1").mask("999.999.999.999",{placeholder:"172.016.000.250"});
$("#dns2").mask("999.999.999.999",{placeholder:"000.000.000.000"});

});

function Validar_IP(valip)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	
	var archivo='mod_soporte_sistemas/script/verificar_ip.php'; 
	var result="#resultadovalip";
	$(result).css("display", "none");//id del select
	$("#preloadimg").css("display", "inline");
	//hasta aqui para mostrar el loading
	
	
	var variable_post=valip;
	$.post('mod_soporte_sistemas/script/verificar_ip.php', { variable: variable_post }, function(data){
	$(result).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	$(result).css("display", "inline");
	$("#preloadimg").css("display", "none");
	});			
}

function Validar_host(valhost)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	
	//var archivo='mod_soporte_sistemas/script/verificar_ip.php'; 
	var resulthost="#resultadoshost";
	
	
	$(resulthost).css("display", "none");//id del select
	
	$("#preloadimghost").css("display", "inline");
	//$(resulthost).html('<img src="imag/loader-orange.gif">');
	//hasta aqui para mostrar el loading
	
	
	
	var variable_host=valhost;
	$.post('mod_soporte_sistemas/script/hostvalidar.php', { variablehost: variable_host }, function(data){
	$(resulthost).html(data);
	$(resulthost).css("display", "inline");
	$("#preloadimghost").css("display", "none");
	});			
}

//funcion para consultar dependencias
function Validar_Dependencias(val_ip,increment,id_pe)
{	

	var result="#verdependencias"+increment;
	var loadimg="#idloading"+increment;
	$(result).css("display", "none");//id del select
	$(loadimg).css("display", "inline");
	//hasta aqui para mostrar el loading
	
	var variable_post=val_ip;
	var variable_post2=id_pe;
	
	$.post('mod_soporte_sistemas/script/consultar_dependencias_ip.php', { variable: variable_post,variable2:variable_post2 }, function(data){
	$(result).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	$(result).css("display", "inline");
	$(loadimg).css("display", "none");
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
function Editar_ip(ip_edit)
{
	
	valor="alldata_ip["+ip_edit+"]";
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
	
	$('#id_ip').val(DATOS[0]);
	$('#ugeografica').val(DATOS[3]);
	
	$('#direccionip').val(DATOS[4]);
	$('#mascara').val(DATOS[5]);
	$('#gateway').val(DATOS[6]);
	$('#dns1').val(DATOS[7]);
	$('#dns2').val(DATOS[8]);
	$('#fecharegistro').val(DATOS[9]);
	$('#estado').val(DATOS[10]);
	$('#otros').val(DATOS[12]);
	$('#dispositivo').val(DATOS[13]);
	$('#hostname').val(DATOS[14]);
	
	if(DATOS[10]=="Inactivo")
	{ 
		document.getElementById('finactivo').style.display="inline";
		document.getElementById('finactivo').innerHTML="Inactivo desde: "+DATOS[11];
	}
}

</script>
        