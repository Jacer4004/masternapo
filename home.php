<?php 
include_once("conf.php");
$destino=$_SESSION['userid'];
$sql_noti=mysql_query("SELECT *
FROM gad_notificaciones where destino='$destino' and accion=''",$conectar)or die("Error: ");
?>
<script>
setInterval(js_general('','color_cobalt','<?php echo $tiempo_cookie;?>'),5000);
</script>
<style>
	.notificaciones
{
	border:1px solid rgba(179,179,179,0.75);
	box-shadow:2px 1px 3px rgba(179,179,179,0.75);
	min-width:200px;

	margin:5px;
	border-radius:4px;
	
}
.notificaciones h4
{
	margin:0px; padding:3px;
	background:#2998CD; color:#FFFFFF;
	border-radius:3px 3px 0px 0px;
	
}
</style>

<!--DASHBOARD-->
<div style="margin:20px">
<div id="dashboard"  >
	<div id="notificaciones" class="">
   <!-- <h4 align="center">AVISOS</h4><br>-->
    
    <ol style="list-style:none">
    <?php 
	if(mysql_num_rows($sql_noti)==0)
	{
		?>
		<li style="display:block; float:left; min-width:400px; font-size:12px; margin:7px">
        <div class="ventanas" style="max-width:400px; text-align:justify" >
        	<h3 style="font-size:14px; margin:0px; padding:2px !important">0 Avisos
            
            </h3>
            <div style="padding:7px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-style:italic" >
            <p>
            Sin Avisos
            </p>
            </div>
        </div>
        </li>
		<?php 
	}
	else
	{
		
	while($regnoti=mysql_fetch_array($sql_noti))
	{
		$idcontar=$idcontar+1;
		
		#activa las notificaciones
		if($regnoti["vista_emergente"]=="")
		{
			$segundo=$idcontar * 1000;
			?>
			
			<script type="application/javascript">
			setTimeout("notifyMe('<?=$regnoti["titulo"]?>','<?=$regnoti["autor"]." ".$regnoti["objetivo"]?>')",<?php echo $segundo?>);
			</script>
			<?php 
			$f_vista=date("Y-m-d H:i:s");
			$idnoti=$regnoti["id_notificacion"];
			mysql_query("UPDATE gad_notificaciones SET vista_emergente= 'Oculto', f_vista='$f_vista' WHERE id_notificacion='$idnoti'",$conectar);
		}
		
		
	?>
    	<li id="notifi<?php echo $idcontar;?>" style="display:block; float:left; min-width:400px; font-size:12px; margin:7px">
        <div class="ventanas" style="max-width:400px; text-align:justify" >
        	<h3 style="font-size:14px; margin:0px; padding:2px !important"><?php echo $regnoti["titulo"]?>
            
            </h3><span style="font-size:11px"><strong>Autor:</strong> <?php echo $regnoti["autor"]?></span>
            <div style="padding:7px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-style:italic" >
            <p>
            <?php echo substr($regnoti["objetivo"],0,125)."...";?>
            </p>
            <div align="right" style="text-align:right !important; ">
            <a href="javascript:void()" onClick="update_status_n('<?php echo $regnoti["id_notificacion"];?>','Aceptar','notifi<?php echo $idcontar;?>')" style="font-size:10px !important" class="btn_azul">Aceptar</a>&nbsp;&nbsp;
            <a href="javascript: void()" onClick="update_status_n('<?php echo $regnoti["id_notificacion"];?>','Ignorar','notifi<?php echo $idcontar;?>')" style="font-size:10px !important" class="btn_rojo">Ignorar</a>
            </div>
            </div>
        </div>
        </li>

<?php 
	}
	
	}
?>
    </ol>
    
    	</div>
</div>

</div>

<script>
function update_status_n(datos,estado_n,objet)
{		
	var file='mod_dashboard/act_est_noti.php';
	var obj="#"+objet;
	var iddato=datos;
	$(obj).html('<h1 align="center"><img src="imag/loader-orange.gif"></h1>');
		$.post(file, { estado: estado_n,id_notis:iddato }, function(data){
	$(obj).html(data);

	$(obj).fadeOut(500);
	});			
}

function  notifyMe(titulo,cuerpo)  {  
    if  (!("Notification"  in  window))  {   
        alert("Este navegador no soporta notificaciones de escritorio");  
    }  
    else  if  (Notification.permission  ===  "granted")  {
        var  options  =   {
            body:  cuerpo,
            icon:   "imag/messagebox_warning.png",
            dir :   "ltr"
			//sound: 'sonidos/facebook_messenger_nuevo_mensaje.mp3'
        };
        var  notification  =  new  Notification(titulo, options);
		//notification.sound ;
    }  
    else  if  (Notification.permission  !==  'denied')  {
        Notification.requestPermission(function (permission)  {
            if  (!('permission'  in  Notification))  {
                Notification.permission  =  permission;
            }
            if  (permission  ===  "granted")  {
                var  options  =   {
                    body:   cuerpo,
		            icon:   "imag/messagebox_warning.png",
		            dir :   "ltr"
					//sound: 'sonidos/facebook_messenger_nuevo_mensaje.mp3'
                };     
                var  notification  =  new  Notification(titulo, options);
				//notification.sound ;
            }   
        });  
    }
}

function recargar_notificaciones()
{
	//$('#home_notificaciones').html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');
	$('#home_notificaciones').fadeOut(500);
	$('#home_notificaciones').load('home.php',{v11:'ok_', v2:'ok_'}, 
	function(response, status, xhr) 
	{
		if (status == "error") 
		{
			var msg = '<h4 align="center"><img src="imag/loader-orange.gif"><br><strong>Error!: </strong>';
			
			$('#home_notificaciones').html(msg + xhr.status + " " + xhr.statusText+'</h4>');
			
		}
	});
	$('#home_notificaciones').fadeIn(1000);
}


</script>
	