<?php 
include("conf.ini.php");
#operacion de seguridad
$numero_a = rand(1,5);
$numero_b = rand(1,8); 
$resultado=$numero_a+$numero_b;

if($_POST["corredor"]=="ok")
{
	
?>

<h3  class="barratitulo" align="center">Recuperación de Contraseña</h3>
    <div style="padding:10px 10px">
    
    <span style="font-size:14px">Ingrese su número de cédula o correo y te la enviamos inmediatemente.</span>
    <br>
<br>
<table border="0">
  <tr>
    <td height="42" align="right" valign="middle">Cédula o Correo<br>
</td>
    <td><input type="text" name="recpasw" id="recpasw" class="recpswinput" ></td>
  </tr>
  <tr>
    <td height="51" align="right">El Resultado de: <?php echo $numero_a." + ".$numero_b." es ";?></td>
    <td><input type="text" class="recpswinput" name="resultado" id="resultado" style="width:40px">
    <input type="hidden" name="numa" id="numa" value="<?php echo $numero_a;?>">
    <input type="hidden" name="numb" id="numb" value="<?php echo $numero_b;?>">
    </td>
  </tr>
  <tr>
    <td height="58" colspan="2" align="center">
    <br>

    <a href="#" class="boton color_btn_azul" onClick="Aceptar_recuperar()">Aceptar</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="$('#olvido').fadeOut(800);"  class="boton color_btn_rojo">Cancelar</a>
    </td>
    
</table>
</div>
<br>
<?php 
}
else
{
	
	$valora=$_POST["valora"];
	$valorb=$_POST["valorb"];
	$uresultado=$_POST["uresultado"];
	$datusuario=$_POST["datusuario"];
	
	#verificammos resultado de suma
	$varresultado=$valora+$valorb;
	if($uresultado==$varresultado and $datusuario<>"")
	{
	
	$querypasw=mysql_query("select concat_ws(' ',gad_personal.nombres,gad_personal.apellidos) as nomina,gad_personal.correo,gad_usuarios.id_personal, gad_usuarios.usuario,gad_usuarios.contrasena from gad_usuarios
inner join gad_personal on gad_usuarios.id_personal=gad_personal.id_personal
where (gad_usuarios.usuario='$datusuario' or gad_personal.correo='$datusuario') and gad_personal.per_estado='activo'",$conectar)or die("Error".mysql_error());
$regcueracion=mysql_num_rows($querypasw);
$regdatos=mysql_fetch_array($querypasw);
$idpersonus=$regdatos["id_personal"];
	if($regcueracion==1)
	{
		#creacion de correo  para enviar mail
		###########################################################
		$para  = $regdatos["correo"]; 
#$para .= 'otrousuario@otrodominio.com';
$newcontraseña = substr( md5(microtime()), 1, 8); #geenra nueva contraseña de 8 caracteres
#fecha para expirar contraseña desde el ultimo cambio
$fecha = date('j-m-Y H:i:s');
$nuevafecha = strtotime ($tiempoexpira , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'j-m-Y H:i:s' , $nuevafecha );

##guarda en la base de datos la nueva contraseña
mysql_query("update gad_usuarios set contrasena='$newcontraseña ',expira='$nuevafecha' 
where gad_usuarios.id_personal='$idpersonus';",$conectar)or die("Error al actualizar la contraseña");
// Asunto
$titulo = 'GADPNAPO-SGT: Recuperación de Contraseña';
 
// Cuerpo o mensaje
$mensaje = '
<html>
<head>
  <title>Recuperacion de contraseña</title>
</head>
<body>
<h2 align="center" style="color:rgba(252,125,0,1.00)">RECUPERACIÓN DE CONTRASEÑA</h2>
<div style="font-family:Cambria; font-size:18px; background:rgba(255,255,255,0.85); padding:15px; text-align:justify">
<p>
Entiendo que solicitaste la recuperación de su contraseña de acceso al sistema, hemos procedido a generar una nueva contraseña, la puedes cambiar en cualquier momento.
</p>
<p ><strong>DATOS DEL USUARIO</strong></p>
<ul>
  <li><strong>Nombres&nbsp;&nbsp;&nbsp;&nbsp;: </strong> '.$regdatos["nomina"].'</li>
  <li><strong>Usuario  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong> '.$regdatos["usuario"].'</li>
  <li><strong>Contraseña:</strong> '.$newcontraseña.'
  </li>
</ul>

<p>
  Atentamente.<br>
<br><br>
<br>

ADMINISTRADOR DEL SISTEMA
</p>
</div>
</body>
</html>
';
 
// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: Administrador del Sistema <'.$correoprincipal.'>' . "\r\n";
$cabeceras .= 'Cc: jrojas@napo.gob.ec' . "\r\n";
#$cabeceras .= 'Bcc: copiaoculta@example.com' . "\r\n";
 
// enviamos el correo!
mail($para, $titulo, $mensaje, $cabeceras);
		
		
?>

<h3  class="barratitulo" align="center">Recuperación de Contraseña</h3>
<div style="padding:10px 10px">
    
  <span style="font-size:18px">Listo!<br>
  <?php echo $regdatos["nomina"]?>.  Hemos enviado la nueva contraseña a tu cuenta de correo <strong style="font-weight:bold"><?php echo $regdatos["correo"]?></strong> 
<br>
</span>
    <br>
<br>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="$('#olvido').fadeOut(800);"  class="boton color_btn_azul">Salir</a><br>
<br>

</div>

<?php
		#echo "en buena hora si exite usuario";
	}
	else
	{
		?>
		<h3  class="barratitulo" align="center">Recuperación de Contraseña</h3>
<div style="padding:10px 10px">
    
  <span style="font-size:16px"><strong style="font-weight:bold; color:red">Error de verificación!</strong><br>
Lo sentimos revisa que tu usuario este activo, escribiste correctamente el usuario y el resultado de la suma sea correcta, Intentalo nuevamente 
<br>
</span>
    <br>
<br>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="$('#olvido').fadeOut(800);"  class="boton color_btn_azul">Salir</a><br>
<br>

</div>
		<?php 
	}
	}
	else #else si no es igual al resultado
	{
		?>
		
		<h3  class="barratitulo" align="center">Recuperación de Contraseña</h3>
<div style="padding:10px 10px">
    
  <span style="font-size:16px"><strong style="font-weight:bold; color:red">Error de verificación!</strong><br>
Lo sentimos revisa que escribiste correctamente el usuario y el resultado de la suma sea correcta, Intentalo nuevamente 
<br>
</span>
    <br>
<br>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="$('#olvido').fadeOut(800);"  class="boton color_btn_azul">Salir</a><br>
<br>

</div>
		<?php 
	}
}
?>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script>
function  Aceptar_recuperar()
{
	
	var numero1=$("#numa").val();
	var numero2=$("#numb").val();
	var resultados=$("#resultado").val();
	var datusuarios=$("#recpasw").val();
	
	var datosok = {
                "valora" : numero1,
                "valorb" : numero2,
				"uresultado":resultados,
				"datusuario":datusuarios
        };
	
	var urlok = "recpswd.php"; 
	//alert(datusuarios);
    $.ajax({
           type: "POST",
           url: urlok,
           data: datosok, 
           success: function(data)
           {
               $("#recpaswordcargar").html(data); // Mostrar la respuestas del script PHP.
           }
         });	 
}
</script>