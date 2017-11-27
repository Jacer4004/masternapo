
<?php 
include("../conf.php");
$variablechat=$_POST["variablechat"];
$variablemostrar=$_POST["variablemostrar"];

$fecha_H_actual=date('Y-m-d H:i:s', gmdate('U'));
$fecha_H_incr=date("Y-m-d H:i:s", strtotime("-10 second", strtotime($fecha_H_actual) ));

#actualizar login
mysql_query("update gad_usuarios set online='$fecha_H_actual' where id_personal='$variablechat'",$conectar)or die("ERROR");

//mysql_query("update gad_usuarios set online=");
$sql=mysql_query("select * from gad_usuarios 
inner join gad_personal on gad_usuarios.id_personal=gad_personal.id_personal
inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
where online>='$fecha_H_incr'")or die("ERROR_CHAT");

#imprime el numero de usuarios en linea

#echo '<h4 class="close_btn" align="center" onClick="deslizar()">Usuarios Conectados [ <span id="totalconectados">'.mysql_num_rows($sql).'</span> ]</h4>';

 #echo '<div class="toggle_chat">';
 #echo 'hola muno';
 #echo '</div>';
echo '
<span class="close_btn header" style=" position:absolute; float:left; top:0px; left:0px;"> ['.mysql_num_rows($sql).'] </span>
  <div class="toggle_chat" style="display:'.$variablemostrar.'">
  <div class="message_box">';
  echo '<ol class="userver" style="list-style:none; margin:2px;padding:2px">';
  while($reg_chat=mysql_fetch_array($sql))
	{
  		echo '
			<li><img style="vertical-align:middle; border:1px solid A3B7C3; margin-right:3px" src="imag/usechat.png">'.$reg_chat["abreviatura"].' - '.$reg_chat["nombres"].'</li>
		
		';
	}
echo '</ol>    </div>
  <input type="text" style="width:100%" name="buscarchat" id="buscarchat" placeholder="Buscar...."></div> 
  
';
/*$actual=strtotime(date("Y-m-d H:i:00",time()));
echo "<hr>".$actual." Actual <hr>";
echo date("Y-m-d H:i:s", strtotime("+1 month", strtotime("2015-11-23 10:10:10") ));
echo "<hr>";
echo date("Y-m-d H:i:s", strtotime("+15 second", strtotime("2015-11-23 10:10:10") ));
echo "listo <hr>";
*/#echo mysql_num_rows($sql);
#echo " OnLine <br>";

	#echo $reg_chat["nombres"]." ".$reg_chat["apellidos"]."<br>";

#echo date('Y-m-d H:i:s', gmdate('U'));


#echo $fecha_H_incr;

/*
if($fecha_H_incr>$fecha_H_actual)
{
echo "la hora actual es mayor";
}
else
{
	echo "NO se sabe";
}

$horaini="10:05:20";
$horafin="14:05:20";
#echo RestarHoras($horaini,$horafin); 

# http://www.lawebdelprogramador.com

# tiene que recibir la hora inicial y la hora final

function RestarHoras($horaini,$horafin)

{

	$horai=substr($horaini,0,2);

	$mini=substr($horaini,3,2);

	$segi=substr($horaini,6,2);

 

	$horaf=substr($horafin,0,2);

	$minf=substr($horafin,3,2);

	$segf=substr($horafin,6,2);

 

	$ini=((($horai*60)*60)+($mini*60)+$segi);

	$fin=((($horaf*60)*60)+($minf*60)+$segf);

 

	$dif=$fin-$ini;

 

	$difh=floor($dif/3600);

	$difm=floor(($dif-($difh*3600))/60);

	$difs=$dif-($difm*60)-($difh*3600);

	return date("H:i:s",mktime($difh,$difm,$difs));

}
$b = strtotime('2012-12-28 04:18:20');
$c = strtotime('2012-12-28 04:18:22');

if($b >= $c){
echo $b."Mayor o igual";
}else {
  echo $c."menor";
}
echo "<br>>>>>>>>>>B:".$b." ---a:".$c;*/


    /*$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));  
    $fecha_entrada = strtotime("19-11-2008 21:00:00");  
    if($fecha_actual > $fecha_entrada){  
      echo "La fecha entrada ya ha pasado";  
    }else{  
      echo "Aun falta algun tiempo";  
    }*/
?>

