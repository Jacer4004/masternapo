<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<script>

$( document ).ready(function() {
	
$('.menuvertical li a').on('click', function(){
    $('.menuvertical li a.menuvertical_selecto').removeClass('menuvertical_selecto');
    $(this).addClass('menuvertical_selecto');
});
});

</script>
</head>

<div class="ventanas" id="contenedor">
<h3>  Talento Humano </h3>

 
  <ul class="menucentral">
	<li ><!--<a class="colortextoiconos" id="" href="inicio.php" onClick="js_general('mod_talento_humano/pag_personal','')"><img src="imag/talentoh.png" style="vertical-align:middle"><br> 
	Personal
</a>-->

<a id="" class="colortextoiconos" href="#" onClick="cerrar_abrir('contenedor','personal');cargarContenido('mod_talento_humano/script/mostrar_personal.php','#personalaqui')"><img src="imag/talentoh.png" style="vertical-align:middle"><br>
    Personal</a>
    

</li>  
    <li ><a id="" class="colortextoiconos" href="#" onClick="cerrar_abrir('contenedor','distributivo');$('#Contneidointernodis').html();"><img src="imag/folder_user.png" style="vertical-align:middle"><br>
    Distributivos</a></li>
    
    
    <li ><a id="" class="colortextoiconos" href="#" onClick="cerrar_abrir('contenedor','configuraciones');"><img src="imag/configuraciones.png" style="vertical-align:middle"><br>Definiciones</a></li>
    
    
      
   <li ><a id="" class="colortextoiconos"  href="javascript:void()" onClick="cerrar_abrir('contenedor','cambiosadmisnitrativos');cargarContenido('mod_talento_humano/script/vermovimiento.php','#vermovimeintos')"><img src="imag/move.png" style="vertical-align:middle"><br>
   Movimientos de Personal</a></li>   
    <li ><a id="" class="colortextoiconos" href="#" onClick="cerrar_abrir('contenedor','reportes_personal');"><img src="imag/reportesvarios.png" style="vertical-align:middle"><br>
    Reportes</a></li>
 
  </ul>
</div>


<!--modulo de reportes-->
<div class="ventanas" id="reportes_personal" style="display:none; text-align:justify !important">
<h3>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('reportes_personal','contenedor');" ><span>Regresar</span><img src="imag/atras_vt.png"></a>
&nbsp;&nbsp;&nbsp;
 <span id="titlosinternos">Reportes de Personal </span> </h3>
 <div>
   <table width="98%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="400" valign="top" bgcolor="#fff">
    <p>
    	<?php include_once("mod_talento_humano/script/reportes_varios.php");?>
    </p>
    </td>
    </tr>
  </table>
 </div>
  </div>





<div class="ventanas" id="configuraciones" style="display:none; text-align:justify !important">
<h3>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('configuraciones','contenedor');" ><span>Regresar</span><img src="imag/atras_vt.png"></a>
&nbsp;&nbsp;&nbsp;
 <span id="titlosinternos">Configuraciones </span> </h3>
 <div>
   <table width="98%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="170" height="400" valign="top" bgcolor="#fff">

    <ul class="menuvertical" style="margin-top:2px !important;">
    	<li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/cargos_laborales.php','#Contneidointerno'); Actualizar_titulo('#titlosinternos','Cargos laborales');">Cargos Laborales</a></li>
        <li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/tratamientos.php','#Contneidointerno'); Actualizar_titulo('#titlosinternos','Tratamientos');">Tratamientos</a></li>
        <li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/dependencias.php','#Contneidointerno'); Actualizar_titulo('#titlosinternos','Dependencias');">Dependencias</a></li>
        <li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/tiposcontratos.php','#Contneidointerno'); Actualizar_titulo('#titlosinternos','Tipos de Contratos');">Tipos de Contratos</a></li>
        
    </ul>
    </td>
    <td valign="top" bgcolor="#E8F1F4 ">
    <div id="Contneidointerno" 
     style="min-height:130px; margin:10px;" align="center">
    	<h4 align="center">Seleccione una Opción de la Izquiera</h4>
    </div>
      </td>
  </tr>
  </table>
 </div>
  </div>
 <div class="ventanas" id="distributivo" style="display:none; text-align:justify !important">
 <h3> <a href="javascript:void();" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('distributivo','contenedor');" ><img src="imag/atras_vt.png"></a>

&nbsp;&nbsp;&nbsp;
 <span id="titlosinternosdis">Distributivo </span> </h3>
 
 
 	<div>
   <table width="98%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="170" height="400" valign="top" bgcolor="#fff">

    <ul class="menuvertical" style="margin-top:2px !important;">
    	
        <li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/distributivos.php','#Contneidointernodis'); Actualizar_titulo('#titlosinternosdis','Distributivos');"> Distributivos</a></li>
        <li><a href="javascript:void()" onClick="cargarContenido('mod_talento_humano/script/reportes_distributivos.php','#Contneidointernodis'); Actualizar_titulo('#titlosinternos','Dependencias');">Reportes</a></li>
        
        
    </ul>
    </td>
    <td valign="top" bgcolor="#E8F1F4 ">
    <div id="Contneidointernodis" 
     style="min-height:130px; margin:10px;" align="center">
    	<h4 align="center">Seleccione una Opción de la Izquiera</h4>
    </div>
      </td>
  </tr>
  </table>
 </div>
 </div>
 
 <!--TODO EL PERSONAL-->
 <div id="principalsecundarios">
 
 </div>
 <div id="principalpersonal">
 <div class="ventanas" id="personal" style="display:none; text-align:justify !important">
<h3> <a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('personal','contenedor');" ><span>Regresar</span><img src="imag/atras_vt.png"></a>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cargarContenido('mod_talento_humano/nuevo_personal.php','#nuevo_personal');cerrar_abrir('funcionarios_load','nuevo_personal');Reset_fomulario('fomulariopersonal');$('#id_personal').val('');"><span>Registrar Nuevo</span><img style="" src="imag/new_vt.png"></a>
&nbsp;&nbsp;&nbsp;
 <span id="titlosinternosper">Personal </span> </h3>
 <div id="personalaqui">
  <?php # include_once("mod_talento_humano/script/mostrar_personal.php")?>  
</div>
 </div>
 </div>
 
 <!--abrir cambiso admisnitrativos-->
<div class="ventanas" id="cambiosadmisnitrativos" style="display:none; text-align:justify !important">
<h3>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('cambiosadmisnitrativos','contenedor');" ><span>Regresar</span><img src="imag/atras_vt.png"></a>
<a href="#" class="botonesaccion tooltipjrojas" onClick="cerrar_abrir('mostrarmovimientos','nuevorealizado');Reset_fomulario('movimientopersonal');"><span>Nuevo Cambio</span><img style="" src="imag/new_vt.png"></a>
&nbsp;&nbsp;&nbsp;
 <span id="titlosinternos">Movimientos e Personal </span> </h3>
 <div>
   <table width="98%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="400" valign="top" bgcolor="#fff">
    <div id="vermovimeintos"> 
    	
    </div>
    </td>
    </tr>
  </table>
 </div>
  </div>