<?php
session_start();

$tiempo_inactividad=3600; #600 = 10 minutos 3600=60minutos
#tiempo de espera en la cookie en minutos
#$tiempo_cookie=480;
#$tiempo_cookie_ok=$tiempo_cookie*60;


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else
{


      session_destroy(); // destruyo la sesión
	  unset($_COOKIE ["mod"]);
	  
    echo '<script type="text/javascript">
window.location="login.php?err=2";
</script>';

exit;
}

#ultimo acceso
$fechaGuardada = $_SESSION["ultimoAcceso"];

$ahora = date("Y-m-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

//comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= $tiempo_inactividad) {
     //limpia una kookie
	  
      session_destroy(); // destruyo la sesión
	unset($_COOKIE ["mod"]);
     echo '<script type="text/javascript">
window.location="login.php?err=1";
</script>';	  
	  exit;
	  //sino, actualizo la fecha de la sesión
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
	$iduslog=$_SESSION['userid'];
	
	mysql_query("UPDATE gad_usuarios SET online = '$ahora' WHERE id_personal = '$iduslog'",$conectar) or die ("Err".mysql_errno());
   } 
	
?>

