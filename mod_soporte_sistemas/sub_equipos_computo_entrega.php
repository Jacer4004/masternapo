<?php 
$sql=mysql_query("select distinct
a.*,concat_ws(' ',p.tratamiento,p.nombres,p.apellidos) as nomina,p.id_personal as elidersonal,d.*,m5sts_ip.*,m5sts_us_ad.*,
(select group_concat(id_equipo separator '<>') from m5sts_e_e_componentes where m5sts_e_e_componentes.id_ent_equi=a.id_ent_equi) as componentesss
from m5sts_entrega_equipos a
left join m5sts_e_e_componentes l on l.id_ent_equi= a.id_ent_equi
inner join gad_personal p on p.id_personal=a.id_personal
inner join gad_dependencia d on d.id_dependencia=p.id_dependencia
left join m5sts_ip on m5sts_ip.id_ip=a.dir_ip
left join m5sts_us_ad on m5sts_us_ad.id_us_ad=a.us_ad
",$conectar) or die("Error 1");
##SELECCIONA LAS ACTAS PARA VALIDAR BOTON GENERAL ACTA
$sqlactasentragadas=mysql_query("select * from m5sts_equipos_acta_entrega",$conectar)or die("ERROR");

$sqlsoftware=mysql_query("select * from conf_sw",$conectar) or die("ERROR 2");
while($regssoftware=mysql_fetch_array($sqlsoftware))
{
	$y=$y+1;
	$array_sw[$y]=$regssoftware["nombre_sw"]." ".$regssoftware["licencia_sw"];
}
?><head>
<link rel="stylesheet" href="../estilos/css.css" type="text/css" charset="utf-8"/>
   
</head>
<?php if (in_array("M5SEC_NUEVO", $accesos)) {?>
<?php }?>

<!--ENTREGA DE EQUIPOS-->
<?php if (in_array("M5SEENuevaEntrega", $accesos)) {?>
<div class="ventanas" id="pagentrega" style="width:80%; display:none">
<h3 id="<?php echo $colorfondo?>"align="center">Equipos entregados </h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" method="post" onSubmit="javascript:js_general('mod_soporte_sistemas/g_equipo_entrega','color_cyan','<?php echo $tiempo_cookie;?>')">
<input type="hidden" name="el_id" id="el_id" value="">       	 
<br>
<table width="90%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right">Denominación:</td>
    <td><select style="width:290px" name="denominacion" id="denominacion" required>
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
    <td width="161" align="right">Dependencia: </td>
    <td width="">
    <select name="dependencia" required id="dependencia" style="width:290px" onChange="cargarcombo(dependencia.value,'combos/cb_usuarios_entrega_e.cbo.php','usuarios_area');">
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
    <select style="width:290px" name="usuarios_area" id="usuarios_area" required onChange="cargarcombo(usuarios_area.value,'mod_soporte_sistemas/script/verificar_ip_entrega_equipo.php','dir_ip');cargarcombo(usuarios_area.value,'mod_soporte_sistemas/script/verificar_usad_entrega_equipo.php','us_ad');">
      <option	value="">.: Seleccione :.</option>
    
    </select></td>
  </tr>
  <tr>
    <td align="right">Dirección IP:</td>
    <td><select style="width:290px" name="dir_ip" id="dir_ip" required>
      <option	value="">.: Seleccione :.</option>
      </select><label><input type="checkbox" onClick="requerido_control('norequiere','#dir_ip');" name="norequiere" id="norequiere">No requerido</label></td>
  </tr>
  <tr>
    <td align="right">Usuario AD:</td>
    <td><select style="width:290px" name="us_ad" id="us_ad" required>
      <option	value="">.: Seleccione :.</option>
    </select><label><input type="checkbox" name="norequiere2" id="norequiere2" onClick="requerido_control('norequiere2','#us_ad');">No requerido</label></td>
  </tr>
  <tr>
    <td align="right">Fecha de Entrega:</td>
    <td><input type="text" name="fechaentrega"  id="fechaentrega" placeholder="aaaa-mm-dd" required value="<?php echo date('Y-m-d');?>"></td>
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
    <td align="right" valign="top">Componentes Físicos:<br>
      
  </td>
    <td>
      
      <img src="imag/add.png" width="25" height="25" style="cursor:pointer" onClick="abrir_emergente();" class="iconos_secundarios">
      
      <table width="100%" border="1" rules="all" id="tabla_entrega_equipos" style="margin-bottom:10px">
        <thead><tr>
          <th align="center">CODIGO</th>
          <th align="center">EQUIPO</th>
          <th align="center">MARCA</th>
          <th align="center">ESPECIFICACIONES</th>
          <th align="center">&nbsp;</th>
          </tr>
          
          </thead>
        <tbody>
          
  </tbody>
        </table></td>
  </tr>
  <tr>
    <td align="right" valign="top">Componentes Lógicos:</td>
    <td><img src="imag/add.png" width="25" height="25" style="cursor:pointer" onClick="abrir_emergentesw();" class="iconos_secundarios">
    <table width="500" border="1" rules="all" id="tabla_entrega_sw" style="margin-bottom:10px">
        <thead><tr>
          <th width="43" align="center">COD</th>
          <th width="410" align="center">DESCRIPCIÓN</th>
          <th width="25" align="center">&nbsp;</th>
          </tr>
          
          </thead>
        <tbody>
          
  </tbody>
        </table>
    </td>
  </tr>
  <tr>
    <td align="right" valign="top">Otros datos:</td>
    <td><textarea name="otros2" id="otros2" cols="60"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<br>
<div align="center" style="text-align:center">
<input type="submit" disabled class="boton color_btn_azul" id="guardar" value="Guardar" > 

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('pagentrega','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>

  </form>
</div>
<?php }#fin cntrola acceso?>

<!--formulario de reportes-->
<?php #if (in_array("M5SDIPREP28", $accesos)) {?>
<div class="ventanas" id="reportes_entragas" style="width:95%; display:none;  text-align:center !important" align="center">
<h3 id="<?php echo $colorfondo?>"align="center">Resportes de Equipos Entregados</h3>
<div class="menu_exploracion" align="center">
    
  <a href="#"onClick="javascript:cerrar_abrir('reportes_entragas','contenedor')"><img style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a></div>
  <hr>
  <h4 style="margin:0px; padding:0px" align="center">
  <div class="tablas_reportes" align="center" style="text-align:center">
  
  <table border="0" align="center" width="500">
  <tr>
    <td width="81%" align="center"><strong>NOMBRE</strong></td>
    <td width="19%" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>
    <form name="areas" method="post" action="mod_soporte_sistemas/reportes/ver_equipos_listado_entregado.php?/modo=html" onSubmit="target_popup(this)">
    
    <input type="submit" value="HTML" name="tipoarchivo">
    <input type="submit" value="EXCEL" name="tipoarchivo"> 
    Areas  
      <select name="previaareas">
    	<option value="">Todas</option>
        <?php 
		$querydependencia=mysql_query("select * from gad_dependencia order by nombre",$conectar)or die ("ERROR_");
		while($regdependencia=mysql_fetch_array($querydependencia))
		{
		?>
        
        <option value="<?php echo $regdependencia["id_dependencia"];?>"><?php echo $regdependencia["nombre"];?></option>
        <?php 
		}
		?>
    </select>
    </form>
    </td>
    <td><!--<div align="center">#<a href="mod_soporte_sistemas/reportes/ver_equipos_listado.php?/cate=&/modo=pdf" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=800,height=600'); return false;"><img src="imag/doc_pdf.png"></a>&nbsp;&nbsp;<a href="mod_soporte_sistemas/reportes/ver_ip_listado.php?/identificador=&/modo=html" onclick="window.open(this.href, '', 'scrollbars=Yes,location=no,menubar=Yes,fullscreen=no,width=800,height=600'); return false;"><img src="imag/buscardoc.png"></a></div>-->
    </td>
  </tr>

</table>
</div>
</h4>
</div>
<?php #}?>



<div class="ventanas" id="contenedor" >
<h3 id="<?php echo $colorfondo?>"align="center">Equipos de Cómputo </h3>
<div class="menu_exploracion">
    
    <a href="inicio.php" onClick="javascript:js_general('mod_soporte_sistemas','<?php echo $colorfondo?>');"><img style="vertical-align:middle" src="imag/atras.png"></a>
   
	<?php if (in_array("M5SEENuevaEntrega", $accesos)) {?>
    <a href="#" onClick="javascript:cerrar_abrir('contenedor','pagentrega');" ><img style="vertical-align:middle;" src="imag/entregar2.png"> Entregar </a><?php }?>   
 
<?php /*if (in_array("M5SDIPREP28", $accesos)) {*/?>
<a href="javascript:void();" title="Reportes" onClick="javascript:cerrar_abrir('contenedor','reportes_entragas');  "><img style="vertical-align:middle;" src="imag/report.png"> Reportes</a><?php #}?>

<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;
</div>

<div class="" style="margin:10px;" align="center">
<h4 align="center" style="padding-bottom:0px; margin-bottom:3px;">EQUIPOS ENTREGADOS</h4>

  <table align="center" id="report" width="100%" style="font-size:14px">
  <thead>
        <tr>
            <th>FUNCIONARIO</th>
            <th> EQUIPO</th>
            <th> IP</th>
            <th> AD</th>
            <th>DEPENDENCIA</th>
            <th width="10">&nbsp;</th>
        </tr>
  </thead>
  <tbody>      
<?php  $cont="";
  while($registros=mysql_fetch_array($sql))
  {
	   $cont=$cont+1;
	   
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $registros["nomina"]; ?></td>
            <td><?php echo $registros["denominacion"]; ?></td>
            <td><?php echo $registros["ip"]; ?></td>
            <td><?php echo $registros["nom_usu_ad"]; ?></td>
            <td><?php echo $registros["nombre"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui" style="display:none">
            <td colspan="6">
            
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
             <div class="bloque_de_menus">
			 
			<?php 
			#echo $arrayactaentregados[1]."ssss";
			if (in_array("M5SEENuevaEntrega", $accesos) ) {
				
				#echo $arrayactaentregados[$registros["id_ent_equi"]]."<<<";
				?>
				
               <a  href="#" id="volverhaceracta<?php echo $cont;?>" onClick="javascript:Generar_acta('<?php echo $registros["id_ent_equi"];?>','<?php echo $cont;?>')" class="boton_pequenio color_btn_azul">Generar Acta</a>
                <div style="width:100px; display:inline-block " id="Generaacta<?php echo $cont;?>"></div>
               
              <?php }?>
              
              <?php 
			 #autoriza el accso a ver este boton 
			 if (in_array("M5SEEImprimirActa", $accesos)) {?>
                <a  href="mod_soporte_sistemas/script/ver_descargar_acta_e_eq.php?acta=<?php echo $registros["id_ent_equi"];?>&modo=I" target="preview" onClick="$('#preview').prop('src','about:blank');Abrir_Y_Ver('#veracta');" class="boton_pequenio color_btn_azul">Ver Acta</a>

              <?php }?>   
               
              </div>
                <h4>Descripción completa de la entrega: <?php echo $registros["denominacion"]; ?></h4>
                <ul>
                    <li><strong>Funcionario:</strong> <?php echo $registros["nomina"]; ?></li>
                    <li><strong>Dependencia:</strong> <?php echo $registros["nombre"]; ?>
                   
                  </li>
                    <li><?php 
					#en caso emergente pued editar cambios solo con autorizacion de acceso 
					if (in_array("M5SEEEditar_Entrega27", $accesos)) {?><a href="mod_soporte_sistemas/script/editar_entregas_equipos.php?ip_val=<?php echo $registros["ip"];?>&ip_idp=<?php echo $registros["elidersonal"];?>&regitro=<?php echo $registros["id_ent_equi"];?>&modo=IP" target="editandodatos_ver" class="editando" style="border-radius:3px" title="Editar" onClick="Abrir_Y_Ver('#editandodatos')"><img style="vertical-align:middle; cursor:pointer" src="imag/editstring.png" height="14" width="14"></a>
                      <?php }?><strong>Dirección IP:</strong> <?php echo $registros["ip"]; ?>
                    
                    </li>
                    <li>
                    <?php 
					#en caso emergente pued editar cambios solo con autorizacion de acceso 
					if (in_array("M5SEEEditar_Entrega27", $accesos)) {?><a href="mod_soporte_sistemas/script/editar_entregas_equipos.php?ip_val=<?php echo $registros["nom_usu_ad"];?>&ip_idp=<?php echo $registros["elidersonal"];?>&regitro=<?php echo $registros["id_ent_equi"];?>&modo=US" target="editandodatos_ver" class="editando" style="border-radius:3px" title="Editar" onClick="Abrir_Y_Ver('#editandodatos')"><img style="vertical-align:middle; cursor:pointer" src="imag/editstring.png" height="14" width="14"></a>
                      <?php }?>
                  <strong>Usuario AD:</strong> <?php echo $registros["nom_usu_ad"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>CLAVE: </strong><?php echo $registros["contrasenia"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>TIPO: </strong><?php echo $registros["perfilusuario"]; ?></li>
                    <li><strong>Fecha de Entrega:</strong> <?php echo $registros["fecha_entrega"]; ?></li>
                    <li><strong>Observaciones:</strong> <?php echo $registros["otros"]; ?></li>
                    <li><strong>Estado:</strong> <?php echo $registros["estadoee"]; ?></li>
                    
                    <li>
                    <?php 
					#en caso emergente pued editar cambios solo con autorizacion de acceso 
					if (in_array("M5SEEEditar_Entrega27", $accesos)) {?><a href="mod_soporte_sistemas/script/editar_entregas_equipos.php?regitro=<?php echo $registros["id_ent_equi"];?>&modo=SWF" target="editandodatos_ver" class="editando" style="border-radius:3px" title="Editar" onClick="Abrir_Y_Ver('#editandodatos')"><img style="vertical-align:middle; cursor:pointer" src="imag/editstring.png" height="14" width="14"></a>
                      <?php }?>
                    <strong>Software Instalado:</strong> <?php 					$sowft=split("<>",$registros["software"]);
					$xsw="";
				
					for($r=0;$r<count($sowft);$r++)
					{
						$xsw=$sowft[$r];
						?>
                     <ul style="padding:0px; margin:0px; margin-left:20px">
                     	
						<?php 
						#si encuentra en el array imprime
						if($registros["software"]=="")
						{
							echo '<li style="padding:0px; margin:0px">Ninguno</li>';
						}
						else
						{
							echo '<li style="padding:0px; margin:0px">'.$array_sw[$xsw].'</li>';
						}
						?>
                     </ul>
                    <?php
					}
					?>
                    </li>
                     <li><?php 
					#en caso emergente pued editar cambios solo con autorizacion de acceso 
					if (in_array("M5SEEEditar_Entrega27", $accesos)) {?><a href="mod_soporte_sistemas/script/editar_entregas_equipos.php?regitro=<?php echo $registros["id_ent_equi"];?>&modo=COMPONENTES" target="editandodatos_ver" class="editando" style="border-radius:3px" title="Eliminar" onClick="Abrir_Y_Ver('#editandodatos')"><img style="vertical-align:middle; cursor:pointer" src="imag/editstring.png" height="14" width="14"></a>
                      <?php }?><strong>Componentes:</strong> 
                     
                     <?php $componentess=split("<>",$registros["componentesss"]);
					for($r2=0;$r2<count($componentess);$r2++)
					{
						$el_id=$componentess[$r2];
						$sqlactivosentregados=mysql_query("select * from m5sts_equipos where id_equipo='$el_id'",$conectar) or die("Error 1");
						$reg_ee=mysql_fetch_array($sqlactivosentregados);
						?>
                     <ul style="padding:0px; margin:0px; margin-left:20px">
                     	<li style="padding:0px; margin:0px;">
						<?php 
						#si encuentra en el array imprime
						if($registros["componentesss"]=="")
						{
							echo "Ninguno";
						}
						else
						{
							echo "[".$reg_ee["codigoactivo"]."] - [".$reg_ee["nombre"]."] - [".$reg_ee["marca"]."]";
						}
						?></li>
                     </ul>
                    <?php
					}
					?>
                     
                     </li>
              </ul>   

            
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
left:0; z-index:15000">
    <div style="position: absolute;
      top: 50%; 
      left: 50%;
      transform: translate(-50%, -50%); background:#FDFDFD; background:none ">
      
      <div style="background:#FFFFFF; padding:10px; border-radius:5px; height:250px;" >
      <div align="left" class="menu_exploracion">
<a href="#" onClick="$('#nuevocomponente').fadeOut(1000);"><img  style="vertical-align:middle" src="imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
<input id="kwd_search" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>
<div style="height:200px; overflow:scroll">
     <table id="my-table" border="1" width="750" style="border-collapse:collapse">
	<thead>
		<tr>
			<th>CÓDIGO ACTIVO</th>
			<th>EQUIPO</th>
			<th>SERIE</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>ESPECIFÍCACIONES</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
    
    <?php 
	$queryequipose=mysql_query("Select * From m5sts_equipos where Not id_equipo In (Select id_equipo From m5sts_e_e_componentes)",$conectar) or die("ERROR 2");
	while($regequipose=mysql_fetch_array($queryequipose))
	{
		$num=$num+1;
	?>
		<tr>
			<td><?php echo $regequipose["codigoactivo"];?>
            <input type="hidden" name="codigoactivo[<?php echo $num?>]" id="codigoactivo[<?php echo $num?>]" value="<?php echo $regequipose["codigoactivo"];?>">
            
            <input type="hidden" name="id_activo[<?php echo $num?>]" id="id_activo[<?php echo $num?>]" value="<?php echo $regequipose["id_equipo"];?>">
            
            </td>
			<td><?php echo $regequipose["nombre"];?>
            <input type="hidden" name="nombreactivo[<?php echo $num?>]" id="nombreactivo[<?php echo $num?>]" value="<?php echo $regequipose["nombre"];?>">
            </td>
			<td><?php echo $regequipose["serie"];?>
            <input type="hidden" name="marcaactivo[<?php echo $num?>]" id="marcaactivo[<?php echo $num?>]" value="<?php echo $regequipose["serie"];?>">
            </td>
            
            <td><?php echo $regequipose["marca"];?>
            <input type="hidden" name="markactivo[<?php echo $num?>]" id="marcaactivo[<?php echo $num?>]" value="<?php echo $regequipose["marca"];?>">
            </td>
            
            <td><?php echo $regequipose["modelo"];?>
            <input type="hidden" name="modeloactivo[<?php echo $num?>]" id="marcaactivo[<?php echo $num?>]" value="<?php echo $regequipose["modelo"];?>">
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
     <table id="my-tablesw" border="1" width="800" style="border-collapse:collapse">
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
			
            
			<td><?php 
			if($regsw["licencia_sw"]=="")
			{
				##imprime propiedades si es software in licencia
				$propiedades="color:red; ";
			}
			else
			{
				$propiedades="";
			}
			
			?>
            <span style=" <?php echo $propiedades;?>">
            <?php
			echo $regsw["nombre_sw"]."  ".$regsw["licencia_sw"];?>
            </span>
            <input type="hidden" name="sw[<?php echo $numsw?>]" id="sw[<?php echo $numsw?>]" value="<?php echo $regsw["id_sw"];?>">
            </td>
			<td><?php echo $regsw["descripcion"];?>
            <input type="hidden" name="dessw[<?php echo $numsw?>]" id="dessw[<?php echo $numsw?>]" value="<?php echo $regsw["nombre_sw"]." - ".$regsw["licencia_sw"]." ".$regsw["descripcion"];?>">
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

<!--mostrar el acta-->
<div align="center" id="veracta"  class="emergentepadre" style="display:none !important; background:rgba(12,97,199,0.77)">
<div style="background:#FFFFFF; padding:10px">
<a href="#" onClick="$('#veracta').fadeOut(700);" class="boton color_btn_negro"><img style="vertical-align:middle" src="imag/cancel.png">Cerrar</a>
</div>
<hr>
<iframe class="emergentehijo"  style=" border: none; height:100%; margin-top:53px; margin-left:-2px; background:#FFFFFF" id="preview" name="preview" src="about:blank" frameborder="0" marginheight="0" marginwidth="0"  width="100%"></iframe>


    <div class="emergentehijo" id="actualizar_datos" style="width:90% !important; display:none">
    
    
    
  
    </div>
</div>

<!--SI PERMITE EDITAR-->
<div align="center" id="editandodatos"  class="emergentepadre" style="display:none !important; background:rgba(12,97,199,0.77)">
<div style="background:rgba(255,255,255,1.00); padding:10px">
<a href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_equipos_computo_entrega','')" class="boton color_btn_negro"><img style="vertical-align:middle" src="imag/atras.png">REGRESAR</a>
</div>
<hr>
<iframe class="emergentehijo"  style=" border: none; height:80%; background:#FFFFFF" id="preview" name="editandodatos_ver" src="about:blank" frameborder="0" marginheight="0" marginwidth="0"  width="95%"></iframe>
 
    </div>
</div>


<script type="text/javascript">
document.getElementById('pagentrega').style.display="none";


            // calnedario bootstrap
            $(document).ready(function () {
				
                $('#fechaentrega').datepicker({
                    format: "yyyy-mm-dd"
                });  
            	
				
            });
		
			$(document).ready(function () {
                
                $('#fechaadd').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });


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
		 	
	var id_equipo=document.getElementById('id_activo['+numactivo+']').value;
	var codigoequipo=document.getElementById('codigoactivo['+numactivo+']').value;
	var equipo=document.getElementById('nombreactivo['+numactivo+']').value;
	var marca=document.getElementById('marcaactivo['+numactivo+']').value;
	var especificaciones=document.getElementById('especificacionesactivo['+numactivo+']').value;
	
	//alert(codigoequipo);
	
	if(codigoequipo!='')
	{

	var agregarfilasum='<tr style="border:1px solid #E1EEF4"><td align="center">'+codigoequipo+'<input type="hidden" name="id_equipoid[]" value="'+id_equipo+'"><input type="hidden" name="g_codigoequipo[]" id="contador_sum" value="'+codigoequipo+'"></td><td>'+equipo+'<input type="hidden" name="g_equipo[]" value="'+equipo+'"></td><td>'+marca+'<input type="hidden" name="g_marca[]" value="'+marca+'"></td><td>'+especificaciones+'<input type="hidden" name="g_especificaciones[]" value="'+especificaciones+'"></td><td align="center"><a href="#" class="link_simple boteliminar" onClick="eliminar_fila($(this))"><img src="imag/eliminar2.png" style="vertical-align:middle"> Quitar</a></td></tr>';
	
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
	
function Abrir_Y_Ver(dondemostrar)
{
	$(dondemostrar).fadeIn(1000);
	
	
}
function Generar_acta(equipo,control)
{

	$("#Generaacta"+control).fadeIn(1000);
	
	$("#volverhaceracta"+control).fadeOut(100);
	$("#Generaacta"+control).html('<img src="imag/loading2.gif">');
	
	var resultadover=$("#Generaacta"+control);
	var archivo="mod_soporte_sistemas/script/crea_acta_entrega_equipo.php";
	var variable_equipo=equipo;
	
	$.post(archivo, { variableequipo: variable_equipo }, function(data){
	$(resultadover).html(data);
	//$("#Generaacta").fadeOut(1000);
	$("#Generaacta"+control).html('<img src="imag/s_success.png">');
	});				
}
	
function edit_entrega()
{
	
}


/*formulario enviar en ventana popu*/
function target_popup(form) {
    window.open('', 'formpopup', 'scrollbars=Yes,location=no,menubar=Yes,fullscreen=no,width=800,height=600');
    form.target = 'formpopup';
}
</script>

<style>
.editando
{
	padding:1px;
	display:inline-block;
	
}
.editando:hover
{
	
	
}
</style>