<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
.aviso
{
	
}
.advertencia_azul
{
	background:#BDE5F8; 
	background-image:url(imag/info.png);
	border:1px solid #00529B;
	color:#00529B;
}

.advertencia_amarillo
{
	background:#FEEFB3; 
	background-image:url(imag/messagebox_warning.png);
	border:1px solid #9F6000;
	color:#9F6000;
}

.advertencia_rojo
{
	background:#FFBABA; 
	background-image:url(imag/error.png);
	border:1px solid #D8000C;
	color:#D8000C;
}

.advertencia_verde
{
	background:#DFF2BF; 
	background-image:url(imag/tick.png);
	border:1px solid #4F8A10;
	color:#4F8A10;
}


.advertencia 
{
	
	margin:15px auto; 
	min-height:80px;
	background-position:left; 
	background-origin:content-box; 
	background-repeat:no-repeat;
	padding-left:10px;
	position:relative;
	display:inline-block;	
}
.advertencia p
{
	margin-right:15px;
	margin-left:40px;
	padding:0px;
	margin-top:20px; 
}

.advertencia h3
{
	
	margin:0px;
	
	margin-left:-10px; 
	padding:3px;
	padding-left:10px;
	font-size:16px;
}
.img_advertencia:hover
{
	background-image:url(imag/cancel2.png);
}
</style>

<script>
function cerra_Aviso()
{
setTimeout(function(){
  $('#advertencia').fadeOut(1000);
}, 3000);
//$('#advertencia').fadeOut(000);
}
</script>
</head>

<body>
<?php 
switch($_GET["avisotipo"])
{
	case 'azul':
		$claseaviso="advertencia_azul";
	break;
	case 'amarillo':
		$claseaviso="advertencia_amarillo";
	break;
	case 'rojo':
		$claseaviso="advertencia_rojo";
	break;
	case 'verde':
		$claseaviso="advertencia_verde";
	break;
}

switch($_GET["automatico"])
{
	case 'si':
		$cerrado="<script>
cerra_Aviso();
</script>";
	break;
	case 'no':
		$cerrado="";
	break;
}

echo $cerrado;
?>
<div align="center" style="text-align:center !important">
<div id="advertencia" class="advertencia <?=$claseaviso;?>" align="justify">
<img src="imag/close_window.png" class="img_advertencia" style="float:right; cursor:pointer" onClick="$('#advertencia').fadeOut(1000)">

<p id="mensajeaviso"><?=$_GET["avisomensaje"];?></p>
</div>
</div>
</body>
</html>