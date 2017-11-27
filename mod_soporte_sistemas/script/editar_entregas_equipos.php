<?php 
session_start();
include("../../conf.php");
$modo=$_REQUEST["modo"];
$fechaactual=date("Y-m-d");
$registrogeneral=$_REQUEST["regitro"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../../estilos/css.css" type="text/css" charset="utf-8"/>
<title>Documento sin título</title>
<style>

.selectes {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 40px;
   padding: 5px 5px 0px 0px;
   width: 250px;
   border:1px solid rgba(129,193,233,1.00);
   
}
.selectes option {
   background: transparent;
   font-size: 14px;
   height: 30px;
   cursor:pointer;
   vertical-align:middle;
}
.selectes option:hover
{
	background:rgba(207,129,31,0.68);
}
.selectes:focus{ outline: none;}

</style>
<script src="../../js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script language="JavaScript">
$(document).ready(function(){
	// Write on keyup event of keyword input element
	$("#comp_search").keyup(function(){
		// When value of the input is not blank
		if( $(this).val() != "")
		{
			// Show only matching TR, hide rest of them
			$("#my-table-comp_search tbody>tr").hide();
			$("#my-table-comp_search td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("#my-table-comp_search tbody>tr").show();
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

function guardar_actualizaciones(fomulario)
{
	
	 $("#procesando").fadeIn(1000);
	 $("#procesando").html('<img src="../../imag/loadingok.gif" width="35" height="38">');
	 var url = "atualizaciones_entregados.php"; // 
    $.ajax({
           type: "POST",
           url: url,
           data: $(fomulario).serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#procesando").html(data); // Mostrar la respuestas del script PHP.
           }
         });
    return false; // Evitar ejecutar el submit del formulario.
}
function activar_guardar(botonmostrar)
{
	
	$(botonmostrar).fadeIn(1000);
	
	
}

function Actualiza_entregacomponentes(numactivo)
{
	var str=numactivo;
	var nc = str.split('<]');
	
	document.getElementById(nc[7]).style.display='none';

	$('#actualizacomponentesadd').append('<tr><td><input type="hidden" name="id_equiposcomponentes_add[]" id="COMPOadd" value="'+'<?php echo $registrogeneral?>'+'|'+nc[0]+'|'+'<?php echo $fechaactual;?>'+'"></td><td>'+nc[1]+'</td><td>'+nc[2]+'</td><td>'+nc[3]+'</td><td>'+nc[4]+'</td><td>'+nc[5]+'</td><td>'+nc[6]+'</td></tr>');

}


 function Entrada_pestanias(objeto)
{
$("#agregardiv, #eliminardiv").css('display','none');
$(objeto).fadeIn(1);	
}

$(document).ready(function(){ // Script del menú con pestañas
    $('.contenido_pestanas_div').not(':first').hide();
    $('.pestanias ul li:first a').addClass('pestaniaselecta');
    $('.pestanias a').click(function(){
        $('.pestanias a').removeClass('pestaniaselecta');
        $(this).addClass('pestaniaselecta');
        $('#contenido_pestanas_div').fadeOut(350).filter(this.hash).fadeIn(350);
        return false;
        
    });
 });
</script>
</head>  

<body>
<?php 
#control para abrir el editor seleccioando
switch($modo)
{
	case "IP":
	$ipvalidar=$_REQUEST["ip_idp"]; #id_personal
	$ipvalidare=$_REQUEST["ip_val"];#id_direccion IP
	$regitro=$_REQUEST["regitro"]; #id de la tabla para hacer el update
	
	$query=mysql_query("select m5sts_entrega_equipos.id_ent_equi,m5sts_entrega_equipos.dir_ip,m5sts_ip.* from m5sts_ip
	left join m5sts_entrega_equipos on m5sts_ip.id_ip=m5sts_entrega_equipos.dir_ip
	where m5sts_ip.id_personal='$ipvalidar'",$conectar)or die("ERROR");
	
	
?>
<div style="margin:20px; text-align:center" align="center">
<h3 align="center">Modificación de IP</h3>
<form method="post" name="actuaip" id="actuaip">
<table width="525" border="1" align="center" rules="all">
  <tr>
    <td align="center">IP Actual</td>
    <td align="center">&nbsp;Cambiar por</td>
    <td>Opciones</td>
  </tr>
  <tr>
    <td ><?php echo $ipvalidare;?></td>
    <td>
    <div class="caja">
    
    <select name="ipcambio" id="ipcambio" class="selectes">
    	<?php 
		echo '<option value="">Ninguno</option>';     	
while($reg_ip= mysql_fetch_array($query))
	{
		if($reg_ip["estado_ip"]=="Inactivo" or $reg_ip["dir_ip"]==$reg_ip["id_ip"] ){$estadoip="Disabled";$inactivo="-[No disponible]";}else{$estadoip="";$inactivo="";}
		echo '<option '.$estadoip.' value="'.$reg_ip["id_ip"].'">'.$reg_ip["ip"].$inactivo.'</option>';
	}
		?>
    </select>
    <input type="hidden" value="IP" name="identificador" id="identificador">
    <input type="hidden" value="<?php echo $regitro;?>" name="id_ent_equi">
    
    </div>
    </td>
    <td><input type="button" class="boton color_btn_azul"  id="guardarip" name="botonaccion" value="Actualizar" onClick="guardar_actualizaciones('#actuaip')">
     </td>
  </tr>
</table>
</form>
</div>
<?php 
#cierra case ip e inicia el de Usuarios 
	break;
	
	case "US":
	$usvalidar=$_REQUEST["ip_idp"]; #id_personal
	$usvalidare=$_REQUEST["ip_val"];#id_direccion IP
	$regitro=$_REQUEST["regitro"];  #id de la tabla para hacer el update
	
$query=mysql_query("select m5sts_entrega_equipos.id_ent_equi,m5sts_entrega_equipos.us_ad,m5sts_us_ad.* from m5sts_us_ad
left join m5sts_entrega_equipos on m5sts_us_ad.id_us_ad=m5sts_entrega_equipos.us_ad
where m5sts_us_ad.id_personal='$usvalidar'",$conectar)or die("ERROR_AL VALIDAR USUARIOS");
?>
<!--USUARIOS ACTIVE DIRECTORY-->
<div style="margin:20px; text-align:center" align="center">
<h3 align="center">Modificación de Usuario de Active Directory</h3>
<form method="post" name="actuaus" id="actuaus">
<table width="525" border="1" align="center" rules="all">
  <tr>
    <td align="center">Usuario Actual</td>
    <td align="center">Cambiar por </td>
    <td>Opciones</td>
  </tr>
  <tr>
    <td ><?php 
	if($usvalidare=="")
	{
		echo "Sin Usuario";
	}
	else
	{
		echo $usvalidare;
	}
	?></td>
    
    <td>
    <div class="caja">
    
    <select name="uscambio" id="uscambio" class="selectes" >
    	<?php 
		echo '<option value="">Ninguno</option>';     	
while($reg_ip= mysql_fetch_array($query))
	{
		if($reg_ip["estado"]=="Inactivo" or $reg_ip["us_ad"]==$reg_ip["id_us_ad"] ){$estadoip="Disabled";$inactivo="-[No disponible]";}else{$estadoip="";$inactivo="";}
		echo '<option '.$estadoip.' value="'.$reg_ip["id_us_ad"].'">'.$reg_ip["nom_usu_ad"].$inactivo.'</option>';
	}
		?>
    </select>
    <input type="hidden" value="US" name="identificador" id="identificador">
    <input type="hidden" value="<?php echo $regitro;?>" name="id_ent_equi">
    
    </div>
    </td>
    <td><input type="button" class="boton color_btn_azul"  id="guardarus" value="Actualizar" onClick="guardar_actualizaciones('#actuaus')"> </td>
  </tr>
</table>
</form>
</div>
<?php 
	#cierra case Usuarios E INICIA SOFTWARE
	break;
	case "SWF":
	$regitro=$_REQUEST["regitro"];
	
	/*$usvalidar=$_REQUEST["ip_idp"]; #id_personal
	$usvalidare=$_REQUEST["ip_val"];#id_direccion IP
	  #id de la tabla para hacer el update
	*/
$query=mysql_query("select * from m5sts_entrega_equipos where id_ent_equi='$regitro'",$conectar)or die("ERROR_SW");
$regsw=mysql_fetch_array($query);
$regswarray=explode("<>",$regsw["software"]);
?>

<div style="margin:20px; text-align:center" align="center">
<h3 align="center">Modificación Software Agregado</h3>
<form method="post" name="actuasw" id="actuasw">
<input type="hidden" value="SWF" name="identificador" id="identificador">
    <input type="hidden" value="<?php echo $regitro;?>" name="id_ent_equi">
    
<div align="center" style="height:300px; width:420px; overflow:scroll; overflow-x: hidden;display:inline-block; padding:20px; text-align:justify; border:1px ridge rgba(97,107,114,1.00) ">


<?php 
		$massw=mysql_query("select * from conf_sw",$conectar) or die("ERROR");
		while($regmasswf=mysql_fetch_array($massw))
		{ 
			
			if(in_array($regmasswf["id_sw"],$regswarray))
			{
				$checked="checked";
			}
			else
			{
				$checked="";
			}
  ?>
<label style="cursor:pointer" class="etiquetas"><input type="checkbox" <?php echo $checked;?>  name="mysoftware[]"  value="<?php echo $regmasswf["id_sw"]?>"><?php echo $regmasswf["nombre_sw"]." ".$regmasswf["licencia_sw"]?></label>
    <br>
  <?php 
  }
  ?>

</div>
<br> 

<div align="center"><br>

    <a href="#" class="boton color_btn_azul" onClick="guardar_actualizaciones('#actuasw')" >Guardar</a><br>
<br>

 </div>

</form>
</div>
<?php 

	break;
 
	#cierra case software y empieza cmponentes
	case "COMPONENTES":
	$regitro=$_REQUEST["regitro"];
	
$query=mysql_query("select m5sts_e_e_componentes.id_ee_componetes, m5sts_equipos.*  from m5sts_e_e_componentes
inner join m5sts_equipos on m5sts_e_e_componentes.id_equipo=m5sts_equipos.id_equipo
where id_ent_equi='$regitro'",$conectar)or die("ERROR_SW");
?>
<div style="margin:20px; text-align:center" align="center">
<h3 align="center">Editar Componentes de la entrega</h3>
<div align="justify">
<ul class="pestanias">
	<li><a href="#" id="eliminara" onClick="Entrada_pestanias('#eliminardiv');" class="pestaniaselecta">Eliminar Componentes</a></li>
	<li><a href="#" id="agregara" onClick="Entrada_pestanias('#agregardiv');">Añadir</a></li>
</ul>
</div>
<div id="eliminardiv" class="contenido_pestanas_div">
<span style="text-align:center">Seleccione los componentes a Eliminar</span>
<form method="post" name="actuacompo" id="actuacompo">
<input type="hidden" value="COMPONENTES_eli" name="identificador" id="identificador">
    <input type="hidden" value="<?php echo $regitro;?>" name="id_ent_equi">
    
<div align="center" style="height:250px; width:95%; overflow:scroll; overflow-x: hidden;display:inline-block; text-align:justify; border:1px groove #ABABAB">

<div class="tablas_reportes">
<table border="0" id="actualizacomponentes">
  <tr>
    <td>&nbsp;</td>
    <td>CÓDIGO</td>
    <td>EQUIPO</td>
    <td>SERIE</td>
    <td>MARCA</td>
    <td>MODELO</td>
    <td>ESPECIFICACIONES</td>
  </tr>
  
  <?php 
  while($regcomponentes=mysql_fetch_array($query))
  {
	  
  ?>
  <tr>
  
    <td><input  type="checkbox" name="id_equiposcomponentes[]" id="COMPO" value="<?php echo $regcomponentes["id_equipo"];?>"></td>
    <td><?php echo $regcomponentes["codigoactivo"];?></td>
    <td><?php echo $regcomponentes["nombre"];?></td>
    <td><?php echo $regcomponentes["serie"];?></td>
    <td><?php echo $regcomponentes["marca"];?></td>
    <td><?php echo $regcomponentes["modelo"];?></td>
    <td><?php echo $regcomponentes["especificaciones"];?></td>
  </tr>
 
  <?php 
  }
  ?>
</table>
</div><br>
</div><br>

 <div align="center">
<br>

    <a href="#" class="boton color_btn_rojo" onClick="guardar_actualizaciones('#actuacompo')" >Eliminar Seleccionados</a>&nbsp;&nbsp;
<br>

 </div>
</form>
</div>
<div id="agregardiv" class="contenido_pestanas_div">
<span style="text-align:center">Añada los componentes necesarios</span>

<form method="post" name="addcompo" id="addcompo">
<input type="hidden" value="COMPONENTES_add" name="identificador" id="identificador">
    <input type="hidden" value="<?php echo $regitro;?>" name="id_ent_equi">
    
<div align="center" style="height:250px; width:95%; overflow:scroll; overflow-x: hidden;display:inline-block; text-align:justify; border:1px solid rgba(0,0,0,1.00)">

<div class="tablas_reportes">
<table border="0" id="actualizacomponentesadd">
  <tr>
    <td>&nbsp;</td>
    <td>CÓDIGO</td>
    <td>EQUIPO</td>
    <td>SERIE</td>
    <td>MARCA</td>
    <td>MODELO</td>
    <td>ESPECIFICACIONES</td>
  </tr>
  
  <?php 
  $registro=$_REQUEST["regitro"];
  $queryadd=mysql_query("select m5sts_e_e_componentes.id_ee_componetes, m5sts_equipos.*  from m5sts_e_e_componentes
inner join m5sts_equipos on m5sts_e_e_componentes.id_equipo=m5sts_equipos.id_equipo
where id_ent_equi='$regitro'",$conectar)or die("ERROR_SW");

  
  while($regcomponentesadd=mysql_fetch_array($queryadd))
  {
  ?>
  <tr>
  
    <td></td>
    <td><?php echo  $registro.$regcomponentesadd["codigoactivo"];?></td>
    <td><?php echo $regcomponentesadd["nombre"];?></td>
    <td><?php echo $regcomponentesadd["serie"];?></td>
    <td><?php echo $regcomponentesadd["marca"];?></td>
    <td><?php echo $regcomponentesadd["modelo"];?></td>
    <td><?php echo $regcomponentesadd["especificaciones"];?></td>
  </tr>
 
  <?php 
  }
  ?>
</table>
</div><br>
</div><br>

 <div align="center">
<br>

    <a href="#" class="boton color_btn_azul" onClick="guardar_actualizaciones('#addcompo')" >Guardar Cambios</a>&nbsp;&nbsp;<a href="#" class="boton color_btn_azul" onClick="$('#editarocomponente').fadeIn(1000);" >Añadir otro</a>
<br>
<br>

 </div>
</form>


</div>
<!--formurario agregrar equipos-->

    <div align="center" id="editarocomponente" style=" display:none; width: 100%; min-height: 100%;
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
<a href="#" onClick="$('#editarocomponente').fadeOut(1000);"><img  style="vertical-align:middle" src="../../imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
<input id="comp_search" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>
<div style="height:200px; overflow:scroll">
     <table id="my-table-comp_search" border="1" width="750" style="border-collapse:collapse">
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
            <td align="center" valign="middle"><a href="#" id="agregarequipos[<?php echo $num;?>]" class="boton_pequenio color_btn_azul" onClick="Actualiza_entregacomponentes('<?php echo $regequipose["id_equipo"]."<]".$regequipose["codigoactivo"]."<]".$regequipose["nombre"]."<]".$regequipose["serie"]."<]".$regequipose["marca"]."<]".$regequipose["modelo"]."<]".$regequipose["especificaciones"]."<]"."agregarequipos[".$num."]"?>')">&nbsp;Agregar&nbsp;</a></td>
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
</div>
 <?php 
  break;
  ?>

 

</div>
<?php 
#cierra el switch
}
?>
<div class="" align="center" id="procesando">&nbsp;</div>
</body>
</html>