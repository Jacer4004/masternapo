<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GAD_P_NAPO</title>
<script language="JavaScript">
/*function Abrir_ventana (pagina) {
var opciones="toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=yes,fullscreen=no,dependent=no";

window.open(pagina,"",opciones);
}*/
function Abrir (pagina) {
var opciones="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no";

window.open(pagina,"Servicios",opciones);
}

function target_popup(form) {
    window.open('', 'Servicios', 'resizeable,scrollbars');
    form.target = 'formpopup';
}

</script>

<style>
.Solo_Caja_Texto
{
 margin:3px;
 padding:4px;
 border:none;	
}
.boton_imagen
{
	background:url(imag/aceptar.png);
	cursor:pointer;
	height:38px;
	width:38px;
	border:none;
}
.boton_imagen:hover
{
	background-image:url(imag/aceptarhover.png);
}
</style>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>


</head>
<!--#F25714-->
<body style="background:#333333" oncontextmenu="return false" onkeydown="return false">
<a href="#" onClick="Abrir('login.php')">Abrir</a>
</body>
</html>