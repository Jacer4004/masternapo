<?php 
include_once("../../conf.php");

$personalid=$_GET["personal_i"];

$activate=$_POST["activate"];#si hay valor procede a guardar
if($activate==true)
{
$a_estado=$_POST["a_estado"];



#actualiza estado en base estado
mysql_query("update gad_personal set per_estado='$a_estado' where id_personal='$personalid'",$conectar)or die(":-(");
#echo $personalid."::-".$activate."-::";

#actualiza usuario para evitar login
#actualiza estado en base estado
$md5pas=md5("diego");
if($a_estado=="activo"){$md5pas="@gadnapo#1";}
mysql_query("update gad_usuarios set contrasena='$md5pas' where id_personal='$personalid'",$conectar)or die(":-(");







######################################################################		
#registro de insidencia y notificacion a gestion tecnológica

###GUARDA COMO NOTIFICACION
$usuariosGT=mysql_query("select id_personal from gad_personal where gad_personal.id_dependencia=17 and gad_personal.per_estado='activo'",$conectar);#seleciona los usuarios del area de gestion tecnológica para indicarles la notificaion


#obtine datos de usuario que se procede a inactivar o activar
$idconsulta_estado=$personalid;
$sqldatos_es=mysql_query("select * from gad_personal
where id_personal='$idconsulta_estado'",$conectar)or die("Error al obtener los datos del usuario");
$regdato_estado=mysql_fetch_array($sqldatos_es);

$usuarioestado=$regdato_estado['tratamiento']." ".$regdato_estado['nombres']." ".$regdato_estado['apellidos'];


#obtine datos de autor
$idconsulta_a=$_SESSION['userid'];
$sqldatos_a=mysql_query("select * from gad_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where id_personal='$idconsulta_a'",$conectar)or die("Error al obtener los datos del usuario");
$regdato_a=mysql_fetch_array($sqldatos_a);

$usuarioautor=$regdato_a['tratamiento']." ".$regdato_a['nombres']." ".$regdato_a['apellidos'];
	
	$titulonotifi="TALENTO HUMANO: Cambio de estado a ".$a_estado. " al personal";
	$objetivonooti="El departamento de Talento Humano cambió el estado a ".$a_estado." al funcionario ".$usuarioestado;
	$f_creada=date("Y-m-d H:i:s");
	$id_accion="MTH.".$id;
	$autor=$usuarioautor;
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
		 '$autor', '$objetivonooti', 'th', '', '$f_creada', '', '', '', ''
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
where id_personal='$idconsulta_r'",$conectar)or die("Error al obtener los datos del usuario");
$regdato_s=mysql_fetch_array($sqldatos_r);

$requiriente=$regdato_s['tratamiento']." ".$regdato_s['nombres']." ".$regdato_s['apellidos']." Cédula: ".$regdato_s['cedula'] ;


$problema="El departamento de Talento Humano modificó el estado a ".$a_estado." al funcionario ".$usuarioestado.". Solicita se haga los tramites correspondientes en los sistemas necesario (Quipux, Fulltime, Olympo, entre otros).";

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

#cierra nueva insisdencia y helpesk


################################FIN HELP DESK#############		


















}
#selecciona del personal
$sqlselecpersonal=mysql_query("select * from gad_personal where id_personal='$personalid'",$conectar);
$regpersonaldata=mysql_fetch_array($sqlselecpersonal);

?>

<div style="margin:20px">
<form name="frm_estado_p" id="frm_estado_p">

<table align="center">
 
    <tr>
      <td align="right" ><strong>PERSONAL: </strong></td>
      <td align="left" ><?php echo $regpersonaldata["tratamiento"]." ".$regpersonaldata["nombres"]." ".$regpersonaldata["apellidos"]?>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><strong>ESTADO ACTUAL:</strong></td>
      <td><?php 
	 if ($regpersonaldata["per_estado"]==""){echo "Sin estado";}elseif($regpersonaldata["per_estado"]=="inactivo"){echo "Inactivo";}else{echo "Activo";}

	?></td>
    </tr>
    <tr>
      <td align="right"><strong>CAMBIAR ESTADO A:</strong></td>
      <td>
      <select name="a_estado" id="a_estado">
      <option value="">.: Seleccione :.</option>
      <option value="activo">Activo</option>
      <option value="inactivo">Inactivo</option>
      </select>
      </td>
    </tr>
    <tr>
      <td align="right"><strong>MOTIVO:</strong></td>
      <td><select name="a_motivo" id="a_motivo">
        <option value="">.: Seleccione :.</option>
        <option value="Otros">Otros</option>
        
      </select></td>
    </tr>
    <tr>
      <td colspan="2">
      <div align="center" style="text-align:center; clear:both;">
<input type="button" class="boton color_btn_azul" value="Guardar" onClick="g_estado()">

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Regresar" onClick=" buscar_th('<?php echo $regpersonaldata["cedula"]?>');$('#estado_personal').fadeOut(500);"> 
&nbsp;&nbsp;&nbsp;
</div>
      </td>
    </tr>
 
</table>
</form>
<br>

</div>

<script>
function g_estado()
 {

	 
	 if($('#a_estado').val()!='' && $('#a_motivo').val()!='')
	 {
	  /**guardar**/	//cerrar_abrir('nuevo_personal','funcionarios_load');
	
	cargardiv_form('mod_talento_humano/script/estado_personal.php?personal_i=<?php echo $personalid;?>','#cargar_estado','#frm_estado_p');


	 }
	 else
	 {
		alert('Los campos con un ( * ) son obligatorios'); 
	 }
	
 }
</script>