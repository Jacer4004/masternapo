<?php 
session_start();
include("../../conf.php");
$identificador=$_REQUEST["identificador"];
$id_ent_equi=$_REQUEST["id_ent_equi"];
$botonaccion=$_REQUEST["botonaccion"];

switch($identificador)
{
	case"IP":
		
		$recibeip=$_REQUEST["ipcambio"];
		
		if($id_ent_equi<>"")
		{
			$update=mysql_query("update m5sts_entrega_equipos set dir_ip='$recibeip' where id_ent_equi='$id_ent_equi'",$conectar) or die("Error_update");
		
		$mensajefinal= array('Se ha guardado los cambios correctamente','confirmacion_guardado');
		}
		else
		{
		$mensajefinal=array('No se hicieron cambios, no cumplen las condiciones','confirmacion_guardado_error');
		}
			
	break;
	
	case"US":
	$recibeus=$_REQUEST["uscambio"];
	
	
	if($id_ent_equi<>"")
		{
			$update=mysql_query("update m5sts_entrega_equipos set us_ad='$recibeus' where id_ent_equi='$id_ent_equi'",$conectar) or die("Error_update");
		
			$mensajefinal= array('Se ha guardado los cambios correctamente','confirmacion_guardado');
		}
		else
		{
			$mensajefinal=array('No se hicieron cambios, no cumplen las condiciones','confirmacion_guardado_error');
		}
	
	break;
	#para actualizar el sw
	case "SWF":

		$mysoftwareok=implode("<>",$_REQUEST["mysoftware"]);
		
			
	if($id_ent_equi<>"")
		{
			$update=mysql_query("update m5sts_entrega_equipos set software='$mysoftwareok' where id_ent_equi='$id_ent_equi'",$conectar) or die("Error_update");
		
			$mensajefinal= array('Se ha guardado los cambios correctamente','confirmacion_guardado');
		}
		else
		{
			$mensajefinal=array('No se hicieron cambios, no cumplen las condiciones','confirmacion_guardado_error');
		}
			
	break;
	
	case "COMPONENTES_eli":
	
	$mycomponentes=$_REQUEST["id_equiposcomponentes"];
	
	$totalcom=count($mycomponentes);
		
	if($id_ent_equi<>"")
		{
			
			for ($rc=0;$rc<$totalcom;$rc++)
			{
				$valoraeliminar=$mycomponentes[$rc];
				mysql_query("delete from m5sts_e_e_componentes where id_equipo='$valoraeliminar'",$conectar) or die("Error_update");
			}
			$mensajefinal= array('Se ha guardado los cambios correctamente','confirmacion_guardado');
		}
		else
		{
			$mensajefinal=array('No se hicieron cambios, no cumplen las condiciones','confirmacion_guardado_error');
		}
	
	
	break;
	case "COMPONENTES_add":
	$mycomponentes=$_REQUEST["id_equiposcomponentes_add"];
	$totalcom=count($mycomponentes);
	
			
	if($id_ent_equi<>"")
		{
			
			for ($rc=0;$rc<$totalcom;$rc++)
			{
				$valorescomponetes=explode("|",$mycomponentes[$rc]);
				$arrayidee=$valorescomponetes[0];
				$arrayidcomponentes=$valorescomponetes[1];
				$arrayecha=$valorescomponetes[2];
				
				$sqlcomponentes=mysql_query("
				insert into m5sts_e_e_componentes (
				id_ee_componetes,
				id_ent_equi,
				id_equipo,
				fecha_entrega
				)values
				(
				'null',
				'$arrayidee',
				'$arrayidcomponentes',
				'$arrayecha'
				)
				",$conectar);
			}
			$mensajefinal= array('Se ha guardado los cambios correctamente','confirmacion_guardado');
		}
		else
		{
			$mensajefinal=array('No se hicieron cambios, no cumplen las condiciones','confirmacion_guardado_error');
		}
	
	break;
	default:
	$mensajefinal=array('No se realizaron cambios','confirmacion_gadvertencia');
	
}

echo '<div class="'.$mensajefinal[1].'" align="center">'.$mensajefinal[0].'</div>';
?>
