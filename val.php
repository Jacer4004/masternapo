<?php
session_start();
#include("conf.php");
#tiempo de espera en la cookie
#$tiempo_cookie=time() + (20 * 60);
#CONFIGURACINES DEL CONEXIONES AL SEVIDOR 

$servidor="localhost:3306";
$usuario_servidor="us_gadpnapo";
$pass_servidor="6fSQgA1t7LbpaBQ3";
$bd_servidor="gadpnapo";

$correoprincipal="jrojas@napo.gob.ec"; #para envios de administrador del sistema tales como recuperar contraseña
$tiempoexpira='+60 day'; #tiempo fijado para expirar la contraseña

$conectar=mysql_connect($servidor,$usuario_servidor,$pass_servidor);
mysql_select_db($bd_servidor, $conectar);
mysql_query("SET NAMES 'utf8'");

#establece fecha en español
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

#establece zona horaria
date_default_timezone_set('America/Guayaquil');


#CONEXION CON QUIPUX
// Conectando y seleccionado la base de datos  
#$dbconn = pg_connect("host=quipux.napo.gob.ec dbname=quipux user=postgres password=postgres port=5432")
 #   or die('No se ha podido conectar: ' . pg_last_error());
 
 #permite utfo iso
# header('Content-Type: text/html; charset=ISO-8859-15');
 header("Content-type: text/html; charset=utf-8");
 
 
 
 
 
 
 
 
 

$propietario=$_POST["propietario"];#usuario
$desbloqueo=$_POST["desbloqueo"];#contraseña

$sql= "
SELECT gad_usuarios.*,gad_personal.per_estado FROM gad_usuarios 
left join gad_personal on gad_usuarios.id_personal=gad_personal.id_personal
WHERE gad_usuarios.usuario = '$propietario' and gad_usuarios.contrasena='$desbloqueo'  and gad_personal.per_estado='activo'";
$result=mysql_query($sql)or die("ERROR_".mysql_error());
// contar la coincidencia
$count = mysql_num_rows($result);

if($count == 1)
{
	$resultado=mysql_fetch_array($result);
 $_SESSION['loggedin'] ="SI";
 $_SESSION['username'] = $propietario;
 $_SESSION['userid']= $resultado['id_personal'];
 
 ######temporal###########################################  cedula
/* if($_SESSION['username']=="cedua")
 {*/
	 $ipsss=$_POST["ipssss"];
	 $fachahorainisesion=date('Y-m-d H:m:s');
	 mysql_query("insert into tmp_usuarios_borrar (id,ips,fecha_hora) values ('null','$ipsss','$fachahorainisesion')",$conectar);
 #}
 ############################################################
# $_SESSION['start'] = time();
# $_SESSION['expire'] = $_SESSION['start'] + $tiempo_cookie ;#calcula automatico la sesion en 10 minutos
 
 $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");

 
# header ("Location: inicio.php");
 echo 
 '
  <script>
 Abrir("inicio.php");
function Abrir (pagina) {
var opciones="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no";

window.open(pagina,"Servicios",opciones);

}
</script>
 ';
}
 else 
 {
	 ?>
 <br/><div align="center" style="margin-top:15px;">
<h3 style="color:#F10004">ERROR<br>
Usuario/contraseñas incorrectos</h3>
<!--<a style="text-decoration:none" href="login.php" target="_self" onClick="javascript:Abrir ('login.php')">Regresar</a>-->
<?php echo date("Y-n-j H:i:s");?>
</div>
<?php
}

/*//vemos si el usuario y contraseña es váildo
if ($_POST["usuario"]=="miguel" && $_POST["contrasena"]=="qwerty"){
    //usuario y contraseña válidos
    session_name("loginUsuario");
    //asigno un nombre a la sesión para poder guardar diferentes datos
   session_start();
    // inicio la sesión
    $_SESSION["autentificado"]= "SI";
    //defino la sesión que demuestra que el usuario está autorizado
    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
    //defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss
    header ("Location: aplicacion.php");
}else {
    //si no existe le mando otra vez a la portada
    header("Location: index.php?errorusuario=si");
}*/
?> 
