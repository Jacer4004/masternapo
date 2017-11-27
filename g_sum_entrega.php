<?php 
session_start();
include_once("conf.php");
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

##usuario que genera el acta
$usua_ent_acta=$_SESSION['userid'];

$sql_usu_entreg=mysql_query("select * from gad_personal inner join gad_dependencia 
on gad_personal.id_dependencia=gad_dependencia.id_dependencia 
where gad_personal.id_personal='$usua_ent_acta'",$conectar) or die("ERROR_AL_CONSULTAR_PERSONAL_QUE_ENTREGA");
$reg_usu_entreg=mysql_fetch_array($sql_usu_entreg);
$area_usua_ent_acta=$reg_usu_entreg["id_dependencia"];
$genero_usua_entrega=$reg_usu_entreg["genero"];
if($genero_usua_entrega=="Masculino"){$genero_usua_entrega=" el ";}else{$genero_usua_entrega=" la ";}
#numeracion de actas
/*$sqlactas=mysql_query("select * from inv_sum_actas",$conectar) or die("ERROR_");
$numeroacta=mysql_num_rows($sqlactas)+1;
$numeroacta=$numeroacta+1;
$numeroacta= sprintf("%05d", $numeroacta);*/

$nactaasql=mysql_query("select * from inv_sum_actas order by id_sum_acta desc limit 1") or die("ERROR_");
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
$numeracionacta="SGT-".date("Y")."-".sprintf("%05d", $nactaa);

#$numeracionacta="SGT-".date ("Y")."-".$numeroacta;

$id_sum_entregados="";
$g_cantidad=$_POST["g_cantidad"];
$g_id_suminsitro=$_POST["g_id_suminsitro"];
$g_area=$_POST["g_area"];
$g_id_responsable=$_POST["g_id_responsable"];
$g_fecha=$_POST["g_fecha"];
$g_observacioes=$_POST["g_observacioes"];
$estado="Entregado";
$g_funcionario=$_POST["g_nombre_responsable"];
$g_nom_area=$_POST["g_nom_area"];
$g_nom_suminsitro=$_POST["g_nombre_suministro"];
$fecha_entrega_sum=$_POST["fecha_entrega_sum"];
$fecha_entrega_sum_l=$fecha_entrega_sum[0];
//$g_cod_sum=$_POST[""];


##dtos de funcionario
$idfuncionario_OK=$g_id_responsable[0];
$datos_funcionario=mysql_query("select gad_personal.* from gad_personal 
where gad_personal.id_personal='$idfuncionario_OK'",$conectar)or die("ERROR_AL BUSCAR_DATOS_DEL_SUMINISTRO");
$reg_dat_funcionario=mysql_fetch_array($datos_funcionario);
$genero=$reg_dat_funcionario["genero"];
if($genero=="Masculino"){$genero=" el ";}else{$genero=" la ";}

#encuentra un id de transaccion
$sql_trans=mysql_query("select * from inv_sum_entregados group by n_transaccion",$conectar)or die("Error");
$n_transaccion=mysql_num_rows($sql_trans)+1;
$n_transaccion=sprintf("%05d", $n_transaccion);

##JEFE DE ÁREA QUE AUTORIZA LA ENTREGA
$jefe="Ing. Fausto Claudio";
$cargo_jefe="<strong>SUBDIRECTOR DE GESTIÓN TECNOLÓGICA</strong>";
$tbl_suministros="";
for($t=0;$t<count($g_id_suminsitro);$t++)
{
$id_sum_entregadosin="";
$g_cantidadin=$g_cantidad[$t];
$g_id_suminsitroin=$g_id_suminsitro[$t];
$nom_sum=$g_nom_suminsitro[$t];
$g_areain=$g_area[$t];
$g_id_responsablein=$g_id_responsable[$t];
$g_fechain=$g_fecha[$t];
$g_observacionesin=$g_observacioes[$t];
//$codigo_sum=$g_cod_sum[$t];

##datos del suministro
$datos_suministro=mysql_query("select * from inv_suministros 
where id_invsuministros='$g_id_suminsitroin'",$conectar)or die("ERROR_AL BUSCAR_DATOS_DEL_SUMINISTRO");
$reg_dat_suministro=mysql_fetch_array($datos_suministro);

$sql=mysql_query("insert into inv_sum_entregados(
id_sum_entregados,
id_suministro,
id_dependencia,
id_personal,
cantidad,
fecha,
observaciones,
n_transaccion,estado,
id_usua_entrega,id_area_usua_entrega) 
values ('$id_sum_entregadosin',
'$g_id_suminsitroin',
 '$g_areain',  '$g_id_responsablein', 
 '$g_cantidadin', '$g_fechain', '$g_observacionesin',
 '$n_transaccion','$estado',
 '$usua_ent_acta','$area_usua_ent_acta') 
ON DUPLICATE KEY UPDATE 
id_suministro='$g_id_suminsitroin',
id_dependencia='$g_areain',
id_personal='$g_id_responsablein',
cantidad='$g_cantidadin',
fecha='$g_fechain',
observaciones='$g_observacionesin',
id_usua_entrega='$usua_ent_acta',
id_area_usua_entrega='$area_usua_ent_acta'",$conectar) or die ("ERROR_");

#disminuye el stock 
$sql_stock=mysql_query("select * from  inv_suministros where 	id_invsuministros='$g_id_suminsitroin'",$conectar)or die("Error");
$reg_stock=mysql_fetch_array($sql_stock);
$stockok=$reg_stock["stock"]-$g_cantidadin;
$sql_up_stock=mysql_query("update inv_suministros set stock='$stockok' where id_invsuministros='$g_id_suminsitroin'",$conectar)or die("ERROR");


#construye la tabla de suministros
$tbl_suministros.='<tr valign="top">
        <td align="center" valign="middle">'.$reg_dat_suministro["cod_bodega"].'</td>
        <td align="center" valign="middle">'.$g_cantidadin.'</td>
        <td  align="left" valign="middle" >'.$nom_sum.'</td>
        <td valign="middle" align="justify">'.$g_observacionesin.'&nbsp;</td>
      </tr>';

}
###
$acta_texto='
 

    <span style="font-size: 16px; font-weight: bold;text-align:center">ACTA  DE ENTREGA – RECEPCIÓN <br>';

$acta_texto.=$numeracionacta; #agreega numero de acta
$acta_texto.='</span>

 
	<p style="text-align:justify;display: inline-block; width: 100%;line-height:24px;" >En la ciudad de Tena provincia de Napo, hoy ';
$acta_texto.=strftime("%A, %d de %B del %Y",strtotime($fecha_entrega_sum_l));#agrega fecha actual
$acta_texto.=', comparece por una parte quien entrega ';
$acta_texto.=$genero_usua_entrega." ".$reg_usu_entreg["tratamiento"]." ".$reg_usu_entreg["nombres"]." ".$reg_usu_entreg["apellidos"];
$acta_texto.=' - <strong>'.$reg_usu_entreg["puesto"].' </strong> de la <strong>';
$acta_texto.=$reg_usu_entreg["nombre"].', </strong>'; #agregar el usuario que entrega
$acta_texto.=' y por otra parte quien recibe ';
$acta_texto.= $genero.$g_funcionario[0];##funcionario
$acta_texto.=' - <strong>'.$reg_dat_funcionario["puesto"].'</strong> de la <strong> '.$g_nom_area[0].'</strong>,';
$acta_texto.=' para proceder a firmar el acta de entrega recepción de lo siguiente:</p>';
$acta_texto.='<div align="center" style=" font-size:13px;text-align:center;"><table width="520" border="1" align="center" rules="all">
     <tr>
        <td width="60" height="11" valign="bottom" align="center"><strong>CÓDIGO</strong></td>
        <td width="50" valign="bottom" align="center"><strong>CANT.</strong></td>
        <td width="210" valign="bottom" align="center"><strong>DETALLE</strong></td>
        <td width="200" valign="top" align="center"><strong>OBSERVACIÓN</strong></td>
      </tr>';
$acta_texto.=$tbl_suministros; #agrega todas las filas con los sumonistros de la tabla
$acta_texto.='</table></div>

<p align="justify">Para  constancia de lo indicado las partes firman.</p><br>
<br>

<div align="center">
Autorizado por
   <br>
<br>
<br>
<br>.......................................<br>';
$acta_texto.=$jefe.' <br>'.$cargo_jefe;
$acta_texto.='
</div><br>
<br>
<br>
<table width="500"   cellpadding="0" cellspacing="0" align="center">
  <tr>
 
    <td width="250" align="center">
    Entregue conforme
   <br>
<br>
<br>
<br>
<br>.......................................<br>';
$acta_texto.=$reg_usu_entreg["tratamiento"]." ".$reg_usu_entreg["nombres"]." ".$reg_usu_entreg["apellidos"];
$acta_texto.='<br><strong style="text-transform:uppercase">'.$reg_usu_entreg["puesto"].'</strong>';##nombre del usuario que entrega
$acta_texto.='
    </td>
	<td align="center" width="250">
    Recibí Conforme
   <br>
<br>
<br>
<br>
<br>.......................................<br>'; 
$acta_texto.=$reg_dat_funcionario["tratamiento"].' '.$reg_dat_funcionario["nombres"].' '.$reg_dat_funcionario["apellidos"].' <br>';
$acta_texto.='<strong style="text-transform:uppercase">'.$reg_dat_funcionario["puesto"].'</strong>';
$acta_texto.='</td> </tr> </table>
';

		
$obseracta="Ninguna";
$sql_g_actas=mysql_query("insert into  inv_sum_actas (
id_sum_acta,
nacta,
n_transaccion,
texto_acta,
observaciones,
id_usua_entrega,
id_area_usua_entrega)values
('null',
'$numeracionacta',
'$n_transaccion',
'$acta_texto',
'$obseracta',
'$usua_ent_acta',
'$area_usua_ent_acta')",$conectar)or die("ERROR_AL_GUARDAR_ACTAS");

echo "SE HA GUARDADO CORRECTAMENTE";

echo "<script type='text/javascript'>
			js_general_guardados('pag_suministros_resumen','','$tiempo_cookie');
						function redireccionar(){
		 window.location='inicio.php';
		} 
		setTimeout ('redireccionar()', 1000); //tiempo expresado en milisegundos
						
		</script>";
 //
?>


