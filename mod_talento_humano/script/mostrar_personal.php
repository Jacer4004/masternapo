<?php 
include("../../conf.php");

$activate=$_POST["activate"];#si hay valor procede a guardar
if($activate==true)
{ 
	
	$id_personal=$_POST["id_personal"];
	$cedula=$_POST["cedula"];
	$apellidos=$_POST["apellidos"];
	$nombres=$_POST["nombres"];
	$tratamiento=$_POST["tratamiento"];
	$genero=$_POST["genero"];
	$fnacimiento=$_POST["fnacimiento"];
	$lugarnacimiento=$_POST["lugarnacimiento"];
	$ecivil=$_POST["ecivil"];
	$tiosangre=$_POST["tiposangre"];
	$nacionalidad=$_POST["nacionalidad"];
	$grupoetnico=$_POST["grupoetnico"];
	$discapacidad=$_POST["discapacidad"];
	$tipodiscapacidad=$_POST["tipodiscapacidad"];
	$numeroconadis=$_POST["numeroconadis"];
	$porcentaje=$_POST["porcentaje"];
	$telefonocasa=$_POST["telefonocasa"];
	$telefonos=$_POST["telefonos"];
	$telefonosarray=$telefonos[0].":".$telefonos[1].":".$telefonos[2];
	$correopersonal=$_POST["correopersonal"];
	$correo=$_POST["correo"];
	$calleprincipal=$_POST["calleprincipal"];
	$callesecundaria=$_POST["callesecundaria"];
	$numcasa=$_POST["numcasa"];
	$provincia=$_POST["provincia"];
	$canton=$_POST["canton"];
	$parroquia=$_POST["parroquia"];
	$aniosresidencia=$_POST["aniosresidencia"];
	$observaciones=$_POST["observaciones"];
	$nafiliacion=$_POST["nafiliacion"];
	$nombreemergencia=$_POST["nombreemergencia"];
	$telefonoemergencia=$_POST["telefonoemergencia"];
	
	$conyuge=$_POST["conyuge"];
	$apellidosconyugue=$_POST["apellidosconyugue"];
	$nombresconyuge=$_POST["nombresconyuge"];
	$cedulaconyuge=$_POST["cedulaconyuge"];
	$telefonosconyuge=$_POST["telefonosconyuge"];

	
	
	
	
	$nuevo_ingreso=mysql_query("select cedula from gad_personal where cedula='$cedula'",$conectar) or die("ERROR: ".mysql_error());
	$reg_nuevo_ingreso=mysql_fetch_array($nuevo_ingreso);
	if((mysql_num_rows($nuevo_ingreso)>0 and $_POST['id_personal']==""))
	{
		$_GET['avisomensaje']='Ya existe un registro con este nombre';
		$_GET['avisotipo']='amarillo';
		$_GET['automatico']='no';
		include("../../ventanas_avisos.php");
	}
	else
	{
			
		$mysqlinsert=mysql_query("
		INSERT INTO gad_personal (
id_personal,
id_dependencia,
nombres,
apellidos,
cedula,
correo,
observaciones,
puesto,
tratamiento,
tituloacademico,
genero,
dir_domicilio_gp,
correo_per_gp,
movil_per_gp,
telfcasa_gp,
sit_laboral,
per_estado,
ultimodistributivo,
fecha_naci,
lug_naci,
estadocivil,
tiposangre,
nacionalidad,
grupoetnico,
discapacidad,
tipodiscapacidad,
numeroconadis,
porcentajeconadis,
callesecundaria,
ncasa,
provinciadomic,
cantondomic,
parroquiadomic,
aniosresidente,
conyuge,
apellidosconyugue,
nombresconyuge,
cedulaconyuge,
telefonosconyuge ,
otros,
nafiliacion,
nombreemergencia,
telefonoemergencia
)
VALUES (
'$id_personal',
'',
'$nombres',
'$apellidos',
'$cedula',
'$correo',
'$observaciones',
'',
'$tratamiento',
'',
'$genero',
'$calleprincipal',
'$correopersonal',
'$telefonosarray',
'$telefonocasa',
'',
'activo',
'',
'$fnacimiento',
'$lugarnacimiento',
'$ecivil',
'$tiosangre',
'$nacionalidad',
'$grupoetnico',
'$discapacidad',
'$tipodiscapacidad',
'$numeroconadis',
'$porcentaje',
'$callesecundaria',
'$numcasa',
'$provincia',
'$canton',
'$parroquia',
'$aniosresidencia',
'$conyuge',
'$apellidosconyugue',
'$nombresconyuge',
'$cedulaconyuge',
'$telefonosconyuge',
'$observaciones',
'$nafiliacion',
'$nombreemergencia',
'$telefonoemergencia'
)		
ON DUPLICATE KEY UPDATE
nombres='$nombres',
apellidos='$apellidos',
cedula='$cedula',
correo='$correo',
observaciones='$observaciones',
tratamiento='$tratamiento',
genero='$genero',
dir_domicilio_gp='$calleprincipal',
correo_per_gp='$correopersonal',
movil_per_gp='$telefonosarray',
telfcasa_gp='$telefonocasa',
fecha_naci='$fnacimiento',
lug_naci='$lugarnacimiento',
estadocivil='$ecivil',
tiposangre='$tiosangre',
nacionalidad='$nacionalidad',
grupoetnico='$grupoetnico',
discapacidad='$discapacidad',
tipodiscapacidad='$tipodiscapacidad',
numeroconadis='$numeroconadis',
porcentajeconadis='$porcentaje',
callesecundaria='$callesecundaria',
ncasa='$numcasa',
provinciadomic='$provincia',
cantondomic='$canton',
parroquiadomic='$parroquia',
aniosresidente='$aniosresidencia',
conyuge='$conyuge',
apellidosconyugue='$apellidosconyugue',
nombresconyuge='$nombresconyuge',
cedulaconyuge='$cedulaconyuge',
telefonosconyuge='$telefonosconyuge',
otros='$observaciones',
nafiliacion='$nafiliacion',
nombreemergencia='$nombreemergencia',
telefonoemergencia='$telefonoemergencia'
")or die("Error: ".mysql_error());
$id=mysql_insert_id();

######################################################################		
#registro de insidencia y notificacion a gestion tecnológica
if($id_personal=="")
{
###GUARDA COMO NOTIFICACION
$usuariosGT=mysql_query("select id_personal from gad_personal where gad_personal.id_dependencia=17 and gad_personal.per_estado='activo'",$conectar);
	
	$titulonotifi="TALENTO HUMANO: Nuevo Personal ha sido registrado";
	$objetivonooti="El departamento de Talento Humano ha registrado a: ".$tratamiento." ".$nombres. " ". $apellidos. ", Cédula: ".$cedula;
	$f_creada=date("Y-m-d H:i:s");
	$id_accion="MTH.".$id;
	
	while($RegusuGT=mysql_fetch_array($usuariosGT))
	{
		$destino= $RegusuGT["id_personal"];
		
		mysql_query("INSERT INTO gad_notificaciones(
		id_notificacion,
		id_accion,
		titulo,
		destino ,
		autor,
		objetivo ,
		tipo,
		vista_emergente ,
		f_creada ,
		f_vista,
		f_lectura ,
		accion,
		observaciones)
		VALUES (
		NULL , '$id_accion', '$titulonotifi', '$destino',
		 '$nombres_us', '$objetivonooti', 'th', '', '$f_creada', '', '', '', ''
		)",$conectar);			
	}

######################################################################
######################################################################	
#REGISTRO JELPDESK

#$id_usuario=$_SESSION['userid'];#usuario actual que asiste
//$nuevoreq=$_POST["nuevoreq"];

$id_incidencia="";
$fech_h_peticion=date("Y-m-d H:i:s");
$tipoinsidencia="Datos del Usuario";

#obtine datos de usuario para requiriente
$idconsulta_r=$_SESSION['userid'];
$sqldatos_r=mysql_query("select * from gad_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where id_personal='$idconsulta_r'",$conectar)or die("Error al obtener los datos del usuario");
$regdato_s=mysql_fetch_array($sqldatos_r);

$requiriente=$regdato_s['tratamiento']." ".$regdato_s['nombres']." ".$regdato_s['apellidos'];


$problema="El departamento de Talento Humano ha registrado al funcionario: ".$tratamiento." ".$nombres. " ". $apellidos. ", Cédula: ".$cedula. ". Solicita se haga los tramites correspondientes en los sistemas necesarios (Quipux, Fulltime, Olympo, entre otros).";

$solucion="";
$atendio="";
$fech_h_iniatencion="";
$fecha_h_finatencion="";
$estado="PENDIENTE";
$ips_incidencias="127.0.0.1";
$insotros="";
$prioridad="Normal";
$id_usuario_crea=$_SESSION['userid']; #usuario que crea la insidencia

#GENERA NUMERO DE INSIDENCIA
#
#calcula el ultimo numero
$actualnum=mysql_query("SELECT num_insidencia as ultimo FROM gad_incidencias ORDER BY id_incidencia DESC LIMIT 1",$conectar)or die("Error");
$queryultimo=mysql_fetch_array($actualnum);

if($queryultimo["ultimo"]<>"")
{
	$anio_num=explode("-", $queryultimo["ultimo"]);
	if($anio_num[1]==date("Y"))
	{
		$secuencia=$anio_num[2]+1;
		
		$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-".$secuencia;
	}
	else
	{
		$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-1";
	}
}
else
{
	$num_insidencia=$regdatos["abreviatura"]."-".date("Y")."-1";
}

#######################guarda helpdesk#####

mysql_query("insert into gad_incidencias (
	id_incidencia,
	num_insidencia,
tipoinsidencia,
fech_h_peticion,
requiriente,
problema,
solucion,
atendio,
fech_h_iniatencion,
fecha_h_finatencion,
ips_incidencias,
estado,
insotros,
id_usuario,
id_usuario_crea,
prioridad) values (
	'$id_incidencia',
	'$num_insidencia',
	'$tipoinsidencia',
	'$fech_h_peticion',
	'$requiriente',
	'$problema',
	'$solucion',
	'$atendio',
	'$fech_h_iniatencion',
	'$fecha_h_finatencion',
	'$ips_incidencias',
	'$estado',
	'$insotros',
	'$id_usuario',
	'$id_usuario_crea',
	'$prioridad') ",$conectar) or die ("ERROR_".mysql_error());

}#cierra nueva insisdencia y helpesk


################################FIN HELP DESK#############		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../../ventanas_avisos.php");
	}
	
	
}
else
	{
	#	echo "Solo muestra";
	}
?>
<script type="text/javascript">

	
 function calcular_edad() 
 {   

 var birthday=$('#fnacimiento').val();
  var year, month, day, age, year_diff, month_diff, day_diff;   
  var myBirthday = new Date();    
  var today = new Date();    
  var array = birthday.split("-");
   
   year = array[0];    month = array[1];    
   day = array[2];
   year_diff = today.getFullYear() - year;   
   month_diff = (today.getMonth() + 1) - month;    
   day_diff = today.getDate() - day;
   
   if (month_diff < 0) 
   	{        
   		year_diff--;    
    } 
	else if ((month_diff === 0) && (day_diff < 0)) 
	{ 
		year_diff--;    
	}    
	/*return year_diff;*/
   $('#Edad').html(year_diff + " Años");
   
    }
 

</script>

 <!--<div class="barraexploracion"   id="navegacion"><a href="#" onClick="cerrar_abrir('personal','contenedor');"></a></div>
 	<div align="center" style="text-align:center !important;">
   <div id="Contneidointernopersonal" 
     style="margin:10px; min-height:500px; text-align:center !important;" align="center">
     -->
     
     <!--AGREGA NUEVOPERSONAL-->
<div id="nuevo_personal" style="clear:both; align-content:center; text-align:center !important; display:none;font-size:14px !important;  " align="center" >
<?php 
	include("mod_talento_humano/nuevo_personal.php"); 
?>
</div>
<div style="clear:both;" align="center"></div>
<!--CARGA EL EPRSONAL--><br>


<div id="funcionarios_load" style="clear:both;">
<div align="center" style="text-align:center !important">
<form name="frmbuscar" class="formularios">

<?php 
if($_GET['datosbuscando']!="")
{
?>
<strong>Filtro:</strong>
<a href="javascript:void()" onClick="document.getElementById('datobuscar').value='';buscar_th('')" class=" tooltipjrojas"><span>Eliminar Filtro</span><?php echo $_REQUEST['datosbuscando'];?> <img src="imag/eliminar2.png"></a>
<?php 
}
?>
<input id="datobuscar" style="width:250px;" type="text" placeholder="Cédula, Apellidos o Nombres" value="<?php echo $_REQUEST['datosbuscando'];?>">

<input style="margin-top:-20px !important" type="button" class="btn_azul" value="Buscar" onClick="buscar_th(document.getElementById('datobuscar').value)">

</form><br>
</div>

<div style="height:400px; overflow-y:scroll; overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >
<table border="0" cellspacing="0" cellpadding="3" class="tabla_jre" width="100%" align="center" style="font-size:14px;">
<thead>
  <tr>
    <th width="200">&nbsp;</th>
    <th align="center"><strong>FUNCIONARIO</strong></th>
    <th align="center"><strong>CÉDULA</strong></th>
    <th align="center"><strong>DEPENDENCIA ACTUAL </strong></th>
    <th width="">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $datobuscar=$_GET['datosbuscando'];
  #echo $datobuscar."xx";
#para mostrar el personal

$sqlpersonal_a=mysql_query("select * from gad_personal 
LEFT JOIN gad_dependencia ON gad_personal.id_dependencia=gad_dependencia.id_dependencia
where cedula like '%$datobuscar%' or nombres like '%$datobuscar%' or apellidos like '%$datobuscar%'",$conectar) or die ("ERROR_".mysql_error());

$num_total_registros = mysql_num_rows($sqlpersonal_a);

$TAMANO_PAGINA = 20;
$pagina = $_GET["pagina"];
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}
//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);


$consulta_a = "select * from gad_personal 
LEFT JOIN gad_dependencia ON gad_personal.id_dependencia=gad_dependencia.id_dependencia
where cedula like '%$datobuscar%' or nombres like '%$datobuscar%' or apellidos like '%$datobuscar%'
 ORDER BY apellidos LIMIT ".$inicio."," . $TAMANO_PAGINA;
$sqlpersonal = mysql_query($consulta_a, $conectar);


  while($regpersonal=mysql_fetch_array($sqlpersonal))
  {
	  $cont=$cont+1;
  ?> 
  <tr>
    <td  align="center" valign="middle">
      
      
      <a href="javascript:void()" onClick="editarpersonal('<?php echo $regpersonal["id_personal"]?>','editar')" class="imgboton tooltipjrojas"><span>Editar</span><img src="imag/pencil2.png" style="vertical-align:middle"></a>
      
      <a href="javascript:void()" onClick="editarpersonal('<?php echo $regpersonal["id_personal"]?>','academico')" class="imgboton tooltipjrojas"><span>Formación Académica</span><img src="imag/academy.png" style="vertical-align:middle"></a>
      
      <a href="javascript:void()" onClick="editarpersonal('<?php echo $regpersonal["id_personal"]?>','eprofesional')" class="imgboton tooltipjrojas"><span>Experiencia profesional</span><img src="imag/156-stats-dots.png" style="vertical-align:middle"></a>
      
      <a href="javascript:void()" onClick="editarpersonal('<?php echo $regpersonal["id_personal"]?>','capacitacion')" class="imgboton tooltipjrojas"><span>Capacitaciones</span><img src="imag/capacitaciones.png" style="vertical-align:middle"></a>
      <a href="javascript:void()" onClick="editarpersonal('<?php echo $regpersonal["id_personal"]?>','familiar')" class="imgboton tooltipjrojas"><span>Estructura Familiar</span><img src="imag/mw.png" style="vertical-align:middle"></a>
      
      <a href="javascript:void()" onClick="Abrir_ventana_reportes ('mod_talento_humano/fichadepersonal.php?var=<?=$regpersonal["id_personal"];?>')" class="imgboton tooltipjrojas"><span>Ficha del Personal</span><img src="imag/eye.png" style="vertical-align:middle"></a>
    </td>
    <td align="left" ><?php echo $regpersonal["apellidos"]." ".$regpersonal["nombres"]; ?></td>
    <td align="left" ><?php echo $regpersonal["cedula"]; ?></td>
    <td align="left" ><?php echo $regpersonal["nombre"]?></td>
    <td align="center"  style="min-width:80px;">
    
    <a href="javascript:void()" onClick="$('#estado_personal').fadeIn(500); cargarContenido('mod_talento_humano/script/estado_personal.php?personal_i=<?php echo $regpersonal["id_personal"]?>','#cargar_estado')" class="<?php if ($regpersonal["per_estado"]=="" or $regpersonal["per_estado"]=="inactivo"){echo "inactivo";}else{echo "activo";}?>">&nbsp;<?php 
	 if ($regpersonal["per_estado"]==""){echo ":-(";}elseif($regpersonal["per_estado"]=="inactivo"){echo "Inactivo";}else{echo "Activo";}
	?>&nbsp;</a>
    

    
    </td>
  </tr>
  <?php 
	}
	?>
    </tbody>
</table>

</div>
<div>
<section class="paginacion">
			<ul>
				<?php 
				if ($total_paginas > 1) 
				{
   				if ($pagina != 1)
				{
				?>
                
                <li><a href="javascript:pagina_anterior(<?=1?>);" >o|</a></li>
				<li><a href="javascript:pagina_anterior(<?=($pagina-1)?>)">Anterior</a></li>
                <?php 
				}
				for ($i=1;$i<=$total_paginas;$i++)
				{
					if ($pagina == $i)
					{
				?>
				<li><a href="#" class="paginacionactive"><?=$i?></a></li>
                <?php 
					}
					else
					{
				?>
                <li><a href="javascript:pagina_anterior(<?=($i)?>);"><?=$i?></a></li>         
                <?php 
					}
				}
				if ($pagina != $total_paginas)
				{
				?>
				<li><a href="javascript:pagina_anterior(<?=($pagina+1)?>);">Siguiente</a></li>
				<li><a href="javascript:pagina_anterior(<?=($total_paginas)?>);">|o</a></li>
                <?php 
				}
				}
				?>
			</ul>
</section>


<!--EMERGENTE PARA BLOQUEAR DISTRIBUTIVO-->


</div>
  

 </div>
 
 <!--emergente par manejo de estado-->
 <div align="center" id="estado_personal" class="emergentepadre" style="background:rgba(0,0,0,0.67) !important">
    <div class="emergentehijo ventanas" style="min-height:50%; max-width:60%">
    <h3>Estado del Personal <a href="javascript: void();"style="float:right; vertical-align:middle" onClick="$('#estado_personal').fadeOut(500);"><img src="imag/close_window.png" ></a></h3>
      
    <h4 align="center">Cambio del Estado del Personal</h4> 
    
    <div id="cargar_estado">
    
    </div>
 </div>
</div>

<script>

function editarpersonal(elidpersonal,tipo)
{
	var idcontrol=elidpersonal;
	switch(tipo)
	{
		case 'editar':
		cargarContenido('mod_talento_humano/nuevo_personal.php?personalcargado='+idcontrol,'#nuevo_personal');
	$('#funcionarios_load').fadeOut(800);
	$('#nuevo_personal').fadeIn(800);
		break;
		case 'academico':
		cargarContenido('mod_talento_humano/mostrar_academico.php?personalcargado='+idcontrol,'#principalsecundarios');
		$('#principalpersonal').hide();
		$('#principalsecundarios').fadeIn(500);
		break;
		
		case 'eprofesional':
		cargarContenido('mod_talento_humano/mostrar_e_profesional.php?personalcargado='+idcontrol,'#principalsecundarios');
		$('#principalpersonal').hide();
		$('#principalsecundarios').fadeIn(500);
		break;
		
		case 'capacitacion':
		cargarContenido('mod_talento_humano/mostrar_c_capacitaciones.php?personalcargado='+idcontrol,'#principalsecundarios');
		$('#principalpersonal').hide();
		$('#principalsecundarios').fadeIn(500);
		break;
		
		case 'familiar':
		cargarContenido('mod_talento_humano/mostrar_estructura_familiar.php?personalcargado='+idcontrol,'#principalsecundarios');
		$('#principalpersonal').hide();
		$('#principalsecundarios').fadeIn(500);
		break;
	}
	
		
	
}
function buscar_th(valor_buscar)
{
	var datobusq=valor_buscar;
	
	cargarContenido('mod_talento_humano/script/mostrar_personal.php?datosbuscando='+datobusq+'','#funcionarios_load')
}



function pagina_anterior(valorpagina)
{
	var datobusqpagina=document.getElementById('datobuscar').value;
	cargarContenido('mod_talento_humano/script/mostrar_personal.php?pagina='+valorpagina +'&datosbuscando='+datobusqpagina+'','#funcionarios_load');	
}


</script>

