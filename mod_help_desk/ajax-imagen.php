<?php
include("../conf.php");

//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	
	$numincidencia=$_REQUEST["numincidencia"];
	$idinsidencia=$_REQUEST["idinsidencia"];
 	$nombreimg=$numincidencia;
	$rutaimg="files/";
    //obtenemos el archivo a subir
	
	######tipo de archivo.
	$extension=$_FILES[archivo][type];
	switch($extension)
	{
		case "image/jpg":
			$extension=".jpg";
			$calidad=95;
		break;
		
		case "image/gif":
			$extension=".gif";
			$calidad="";
		break;
		case "image/png":
			$extension=".png";
			$calidad=9;
		break;
		case "image/jpeg":
			$extension=".jpg";
			$calidad=95;
		break;
		default:
			$extension=".jpg";
			//Definimos la calidad de la imagen final
			$calidad=95; #nodificamos para png y gif
		break;
	}
	
	#nuevo nombre de archivo
	$file = $nombreimg.$extension;
 
    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir($rutaimg)) 
        mkdir($rutaimg, 0777);
     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaimg.$file))
    {
       sleep(3);//retrasamos la petición 3 segundos
       echo $file;//devolvemos el nombre del archivo para pintar la imagen
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}
$rutaImagenOriginal=$rutaimg.$file;


##########################GUARDA LA RUTA EN LA BASE DE DATOS
$rutaimgcompleta="mod_help_desk/".$rutaImagenOriginal;

$queryimg=mysql_query("
UPDATE gad_incidencias SET capturas = concat_ws(';',capturas,'$rutaimgcompleta') WHERE id_incidencia ='$idinsidencia';
",$conectar)or die("error");

#########################PONE MARCA DE AGUA PARA IDENTIFICAR MEJOR LA IMAGEN
// Crear la imagen
$im = imagecreatetruecolor(400, 100);
// Crear algunos colores
$blanco = imagecolorallocate($im, 255, 255, 255);
$negro  = imagecolorallocate($im, 0, 0, 0);
#imagecolortransparent($im, $negro);
imagefilledrectangle($im,0,0,399,29, $negro);
// El texto a pintar
$textoarray = explode('_',$numincidencia);
$texto = $textoarray[0] ;
$texto_firma1 = 'GADPNAPO-GESTIÓN TECNOLÓGICA';
$texto_firma = 'Ing. Diego Rojas';
// Reemplaze la ruta con su propio ruta a la fuente
$fuente = 'Comfortaa-Bold.ttf';
$anchoa = 10;
$altoa = imagesy($im)-(imagesy($im)/2);
$altob=$altoa+25;
$altoc=$altob+15;
// Agregar el texto
imagettftext($im, 20, 0, $anchoa, $altoa , $blanco, $fuente, $texto);
imagettftext($im, 12, 0, $anchoa, $altob, $blanco, $fuente, $texto_firma1);# dos lineas
imagettftext($im, 10, 0, $anchoa, $altoc, $blanco, $fuente, $texto_firma);# dos lineas
// Usar imagepng() resulta en texto más claro, en comparación con imagejpeg()
imagepng($im,"ultima.png");
imagedestroy($im);

$nombre = $numincidencia;
$extensions = explode(".",$rutaImagenOriginal);
$hay = count($extensions)-1;
$ext = strtolower($extensions[$hay]);
$nuevonombre = $nombre.".".$ext;

#########################################################################
foto($rutaImagenOriginal,$nuevonombre,$ext) or die("Error");

function foto($img_original,$img_nueva,$extension)
{
	$img_nueva_calidad=100;
$watermark = "ultima.png";

$im = imagecreatefrompng($watermark);

if (strtolower($extension)=="jpg") $img = imagecreatefromjpeg($img_original);
if (strtolower($extension)=="gif") $img = imagecreatefromgif($img_original);
if (strtolower($extension)=="png") $img = imagecreatefrompng($img_original);

$ancho = imagesx($img);
$alto = imagesy($img);
$nuevoalto = $alto;
$img_nueva_anchura=$ancho;

$thumb = imagecreatetruecolor($img_nueva_anchura,$nuevoalto);
imagecopyresampled($thumb,$img,0,0,0,0,$img_nueva_anchura,$nuevoalto,$ancho,$alto);
imagecopymerge($thumb, $im, (imagesx($thumb)/2)-(imagesx($im)/2), (imagesy($thumb)/2)-(imagesy($im)/2), 0, 0, imagesx($im), imagesy($im), 20);

if ($extension=="jpg"){imagejpeg($thumb,"files/".$img_nueva,$img_nueva_calidad);}
if ($extension=="gif"){imagegif($thumb,"files/".$img_nueva,$img_nueva_calidad);
	#imagegif($thumb2,"archivos/th_".$img_nueva,$img_nueva_calidad);
	}
if ($extension=="png"){imagepng($thumb,"files/".$img_nueva,$img_nueva_calidad);
	#imagepng($thumb2,"archivos/th_".$img_nueva,$img_nueva_calidad);
	}
}