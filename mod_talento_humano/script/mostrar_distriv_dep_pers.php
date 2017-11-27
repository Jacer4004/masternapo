<?php 
include_once("../../conf.php");
$activate=$_POST["activate"]; #para verificar si es guardar o solo consultar


$idconsultar=$_REQUEST["variable"];#consulta a dependencia que selecciono
  if($_REQUEST["vardelete"]=="True")#verifica para eliminar
{
	$ideliminar=$_POST["varusu"];	
	$mysqldelete=mysql_query("DELETE FROM th_distributivo_per WHERE id_distributivo_per = '$ideliminar'",$conectar)or die("Error");
	
	$_GET['avisomensaje']='Se ha eliminado un registro';
	$_GET['avisotipo']='rojo';
	$_GET['automatico']='si';
	include("../../ventanas_avisos.php");
	
}
#echo $activate.">>>>>".$_REQUEST["autnom"]."<<<>>>>";

if($activate==true)
{ 
#botn agregar 
?>
<div align="center" style="text-align:center !important"><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/mostrar_distributivos_personal.php?aut=<?=$_REQUEST["aut"];?>&autnom=<?=$_REQUEST["autnom"]?>','#Contneidointernodis');" class="btn_azul" style="min-width:40px;">&nbsp;&nbsp;Continuar Agregando</a>
</div>
<?php 
	$idprincipal=trim($_POST["idprincipal"]);
	$area= trim($_POST["area"]);
	$id_personal=trim($_POST["id_personal"]);
	$mod_contrato=trim($_POST["mod_contrato"]);
	$denominacion_puesto=trim($_POST["denominacion_puesto"]);
	$rol_de_puesto= trim($_POST["rol_de_puesto"]);
	$rmu= trim($_POST["rmu"]);
	$partida= trim($_POST["partida"]);
	$fecha_ing= trim($_POST["fecha_ing"]);
	$fecha_salida= trim($_POST["fecha_salida"]);
	$otros= trim($_POST["otros"]);
	
	#recibe el periodo/distributivo
	$periodo_id_distr=trim($_POST["id_distributivo_dis"]);
	
	#id_dependencia area original
	$queryarea_original=mysql_query("select * from th_distributivo_dep where id_distributivo_dep='$area' ",$conectar) or die("Error");
	$reg_area_original=mysql_fetch_array($queryarea_original);
		
	$id_dependencia=$reg_area_original["nivel_dependencia"];
	$id_distributivo_se=$reg_area_original["id_distributivo"];
	
	$nuevo_ingreso=mysql_query("select * from th_distributivo_per where id_personal='$id_personal' and id_distributivo='$periodo_id_distr'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	
	if((mysql_num_rows($nuevo_ingreso)>0 and $_POST['idprincipal']==""))
	{
		$_GET['avisomensaje']='Este funcionario ya esta registrado';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../../ventanas_avisos.php");
	}
	else
	{
		mysql_query("BEGIN"); #inicia la transaccion		
		$mysqlinsert=mysql_query("
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
		 '$idprincipal',
		 '$id_personal',
		 '$area',
		 '$mod_contrato',
		 '$rol_de_puesto',
		 '$denominacion_puesto',
		 '$rmu',
		 '$partida',
		 '$fecha_ing',
		 '$fecha_salida',
		 '$otros',
		 '$periodo_id_distr'
		 )ON DUPLICATE KEY UPDATE
		 	id_personal='$id_personal',
			id_distributivo_dep='$area',
			mod_contrato='$mod_contrato',
			rol_de_puesto='$rol_de_puesto',
			denominacion_puesto='$denominacion_puesto',
			rmu='$rmu',
			partida='$partida',
			fecha_ing='$fecha_ing',
			fecha_salida='$fecha_salida',
			otros='$otros'")or die("Error: ".mysql_error());
			
			
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
			
			
			$mysqlupdate=mysql_query("UPDATE gad_personal SET 
			id_dependencia = '$id_dependencia', 
			per_estado='activo',
			puesto='$rol_de_puesto',
			sit_laboral='$mod_contrato',
			ultimodistributivo='$id_distributivo_se'
			 WHERE id_personal ='$id_personal'",$conectar);
			
		if (!$mysqlupdate) 
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
		
		
		 if ($error != 1)
		 {
		############
		// No hay error.
	        // Entonces con COMMIT aceptamos todos los movimientos
	        // y ya se reflejan en la Base de Datos.
	        mysql_query("COMMIT");	
		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../../ventanas_avisos.php");
		
		$idconsultar=$area; #para mostrar el personal del área que se guardo los cmabios
		
		 }
		}
	}
	
	
}
else
	{
	#	echo "Solo muestra";
	}
	
	if($idconsultar<>"")
	{
?>

<div style="height:250px; overflow-y:scroll; overflow-style:marquee-line; border-top:1px solid rgba(185,185,185,1.00); padding:2px" >
<h4 style="margin:0px; padding:2px; text-transform:uppercase" align="center">Personal REGISTRADO en: 
<?php 
#selecciona el titulo de la dependecia seleccionada
$depselec=mysql_query("select dependencia_nom from th_distributivo_dep where id_distributivo_dep='$idconsultar'",$conectar)or die ("Error");
$regdepselec=mysql_fetch_array($depselec);
echo $regdepselec["dependencia_nom"];
?>
</h4>
<table border="0" cellspacing="0" cellpadding="0" class="estilo_tabla1" width="100%" align="center" style="font-size:13px !important">
<thead>
  <tr>
    <th align="center"><strong>#</strong></th>
    <th align="center"><strong>NOMBRES</strong></th>
    <th align="center"><strong>ROL DE PUESTO</strong></th>
    <th align="center"><strong>MOD. CONTRATO</strong></th>
    <th align="center"><strong>RMU</strong></th>
    <th align="center"><strong>INGRESO</strong></th>
    <th align="center"><strong>SALIDA</strong></th>
    <th align="center">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php 

  
	$querycargo=mysql_query("select concat_ws(' ',
	gad_personal.tratamiento,
	gad_personal.nombres,
	gad_personal.apellidos)as nomina,
concat_ws('.*.',
th_distributivo_per.id_distributivo_per,
th_distributivo_per.id_personal,
th_distributivo_per.id_distributivo_dep,
th_distributivo_per.mod_contrato,
th_distributivo_per.rol_de_puesto,
th_distributivo_per.denominacion_puesto,
th_distributivo_per.rmu,
th_distributivo_per.partida,
th_distributivo_per.fecha_ing,
th_distributivo_per.fecha_salida,
th_distributivo_per.otros,
gad_personal.nombres,
gad_personal.apellidos)as todos,
 th_distributivo_per.* from th_distributivo_per 
inner join gad_personal on th_distributivo_per.id_personal=gad_personal.id_personal
where th_distributivo_per.id_distributivo_dep='$idconsultar'", $conectar)or die("Error_".mysql_error());
	
	$totalrmu=0;
	while($regcargo=mysql_fetch_array($querycargo))
	{
		$var=$var+1;
		
	?>
  <tr>
    <td align="center" valign="middle"><?=$var?></td>
    <td><?=$regcargo["nomina"]?></td>
    <td><?=$regcargo["rol_de_puesto"]?></td>
    <td><?=$regcargo["mod_contrato"]?></td>
    <td align="right">
	<?php #imprime RMU y calcula el total
	echo $regcargo["rmu"];
	$totalrmu=$totalrmu+$regcargo["rmu"];
	?>
    
    </td>
    <td align="center"><?=$regcargo["fecha_ing"]?></td>
    <td align="center"><?=$regcargo["fecha_salida"]?></td>
    <td align="center" style="width:80px;">
    <?php 
	#muestra est opcion solo si es edicion
	if(!$activate)
	{
	?>
    <a href="javascript:void()" onClick="pasarpersonal('<?=$regcargo["todos"];?>')" class="btn_azul" ><img src="imag/editarbtn.png" style="vertical-align:middle"></a>
    <a href="javascript:void()" onClick="pasar_a_eliminar('<?=$regcargo["todos"];?>')" class="btn_rojo" ><img src="imag/bin.png" style="vertical-align:middle"></a>
    
    <?php 
	}
	?>
    </td>
  </tr>
  <?php 
	}
	?>
    <tr>
    <td colspan="4" align="right" valign="middle"><div align="right" style="text-align:right;"><strong>TOTAL EN RMU: &nbsp;</strong></div></td>
    <td align="right"><?php echo number_format($totalrmu,2);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </td>
</tr>
    
    </tbody>
</table>
<div id="eliminar" class="emergentepadre">
	<div class="emergentehijo" style="background:rgba(255,255,255,1.00); min-height:200px; min-width:350px">
    <h4 align="center" id="color_red" style="margin:0px; color:rgba(255,255,255,1.00); padding:2px">Eliminar Datos</h4>
    <input type="hidden" name="eliminarid"  id="eliminarid" value="">
    <p align="center" style="padding:10px;" >Está seguro que desea eliminar el funcionario:<br>
      <strong><span id="funcionariodelete"></span></strong> <br>
      de este distributivo? </p>
    <div align="center" style="text-align:center !important">
    <a href="javascript:void()" onClick="cambioseliminar($('#area').val(),$('#eliminarid').val(),'mod_talento_humano/script/mostrar_distriv_dep_pers.php','cargperarea');" class="btn_azul" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a href="javascript:void()" onClick="$('#eliminar').fadeOut(800);$('#eliminarid').val('');" class="btn_rojo" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>
<br>

    </div>
    </div>
</div>
</div>
<script>
function pasarpersonal(valores_dep)
{
	
	var string = valores_dep;
	var array = string.split(".*.");
	$('#idprincipal').val(array[0]);
	$('#id_personal').val(array[1]);
	$('#area').val(array[2]);
	$('#mod_contrato').val(array[3]);
	$('#rol_de_puesto').val(array[4]);
	$('#denominacion_puesto').val(array[5]);
	$('#rmu').val(array[6]);
	$('#partida').val(array[7]);
	$('#fecha_ing').val(array[8]);
	$('#fecha_salida').val(array[9]);
	$('#otros').val(array[10]);
	$('#funcionario').val(array[11]+' '+array[12]);
	
	//$("#nivelestructural> option[value="+ array[3] +"]").attr("selected",true);
	//$("#organicoestructural>option[value="+ array[4] +"]").attr("selected",true);
	
	
}
function pasar_a_eliminar(vardelete)
{
	$('#eliminarid').val("");
	
	var stringdel = vardelete;
	var arraydel = stringdel.split(".*.");
	$('#funcionariodelete').html(arraydel[11]+' '+arraydel[12]);
	$('#eliminar').fadeIn(800);
	$('#eliminarid').val(arraydel[0]);
}

function cambioseliminar(datose,variable_postc,filee,objete)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	var obje="#"+objete;
	$(obje).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');//id del select
	//hasta aqui para mostrar el loading
	
	var variable_post=datose;
	var variable_postb='True';
	//var variable_postc=$('#eliminarid').val();
	
	$.post(filee, {variable: variable_post,vardelete:variable_postb,varusu:variable_postc }, function(data){
	$(obje).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	//$(obj).css("display", "inline");
	//$("#botonguardar").css("display", "inline");
	});			
}
</script>

<?php 
	}
?>