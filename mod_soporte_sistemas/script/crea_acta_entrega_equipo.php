<?php
session_start();
include("../../conf.php");

$ideconsulta=$_REQUEST["variableequipo"];
##echo ">>>>>>>>>>>>>>>>>>>>>>>".$ideconsulta;
#selecciona datos de acuerdo al valor recibido
$sqldatos=mysql_query("select distinct
a.*,concat_ws(' ',p.tratamiento,p.nombres,p.apellidos) as nomina,p.puesto,d.*,m5sts_ip.*,m5sts_us_ad.*,
(select group_concat(id_equipo separator '<>') from m5sts_e_e_componentes where m5sts_e_e_componentes.id_ent_equi=a.id_ent_equi) as componentesss
from m5sts_entrega_equipos a
left join m5sts_e_e_componentes l on l.id_ent_equi= a.id_ent_equi
inner join gad_personal p on p.id_personal=a.id_personal
inner join gad_dependencia d on d.id_dependencia=p.id_dependencia
left join m5sts_ip on m5sts_ip.id_ip=a.dir_ip
left join m5sts_us_ad on m5sts_us_ad.id_us_ad=a.us_ad
where a.id_ent_equi='$ideconsulta'",$conectar)or die ("ERROR_");
$regdatos=mysql_fetch_array($sqldatos);
$fecha=$regdatos["fecha_entrega"];

##consulta que recuepra el software para validar los entregados

#consulta y genera el numero de acta
#primeero verificamos si no existe el numero de acta
$sqlverifica=mysql_query("select * from m5sts_equipos_acta_entrega 
where m5sts_equipos_acta_entrega.id_ent_equi_acta=$ideconsulta",$conectar)or die("ERROR_CONSULTA DB ".mysql_error());

if(mysql_num_rows($sqlverifica)==0)
{
$nactaasql=mysql_query("select * from m5sts_equipos_acta_entrega order by nacta desc limit 1",$conectar) or die("ERROR_");
$regnactaa=mysql_fetch_array($nactaasql);
$nactaarreglo=split("-",$regnactaa["nacta"]);#descompone el numero de acta
#verifica el año para reinicial conteo automatico cada año 
if($nactaarreglo[1]==date("Y"))
{
	$nactaa=$nactaarreglo[2]+1;#incrementa el numero de acta
}else
{
	$nactaa=1;#inicia el conteo
}
$nactaa="SGT-".date("Y")."-".sprintf("%05d", $nactaa);
}else
{
	$regverificaacta=mysql_fetch_array($sqlverifica);
	$nactaa=$regverificaacta["nacta"];
}


###fecha 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

 

$texto_a_guardar='
<div>
<h3 align="center">ACTA DE ENTREGA DE EQUIPO N°- '. $nactaa.'</h3>
<p>Tena, '.date('d',strtotime($fecha)).' de '.$meses[date('n',strtotime($fecha))]. ' del '.date('Y',strtotime($fecha)).' </p>
<p align="justify">Se procede a la entrega del equipo informático con las características, software y aplicaciones únicamente autorizadas por la Subdirección de Gestión Técnológica del GADPNAPO, por lo tanto queda bajo responsabilidad el buen uso de lo especificado a continuación:</p>

	<h4>1. INFORMACIÓN DEL CUSTODIO</h4>
	  <table width="573" border="0">
  <tr>
    <td width="87"><strong>Nombre</strong></td>
    <td width="476"><strong>:</strong> '.$regdatos["nomina"].'</td>
  </tr>
  <tr>
    <td><strong>Cargo</strong></td>
    <td><strong>:</strong> '.$regdatos["puesto"].'</td>
  </tr>
  <tr>
    <td><strong>Dependencia</strong></td>
    <td><strong>:</strong> '.$regdatos["nombre"].'</td>
  </tr>
</table>

	<h4>2. EQUIPOS ESPECIFICACIONES/CARACTERÍSTICAS </h4>';
	if($regdatos["componentesss"]<>"")
	{
	$texto_a_guardar.='
	
	  <table border="1" rules="all" style="font-size:10px">
  <tr>
    <td align="center" width="90"><strong>CÓDIGO</strong></td>
    <td align="center" width="70"><strong>EQUIPO</strong></td>
    <td align="center" width="50"><strong>MARCA</strong></td>
    <td align="center" width="60"><strong>MODELO</strong></td>
	<td align="center" width="70"><strong>SERIE</strong></td>
	<td align="center" width="70"><strong>IU/MAC</strong></td>
	<td align="center" width="50"><strong>ESTADO</strong></td>
	<td align="center" width="150"><strong>ESPECIFÍCACIONES</strong></td>
  </tr>
  '; 					
	$componentess=split("<>",$regdatos["componentesss"]);
					for($r2=0;$r2<count($componentess);$r2++)
					{
						$el_id=$componentess[$r2];
						$sqlactivosentregados=mysql_query("select * from m5sts_equipos where id_equipo='$el_id'",$conectar) or die("Error 1");
						$reg_ee=mysql_fetch_array($sqlactivosentregados);
	#si encuentra en el array imprime
							
	$texto_a_guardar.='
    
  <tr>
    <td>'.$reg_ee["codigoactivo"].'</td>
    <td>'.$reg_ee["nombre"].' ('.substr($reg_ee["propietario"],0,3).')'.'</td>
	<td>'.$reg_ee["marca"].'</td>
	<td>'.$reg_ee["modelo"].'</td>
	<td>'.$reg_ee["serie"].'</td>
	<td>'.$reg_ee["IUequipo"].'</td>
	<td>'.$reg_ee["estado"].'</td>
	<td>'.$reg_ee["especificaciones"].'</td>
    <td>'.$reg_ee["observaciones"].'</td>
  </tr>';
  
					}
  $texto_a_guardar.='
</table>';
	}
	else
	{
		$texto_a_guardar.='Ninguno';	
	}
	$texto_a_guardar.='
	
	<h4>3. CONFIGURACIONES</h4>
	  
	  <table border="1" rules="all">
	    <tr>
    <td align="center"><strong>CONECTIVIDAD </strong></td>
    <td align="center"><strong>ACCESO AL EQUIPO</strong></td>
    </tr>
  <tr>
    <td>
    <strong>';
	if($regdatos["ip"]=="" or $regdatos["ip"]==" ")
	{
		$texto_a_guardar.="Ninguna en esta entrega";
	}else
	{
		$texto_a_guardar.='
	Dirección IP:</strong> '.$regdatos["ip"].'
    </td>
    <td>';
	}
	if($regdatos["nom_usu_ad"]=="" or $regdatos["nom_usu_ad"]==" ")
	{
		$texto_a_guardar.="Ninguna en esta entrega";
	}
	else
	{
		$texto_a_guardar.='
    <strong>Usuario: </strong>'.$regdatos["nom_usu_ad"];
	}
	$texto_a_guardar.=' &nbsp;
    </td>
    </tr>
</table>
	<h4>4. SOFTWARE / APLICACIONES INSTALADAS</h4>
<ul>
	  ';
	  if($regdatos["software"]<>"")
	  {
	  $sowft=explode("<>",$regdatos["software"]);
	  $massw=mysql_query("select * from conf_sw",$conectar) or die("ERROR");
		while($regmasswf=mysql_fetch_array($massw))
		{ 
			
			if(in_array($regmasswf["id_sw"],$sowft))
			{
				
				$texto_a_guardar.="<li>".$regmasswf["nombre_sw"]."</li>";
			}
		}
	  }
	  else
	  {
		 $texto_a_guardar.="Ninguno"; 
	  }
  					/*$sowft=explode("<>",$regdatos["software"]);
					$contarn=count($sowft);					
					if(count($sowft)<1)
					{
						$texto_a_guardar.='Ninguno en esta entrega';
					}
					else
					{
					for($r=0;$r<count($sowft);$r++)
						{
						$numeracion=$numeracion+1;
						
						#si encuentra en el array imprime
							$texto_a_guardar.= $numeracion .'. '.$sowft[$r]."<br>";
						}
					}*/
					
					
$texto_a_guardar.='	</ul>
	<h4>5. OBSERVACIONES </h4>
	  <p align="justify">La Subdirección de Gestión Tecnológica realizará el monitoreo del equipo, en cumplimiento de las Normas y Políticas de Seguridad Informática por lo que queda terminantemente prohibido la instalación de software no autorizado.<br>
'.$regdatos["otros"];
 $texto_a_guardar.='
      </p>
	<h4>6. FIRMAS</h4>
    <br>
    <br>
    <br>
	<br>
	<br>
<br>
<table border="0" align="center">
  <tr>
    <td width="301" align="center">...................................</td>
    <td width="273" align="center">...................................</td>
  </tr>
  <tr>
    <td>';
    
	##usuario que genera el acta
$usua_ent_acta=$_SESSION['userid'];

$sql_usu_entreg=mysql_query("select * from gad_personal inner join gad_dependencia 
on gad_personal.id_dependencia=gad_dependencia.id_dependencia 
where gad_personal.id_personal='$usua_ent_acta'",$conectar) or die("ERROR_AL_CONSULTAR_PERSONAL_QUE_ENTREGA");
$reg_usu_entreg=mysql_fetch_array($sql_usu_entreg);

$texto_a_guardar.= $reg_usu_entreg["tratamiento"]." ".$reg_usu_entreg["nombres"]." ".$reg_usu_entreg["apellidos"]."<br>".$reg_usu_entreg["puesto"];
	$texto_a_guardar.='	
    <br>
    <strong>ENTREGA</strong>
    </td>
    <td>'.$regdatos["nomina"].'<br>'.$regdatos["puesto"].'<br>'.'<strong>CUSTODIO</strong></td>
  </tr>
</table>';

###GUARDA EL ACTA
$id_ent_equi_acta=$ideconsulta;
$nacta=$nactaa;
$texto_acta=$texto_a_guardar;
$plantilla="2";
$id_usua_entrega=$usua_ent_acta;
$id_area_usua_entrega=$reg_usu_entreg["id_dependencia"];


##guarda o actualiza
$sqlgacta=mysql_query("insert into m5sts_equipos_acta_entrega 
(id_ent_equi_acta,
nacta,
texto_acta,
plantilla,
id_usua_entrega,
id_area_usua_entrega) values (
'$id_ent_equi_acta',
'$nacta',
'$texto_acta',
'$plantilla',
'$id_usua_entrega',
'$id_area_usua_entrega')
ON DUPLICATE KEY UPDATE 
texto_acta='$texto_acta',
plantilla='$plantilla',
id_usua_entrega='$id_usua_entrega',
id_area_usua_entrega='$id_area_usua_entrega'
",$conectar) or die("ERROR");
#$nombre_archi="Acta-".$reg_acta_abrir["nacta"].".pdf";
echo "Guardado Satisfactoriamente";

?>