<?php 
include("../../conf.php");
$activate=$_POST["activate"];#si hay valor procede a guardar

#para bloquear e impedirlos cambios en el distributivo que ya finalizo

if($_REQUEST["valblock"]=="True")#verifica para bloquear el distributivo
{
	$idisbloc=$_REQUEST["variable"];#consulta distributivo a bloquear
	
	
	
	#inicia la transaccion
	mysql_query("BEGIN"); 
	#mysql_query("START TRANSACTION");
	#actualiza el estado
	$mysqbloquea=mysql_query("UPDATE th_distributivo SET bloqueo = '1' WHERE id_distributivo = '$idisbloc'",$conectar)or die("Error");
	
	#genera la consulta para cambiar de estado	
	$distributivo=mysql_query("select th_distributivo_per.id_personal from th_distributivo_per 
	where th_distributivo_per.id_distributivo='$idisbloc';",$conectar);
	$distributivototal=mysql_num_rows($distributivo);		
	#actualiza los estados en la tabla gad_personal
	while($regidistributivo=mysql_fetch_array($distributivo))
	{
		$idpersonalupdate=$regidistributivo["id_personal"];
		$qyeryestado=mysql_query("update gad_personal set per_estado='inactivo' where id_personal='$idpersonalupdate' and (UPPER(sit_laboral) !='NOMBRAMIENTO' or UPPER(sit_laboral) ='')",$conectar);
		if($qyeryestado){$qyeryestadoto=$qyeryestadoto+1;}
	}


	if($mysqbloquea and $distributivo and $qyeryestadoto==$distributivototal)
	{
	// No hay error.
	// Entonces con COMMIT aceptamos todos los movimientos
	 mysql_query("COMMIT");	
	 
	 $_GET['avisomensaje']='Se ha Cerrado el Periodo';
	 $_GET['avisotipo']='rojo';
	 $_GET['automatico']='si';
	 include("../../ventanas_avisos.php");
	 
	}#cierra el try {}
	# catch (Exception $e) 
	#{ // Como ocurrio un error, entonces cancelamos toda la transacción, dejamos todo igual hasta antes del BEGIN
	else
	{
	 mysql_query("ROLLBACK");   
	 
	 $_GET['avisomensaje']='Error en la Transacción: '.mysql_error();
	 $_GET['avisotipo']='rojo';
	 $_GET['automatico']='no';
	 include("../../ventanas_avisos.php");
	}
	
}

############################




if($activate==true)
{ 
	$idprincipal=trim($_POST["idprincipal"]);
	$nombre= trim($_POST["dis_periodo"]);
	$sueldo=trim($_POST["dis_descripcion"]);
	$fecha_desde=trim($_POST["fecha_desde"]);
	$fecha_hasta=trim($_POST["fecha_hasta"]);
	
	$nuevo_ingreso=mysql_query("select * from th_distributivo where dis_periodo='$nombre'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	
	if(mysql_num_rows($nuevo_ingreso)>0 and $_POST['idprincipal']=="")
	{
		$_GET['avisomensaje']='Ya existe un registro con este nombre';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../../ventanas_avisos.php");
	}
	else
	{
		mysql_query("BEGIN"); #inicia la transaccion	
		$mysqlinsert=mysql_query("
		insert into th_distributivo
		 (id_distributivo,
		  dis_periodo,
		  dis_descripcion,
		  fecha_desde,
		  fecha_hasta
		 )values
		 (
		 '$idprincipal',
		 '$nombre',
		 '$sueldo',
		 '$fecha_desde',
		 '$fecha_hasta'
		 )ON DUPLICATE KEY UPDATE
		 dis_periodo='$nombre',
		 dis_descripcion='$sueldo',
		 fecha_desde='$fecha_desde',
		 fecha_hasta='$fecha_hasta'
		");
		if (!$mysqlinsert) 
			{$error = 1;}
		
		if ($error == 1)
		{
	         // Como ocurrio un error, entonces cancelamos toda la transacción,
	         // y dejamos todo igual hasta antes del BEGIN
	         mysql_query("ROLLBACK");   
	         $_GET['avisomensaje']='Error en la Transacción: '.mysql_error();
			$_GET['avisotipo']='rojo';
			$_GET['automatico']='no';
			include("../../ventanas_avisos.php");
	    }
		else
		{
		if($idprincipal=="")
			{	
			#ultimo id
			$idultimo=mysql_insert_id();
			
			#echo $idultimo.">>>>>>>>>>>>>>>>>>><";
			$querydis=mysql_query("insert into th_distributivo_dep 
			(id_distributivo_dep,
			id_distributivo,
			dependencia_nom,
			dependnencia_abre,
			nivel_dependencia,
			nivel_padre,
			nivel_estructural) select
			null,
			$idultimo,
			gad_dependencia.nombre,
			gad_dependencia.abreviatura,
			gad_dependencia.id_dependencia,
			gad_dependencia.nivel,
			gad_dependencia.nivel_estructural from gad_dependencia where gad_dependencia.organico='SI'",$conectar);
			#genera el distributivo con las áreasas autorizadas
			
			#falta indentificar el ultimo distributivo valido
			$idultimodistrvalido=$idultimo-1;
			
			if($idultimodistrvalido>=1)
			{
			#pasa todos los de nombramiento al nuevo distributivo
			
			$querydiss=mysql_query("select * from th_distributivo_dep
where th_distributivo_dep.id_distributivo='$idultimo'",$conectar) or die ("Erorrrrrr");
				while($regdispasar=mysql_fetch_array($querydiss))
				{
					$nivel_dependencia=$regdispasar["nivel_dependencia"];
					$id_distributivo_depn=$regdispasar["id_distributivo_dep"];
					#BUSCAR EL PERSONAL CON NOMBRAMEINTO
					$querydis2=mysql_query("select * from th_distributivo_per
inner join th_distributivo_dep on th_distributivo_per.id_distributivo_dep=th_distributivo_dep.id_distributivo_dep
where th_distributivo_per.id_distributivo='$idultimodistrvalido'
and upper(th_distributivo_per.mod_contrato)='Nombramiento'
and th_distributivo_dep.nivel_dependencia='$nivel_dependencia'",$conectar) or die("Errorr1111111");
					while($regdissegundo=mysql_fetch_array($querydis2))#recorre e inserta los recultados
					{
						$id_personal2=$regdissegundo["id_personal"];
						$mod_contrato2=$regdissegundo["mod_contrato"];
						$rol_de_puesto2=$regdissegundo["rol_de_puesto"];
						$denominacion_puesto2=$regdissegundo["denominacion_puesto"];
						$rmu2=$regdissegundo["rmu"];
						$partida2=$regdissegundo["partida"];
						$fecha_ing2=$regdissegundo["fecha_ing"];
						$fecha_salida2='';
						$otros2=$regdissegundo["otros"];
						
						
						$queryinspers=mysql_query("
				 insert into th_distributivo_per
				 (id_distributivo_per,
					id_personal,
					id_distributivo_dep,
					mod_contrato,
					rol_de_puesto,
					denominacion_puesto,
					rmu,
					partida,
					fecha_ing,
					fecha_salida,
					otros,
					id_distributivo
				 )values
				 (
				 null,
				 '$id_personal2',
				 '$id_distributivo_depn',
				 '$mod_contrato2',
				 '$rol_de_puesto2',
				 '$denominacion_puesto2',
				 '$rmu2',
				 '$partida2',
				 '$fecha_ing2',
				 '$fecha_salida2',
				 '$otros2',
				 '$idultimo'
						)",$conectar) or die("Eroorrrrr".mysql_error());
					}
		
				}
			
			}

			if (!$querydis) {$error = 1;}
			}
			if ($error == 1)
			{
				mysql_query("ROLLBACK");   
				#echo "Error en la Transacción: ".mysql_error();
				$_GET['avisomensaje']='Error en la Transacción '.mysql_error();
				$_GET['avisotipo']='rojo';
				$_GET['automatico']='no';
				include("../../ventanas_avisos.php");
			}
		}
		
		 if ($error != 1)
		 {
		############
		// No hay error.
	        // Entonces con COMMIT aceptamos todos los movimientos
	        // y ya se reflejan en la Base de Datos.
	        mysql_query("COMMIT");
	        #echo "Transacción exitosa";
			$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
			$_GET['avisotipo']='verde';
			$_GET['automatico']='si';
			include("../../ventanas_avisos.php");
		 }
	} 
}
else
	{
	#	echo "Solo muestra";
	}
?>


<div style="height:300px; overflow-y:scroll; overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >
<table border="0" cellspacing="0" cellpadding="0" class="tabla1" width="100%" align="center">
<thead>
  <tr>
    <th width="220">&nbsp;</th>
    <th align="center"><strong>PERIODO</strong></th>
    <th align="center"><strong>DESDE</strong></th>
    <th align="center"><strong>HASTA</strong></th>
    <th align="center"><strong>DESCRIPCIÓN</strong></th>
    <th width="150">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php 
	$querycargo=mysql_query("select concat_ws('.*.',id_distributivo,dis_periodo,dis_descripcion,fecha_desde,fecha_hasta) as todos,th_distributivo.* from  th_distributivo", $conectar)or die("Error_".mysql_error());
	while($regcargo=mysql_fetch_array($querycargo))
	{
	?>
  <tr>
    <td  align="center" valign="middle">
    <?php 
	if($regcargo["bloqueo"]==0)
	{
	?>
	
    <a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/distributivos_dependencias.php?aut=<?=$regcargo["id_distributivo"];?>','#Contneidointernodis'); Actualizar_titulo('#titlosinternosdis','Distributivo-Dependencias');" class="botocuadrado color_verde">&nbsp;Dependencias</a>
   
   <a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/mostrar_distributivos_personal.php?aut=<?=$regcargo["id_distributivo"];?>&autnom=<?=$regcargo["dis_periodo"];?>','#Contneidointernodis'); Actualizar_titulo('#titlosinternosdis','Distributivo-Dependencias-Personal');" class="botocuadrado color_blue2" >&nbsp;Personal&nbsp;</a>
   
   <?php 
	}
	else
	{
	?>	 
	<p style="width:90%" class="inactivo">Finalizado</p>
	<?php
	}
   ?>
   </td>
    <td align="center" ><?=$regcargo["dis_periodo"]?></td>
    <td align="center" ><?=$regcargo["fecha_desde"]?></td>
    <td align="center" ><?=$regcargo["fecha_hasta"]?></td>
    <td ><?=$regcargo["dis_descripcion"]?></td>
    <td align="center"  style="min-width:80px;">
    <?php 
	if($regcargo["bloqueo"]==0)
	{
	?>
    <a href="javascript:void()" onClick="pasardep('<?=$regcargo["todos"];?>')" class="btn_azul"><img src="imag/editarbtn.png" style="vertical-align:middle">&nbsp;&nbsp;Editar</a>
    
    <a href="javascript:void()" onClick="pasar_a_cerrar('<?=$regcargo["id_distributivo"]?>')" class="btn_rojo"><img src="imag/lock.png" style="vertical-align:middle">&nbsp;&nbsp;Cerrar</a>
    <?php 
	}
	else
	{
	
	}
	?>
    </td>
  </tr>
  <?php 
	}
	?>
    </tbody>
</table>
</div>

<!--EMERGENTE PARA BLOQUEAR DISTRIBUTIVO-->

<div id="bloquear" class="emergentepadre">
	<div class="emergentehijo" style="background:rgba(255,255,255,1.00); min-height:200px; min-width:350px">
    <h4 align="center" id="color_red" style="margin:0px; color:rgba(255,255,255,1.00); padding:2px">Bloquear Distributivo</h4>
    <input type="hidden" name="bloqueardistrib"  id="bloqueardistrib" value="">
    <p align="center" style="padding:10px;" >Está seguro que desea Bloquer el Distributivo.<strong><span id="dsitribubloquear"></span></strong>.<br>
Una vez cerrado este periodo no podrán hacerse cambios en este distributivo. </p>
    <div align="center" style="text-align:center !important">
    <a href="javascript:void()" onClick="cambioscerrardistr($('#bloqueardistrib').val(),'mod_talento_humano/script/mostrar_distributivos.php','cargaraquidistrib');" class="btn_azul" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a href="javascript:void()" onClick="$('#bloquear').fadeOut(800);$('#bloqueardistrib').val('');" class="btn_rojo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>
<br>

    </div>
    </div>
</div>
<script>
function pasardep(valores_dep)
{
	
	cambiar_vetana('#frmnuevodis','#contenidosinternosdis')
	var string = valores_dep;
var array = string.split(".*.");
$('#idprincipal').val(array[0]);
$('#dis_periodo').val(array[1]);
$('#dis_descripcion').val(array[2]);
$('#fecha_desde').val(array[3]);
$('#fecha_hasta').val(array[4]);
}

function pasar_a_cerrar(vardelete)
{
	$('#bloqueardistrib').val("");
	
	$('#bloquear').fadeIn(800);
	$('#bloqueardistrib').val(vardelete);
	
}

function cambioscerrardistr(variable_postbloc,filedis,objdis)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	var obje="#"+objdis;
	$(obje).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');//id del select

	var variable_post=variable_postbloc;
	var variable_postb='True';
	
	$.post(filedis, {variable: variable_post,valblock: variable_postb}, function(data){
	$(obje).html(data);
	});			
}
</script>

