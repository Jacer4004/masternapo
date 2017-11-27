<?php 
#verifica la sesion

###########################finaliza verifica la sesion######
include("conf.php");


$mod=$_COOKIE["mod"];

if($mod=="")
{
	$pagina="home.php";
}
else
{
	$pagina=$mod.".php";
}

$colorfondo=$_COOKIE["color_bg"];
if($colorfondo==""){$colorfondo="color_negro";}


#DATOS DE USUARIO
$idconsulta=$_SESSION['userid'];
$sqldatos=mysql_query("select * from gad_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where id_personal='$idconsulta'",$conectar)or die("Error al obtener los datos del usuario");
$regdatos=mysql_fetch_array($sqldatos);

$nombres_us=$regdatos['tratamiento']." ".$regdatos['nombres']." ".$regdatos['apellidos'];
#valida accesos
$sqlaccesos=mysql_query("select * from gad_usuarios where id_personal='$idconsulta'",$conectar)or die("ERROR_ACCESOS");
$regaccesos=mysql_fetch_array($sqlaccesos);

if($regaccesos["acceso"]=="TODO")
{
	$sqltodo=mysql_query("select * from gad_accesos",$conectar)or die("ERROR_ACCESOS_");
	while($regtodo=mysql_fetch_array($sqltodo))
	{
		$accesos[]=$regtodo['codigo'];
	}
}
else
{
	
  $accesos=explode(',',$regaccesos["acceso"]);
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=0.8">
<!--<meta http-equiv=Refresh content="600; URL=login.php">--> 

<title>NAPO</title>
<!--calendario-->
 <link rel="stylesheet" href="css/datepicker.css">
 <link rel="stylesheet" href="css/bootstrap.css">
 
 <!--acelerando cargas
 Agregando este código a la página puedes ahorrarte algo de tiempo evitando la latencia de la consulta DNS. Cuando el browser encuentra esta línea agrega la tarea de hacer la consulta al DNS y cuando el usuario hace clic sobre el link de la página hermana ya esta información está cargada.
 <link rel="preconnect" href="//xyzsite.com">
 -->
 <!--<link rel="preconnect" href="//localhost">-->
 <meta http-equiv="x-dns-prefetch-control" content="off">
 <script>
function detectarPhone(){
            var navegador = navigator.userAgent.toLowerCase();
            if ( navigator.userAgent.match(/iPad/i) != null)//detectar ipad
              return 2;
            else{//detectar phone        
                if( navegador.search(/iphone|ipod|blackberry|android/) > -1 )
                   return 1;    
                else 
                    return 0;
            }
        }

window.focus();
        
        if (window.menubar.visible || window.toolbar.visible) { // si estan activas las barras llame a index para que se bloqueen
          if (detectarPhone()==0)
            window.location="index.php";
        }
		
 
function inhabilitar(){
    alert ("Esta función está inhabilitada.\n\nPerdonen las molestias.")
    return false
}
/*document.oncontextmenu=inhabilitar;
*/ </script>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script> 
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> 
<script src="js/bootstrap-datepicker.js"></script>
    <!--arriba calendario-->


<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<link rel="stylesheet" href="estilos/tablas.css" type="text/css" charset="utf-8"/>

<!--<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>-->
<script type="text/javascript" src="js/jquery.validaciones.js"></script>
<script type="text/javascript" src="js/gadjs.js"></script>

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	/*background:#C3C3C3;
	background-image:url(imag/fondo4.jpg);*/
	
	
}
html, body
{
  height: 100%;
}

.emergentepadre
{
	display:none; width: 100%; min-height: 100%;
height: auto !important;
position: fixed;
top:0; background:rgba(233,233,233,0.56);
left:0; z-index:20000
}
.emergentehijo
{
	position: absolute;
      top: 50%; 
      left: 50%;
      transform: translate(-50%, -50%); background:#FDFDFD; background:none 
}

.Chat_GT
{
position: fixed;width: 300px;
height: 75; background-color: #0df;
bottom: 1px; right: 1px; 
cursor:pointer;
z-index: 4;background:#08AEFF;
}
.Chat_GTdd
{ 
text-align:center; 
margin:0px;
padding:0px; 
background:#000000; 
color:#FFFFFF;
height:25;
vertical-align:middle;
}

.barra_lateral
{
	background-image:url(imag/lateral.png);  width:178px !important;
}

@media only screen and (max-width: 680px) 
{
.barra_lateral
{
	background-image:none;  width:18px !important;
	
}

#menulateral li {
    width: 70px !important;
	
	
}
}
</style>
<style>
.chat_conectados
{
	text-decoration:none;
}
.chat_conectados:hover
{

box-shadow:0px 0px 2px rgba(168,168,168,1.00);

}

.chat_conectados sup
{
	background:#4285F4;
	color:rgba(255,255,255,1.00);
	padding:1px; font-size:10px;font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	padding-left:4px; padding-right:4px;
	border-radius:2px;
	margin-left:-8px;
	margin-top:-5px;
	position:absolute;
	text-decoration:none;
}


</style>

</head>

<!--<body oncontextmenu="return false" onkeydown="return false">-->

<body onUnload="document.cookie='mod=;expires=-1';">

<table width="100%" style="height: 100%;" border="0" cellspacing="0">
  <tr>
  
    <td height="32" colspan="2"  >
   <div style="top:0px; left:0px; position:fixed; width:100%;background:#577E8D; border-bottom:2px solid #000000; z-index:1000; text-decoration:none" align="right" >
   
    <span style="background:#fff; padding:5px; padding-left:10px; padding-right:10px; border-bottom-right-radius:5px; height:20px; display:inline-block; border:1px solid #000; border-top:none; border-bottom-left-radius:5px; color:#000; margin-right:10px; z-index:999">
    
   <a href="#" class="tooltipjrojas chat_conectados" id="conectadoshoy"><span>Usuarios Conectados</span><img   src="imag/users.png"><sup id="">0</sup></a>&nbsp;&nbsp;&nbsp;<a class="tooltipjrojas chat_conectados" href="javascript:alert('Chat interno aquí Próximante')"><span>Chatea con usuarios</span><img src="imag/chat.png"></a>
    <img src="imag/usualogin.png" height="24" style="vertical-align:middle"> <?php echo $nombres_us;?>&nbsp;&nbsp;<img  src="imag/napo.png" width="64" height="24" alt="" style="vertical-align:middle;"/></span>
    </div>
    </td>
  </tr>
  <tr>
    <td width="15" rowspan="2" valign="top" class="barra_lateral"  >    
 
      <ul id="menulateral" style="z-index:20000">
            <?php #if (in_array("M1ADM", $accesos)) {?><li style=""><a id="color_cobalt" href="inicio.php" title="Administración" onClick="javascript:js_general('','color_cobalt','<?php echo $tiempo_cookie;?>')"><span>Dashboard</span>&nbsp;<img src="imag/dashboard.png"></a></li><?php #}?>
            
			<?php if (in_array("M1ADM", $accesos)) {?><li><a id="color_indigo" href="inicio.php" title="Administración" onClick="javascript:js_general('mod_administracion','color_indigo','<?php echo $tiempo_cookie;?>')"><span>Administración</span>&nbsp;<img src="imag/administracion.png"></a></li><?php }?>
            <?php if (in_array("M2TAH", $accesos)) {?><li><a id="color_cyan" href="inicio.php" title="Módulo de Talento Humano" onClick="javascript:js_general('mod_talento_humano','color_cyan','<?php echo $tiempo_cookie;?>')"><span style="vertical-align:middle">Talento Humano</span>&nbsp;<img src="imag/talentohumano.png"></a></li><?php }?>
            <?php if (in_array("M3ACT", $accesos)) {?><li><a id="color_lightOlive" href="inicio.php" title="Módulo de Activos Fijos" onClick="js_general('mod_activos','color_lightOlive','<?php echo $tiempo_cookie;?>')"><span style="vertical-align:middle">Activos</span>&nbsp;<img  src="imag/activos.png"></a></li><?php }?>
            <?php if (in_array("M4SUM", $accesos)) {?><li><a  id="color_darkBlue" href="inicio.php" title="Módulo de Suministros" onClick="js_general('mod_suministros','color_darkBlue','<?php echo $tiempo_cookie;?>')"><span >Suministros</span>&nbsp;<img src="imag/suministro.png"></a></li><?php }?>
            <?php if (in_array("M5STS", $accesos)) {?><li><a  id="color_amber" href="inicio.php" title="Módulo de Soporte Técnico" onClick="js_general('mod_soporte_sistemas','color_amber','<?php echo $tiempo_cookie;?>')"><span style="vertical-align:middle">Soporte Técnico</span>&nbsp;<img src="imag/soporte_gt.png"></a></li><?php }?>
            <?php if (in_array("CONSULTAS_P", $accesos)) {?><li><a id="color_orange" href="inicio.php" title="Módulo de Reportes"  onClick="js_general('mod_reportes/personal_gad','color_darkBlue','<?php echo $tiempo_cookie;?>')"><span>Consultas</span>&nbsp;<img src="imag/consultas.png"></a></li><?php }?>     
           <li><a id="color_red" href="logout.php" title="Salir"  ><span>Salir</span>&nbsp;<img style="vertical-align:middle" src="imag/exit.png"></a></li>     
      </ul>
    
    </td>
    <td align="center" valign="top" >
	<div id="home_notificaciones">
    <?php include($pagina); ?>
    </div>
	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<div id="mensajes" style="background:#2788E3; color:#FFFFFF; height:100px;  display:none; z-index:10000; position:fixed; top:100px; margin-top:100px; width:100%; text-align:center; vertical-align:middle; padding:20px">hola</div>
<script>
Entrada_con_fade_in('contenedor',1000);


</script>

<div align="center" id="procesando"  class="emergentepadre">
    <div class="emergentehijo">
      
    <img src="imag/loading1.gif">
    </div>
</div>

<?php 
#validadcion de pswd para obligar a cambiar
$paswvalidacion= "@gadnapo#1";
$sqlpaswd=mysql_query("select * from gad_usuarios where id_personal='$idconsulta' and contrasena='$paswvalidacion'",$conectar)or die("ERROR_");
if(mysql_num_rows($sqlpaswd)==1)
{
?>
<!--verificacion de perfil pswd-->
<div align="center" id="procesandopsw"  class="emergentepadre" style="display:inline !important; background:rgba(12,97,199,0.77)">
    
    <div class="emergentehijo" id="smspswd" align="center" style="padding-top:50px">
    <p align="center" style="background:#025293; color:#FFFFFF; font-size:20px; font-weight:bold;">Su contraseña !Expiró¡ por favor cambie una contraseña nueva para continuar usando el sistema. </p>
    <div align="center">
    <a href="#" onClick="$('#smspswd').fadeOut(2000);$('#actualizar_datos').fadeIn(2000);$('#opusuario_pswd').css('display','none');Entrada_pestanias('#cambiar_contrasenia');" class="boton color_btn_rojo">Aceptar</a>
    </div>
    </div>
    <div class="emergentehijo" id="actualizar_datos" style="width:90% !important; display:none">
    <?php include("pag_misdatos.php")?>
    </div>
</div>
<?php 
}
?>


<script>

Verconectados();
setInterval('Verconectados()',5000);

function Verconectados()
{
	
	//$("#shout_box").fadeIn(1000);
	
	//$("#okkkk").html('<img src="imag/loading2.gif">');
	
	var archivochat="chat/conectados.php";
	var mostrar_ver="";
	$.post(archivochat, { variablechat: mostrar_ver}, function(data){
	$("#conectadoshoy").html(data);
	//$("#conectadoshoy").fadeOut(1000);
	});				
}

</script>
<!--fondo para mostrar-->

</body>
</html>