<?php 
include_once("../../conf.php");


if($_REQUEST["activate"]==true)
{
	#recoge el id depa ctual 
	$id_buscado=explode(":",$_POST["area_dep"]);
	#propuesto dep
	$id_buscado2=explode(":",$_POST["area_dep2"]);	

	#guarda o actualiza
	$ids_personal_distr=explode(":", $_POST["funcionariosac"]);
	
	$id_cambio_adm=$_POST["id_cambio_adm"];
	$id_personal=$ids_personal_distr[0];
	$fecha_creacion=$_POST["fecha_elaboracion"];
	$accion_n=$_POST["accionn"];
	$explicacion=mysql_escape($_POST["explicación"]);
	$referencias=mysql_escape($_POST["referencias"]);
	$ac_period=$_POST["periodo"];
	$ac_dependencia=$id_buscado[1];#$_POST["area_dep"];
	$ac_nombrespesonal="";
	$ac_motivo_salida=$_POST["motivocambio"];
	$ac_mod_contrato=$_POST["mod_contrato_ac"];
	$ac_denominacion=$_POST["puestoactual"];
	$ac_rol=$_POST["rol_de_puesto_ac"];
	$ac_rmu=$_POST["rmu_ac"];
	$ac_partida=$_POST["partida"];
	$ac_fecha_in=$_POST["fecha_ing_ac"];
	$periodo_nuevo=$_POST["periodo2"];
	$depe_nueva=$id_buscado2[1];
	
	$motivo=$_POST["ingresopor"];
	$mod_contrat=$_POST["mod_contrato"];
	$denominacion_nuevo=$_POST["denominacion_puesto"];
	$rolpuesto=$_POST["rol_de_puesto_pr"];
	$rmu_nuevo=$_POST["rmu_pr"];
	$partida_nuevo=$_POST["partida2"];
	$fecha_ini=$_POST["fecha_ing_ing_pr"];
	$observaciones=mysql_escape($_POST["observaciones"]);
	$fecha_finaliza=$_POST["fecha_finaliza"];


	#NO SE VALIDA DUPLICIDAD
		mysql_query('begin'); 	
		$mysqlinsert=mysql_query("
		INSERT INTO th_cambio_admin (
		id_cambio_adm,
		id_personal,
		fecha_creacion,
		accion_n,
		explicacion,
		referencias,
		ac_period,
		ac_dependencia,
		ac_nombrespesonal,
		ac_motivo_salida,
		ac_mod_contrato,
		ac_denominacion,
		ac_rol,
		ac_rmu,
		ac_partida,
		ac_fecha_in,
		periodo_nuevo,
		depe_nueva,
		motivo,
		mod_contrat,
		denominacion_nuevo,
		rolpuesto,
		rmu_nuevo,
		partida_nuevo,
		fecha_ini,
		observaciones,
		fecha_finaliza)
		VALUES (
		'$id_cambio_adm',
		'$id_personal',
		'$fecha_creacion',
		'$accion_n',
		'$explicacion',
		'$referencias',
		'$ac_period',
		'$ac_dependencia',
		'$ac_nombrespesonal',
		'$ac_motivo_salida',
		'$ac_mod_contrato',
		'$ac_denominacion',
		'$ac_rol',
		'$ac_rmu',
		'$ac_partida',
		'$ac_fecha_in',
		'$periodo_nuevo',
		'$depe_nueva',
		'$motivo',
		'$mod_contrat',
		'$denominacion_nuevo',
		'$rolpuesto',
		'$rmu_nuevo',
		'$partida_nuevo',
		'$fecha_ini',
		'$observaciones',
		'$fecha_finaliza')		
		
		ON DUPLICATE KEY UPDATE
		accion_n='$accion_n',
		explicacion='$explicacion',
		referencias='$referencias',
		ac_period='$ac_period',
		ac_dependencia='$ac_dependencia',
		ac_nombrespesonal='$ac_nombrespesonal',
		ac_motivo_salida='$ac_motivo_salida',
		ac_mod_contrato='$ac_mod_contrato',
		ac_denominacion='$ac_denominacion',
		ac_rol='$ac_rol',
		ac_rmu='$ac_rmu',
		ac_partida='$ac_partida',
		ac_fecha_in='$ac_fecha_in',
		periodo_nuevo='$periodo_nuevo',
		depe_nueva='$depe_nueva',
		motivo='$motivo',
		mod_contrat='$mod_contrat',
		denominacion_nuevo='$denominacion_nuevo',
		rolpuesto='$rolpuesto',
		rmu_nuevo='$rmu_nuevo',
		partida_nuevo='$partida_nuevo',
		fecha_ini='$fecha_ini',
		observaciones='$observaciones',
		fecha_finaliza='$fecha_finaliza'")or die(mysql_query('rollback'));
		$ultimoidcambioad=mysql_insert_id();

#ACTUALIZAR EL DISTRIBUTIVO 

$id_distributivo_dep=$id_buscado2[0];
$mod_contrato=$mod_contrat;
$rol_de_puesto=$rolpuesto;
$denominacion_puesto=$denominacion_nuevo;
$rmu=$rmu_nuevo;
$partida=$partida_nuevo;
$fecha_ing=$fecha_ini;
$fecha_salida=$fecha_finaliza;
$id_distributivo=$_POST["periodo2"];

$id_distributivo_per=$ids_personal_distr[1];


#actualiza el distributivo
$sqlupdistributivo=mysql_query("UPDATE th_distributivo_per SET 
id_distributivo_dep='$id_distributivo_dep',
mod_contrato='$mod_contrato',
rol_de_puesto='$rol_de_puesto',
denominacion_puesto='$denominacion_puesto',
rmu='$rmu',
partida='$partida',
fecha_ing='$fecha_ing',
fecha_salida='$fecha_salida'
WHERE id_distributivo_per = '$id_distributivo_per'",$conectar)  or die(mysql_query('rollback'));

#actualiza el perfil laboral
#fechasalida

$fecha_salida = $fecha_ini;
$nuevafecha = strtotime ( '-1 day' , strtotime ( $fecha_salida ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha ); 

#$id_trayectoria='NULL';
$id_personal=$ids_personal_distr[0];
$institucion="GOBIERNO AUTÓNOMO DESCENTRALIZADO PROVINCIAL DE NAPO";
$t_tipo="Pública";
$unidadadmin=$id_buscado[1];
$denonpuesto=$ac_denominacion;
$ingresopor="CAMBIO ADMINISTRATIVO";#$ac_mod_contrato;
$motivosalida=$ac_motivo_salida;
$fingreso=$ac_fecha_in;
$fsalida=$nuevafecha;
$actividades=$ac_rol;

$trayelaboral=mysql_query("
INSERT INTO gad_tray_laboral (
id_trayectoria,
id_personal, 
institucion,
t_tipo,
unidadadmin,
denonpuesto,
ingresopor,
motivosalida,
fingreso,
fsalida,
actividades) VALUES (
NULL, 
'$id_personal',
'$institucion',
'$t_tipo',
'$unidadadmin',
'$denonpuesto',
'$ingresopor',
'$motivosalida',
'$fingreso',
'$fsalida',
'$actividades')
",$conectar)or die(mysql_query('rollback'));











######################################################################	######################################################################		
#registro de insidencia y notificacion a gestion tecnológica

### IDENTIFICACION DEL PERSONAL QUE HACE EL CAMBIO
$sqlinfoper=mysql_query("select * from gad_personal where id_personal='$id_personal'",$conectar) or die(mysql_query('rollback'));
$reginfoper=mysql_fetch_array($sqlinfoper);


###GUARDA COMO NOTIFICACION
$usuariosGT=mysql_query("select id_personal from gad_personal where gad_personal.id_dependencia=17 and gad_personal.per_estado='activo'",$conectar);

	$inforpersonal=$reginfoper["tratamiento"]." ".$reginfoper["nombres"]. " ". $reginfoper["apellidos"]. ", Cédula: ".$reginfoper["cedula"];
	
	$titulonotifi="TALENTO HUMANO: Se ha realizado un movimiento de Personal.";
	$objetivonooti="El departamento de Talento Humano ha realizado un movimiento de puesto al funcionario ".$inforpersonal;
	
	$f_creada=date("Y-m-d H:i:s");
	$id_accion="MTH.".$reginfoper["id_personal"];

############
#DATOS DE USUARIOque resitra
$idconsulta=$_SESSION['userid'];
$sqldatos=mysql_query("select * from gad_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where id_personal='$idconsulta'",$conectar)or die("Error al obtener los datos del usuario");
$regdatos=mysql_fetch_array($sqldatos);

$nombres_us_registro=$regdatos['tratamiento']." ".$regdatos['nombres']." ".$regdatos['apellidos'];
#valida accesos



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
		 '$nombres_us_registro', '$objetivonooti', 'th', '', '$f_creada', '', '', '', ''
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

$requiriente=$nombres_us_registro;
#GENERA EL NOMBRE DE ACCION DE PERSONAL
#buscar el cambiosolicitado
$id_buscado=$ultimoidcambioad;
$sqlcambioi=mysql_query("SELECT concat_ws(' ',gad_personal.apellidos,gad_personal.nombres)as nomina, gad_personal.cedula,th_cambio_admin.* FROM th_cambio_admin 
INNER JOIN gad_personal on th_cambio_admin.id_personal=gad_personal.id_personal
where th_cambio_admin.id_cambio_adm='$id_buscado'",$conectar)or die("Error...".mysql_error());
$registroi=mysql_fetch_array($sqlcambioi);
$nombrearchivoadjunto="TH_AP_".$registroi["accion_n"]."_".str_replace(" ","_",$registroi["nomina"])."_".$registroi["cedula"].".pdf";;
$urladjunto="mod_talento_humano/reportes/accionpersonal.php?cuota=".$ultimoidcambioad.":".$nombrearchivoadjunto;


$problema='El departamento de Talento Humano ha realizado un movimiento de puesto al funcionario '.$inforpersonal. '. Solicita se haga los tramites correspondientes en los sistemas necesarios (Quipux, Fulltime, Olympo, entre otros). para mayor información puede revisar la acción de personal en el archivo adjunto.';

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
$actualnum=mysql_query("SELECT num_insidencia as ultimo FROM gad_incidencias ORDER BY id_incidencia DESC LIMIT 1",$conectar);
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
$prioridad='Normal';
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
prioridad,
adjuntos) values (
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
	'$prioridad',
	'$urladjunto')",$conectar) ;

#cierra nueva insisdencia y helpesk




















mysql_query('commit'); 

#GUARDAR CAMBIO EN TRAYECTORIA LABORAL


		
		$_GET['avisomensaje']='Se ha guardado el Registro correctamente';
		$_GET['avisotipo']='verde';
		$_GET['automatico']='si';
		include("../ventanas_avisos.php");
	
		
}
else
{
	#solo muestra
}

?>

<div style="height:300px;  overflow-y:scroll; overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >

<table border="0" cellspacing="4" cellpadding="4" class="tabla1" width="100%" align="center">
<thead>
  <tr>
    <th align="center">PERSONAL</th>
    <th align="center"><strong>MOTIVO</strong></th>
    <th align="center"><strong>DESDE</strong></th>
    <th align="center">HACIA</th>
    <th align="center"><strong>EXPLICACIÓN</strong></th>
    <th width="50" align="center">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  
  <?php 
	$querycargo=mysql_query("select concat_ws(' ',gad_personal.apellidos,gad_personal.nombres) as apell_nom,th_cambio_admin.* from th_cambio_admin 
inner join gad_personal on th_cambio_admin.id_personal=gad_personal.id_personal 
order by fecha_creacion desc", $conectar)or die("Error_".mysql_error());
	while($regcargo=mysql_fetch_array($querycargo))
	{
	?>
  <tr>
    <td  align="center" valign="middle"><?php echo $regcargo["apell_nom"]; ?></td>
    <td align="center" ><?php echo $regcargo["motivo"]; ?></td>
    <td align="center" ><?php echo $regcargo["ac_dependencia"]; ?></td>
    <td align="center" ><?php echo $regcargo["depe_nueva"]; ?></td>
    <td ><?php echo $regcargo["explicacion"]; ?></td>
    <td align="center" ><a href="mod_talento_humano/reportes/accionpersonal.php?cuota=<?php echo $regcargo["id_cambio_adm"]; ?>"><img src="imag/doc_pdf.png"></a></td>
    
  </tr>
  <?php 
	}
	?>
    </tbody>
</table>
</div>
<script>
function Abrir_reporte (pagina,haspag) {
var opciones="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=yes";

window.open(pagina,haspag,opciones);
}

function target_popup(form) {
    window.open('', '_Rep_Servicios', 'resizeable,scrollbars');
    form.target = 'formpopup';
}

</script>