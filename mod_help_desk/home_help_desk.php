
<?php 
$sqlinsidente=mysql_query("select * from gad_tipoinsidencia order by tiponombre",$conectar) or die ("ERROR_");

#RECUPRA LAS INCIDENCIAS PENDIENTES, NO ASIGNADAS 
$sqlpendientes=mysql_query("
select concat_ws(']-[',gad_incidencias.id_incidencia,
gad_incidencias.tipoinsidencia,
gad_incidencias.fech_h_peticion,
gad_incidencias.requiriente,
gad_incidencias.problema,
gad_incidencias.solucion,
gad_incidencias.atendio,
gad_incidencias.fech_h_iniatencion,
gad_incidencias.fecha_h_finatencion,
gad_incidencias.ips_incidencias,
gad_incidencias.estado,
gad_incidencias.insotros,
gad_incidencias.prioridad,
gad_incidencias.num_insidencia)as todos ,gad_incidencias.*,concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres, gad_personal.apellidos)as personal, (select concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres, gad_personal.apellidos)as personalcreo from gad_personal where gad_personal.id_personal=gad_incidencias.id_usuario_crea)as persoalcrea from gad_incidencias 
left join gad_personal on gad_incidencias.id_usuario=gad_personal.id_personal
where estado='PENDIENTE' or estado='EN ATENCIÓN' order by id_incidencia desc",$conectar)or die("error");
?><head>
<link rel="stylesheet" href="../estilos/css.css" type="text/css" charset="utf-8"/>
<script>
function limpiarform()
{
	document.getElementById('fomulariook').reset();
	document.getElementById('adjutnar_archivos').style.display='none';
	document.getElementById('adjutnar_archivossma').style.display='none';
	
$('#tipoinsidente').removeAttr('disabled');
$("#atencion").removeAttr('checked');
$('#requiriente').removeAttr('disabled');
$('#previoimg').html("Guarde la Incidencia, luego podrá adjuntar capturas de pantalla");

}
// function para cargar datos a editar 
function cargar_datos_ins(idcontrolador)
{
	
	
	
	var datall=document.getElementById(idcontrolador).value;
	var arraydetall=datall.split("]-[");
	//alert (datall);
	
	
	
	$('#id_incidenciai').val(arraydetall[0]);
	$('#tipoinsidente').val(arraydetall[1]);
	$('#tipoinsidente').attr('disabled', 'disabled');
	$('#fech_h_peticion').val(arraydetall[2]);
	$('#requiriente').val(arraydetall[3]);
	$('#problema').val(arraydetall[4]);
	$('#solucion').val(arraydetall[5]);
	$('#tomasolicitud').val(arraydetall[6]);
	//$("#pendiente").prop("checked", true);
	$('#otros').val(arraydetall[11]);
	$('#prioridad').val(arraydetall[12]);
	$('#idinsidencia').val(arraydetall[0]);
	$('#numincidencia').val(arraydetall[13]);
	//gad_incidencias.prioridad
	
	var elestado=arraydetall[10];
	
	;
	//$('#estado > option[value="'+elestado+'"]').prop("checked", true);
	$("#atencion").attr('checked', 'checked');
	
	 //alert(elestado);
	 //$('#estado > option[value="EN ATENCIÓN"]').attr('selected', 'selected');
	
	 document.getElementById('adjutnar_archivos').style.display='inline';
	 document.getElementById('adjutnar_archivossma').style.display='inline';
	cerrar_abrir('contenedor','nuevo');
	$('#anulartomado').fadeOut(10);	
	$('#bscusuario').fadeOut(10);
	$('#requiriente').attr('disabled', 'disabled');
	
}
</script>
<script>
//constructor para recuperar la ip del que registra la insidencia para auditoria futuras

// NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

if (RTCPeerConnection) (function () {
	
    var rtc = new RTCPeerConnection({iceServers:[]});
    if (1 || window.mozRTCPeerConnection) {      // FF [and now Chrome!] needs a channel/stream to proceed
        rtc.createDataChannel('', {reliable:false});
    };
    
    rtc.onicecandidate = function (evt) {
        // convert the candidate to SDP so we can run it through our general parser
        // see https://twitter.com/lancestout/status/525796175425720320 for details
        if (evt.candidate) grepSDP("a="+evt.candidate.candidate);
    };
    rtc.createOffer(function (offerDesc) {
        grepSDP(offerDesc.sdp);
        rtc.setLocalDescription(offerDesc);
    }, function (e) { console.warn("offer failed", e); });
    
   
    var addrs = Object.create(null);
    addrs["0.0.0.0"] = false;
	
    function updateDisplay(newAddr) {
		
        if (newAddr in addrs) return;
        else addrs[newAddr] = true;
		//alert(newAddr+"<<==es esta");
        var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; });
        document.getElementById('ips_incidencias').value = displayAddrs.join(";") || "n/a";
		//alert(displayAddrs.join(";") || "n/a");
    }
    
    function grepSDP(sdp) {
        var hosts = [];
        sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
            if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
                var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
                    addr = parts[4],
                    type = parts[7];
                if (type === 'host') updateDisplay(addr);
            } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
                var parts = line.split(' '),
                    addr = parts[2];
                updateDisplay(addr);
            }
        });
    }
})(); else {
    document.getElementById('list').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
    document.getElementById('list').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically, by the power of WebRTCskull.";
}

//funcion para validar estado
function validar_estado()
{
	if($('#tomasolicitud').val()=='')
	{
		$("#pendiente").prop("checked", true);	
		
	}
	if($('#tomasolicitud').val()!='')
	{
		$("#atencion").prop("checked", true);
		$('#anulartomado').fadeIn(10);	
	}	
}
function validar_estado_finalizado()
{
	if($('#tomasolicitud').val()=='')
	{
		$("#pendiente").prop("checked", true);	
	}	
}

</script>
<style>
.insidencias
{
	list-style:none;
	font-size:14px;
	margin:0px; padding:0px;
	padding:10px;
	
}
.insidencias>li
{
	margin:5px; padding:0px;
	border:1px solid #009999; border-bottom:1px; border-top:1px;
	border-color:#008989; border-style:solid;
	border-radius:4px;
	background:rgba(255,255,255,1.00);
	margin-left:5px; margin-right:5px;
	min-height:80px;
	margin-bottom:28px;
	
	
}
.insidencias .titulosinsi
{
	color:rgba(255,255,255,1.00);
	border-bottom:1px solid #009999;
	background:#009999;
	font-size:12px;
	border-top-left-radius:4px;
	border-top-right-radius:4px;
	padding:5px;
	
	
}


.prioridadalta
{
	padding:2px;
	padding-left:3px; padding-right:3px;
	animation-name: parpadeo;
    animation-duration: 2s;
	animation-iteration-count: infinite;	
}


@keyframes parpadeo {  
  0% {background:#FFFFFF; color:#000000 }
   50% { background:#EC080C; color:#FFFFFF; }
  100% { background:#FFFFFF; color:#000000; }
}

.contenidoshelpdesk
{
	padding:12px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size:12px;

}

</style>
</head>
<!--para las consultas-->
<div class="ventanas" id="consultains" style="width:98%; display:none">
<h3 id="color_darker" align="center">
<a href="javascript:void()" class="botonesaccion tooltipjrojas" onClick="javascript:cerrar_abrir('consultains','contenedor');"><img src="imag/atras_vt.png"></a>&nbsp;&nbsp;&nbsp;
Consultas de Incidencia</h3>

	<?php include("reportes_general.php"); ?>
</div>
<!--nueva insidencia-->
<?php # if (in_array("M5SUA_NUEVO", $accesos)) {?>
<div class="ventanas" id="nuevo" style="width:780px; display:none">
<h3 id="color_darker" align="center">Solicitud de Incidencia</h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" method="post" onSubmit="javascript:js_general('mod_help_desk/g_solicitud','color_cyan','<?php echo $tiempo_cookie;?>')">
       	 
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="218" align="right">Fecha Petición: </td>
    <td width="378"><input type="text" name="fech_h_peticion" id="fech_h_peticion"  required value="<?php echo  date ("Y-m-d H:i:s");?>" readonly>
    <input type="hidden" name="id_incidencia" id="id_incidenciai" value="">
    <input type="hidden" name="ips_incidencias" id="ips_incidencias" value="">
    
      </td>
  </tr>
  <tr>
    <td align="right">Categoría:</td>
    <td><select name="tipoinsidente" id="tipoinsidente" style="width:270px" required>
    <option value="">.:Seleccione:.</option>
    <?php 
	while($regtipoi=mysql_fetch_array($sqlinsidente))
	{
	?>
      <option value="<?php echo $regtipoi["tiponombre"]; ?>"><?php echo $regtipoi["tiponombre"]; ?></option>
<?php 
	}
?>
    </select>
    <select name="prioridad" id="prioridad" required>
    <option value="Normal" style="background:rgba(59,160,29,1.00)">Normal</option>
    <option value="Alta" style="background:rgba(255,7,11,1.00)">Prioridad: Alta</option>
    <option value="Media" style="background:rgba(255,227,45,1.00)">Prioridad: Media</option>
    <option value="Baja" style="background:rgba(219,219,219,1.00)">Prioridad: Baja</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right">Requiriente:</td>
    <td><input type="text" size="40" name="requiriente" id="requiriente" required value=""  onBlur="javascript:Validar_usuario(usuario.value);" ><a href="javascript:void()" onClick="$('#fun_heldesk').fadeIn(1000)" title="Funcionario del Gad"><img id="bscusuario" src="imag/usualogin.png" style="vertical-align:middle"></a></td>
  </tr>
  <tr>
    <td align="right" valign="top">Incidencia:</td>
    <td><textarea name="problema" id="problema" cols="45" rows="3" required></textarea></td>
  </tr>
  <tr>
    <td height="61" align="right" valign="top">Solución:</td>
    <td valign="top"><textarea name="solucion" id="solucion" cols="45" rows="3"></textarea>
    </td>
  </tr>
  <tr>
    <td align="right">Usuario/Soporte:</td>
    <td>
      <input type="button" id="atendersolicitud" class="boton color_btn_azul" value="Tomar Solicitud" style=" padding:3px !important" onClick="$('#anulartomado').fadeIn(10);$('#tomasolicitud').val('<?php echo $nombres_us;?>');  validar_estado()">
      <img src="imag/eliminar2.png" id="anulartomado" onClick="$('#anulartomado').fadeOut(10); $('#tomasolicitud').val('');validar_estado()" style="vertical-align:middle; display:none; cursor:pointer" title="Anuar Selección"><input type="text" size="38" name="tomasolicitud" id="tomasolicitud" value=""   readonly></td>
  </tr>
  <tr>
    <td align="right" valign="top">Estado:</td>
    <td style="font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif; font-size:14px">
      
        <label><input name="estado" type="radio" id="pendiente" onClick="validar_estado()"  value="PENDIENTE" checked="checked">PENDIENTE</label>&nbsp;&nbsp;<br>

        <label><input type="radio" name="estado" id="atencion" value="EN ATENCIÓN" onClick="validar_estado()">EN ATENCIÓN</label>&nbsp;&nbsp;
        <br>
<label><input type="radio" name="estado" id="finalizado" value="FINALIZADO" onClick="validar_estado_finalizado()">FINALIZADO</label>
        <br>
<label><input type="radio" name="estado" id="finalizado" value="CONSECUENTE" onClick="validar_estado_finalizado()">CONSECUENTE</label>
      </td>
  </tr>
   <tr>
     <td align="right" valign="top">Otros datos:</td>
     <td><textarea name="otros" id="otros" cols="45" rows="3"></textarea></td>
   </tr>
   <tr>
     <td align="right" valign="top">Capturas:</td>
     <td>
       <input type="button" name="adjutnar_archivos" id="adjutnar_archivos" onClick="$('#subirima').fadeIn(800);" value="Adjuntar" class="boton_pequenio color_btn_azul" style="display:none"><br>

       <div style="color:#F14300; font-size:12px; display:none" id="adjutnar_archivossma">Las imágenes que se muestran aquí quedaran guardadas en la base de datos, aunque haga clic en cancelar.</div>
       <div style="padding:4px" id="previoimg">
       
       </div>
       
       
       </td>
   </tr>
   
   <!--<tr>
     <td align="right" valign="top">Archivos Adjuntos:</td>
     <td>
        <div style="padding:4px" id="archivos">
       
       </div>
       
       </td>
   </tr>-->
   
   
</table>
<br>
<div align="center" style="text-align:center">

<input type="submit" id="btnguardar" class="boton color_btn_azul" value="Guardar"> 


&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
<!--&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >-->
</div>

  </form>
</div>

<?php # }#cierrar seguridad para validar accesos?>

<div class="ventanas" id="contenedor" style="width:98% !important; margin-left:0px; padding-left:0px;" >


<h3 id="color_dark" align="">
<a href="inicio.php" class="botonesaccion tooltipjrojas" onClick="javascript:js_general('mod_soporte_sistemas','');" ><span>Regresar Atras</span><img src="imag/atras_vt.png"></a>

<?php #if (in_array("M5SUA_NUEVO", $accesos)) {?>
<a href="#" class="botonesaccion tooltipjrojas" onClick="javascript:limpiarform();cerrar_abrir('contenedor','nuevo');$('#anulartomado').fadeOut(10); validar_estado()"><span>Nueva Incidencia</span><img style="" src="imag/new_vt.png"></a>
<?php #}?>
<?php #if (in_array("M5SEC_REPORTES26", $accesos)) {?>
    <a href="#" class="botonesaccion tooltipjrojas"  onClick="javascript:cerrar_abrir('contenedor','consultains')" ><span>Reporte de Incidencias</span><img style="vertical-align:middle;" src="imag/reporte_vt.png"></a><?php #}?>
&nbsp;&nbsp;&nbsp;Bitacora de Incidencias</h3>


<div align="center" style="text-align:center">
<!--<div align="left" class="menu_exploracion">

<a href="inicio.php" onClick="javascript:js_general('mod_soporte_sistemas','');"><img  style="vertical-align:middle" src="imag/atras.png" ></a>
<?php #if (in_array("M5SUA_NUEVO", $accesos)) {?>
<a href="javascript:void();" title="Registro de Insidencia" onClick="javascript:limpiarform();cerrar_abrir('contenedor','nuevo');$('#anulartomado').fadeOut(10); validar_estado()"><img  style="vertical-align:middle" src="imag/newhelpdesk.png" ></a>
<?php #}?>

    
    <input id="buscadorinsi" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>-->
<div ><br>
<div style=" padding:8px" >
<?php 
#etdisticas cuantos pendientes, enproces y finalzados
$queryestadistica=mysql_query("select (select count(gad_incidencias.estado) from gad_incidencias) as todos,(select count(gad_incidencias.estado) from gad_incidencias where gad_incidencias.estado='PENDIENTE') as pendientes,(
select count(gad_incidencias.estado)  from gad_incidencias where gad_incidencias.estado='EN ATENCIÓN') as enatencion,(
select count(gad_incidencias.estado)  from gad_incidencias where gad_incidencias.estado='FINALIZADO') as finalizado,(
select count(gad_incidencias.estado)  from gad_incidencias where gad_incidencias.estado='FINALIZADO' AND DATE(gad_incidencias.fecha_h_finatencion)=DATE(NOW())) as finalizadohoy;",$conectar)or die("ERROR");
$regestadistica=mysql_fetch_array($queryestadistica);
?>
<span  class="cuadroestadistica" style="background:#DB4A38; border-color:#A52C1D" ><strong>PENDIENTES</strong> <span><?php echo $regestadistica["pendientes"]?></span></span>&nbsp;<span  class="cuadroestadistica" ><strong>EN ATENCIÓN</strong> <span><?php echo $regestadistica["enatencion"]?></span></span>&nbsp;<span  class="cuadroestadistica" style="background:#029224; border-color:#01751C"><strong> HOY</strong> <span><?php echo $regestadistica["finalizadohoy"]?></span></span>&nbsp;<span  class="cuadroestadistica" style="background:#029224; border-color:#01751C"><strong>TOTAL ATENDIDOS</strong> <span><?php echo $regestadistica["finalizado"]." / ".$regestadistica["todos"]?></span></span>
</div>
<br>


<div>
	<ul class="insidencias">
    <?php 
  while($reginsidentesp=mysql_fetch_array($sqlpendientes))
  {
	  $contarin=$contarin+1;
  ?>
    
    	<li>
        	
            <div class="titulosinsi " style="cursor:pointer; " title="Creado Por: <?php echo $reginsidentesp["persoalcrea"];?>"><span > N°- <strong><?php echo $reginsidentesp["num_insidencia"];?></strong><strong > &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</strong> </span><span style="text-transform:uppercase"><?php echo $reginsidentesp["tipoinsidencia"];?>.</span><span > &nbsp;&nbsp;« hace 
        	  <?php 
		$imprimetiempo="";
	$fecha1 = new DateTime($reginsidentesp["fech_h_peticion"]);
	$fecha2 = new DateTime(date());
	$fecha = $fecha1->diff($fecha2);
	#printf('%d años, %d meses, %d días, %d horas, %d minutos, %d segundos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i, $fecha->s);
	// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos
	#if($fecha->y>0){echo "Si hay";}else{echo "no hay año<br>";}
	if($fecha->y>0){$imprimetiempo= $fecha->y." Años ";}
	if($fecha->m>0){$imprimetiempo.= $fecha->m." Meses ";}
	if($fecha->d>0){$imprimetiempo.= $fecha->d." Días ";}
	if($fecha->h>0){$imprimetiempo.= $fecha->h." Horas ";}
	if($fecha->i>0){$imprimetiempo.= $fecha->i." Minutos ";}
	if($fecha->s>0 and $fecha->i<0){$imprimetiempo.= " Menos de un minuto";}
	
	echo $imprimetiempo;
	 ?>  »</span><span class=" <?php if($reginsidentesp["prioridad"]=="Alta"){ echo "prioridadalta";}?>" style=" margin-left:5px; text-transform:uppercase; border-radius:3px">
     <strong >Prioridad:</strong> <?=$reginsidentesp["prioridad"]?></span>
            <div style="float:right; "><div align="center">
    <?php 
	if($reginsidentesp["id_usuario"]==$_SESSION['userid'] or$reginsidentesp["id_usuario"]=='0')
						{
	?>
    <ul class="nav" >
    <li> <span class="boton_pequenio  
	<?php 
	if($reginsidentesp["estado"]=="PENDIENTE"){echo  "color_btn_rojo";}else {echo  "color_btn_verde";} ?> " style=" display:inline-block; min-width:100px; text-align:center; padding-left:3px; padding-right:3px; font-size:12px !important"><?php echo $reginsidentesp["estado"];?>&nbsp;&nbsp;▼</span>
    
					<ul>
                    	<?php 
						
						?>
						<li><a href="javascript:void()" onClick="limpiarform();verimg('<?php echo $reginsidentesp["capturas"];?>');cargar_datos_ins('alldata[<?php echo $contarin;?>]');validar_estado(); " ><span><img src="imag/editstring.png" style="cursor:pointer; vertical-align:middle;" >&nbsp;&nbsp;Editar</span></a></li>
                            
                        <li><a href="javascript:void()" onClick="alert('No se puede Eliminar, contacte al Administrador del sistema')"><span><img src="imag/eliminar2.png" style="cursor:pointer; " >&nbsp;&nbsp;Eliminar</span></a></li>
                      </ul>
                                            
     </li>
     </ul>
      <?php 
						}
						else
						{
						?>
                        <strong>En Asistencia por:</strong>
<?php echo $reginsidentesp["personal"];?>
						<?php 
						}
						?>
      <input type="hidden" name="alldata[<?php echo $contarin;?>]" id="alldata[<?php echo $contarin;?>]" value="<?php echo $reginsidentesp["todos"];?>">
      </div></div> 
            </div>
            <!--contenidos-->
            <div class="contenidoshelpdesk" title="Creado Por: <?php echo $reginsidentesp["persoalcrea"];?>">
            	<strong style=" color:#A52C1D; text-transform:uppercase"> 
           	  <?php 
	$resultadoin=explode(";", $reginsidentesp["requiriente"]);
	
	#$resultadoin = str_replace(";", "<br>", $reginsidentesp["requiriente"]);
	echo '<img src="imag/calendario.png" height="20" width="20" style="vertical-align:middle">'.$reginsidentesp["fech_h_peticion"]." &nbsp;&nbsp;".$resultadoin[2]." - ".$resultadoin[0];
	?></strong>
       	        <br><br>

           	  <?php echo $reginsidentesp["problema"];?>
                
                
<hr style="width:20%;" align="left"  color="#DBDBDB">
<strong style=" color:#A52C1D; text-transform:uppercase">
ASISTENCIA:</strong> <?php 
if($reginsidentesp["personal"]==""){echo "Ninguno";}
else{echo $reginsidentesp["personal"]."<br>";}

echo $reginsidentesp["solucion"];?>
</div>
<div id="" style="padding:10px;   ">
<strong style="">Capturas:</strong>
<br><br>
<?php 
if($reginsidentesp["capturas"]=="")
{
}
else
{
	$capturashelp = explode(";", $reginsidentesp["capturas"]);
	for($r=1;$r<count($capturashelp);$r++)
	{
	echo '<img class="hoverzoom" onClick="vistaprevimg('."'".$capturashelp[$r]."'".')" title="Clic para ampliar" style=" cursor:pointer; margin:5px; box-shadow:0px 0px 5px #000000;border-radius:13em/3em" src="'.$capturashelp[$r].'" height="95" width="90" >';
	}
 
}
?>


<?php 
#recupera adjuntos
$archivos=explode (";",$reginsidentesp["adjuntos"]);

if(count($archivos)>0)
{
	
	?><br>
 <strong style="">Adjuntos:</strong>
<ul style="list-style:none;">
<?php 
for($y=0;$y<count($archivos);$y++)
{
	$arc_tit=explode(":",$archivos[$y]);
?>
<li><a href="<?php echo $arc_tit[0];?>"><?php echo $arc_tit[1]?></a></li>
<?php 
}
?>
</ul>
<?php 
}

?>
</div>

        </li>
        <?php 
		    
  }
		?>
        
        
    </ul>
</div>
 <style>
 .hoverzoom
 {
	 -webkit-transition: all .2s ease;
    -moz-transition: all .2s ease;
    -ms-transition: all .2s ease;
    -o-transition: all .2s ease;
    transition: all .2s ease;
    
    vertical-align: middle;
 }
 .hoverzoom:hover
 {
	  -webkit-transform:scale(1.5); /* Safari and Chrome */
    -moz-transform:scale(1.5); /* Firefox */
    -ms-transform:scale(1.5); /* IE 9 */
    -o-transform:scale(1.5); /* Opera */
    transform:scale(1.5);
	
	border-radius:3px;
 }
 </style>
 
  <?php 
  
 
  #consulta  los 10 ultimos atendidos 
 $queryultimos=mysql_query("select gad_incidencias.*,concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres, gad_personal.apellidos)as personal from gad_incidencias 
left join gad_personal on gad_incidencias.id_usuario=gad_personal.id_personal
where estado='FINALIZADO' order by id_incidencia desc limit 10;",$conectar)or die("Error");

$totalatendidos=mysql_num_rows($queryultimos);
  ?>
<div style="background:#CD2225; color:#FFFFFF" >&nbsp;&nbsp;
Últimos <?php echo $totalatendidos;?> Atendidos de  <?php echo $regestadistica["finalizado"]?>
</div>
<table width="100%" align="center" bgcolor="#FFFFFF"  bordercolor="#B5B5B5" id="insidentebuscado" style="font-size:13px" class="estilo_tabla1" border="1" rules="all">
<tbody>
  <tr >
    <th width="158" align="center" valign="middle"><strong>#</strong></th>
    <th width="158" align="center" valign="middle"><strong>CATEGORÍA</strong></th>
    <th width="307" align="center" valign="middle"><strong>PROBLEMA</strong></th>
    <th width="236" align="center" valign="middle"><strong>SOLUCIÓN</strong></th>
    <th width="231" align="center" valign="middle"><strong>R: REQUIRIENTE<br>
      A: ATIENDE</strong></th>
    <th width="181" align="center" valign="middle">I: INICIA  <br>
      F. FINALIZA</th>
    <th width="93" align="center" valign="middle">DURACIÓN</th>
    </tr>
  <?php 
 
while($regultimos=mysql_fetch_array($queryultimos))
{
	
 ?>
  <tr>
    <td style="text-transform:uppercase"><?php echo $regultimos["num_insidencia"]."<br>";
	$totalcapt=explode(";", $regultimos["capturas"]);
	echo "Total capturas: ".(count($totalcapt)-1);
	
	?>
    
    </td>
    <td style="text-transform:uppercase"><?php echo $regultimos["tipoinsidencia"];?></td>
    <td><?php echo $regultimos["problema"];?></td>
    <td><?php echo $regultimos["solucion"];?></td>
    <td><?php
	$requirientesolucionado=explode(";", $regultimos["requiriente"]);
	 echo "<strong>R:</strong> ".$requirientesolucionado[0]."<br><strong>A:</strong> ".$regultimos["personal"];?></td>
    <td><?php echo "<strong>I:</strong> ".$regultimos["fech_h_peticion"]."<br> <strong>F:</strong> ".$regultimos["fecha_h_finatencion"];?></td>
    <td align="center" valign="middle">
      <?php 
		$imprimetiempo="";
	$fecha1 = new DateTime($regultimos["fech_h_peticion"]);
	$fecha2 = new DateTime($regultimos["fecha_h_finatencion"]);
	$fecha = $fecha1->diff($fecha2);
	#printf('%d años, %d meses, %d días, %d horas, %d minutos, %d segundos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i, $fecha->s);
	// imprime: 2 años, 4 meses, 2 días, 1 horas, 17 minutos
	#if($fecha->y>0){echo "Si hay";}else{echo "no hay año<br>";}
	if($fecha->y>0){$imprimetiempo= $fecha->y." Años<br>";}
	if($fecha->m>0){$imprimetiempo.= $fecha->m." Meses<br>";}
	if($fecha->d>0){$imprimetiempo.= $fecha->d." Días<br>";}
	if($fecha->h>0){$imprimetiempo.= $fecha->h." horas<br>";}
	if($fecha->i>0){$imprimetiempo.= $fecha->i." Minutos<br>";}
	if($fecha->s>0){$imprimetiempo.= $fecha->s." Segundos";}
	
	echo $imprimetiempo;
	 ?>
      </td>
    </tr>
  <?php 
}
  ?>
  
<tbody>
</table>
</div>
</div>
</div>

  
 <!--**********************para cargar emergente la lita de funcioanrios-->
 <!--verificacion de perfil pswd-->
<div align="center" id="fun_heldesk"  class="emergentepadre" style="display:none !important; background:rgba(12,97,199,0.77);">
   
    <div class="emergentehijo" id="fun_heldesk2" style=" transform: translate(-50%, -80%);" >
    <?php 
	include("mod_help_desk/fun_x_helpdesk.php");
	?>
    </div>
</div>

<div class="emergentepadre ventanas" id="subirima" >
	<div class="emergentehijo" style="width:80% !important; background:#FFFFFF; min">
    <h3>Subir Imagen</h3>
    <form enctype="multipart/form-data" class="formulario" name="fotoempleado" style="margin:10px;">
    
    <input type="hidden" name="idinsidencia" id="idinsidencia" value="">
    <input type="hidden" name="numincidencia" id="numincidencia" value="">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
      
        Seleccione una imagen
      <br>

      <label   class="botocuadrado color_verde">Examinar
        <input name="archivo" type="file" accept="image/jpeg" id="imagenfotempleado" onChange="mostrarImagen(this);" style="overflow:none !important;display:none" />
      </label>
     
      <input type="button" class="botocuadrado color_azul" id="ejecutaruplfoto" value="Subir imagen" />
      <input type="button" id="calceupload" class="botocuadrado color_rojo" onClick="$('#subirima').fadeOut(1000)" value="Cancelar" />
       <div class="messages"></div>
      <br>
     <!--div para visualizar en el caso de imagen-->
      <div class="showImage"></div>    </td>
    </tr>
  <tr>
    <td><img style="border-radius:4px; box-shadow:1px 1px 5px rgba(64,196,244,1.00)" src="imag/usuario2.gif" id="vistapre" height="205" width="188"></td>
    </tr>
    </table>
    <br /><br /><br />
    
    </form>
    </div>
</div>
<div class="emergentepadre ventanas" id="imgprevia" style="background:rgba(0,0,0,0.64) !important" >
	<div class="emergentehijo" style="width:95% !important; height:95% !important; background:#FFFFFF; text-align:center !important" align="center">
    <h3 align="center">VISTA PREVIA DE IMAGEN<input type="button" id="calceupload" class="botocuadrado color_rojo" onClick="$('#imgprevia').fadeOut(1000)" value="X" style=" cursor:pointer;float:right; margin-top:-5px !important; top:0px !important; display:inline-block" /></h3>
    
    <div style="clear: both;text-align:center !important; overflow:scroll; position:relative; display:inline-block; width:100%; height:95%" align="center" id="aquiloadimg"></div>
    </div>
 </div>
<script>
$(document).ready(function(){
	// Write on keyup event of keyword input element
	$("#buscadorinsi").keyup(function(){
		// When value of the input is not blank
		if( $(this).val() != "")
		{
			// Show only matching TR, hide rest of them
			$("#insidentebuscado tbody>tr").hide();
			$("#insidentebuscado td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("#insidentebuscado tbody>tr").show();
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

</script>

<script>
$(document).ready(function(){
	
	 $(".messages").hide();
	 
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $('#imagenfotempleado').change(function()
    {
		//limpia la vista previa
		$(".showImage").html("");
		
		//vista previa apenas selecciona la imagen
		mostrarImagen(this);
		
		
        //obtenemos un array con los datos del archivo
        var file = $("#imagenfotempleado")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
				
        //obtenemos el tamaño del archivo
        var fileSize = file.size; //bytes
		
		var fileSize = (Number(fileSize) / 1024);  
		var fileSize = (Number(fileSize) / 1024);
		var fileSize= fileSize.toFixed(2)
		
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo: "+fileName+"<br> Peso total: "+fileSize+" MB.</span>");
    
	if(isImage(fileExtension))
	{}
	else
	{
		alert("El archivo que seleccionó, no es una imágen");
		}
	});
 
  
	//al enviar el formulario
    $('#ejecutaruplfoto').click(function(){
		
		  	//verificamos si tiene la extencion de imagen
	if(isImage(fileExtension))
	{
		
	
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
		
		//numero de aleatorio para nombre
		var nombreimgempl=$('#numincidencia').val()+'_'+getRandomInt(100000, 999999);
				
		formData.append("numincidencia", nombreimgempl);
		formData.append("idinsidencia", $('#idinsidencia').val());
		var minusculasextension=fileExtension.toLowerCase()
		
		var nomfoto= nombreimgempl+'.'+minusculasextension;
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({ 
            url: 'mod_help_desk/ajax-imagen.php',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                message = $('<span>Subiendo la imagen, por favor espere...	<img src="imag/spinner.gif">	</span>');
                showMessage(message)        
            },
            //una vez finalizado correctamente
            success: function(data){
                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                showMessage(message);
				cerrarymostrar('mod_help_desk/files/'+nomfoto)
                
                    //$(".showImage").html("<img src='files/"+data+"' />");
                
				
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                showMessage(message);
            }
        });
		
	}
	else
	{
		alert("Seleccione un tipo de imágen válido");
	}
    });
	
})
 
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}


//FUNCION VISTA PREVIA
function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#vistapre').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
  

 }
}
 
 function pasaupload(ced,idempl)
 {
	$('#subirima').fadeIn(1000);
		 
 }
 
 function cerrarymostrar(rutafoto)
 {
	$('#subirima').fadeOut(1000);
	//alert('#fotogrfia'+$('#idempleadoifot').val());
	//$('#fotogrfia'+$('#idempleadoifot').val()).attr('src', rutafoto);
	$('#previoimg').html($('#previoimg').html()+'<img style="margin:4px" height="46" width="50"  src="'+rutafoto+'">');
	
 }
 function getRandomInt(minn, maxn) {
  return Math.floor(Math.random() * (maxn - minn + 1) + minn);
}

function verimg(dbdir)
{
	
	var arrayimg=dbdir;
	var arrayimg=arrayimg.split(";");
	var htmlimg="";
	for (var g=1;g<arrayimg.length;g++)
	{
		 htmlimg =htmlimg+'<img style="margin:4px" height="46" width="50"  src="'+arrayimg[g]+'">';
	}
	$('#previoimg').html(htmlimg);
}
function vistaprevimg(rutapreve)
{
	$('#imgprevia').fadeIn(1000);
	$('#aquiloadimg').html('<img style="display:inline-block "  src="'+rutapreve+'">');
	
}
</script>

