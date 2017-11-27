<?php 
//$sql_areas=mysql_query("select distinct dependencia,nombre, id_dependencia from gad_dependencia group by dependencia",$conectar);
?><head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<style type="text/css">
	ul{
		list-style: none;
	}
	</style>
	<script>
	$(document).ready(function()
	{
		$(".btn-folder").on("click", function(e)
		{
			e.preventDefault();
			if($(this).attr("data-status") === "1")
			{
				$(this).attr("data-status", "0");
				$(this).find("span").removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign")
			}
			else
			{
				$(this).attr("data-status", "1");
				$(this).find("span").removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign")
			}
			$(this).next("ul").slideToggle();
		})
	});
	</script>
</head>


<div class="ventanas" id="contenedor">
<h3 align="center" id="<?php echo $colorfondo?>">Actualice su perfil</h3>
<div >


<?php 
$sql_subarea=mysql_query("SELECT gad_personal.*, gad_dependencia.*
    FROM   gad_personal 
	inner join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
	where id_personal='$idconsulta'",$conectar) or die("ERROR");
$reg_areas=mysql_fetch_array($sql_subarea);

$telefonos=split(":",$reg_areas["movil_per_gp"]);			
?>

<div style="margin:20px;">

<table width="90%" border="0">
  <tr>
    <td width="183" valign="top" align="center" style="background:rgba(194,218,225,1.00)">
      <div align="center" style="text-align:center">
        <br>
        <img src="imag/userperfil.png">
        
        <ul class="menulistas" id="opusuario_pswd">
          <li><a href="#" id="mi_perfil_us" onClick="Entrada_pestanias('#mi_perfil');">Mi Perfil</a></li>
          <li><a href="#" id="mi_perfil_pswd" onClick="Entrada_pestanias('#cambiar_contrasenia');">Cambiar Contraseña</a></li>
          <li><a href="#" id="mi_perfil_conf" onClick="Entrada_pestanias('#configuraciones');">Configuraciones</a></li>
          <li><a href="#" id="mi_perfil_activos" onClick="Entrada_pestanias('#activos_a_cargo');">Activos a Cargo</a></li>
          </ul>
        </div>
      </td>
    <td width="234" colspan="2" valign="top" style="padding-left:15px">
    <!--grupo mi perfil-->
    <div id="mi_perfil">
    
    <h4 style="color:rgba(252,113,19,1.00); margin:0px; margin-bottom:7px;">Mi perfil</h4>
    
      <table border="0">
        <tr>
          <td><strong>Nombres</strong></td>
          <td>: <?php echo $reg_areas["nombres"];?></td>
          </tr>
        <tr>
          <td><strong>Apelidos</strong></td>
          <td>: <?php echo $reg_areas["apellidos"];?></td>
          </tr>
        <tr>
          <td><strong>Cédula</strong></td>
          <td>: <?php echo $reg_areas["cedula"];?></td>
          </tr>
        <tr>
          <td><strong>Correo</strong></td>
          <td>: <?php echo $reg_areas["correo"];?></td>
        </tr>
        <tr>
          <td><strong>Dependencia</strong></td>
          <td>: <?php echo $reg_areas["nombre"];?></td>
          </tr>
        </table>
      <br>
      
      <form name="nuevoactivo" id="fomulariook" class="formularios" >
	<input type="hidden" name="ussactu" id="ussactu" value="<?php echo $idconsulta;?>">
      <table border="0">
        <tr>
          <td align="right" valign="top"><strong>Dir. Domicilio</strong></td>
          <td><input type="text" name="dirdomicilio" id="dirdomicilio" value="<?php echo $reg_areas["dir_domicilio_gp"];?>" placeholder="Barrio-Calle Principal-Calle Secundaria - #" size="60" required></td>
          </tr>
        <tr>
          <td align="right" valign="top"><strong>Correo Personal</strong></td>
          <td><input type="text" name="correopersonal" id="correopersonal" value="<?php echo $reg_areas["correo_per_gp"];?>" size="60"></td>
          </tr>
        <tr>
          <td align="right" valign="top"><strong>Telf. Movil</strong></td>
          <td align="left"><input type="text" name="movil1" id="movil1" placeholder="Movistar" value="<?php echo $telefonos[0]?>">
            <input type="text" name="movil2" id="movil2"  placeholder="Claro"value="<?php echo $telefonos[1]?>">
            <input type="text" name="movil3" id="movil3" placeholder="CNT" value="<?php echo $telefonos[2]?>"></td>
          </tr>
        <tr>
          <td align="right" valign="top"><strong>Telf. Casa</strong></td>
          <td><input type="text" name="telfcasa" id="telfcasa" value="<?php echo $reg_areas["telfcasa_gp"];?>"></td>
        </tr>
        <tr>
          <td height="80" colspan="2" align="center" valign="top" style="text-align:center !important">
          <input type="button" class="boton color_btn_azul" id="guardar" value="Guardar" onClick="salvar_cambios_perfil('<?php echo $idconsulta;?>')" ><br>
<div id="solved_perfil">

</div>
          </td>
          </tr>
        </table>
        </form>
        
        </div>
        <!--grupo Cambiar contraseña-->
    <div id="cambiar_contrasenia">
    
    <h4 style="color:rgba(252,113,19,1.00); margin:0px; margin-bottom:7px;">Cambiar contraseña</h4>
    
    
    	<div>
        	<form name="pass" id="fomulariookpas" class="formularios">
            <table border="0" align="center">
  <tr>
    <td align="right">Contraseña Actual: </td>
    <td>
    <input type="password" name="pasactual" id="pasactual" onKeyUp="pass_actual('<?php echo $idconsulta;?>',this.value);"  required class="">    </td>
    <td><img src="imag/loading2.gif" height="24" width="24" style="display:none" id="loadpassactual">
    <span id="pas_Actual" class="pass_invalido ">
    Ingrese la contraseña actual</span>
    
    </td>
  </tr>
  <tr>
    <td align="right">Contraseña Nueva:</td>
    <td><input type="password" name="newpass" class="cajatextodisabled" id="newpass" onKeyUp="val_n_pass();val_confirpass()" disabled>
      </td>
    <td><span id="pas_nuevo" class="pass_invalido">La nueva contraseña debe tener almenos 8 caracteres,
Almenos 1 letra, Almenos una mayúscula y Almenos 1 número </span></td>
  </tr>
  <tr>
    <td align="right">Confirme&nbsp;Nueva Contraseña:</td>
    <td><input type="password" class="cajatextodisabled" name="confirpass" id="confirpass"  onKeyUp="val_confirpass()" disabled></td>
    <td><span id="pas_confirm" class="pass_invalido">No coincide la nueva contraseña</span></td>
  </tr>
  <tr>
    <td  height="80" colspan="3"align="center" valign="top">
    &nbsp;
    <div style="text-align:center">
        <input type="button"  class="boton color_btn_azul" id="guardar2" onClick="salvar_cambios('<?php echo $idconsulta;?>')" value="Guardar" style="display:none" ><br>

        <div id="solved_npwd">
        
        </div>
    </div>
    </td>
    </tr>
</table>
</form>

</div>
    </div>
    
    <!--grupo Cambiar contraseña-->
    <div id="configuraciones">
    
    <h4 style="color:rgba(252,113,19,1.00); margin:0px; margin-bottom:7px;">Configuraciones</h4>
    
    <strong>Mi Ususario de equipo. </strong><br>
        <div>
        	<?php 
			$sqlconfig=mysql_query("select m5sts_us_ad.* from m5sts_us_ad where m5sts_us_ad.id_personal='$idconsulta'",$conectar)or die("ERROR_CONFIGURACIONES");
 
			while($regconfig=mysql_fetch_array($sqlconfig))
			{
			?>
            <table border="0">
  <tr>
    <td align="right"><strong style="font-size:13px">USUARIO:</strong></td>
    <td>&nbsp;<?php echo $regconfig["nom_usu_ad"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">PERFIL: </strong></td>
    <td><?php echo $regconfig["perfilusuario"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">CONTRASEÑA: </strong></td>
    <td>&nbsp;<?php echo $regconfig["contrasenia"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">FECHA DE CREACIÓN: </strong></td>
    <td>&nbsp;<?php echo $regconfig["f_creacion"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">ESTADO: </strong></td>
    <td>&nbsp;<?php if($regconfig["estado"]=="Inactivo")
				  {
					  echo "Inactivo desde: ".$regconfig["f_inactivo_us"];
				  }else
				  {
				   echo $regconfig["estado"]; 
				  }
				   ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">OBSERVACIONES:</strong> </td>
    <td>&nbsp;<?php echo $regconfig["observaciones"]; ?></td>
  </tr>
</table>
            <hr>

              <?php 
			}
					?>
     <br>
<strong>Dirección IP asignada.</strong> <br>

     <?php 
			$sqlconfigip=mysql_query("select m5sts_ip.* from m5sts_ip where m5sts_ip.id_personal='$idconsulta'",$conectar)or die("ERROR_CONFIGURACIONES");
 
			while($regconfigip=mysql_fetch_array($sqlconfigip))
			{
			?>
            <table border="0">
  <tr>
    <td align="right"><strong style="font-size:13px">UBICACIÓN GEOGRÁFICA:</strong></td>
    <td>&nbsp;<?php echo $regconfigip["ugeografica"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">DISPOSITIVO: </strong></td>
    <td><?php echo $regconfigip["dispositivo"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">DIRECCIÓN IP: </strong></td>
    <td>&nbsp;<?php echo $regconfigip["ip"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">FECHA DE CREACIÓN: </strong></td>
    <td>&nbsp;<?php echo $regconfigip["f_creacion_ip"]; ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">ESTADO: </strong></td>
    <td>&nbsp;<?php if($regconfig["estado_ip"]=="Inactivo")
				  {
					  echo "Inactivo desde: ".$regconfigip["f_inactivo_ip"];
				  }else
				  {
				   echo $regconfigip["estado_ip"]; 
				  }
				   ?></td>
  </tr>
  <tr>
    <td align="right"><strong style="font-size:13px">OBSERVACIONES:</strong> </td>
    <td>&nbsp;<?php echo $regconfigip["f_inactivo_ip"]; ?></td>
  </tr>
</table>
            <hr>
              <?php 
			}
					?>
        </div>
    </div>
    
    <!--grupo Cambiar contraseña-->
    <div id="activos_a_cargo">
    
    <h4 style="color:rgba(252,113,19,1.00); margin:0px; margin-bottom:7px;">Ativos a Cargo</h4>
    
        <div>
          <?php 
		  $sqlactivos=mysql_query("select * from m5sts_entrega_equipos
inner join m5sts_e_e_componentes on m5sts_entrega_equipos.id_ent_equi=m5sts_e_e_componentes.id_ent_equi
inner join m5sts_equipos on m5sts_e_e_componentes.id_equipo=m5sts_equipos.id_equipo
where m5sts_entrega_equipos.id_personal='$idconsulta'
order by nombre
",$conectar)or die("ERROR_ACTIVOS");

		  ?>
          <div class="" style="margin:10px;" align="center">
          
<h4 align="center" style="padding-bottom:0px; margin-bottom:3px;">EQUIPOS Y PARTES</h4>
<div align="right" style="text-align:right; background:#7CB8E2; padding:10px; border-top-left-radius:8px; border-top-right-radius:8px">

<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle; " type="text" name="buscar">&nbsp;&nbsp;</div>
  <table align="center" id="report" width="100%"  >
  <thead>
        <tr>
            <th>Código Activo</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>SERIE</th>
            <th width="10">&nbsp;</th>
        </tr>
  </thead>
  <tbody>      
<?php  $cont="";
  while($regactivo=mysql_fetch_array($sqlactivos))
  {
	   $cont=$cont+1;
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $regactivo["codigoactivo"]; ?></td>
            <td><?php echo $regactivo["nombre"]; ?></td>
            <td><?php echo $regactivo["marca"]; ?></td>
            <td><?php echo $regactivo["serie"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="5">
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
              <h4>Descripción completa del Equipo: <?php echo $regactivo["nombre"]." - ".$regactivo["marca"] ; ?></h4>
                <ul>
                    <li><strong>Marca:</strong> <?php echo $regactivo["marca"]; ?></li>
                    <li><strong>Modelo:</strong> <?php echo $regactivo["modelo"]; ?></li>
                    <li><strong>Serie:</strong> <?php echo $regactivo["serie"]; ?></li>
                    <li><strong>IU de Equipo:</strong> <?php echo $regactivo["IUequipo"]; ?></li>
                    <li><strong>Estado:</strong> <?php echo $regactivo["estado"]; ?></li>
                    <li><strong>Fecha de Registro:</strong> <?php echo $regactivo["fecha_registro"]; ?></li>
                    <li><strong>Propietario:</strong> <?php echo $regactivo["propietario"]; ?></li>
                    <li><strong>Especificaciones:</strong> <?php echo $regactivo["especificaciones"]; ?></li>
                    
                    <li><strong>Otros:</strong> <?php echo $regactivo["otros"]; ?></li>
                    <li><strong>Custodio:</strong> <?php 
					$idactivocus=$regactivo["id_equipo"];
					$sqlcustodio=mysql_query("SELECT m5sts_e_e_componentes.* , concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres,gad_personal.apellidos) as nomina 
FROM m5sts_e_e_componentes
INNER JOIN m5sts_entrega_equipos ON m5sts_e_e_componentes.id_ent_equi = m5sts_entrega_equipos.id_ent_equi
INNER JOIN gad_personal ON m5sts_entrega_equipos.id_personal = gad_personal.id_personal where id_equipo='$idactivocus'  and m5sts_entrega_equipos.estadoee='Activo'")or die("ERROR_CUSTODIO");
					$regcustodio=mysql_fetch_array($sqlcustodio);
					echo $regcustodio["nomina"]; ?></li>
              </ul>   

              
              </div>
            </td>
        </tr>
 <?php 
  }
  ?>       
      </tbody> 
       
  </table>
</div>
        </div>
    </div>
        </td>
  </tr>
  </table>

</div>
</div>

</div>
<style>
.menulistas
{
	list-style:none;
	margin:0px;
	text-align:left;
	padding:0px;
	font-size:14px;
	
}
.menulistas a
{
	text-decoration:none;
	padding:2px;
	display:block;
}

.menulistas li:hover
{
	background:rgba(255,255,255,0.49);
	color:#FFFFFF !important;
	
	font-style:italic;
	
}

.pass_valido
{
	display:none
}
.pass_invalido
{
	color:rgba(255,0,0,1.00);
	font-size:13px; 
	font-style:italic;
	
	padding:5px;
	
}

.cajatextodisabled:disabled
{
	background:rgba(193,193,193,1.00);
	cursor:not-allowed;
	
}
.cajatextodisabled:enabled
{
	background:rgba(252,252,252,1.00);
	
}
.cajatextodisabled
{
	
	background:rgba(193,193,193,1.00);
}


</style>
<script>
document.getElementById("cambiar_contrasenia").style.display="none";
document.getElementById("configuraciones").style.display="none";
document.getElementById("activos_a_cargo").style.display="none";

function pass_actual(valor,comprobar)
{
	var totlac=$("#pasactual").val();
	if(totlac.length==0)
	{
		$("#pas_Actual").html("Escriba su contraseña actual");
		//document.getElementById('newpass').disabled=true;	
		$("#newpass").prop('disabled', true);
		$("#newpass").focus();
//$("input").prop('disabled', false);
	}
	
	else
	{
		var paswordactual=$("#pasactual").val();
		if(paswordactual.length >= 8)
		{
			$('#loadpassactual').css("display", "inline");
			$('#pas_Actual').fadeOut(1500);
		
			var result="#pas_Actual";
			var variable_post=valor;
			var variable_postz=comprobar;
			
			$.post('script/verificar_pass_personal.php', { variable: variable_post, variable2: variable_postz }, function(data){
			$(result).html(data);
			//cierra el loading despues de cargar 
			//$("#cargando2").css("display", "none");
			$(result).fadeIn(1500);
			$("#loadpassactual").css("display", "none");
			$('#pas_Actual').fadeIn(1500);
			if(document.getElementById("ok_useract").value=="suse")
			{
			
				//document.getElementById('newpass').disabled="";
				$("#newpass").prop('disabled', false);
				$("#newpass").focus();
				$("#pasactual").prop('disabled', true);
				$("#pasactual").addClass("cajatextodisabled")
				
			}
			else
			{
				$("#newpass").prop('disabled', true);
			}
		
			});
			
		}
	//alert(totlac.length);
	}
	valtres()//verifica los tres campos
	
}

function val_n_pass()
{
	
	var paswd=$("#newpass").val();
		if (paswd.length >= 8 && paswd.match(/[A-Z]/) && paswd.match(/[A-Z]/) && paswd.match(/\d/)) 
		{
			$("#pas_nuevo").html('<img src="imag/s_success.png">');
			$("#confirpass").prop('disabled', false);
			//$("#confirpass").focus();
		}
		else
		{
			$("#pas_nuevo").html('La nueva contraseña debe tener almenos 8 caracteres, Almenos 1 letra, Almenos una mayúscula y Almenos 1 número ');
			$("#confirpass").prop('disabled', true);
		}

valtres()//verifica los tres campo	
}

function val_confirpass()
{
	if($("#confirpass").val()==$("#newpass").val())
	{
		$("#guardar2").fadeIn(800);
		$("#pas_confirm").html('<img src="imag/s_success.png">');
	}
	else
	{
		$("#pas_confirm").html('No coinciden la confirmación de la contraseña');
		$("#guardar2").css("display","none");
	}
valtres()//verifica los tres campo

}

function validar_usuario() {
	
    $('input[type=password]').keyup(function() {
        // set password variable
        var pswd = $(this).val();
        //validate the length
        if ( pswd.length < 8 ) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }

        //validate letter
        if ( pswd.match(/[A-z]/) ) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validate capital letter
        if ( pswd.match(/[A-Z]/) ) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validate number
        if ( pswd.match(/\d/) ) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }

    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });

}


function Entrada_pestanias(objeto)
{
$("#mi_perfil, #cambiar_contrasenia, #configuraciones, #activos_a_cargo,#guardar2").css('display','none');
document.getElementById("fomulariookpas").reset();
$(objeto).fadeIn(1000);	
$("#newpass").prop('disabled', true);
$("#confirpass").prop('disabled', true);
/*document.getElementById(objeto).style.display='none';
	var objetoA="#"+objeto;
$(objetoA).fadeIn(tiempo);*/
}
// fin 3.
//salvar cambios
function salvar_cambios(cambio)
{
			var result="#solved_npwd";
			$(result).html('<img src="imag/loading2.gif" height="24" width="24" >');
			var variable_y=$("#newpass").val();
			
			var variable_z=cambio;
			
			$.post('script/actualizar_pass_usuario.php', { variable2: variable_y, variable: variable_z }, function(data){
			$(result).html(data);

			$(result).css("display", "inline");
		
			});
			
}

function salvar_cambios_perfil(cambioz)
{

 var url = "script/actualizar_datos_perfil.php"; // El script a dónde se realizará la petición.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#fomulariook").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#solved_perfil").html(data); // Mostrar la respuestas del script PHP.
           }
         });

    return false; // Evitar ejecutar el submit del formulario.
 
 /*var result="#solved_perfil";
			$(result).html('<img src="imag/loading2.gif" height="24" width="24">');
			var variable_y=$("#newpass,").val();
			dirdomicilio
correopersonal
movil1
movil2
movil3
telfcasa
			var variable_z=cambio;
			
			$.post('script/actualizar_pass_usuario.php', { variable2: variable_y, variable: variable_z }, function(data){
			$(result).html(data);
			$(result).css("display", "inline");
			});*/
}

function valtres()
{
	var verifica1=document.getElementById('ok_useract').value;

	var verifica2=$("#newpass").val();
	
	if(verifica1=="suse" && verifica2.length >= 8 && verifica2.match(/[A-Z]/) && verifica2.match(/[A-Z]/) && verifica2.match(/\d/) && $("#confirpass").val()==$("#newpass").val())
	{
		$("#guardar2").fadeIn(800);
	}
	else
	{
		$("#guardar2").css("display","none");
	}
}
</script>

