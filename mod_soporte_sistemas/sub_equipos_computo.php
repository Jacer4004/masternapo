<?php 
$sqlactivos=mysql_query("select * from m5sts_equipos",$conectar) or die("Error 1");
?><head>
<link rel="stylesheet" href="../estilos/css.css" type="text/css" charset="utf-8"/>
   
</head>
<?php if (in_array("M5SEC_NUEVO", $accesos)) {?>
<div class="ventanas" id="nuevo" style="width:95%; display:none">
<h3 id="<?php echo $colorfondo?>"align="center">Registro de Equipo </h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" method="post" onSubmit="javascript:js_general('mod_soporte_sistemas/g_equipos','color_cyan','<?php echo $tiempo_cookie;?>')">
<input type="hidden" name="id_equipo" id="id_equipo" value="">       	 <br>
<br>


<table width="604" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right">Propiedad:</td>
    <td><select name="propiedad" id="propiedad" required onChange="validar_secuencia(propiedad.value,'mod_soporte_sistemas/script/verificar_num_activo.php','codigo');">
      <option	value="Institucional">Institucional</option>
      <option	value="Personal">Personal</option>
      <option	value="Donado">Donado</option>
      <option	value="Conmodato">Conmodato</option>
    </select><input type="hidden" id="registrapersona" value="<?php echo $_SESSION['userid'];?>"></td>
  </tr>
  <tr>
    <td width="153" align="right">Código de Activo: </td>
    <td width="353"><input type="text" class="requerido" name="codigo" id="codigo" size="40" title="Ingrese el código del activo" value="" required onBlur="Quitarespacios('codigo');$('#nombre').val($('option:first', select).val());$('#resultadovalequipo').html('')"></td>
  </tr>
  <tr>
    <td align="right">Equipo:</td>
    <td>
    <select name="nombre" class="requerido" required id="nombre" onChange="Validar_equipo_existe(codigo.value,nombre.value);">
    <option value="" >.:Seleccione:.</option>
    <?php 
	$sqlauxequipos=mysql_query("select * from m5sts_aux_equipos order by nombre",$conectar)or die("ERROR EN AUXILIAR EQUIPOS");
	while($regauxequipos=mysql_fetch_array($sqlauxequipos))
	{
	?>
    <option value="<?php echo $regauxequipos["nombre"]?>"><?php echo $regauxequipos["nombre"]?></option>
    <?php 
	}
	?>
    </select>
    <span id="resultadovalequipo" style="color:#FF470A; font-size:11px"></span>
    </td>
  </tr>
  <tr>
    <td align="right">Marca:</td>
    <td><input type="text" name="marca" id="marca" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Modelo:</td>
    <td><input type="text"  name="modelo" id="modelo" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Serie:</td>
    <td><input type="text" name="serie" id="serie" size="40" required></td>
  </tr>
  <tr>
    <td align="right">IU/MAC de Equipo</td>
    <td><input type="text" onBlur="Quitarespacios('modelo')" name="IUequipo" id="IUequipo" size="40" ></td>
  <tr>
    <td align="right">Estado:</td>
    <td>
    <select name="estado" id="estado" required>
     	<option	value="Bueno">Bueno</option>
        <option	value="Regular">Regular</option>
        <option	value="Malo">Malo</option>
    </select>
    
    </td>
    
     <tr>
    <td align="right">Fecha de Registro:</td>
    <td>
    <input type="text" name="fecharegistro"  id="fecharegistro" placeholder="aaaa-mm-dd" required value="<?php echo date('Y-m-d');?>">
    
    </td>
    
  <tr>
    <td align="right" valign="middle">Especificaciones:</td>
    <td><textarea name="especificaciones" id="especificaciones" cols="40"></textarea></td>
  </tr>
  <tr>
    <td align="right">Otros datos:</td>
    <td><textarea name="otros" id="otros" cols="40"></textarea></td>
  </tr>
</table>
<br>
<br>
<div align="center" style="text-align:center">
<input type="submit" class="boton color_btn_azul" value="Guardar"> 

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>

        </form>
        
<br>

</div>
<?php }?>


<?php #reporstes de equipos?>
<?php if (in_array("M5SEC_REPORTES26", $accesos)) {?>
<div class="ventanas" id="reportes_equipos26" style="width:95%; display:none;  text-align:center !important" align="center">
<h3 id="<?php echo $colorfondo?>"align="center">Resportes de equipos </h3>
<div class="menu_exploracion" align="center">
    
  <a href="#"onClick="javascript:cerrar_abrir('reportes_equipos26','contenedor')"><img style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a></div>
  <hr>
  <h4 style="margin:0px; padding:0px" align="center">
  <div class="tablas_reportes" align="center" style="text-align:center">
  
  <table border="0" align="center" width="500">
  <tr>
    <td width="81%" align="center"><strong>NOMBRE</strong></td>
    <td width="19%" align="center"><strong>OPERACIONES</strong></td>
  </tr>
<?php 
#recuperalos reportes
$sqlauxequipos_reportes=mysql_query("select * from m5sts_aux_equipos order by nombre",$conectar)or die("ERROR EN AUXILIAR EQUIPOS");
while($regreportes=mysql_fetch_array($sqlauxequipos_reportes))
{
?>  
  <tr>
    <td><?php echo $regreportes["nombre"];?></td>
    <td><div align="center"><a href="mod_soporte_sistemas/reportes/ver_equipos_listado.php?/cate=<?php echo $regreportes["nombre"];?>&/modo=pdf" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=800,height=600'); return false;"><img src="imag/doc_pdf.png"></a>&nbsp;&nbsp;<a href="mod_soporte_sistemas/reportes/ver_equipos_listado.php?/cate=<?php echo $regreportes["nombre"];?>&/modo=html" onclick="window.open(this.href, '', 'scrollbars=Yes,location=no,menubar=Yes,fullscreen=no,width=800,height=600'); return false;"><img src="imag/buscardoc.png"></a></div>
    </td>
  </tr>
<?php 
}
?>
</table>
</div>
</h4>
</div>
<?php }?>
<!--ENTREGA DE EQUIPOS-->

<div class="ventanas" id="contenedor" >
  <h3 id="<?php echo $colorfondo?>"align="center">Equipos de Cómputo </h3>
<div class="menu_exploracion">
    
    <a href="inicio.php" onClick="javascript:js_general('mod_soporte_sistemas','<?php echo $colorfondo?>');"><img style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a>
    
	<?php if (in_array("M5SEC_NUEVO", $accesos)) {?>
    <a href="#" onClick="javascript:cerrar_abrir('contenedor','nuevo'); document.forms.fomulariook.reset();" ><img style="vertical-align:middle;" src="imag/add.png"> Nuevo </a><?php }?>
    
    <?php if (in_array("M5SEC_REPORTES26", $accesos)) {?>
    <a href="#" onClick="javascript:cerrar_abrir('contenedor','reportes_equipos26')" ><img style="vertical-align:middle;" src="imag/report.png"> Reportes </a><?php }?>
  
 


<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>


<div class="" style="margin:10px;" align="center">
<h4 align="center" style="padding-bottom:0px; margin-bottom:3px;">EQUIPOS Y PARTES</h4>
  <?php echo $regactivo["codigoactivo"]; ?>
  <table align="center" id="report" width="100%">
  <thead>
        <tr>
            <th>#</th>
          <th>Código Activo</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>SERIE</th>
            <th width="10">&nbsp;</th>
        </tr>
  </thead>
  <tbody>      
<?php  $cont="";
  while($regactivo=mysql_fetch_array($sqlactivos))
  {
	   $cont=$cont+1;
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $cont;?></td>
          <td><?php echo $regactivo["codigoactivo"];?></td>
            <td><?php echo $regactivo["nombre"]; ?></td>
            <td><?php echo $regactivo["marca"]; ?></td>
            <td><?php echo $regactivo["serie"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui" style="display:none">
            <td colspan="6">
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
                <img src="imag/pc_escritorio_2.jpg" height="128"  width="128" alt="Foto del Usuario" />
                <h4>Descripción completa del Equipo: <?php echo $regactivo["nombre"]." - ".$regactivo["marca"] ; ?></h4>
                <ul>
                    <li><strong>Marca:</strong> <?php echo $regactivo["marca"]; ?></li>
                    <li><strong>Modelo:</strong> <?php echo $regactivo["modelo"]; ?></li>
                    <li><strong>Serie:</strong> <?php echo $regactivo["serie"]; ?></li>
                    <li><strong>IU de Equipo:</strong> <?php echo $regactivo["IUequipo"]; ?></li>
                    <li><strong>Estado:</strong> <?php echo $regactivo["estado"]; ?></li>
                    <li><strong>Fecha de Registro:</strong> <?php echo $regactivo["fecha_registro"]; ?></li>
                    <li><strong>Propietario:</strong> <?php echo $regactivo["propietario"]; ?></li>
                    <li><strong>Especificaciones:</strong> <?php echo $regactivo["especificaciones"]; ?></li>
                    
                    <li><strong>Otros:</strong> <?php echo $regactivo["otros"]; ?></li>
                    <li><strong>Custodio:</strong> <?php 
					$idactivocus=$regactivo["id_equipo"];
					$sqlcustodio=mysql_query("SELECT m5sts_e_e_componentes.* , concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres,gad_personal.apellidos) as nomina 
FROM m5sts_e_e_componentes
INNER JOIN m5sts_entrega_equipos ON m5sts_e_e_componentes.id_ent_equi = m5sts_entrega_equipos.id_ent_equi
INNER JOIN gad_personal ON m5sts_entrega_equipos.id_personal = gad_personal.id_personal where id_equipo='$idactivocus'  and m5sts_entrega_equipos.estadoee='Activo'")or die("ERROR_CUSTODIO");
					$regcustodio=mysql_fetch_array($sqlcustodio);
					echo $regcustodio["nomina"]; ?></li>
              </ul>   

<?php if (in_array("M5SEC_NUEVO", $accesos)) {?>

               <a href="#" class="boton_pequenio color_btn_azul" onClick="javascript:Pasar_Datos_equipos(<?php echo $cont?>);cerrar_abrir('contenedor','nuevo');">Editar</a>
              <input type="hidden" value="<?php 
				 echo $regactivo["id_equipo"].")(".
				 $regactivo["codigoactivo"].")(".
				 $regactivo["nombre"].")(".
				 $regactivo["marca"].")(".
				 $regactivo["modelo"].")(".
				 $regactivo["serie"].")(".
				 $regactivo["estado"].")(".
				 $regactivo["fecha_registro"].")(".
				 $regactivo["propietario"].")(".
				 $regactivo["especificaciones"].")(".
				 $regactivo["otros"].")(".
				 $regactivo["IUequipo"];
				 
				 ?>" name="alldata_equipo[<?php echo $cont?>]" id="everydata[<?php echo $cont;?>]">
               <!--<input type="button" value="Eliminar" class=" boton_pequenio color_btn_rojo">-->
<?php 
}
?>               
              </div>
            </td>
        </tr>
 <?php 
  }
  ?>       
      </tbody> 
       
  </table>
</div>
 

</div>
    </div>
</div>
<!--formurario agregrar equipos-->

<div align="center" id="nuevocomponente" style=" display:none; width: 100%; min-height: 100%;
height: auto !important;
position: fixed;
top:0; background:rgba(30,86,171,0.70);
left:0; z-index:5000">
  <div style="position: absolute;
      top: 50%; 
      left: 50%;
      transform: translate(-50%, -50%); background:#FDFDFD; background:none ">
      
      <div style="background:#FFFFFF; padding:10px; border-radius:5px; height:250px;" >
      <div align="left" class="menu_exploracion">
<a href="#" onClick="$('#nuevocomponente').fadeOut(1000);"><img  style="vertical-align:middle" src="imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
<input id="kwd_search" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>
<div style="height:200px; overflow:scroll">
     <table id="my-table" border="1" width="600" style="border-collapse:collapse">
	<thead>
		<tr>
			<th>CÓDIGO ACTIVO</th>
			<th>EQUIPO</th>
			<th>SERIE</th>
            <th>ESPECIFÍCACIONES</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
	$queryequipose=mysql_query("select * from m5sts_equipos",$conectar) or die("ERROR 2");
	while($regequipose=mysql_fetch_array($queryequipose))
	{
		$num=$num+1;
	?>
		<tr>
			<td><?php $regequipose["codigoactivo"];?>
            <input type="hidden" name="codigoactivo[<?php echo $num?>]" id="codigoactivo[<?php echo $num?>]" value="<?php echo $regequipose["codigoactivo"];?>">
            </td>
			<td><?php echo $regequipose["nombre"];?>
            <input type="hidden" name="nombreactivo[<?php echo $num?>]" id="nombreactivo[<?php echo $num?>]" value="<?php echo $regequipose["nombre"];?>">
            </td>
			<td><?php echo $regequipose["marca"];?>
            <input type="hidden" name="marcaactivo[<?php echo $num?>]" id="marcaactivo[<?php echo $num?>]" value="<?php echo $regequipose["marca"];?>">
            </td>
            <td><?php echo $regequipose["especificaciones"];?>
            <input type="hidden" name="especificacionesactivo[<?php echo $num?>]" id="especificacionesactivo[<?php echo $num?>]" value="<?php echo $regequipose["especificaciones"];?>">
            </td>
            <td align="center" valign="middle"><a href="#" id="agregarequipos[<?php echo $num;?>]" class="boton_pequenio color_btn_azul" onClick="Actualiza_entrega(<?php echo $num;?>)">&nbsp;Agregar&nbsp;</a></td>
		</tr>
	<?php 
	}
	?>
	</tbody>
</table>
</div>
	</div>
    </div>
</div>
<!--hasta aqui agregar equipos-->
<!--formurario agregrar software-->

<div align="center" id="nuevocomponentesw" style=" display:none; width: 100%; min-height: 100%;
height: auto !important;
position: fixed;
top:0; background:rgba(30,86,171,0.70);
left:0; z-index:5000">
    <div style="position: absolute;
      top: 50%; 
      left: 50%;
      transform: translate(-50%, -50%); background:#FDFDFD; background:none ">
      
      <div style="background:#FFFFFF; padding:10px; border-radius:5px; height:250px;" >
      <div align="left" class="menu_exploracion">
<a href="#" onClick="$('#nuevocomponentesw').fadeOut(1000);"><img  style="vertical-align:middle" src="imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
<input id="kwd_searchsw" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle "  onKeyUp="buscar_en_tabla('my-tablesw')" type="text" name="buscar">&nbsp;&nbsp;</div>
<div style="height:200px; overflow:scroll">
     <table id="my-tablesw" border="1" width="600" style="border-collapse:collapse">
	<thead>
		<tr>
			
			<th>SOFTWARE</th>
			<th>DESCRIPCIÓN</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
	$querysw=mysql_query("select * from conf_sw",$conectar) or die("ERROR 3");
	while($regsw=mysql_fetch_array($querysw))
	{
		$numsw=$numsw+1;
	?>
		<tr>
			
            
			<td><?php echo $regsw["nombre_sw"];?>
            <input type="hidden" name="sw[<?php echo $numsw?>]" id="sw[<?php echo $numsw?>]" value="<?php echo $regsw["nombre_sw"];?>">
            </td>
			<td><?php echo $regsw["descripcion"];?>
            <input type="hidden" name="dessw[<?php echo $numsw?>]" id="dessw[<?php echo $numsw?>]" value="<?php echo $regsw["descripcion"];?>">
            </td>
            
            <td align="center" valign="middle"><a href="#" id="agregarsw[<?php echo $numsw;?>]" class="boton_pequenio color_btn_azul" onClick="Actualiza_entregasw(<?php echo $numsw;?>)">&nbsp;Agregar&nbsp;</a></td>
		</tr>
	<?php 
	}
	?>
	</tbody>
</table>
</div>
	</div>
    </div>
</div>

<script>


document.getElementById('nuevo').style.display="none";
document.getElementById('pagentrega').style.display="none";


</script>
<script type="text/javascript">
document.getElementById("reportes_equipos26").style.display="none";
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecharegistro').datepicker({
                    format: "yyyy-mm-dd"
                });  
				
                $('#fechaentrega').datepicker({
                    format: "yyyy-mm-dd"
                });  
            	
				
            });
		
			$(document).ready(function () {
                
                $('#fechaadd').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>
<script>

function Pasar_Datos_equipos(equipo)
{
	valor="everydata["+equipo+"]";
	document.getElementById("fomulariook").reset();
	//$('#area_personal > option[value=""]').attr('selected', 'selected');

	var DATOS=document.getElementById(valor).value;
	//alert (DATOS);
	var DATOSP=DATOS.split(')(');
	document.getElementById("id_equipo").value=DATOSP[0];
	document.getElementById("codigo").value=DATOSP[1];
	document.getElementById("nombre").value=DATOSP[2];
	document.getElementById("marca").value=DATOSP[3];
	document.getElementById("modelo").value=DATOSP[4];
	document.getElementById("serie").value=DATOSP[5];
	document.getElementById("estado").value=DATOSP[6];
	document.getElementById("fecharegistro").value=DATOSP[7];
	document.getElementById("propiedad").value=DATOSP[8];
	document.getElementById("especificaciones").value=DATOSP[9];
	document.getElementById("otros").value=DATOSP[10];
	document.getElementById("IUequipo").value=DATOSP[11];
		
}
function abrir_emergente()
{
	var ventanaa='#nuevocomponente';
	$(ventanaa).fadeIn(1000);
//document.getElementById('nuevocomponente').style.display="";
}

function abrir_emergentesw()
{
	var ventanaa='#nuevocomponentesw';
	$(ventanaa).fadeIn(1000);
//document.getElementById('nuevocomponente').style.display="";
}



function Actualiza_entrega(numactivo)
{
		 	
	var codigoequipo=document.getElementById('codigoactivo['+numactivo+']').value;
	var equipo=document.getElementById('nombreactivo['+numactivo+']').value;
	var marca=document.getElementById('marcaactivo['+numactivo+']').value;
	var especificaciones=document.getElementById('especificacionesactivo['+numactivo+']').value;
	
	//alert(codigoequipo);
	
	if(codigoequipo!='')
	{

	var agregarfilasum='<tr style="border:1px solid #E1EEF4"><td align="center">'+codigoequipo+'<input type="hidden" name="g_codigoequipo[]" id="contador_sum" value="'+codigoequipo+'"></td><td>'+equipo+'<input type="hidden" name="g_equipo[]" value="'+equipo+'"></td><td>'+marca+'<input type="hidden" name="g_marca[]" value="'+marca+'"></td><td>'+especificaciones+'<input type="hidden" name="g_especificaciones[]" value="'+especificaciones+'"></td><td align="center"><a href="#" class="link_simple boteliminar" onClick="eliminar_fila($(this))"><img src="imag/eliminar2.png" style="vertical-align:middle"> Quitar</a></td></tr>';
	
$('#tabla_entrega_equipos >tbody').append(agregarfilasum);
document.getElementById('guardar').disabled='';

//deshabilita boton agregra
document.getElementById('agregarequipos['+numactivo+']').style.display="none";


	}
else
{
	
	alert('Faltan datos');
}
}

function Actualiza_entregasw(numactivo)
{
	 	
	var sw=document.getElementById('sw['+numactivo+']').value;
	var swdes=document.getElementById('dessw['+numactivo+']').value;
	
	//alert(codigoequiposw);
	
	if(sw!='')
	{

	var agregarfilasum='<tr style="border:1px solid #E1EEF4"><td>'+sw+'<input type="hidden" name="g_sw[]" value="'+sw+'"></td><td>'+swdes+'<input type="hidden" name="g_swdes[]" value="'+swdes+'"></td><td align="center"><a href="#" class="link_simple boteliminar" onClick="eliminar_fila($(this))"><img src="imag/eliminar2.png" style="vertical-align:middle"> Quitar</a></td></tr>';
	
$('#tabla_entrega_sw >tbody').append(agregarfilasum);
document.getElementById('guardar').disabled='';

//deshabilita boton agregra
document.getElementById('agregarsw['+numactivo+']').style.display="none";


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
		{ document.getElementById('guardar').disabled="disabled";}
		
        fila.closest('tr').remove();	
    }
	
	
	////////////////***************++++++BUSCAR DENTRO DE UNA TABLA******//

$(document).ready(function(){
	// Write on keyup event of keyword input element
	$("#kwd_searchsw").keyup(function(){
		// When value of the input is not blank
		if( $(this).val() != "")
		{
			// Show only matching TR, hide rest of them
			$("#my-tablesw tbody>tr").hide();
			$("#my-tablesw td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("#my-tablesw tbody>tr").show();
		}
	});
});
// jQuery expression for case-insensitive filter
$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

//////HASTA A QUI BUSCAR EN UNA TABLA**/
	function validar_secuencia(dato,archivo,selct)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	var combo="#"+selct;
	if(dato=="Personal")
	{
	var registrapersonajs=document.getElementById("registrapersona").value;
	$(combo).css("display", "none");//id del select
	//hasta aqui para mostrar el loading
	$(combo).val("");
	var variable_post=dato;
	$.post(archivo, { variable: variable_post, variable2:registrapersonajs }, function(data){
	$(combo).val($.trim(data));
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	$(combo).css("display", "inline");
	//$("#botonguardar").css("display", "inline");
	});		
	}
	else
	{
	document.getElementById(selct).value="";
	}
}

function Validar_equipo_existe(codigoval,tipoequipo)
{	
	var archivo='mod_soporte_sistemas/script/verificar_equipo_existe.php'; 
	var result="#resultadovalequipo";
	$(result).html('<img src="imag/loading2.gif" height="26" width="26" style="vertical-align:middle;" id="preloadimg">');
		
	var variable_a=codigoval;
	var variable_b=tipoequipo;
	$.post(archivo, { variablea: variable_a, variableb:variable_b }, function(data){
	$(result).html(data);
	});		
	
	
}
</script>

