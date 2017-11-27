<?php 
$sqlactivos=mysql_query("select * from ac_equipos",$conectar);
?><head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
   
</head>

<div class="ventanas" id="nuevo" style="width:600px">
<h3 id="<?php echo $colorfondo?>"align="center">Registro de Activo </h3>

<form name="nuevoactivo" id="fomulariook" class="formularios">
       	  <table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="152" align="right">Código de Activo: </td>
    <td width="248"><input type="text" class="requerido" name="codigo" size="40" title="Ingrese el código del activo" required> </td>
  </tr>
  <tr>
    <td align="right">Nombre:</td>
    <td><input type="text" name="nombre" size="40" class="requerido" required></td>
  </tr>
  <tr>
    <td align="right">Marca:</td>
    <td><input type="text" name="marca" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Modelo:</td>
    <td><input type="text" name="modelo" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Serie:</td>
    <td><input type="text" name="serie" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Estado:</td>
    <td>
    <select name="estado" required>
     	<option	value="Bueno">Bueno</option>
        <option	value="Regular">Regular</option>
        <option	value="Malo">Malo</option>
    </select>
    
    </td>
    
     <tr>
    <td align="right">Fecha de Registro:</td>
    <td>
    <input type="text" name="fecharegistro"  id="fecharegistro" placeholder="aaaa-mm-dd" required>
    
    </td>
    <tr>
    <td align="right">Fecha de Adquisición:</td>
    <td>
    <input type="text" name="fechacompra"  id="fechaadd" placeholder="aaaa-mm-dd" required>
    
    </td>
    
     <tr>
    <td align="right">Procedencia:</td>
    <td>
    <select name="procedencia" required>
     	<option	value="Existente">Existente</option>
        <option	value="Compra">Compra</option>
        <option	value="Renovación">Renovación</option>
    </select>
    
    </td>
  </tr>
  <tr>
    <td align="right" valign="top">Componentes:</td>
    <td style="padding:5px"><!--<textarea name="componentes"></textarea>-->
    <a href=""><img src="imag/add2.png"></a>
    <div>
    	Nombre:<input type="text" name="componente">
    </div>
    </td>
  </tr>
  <tr>
    <td align="right">Otros datos:</td>
    <td><textarea name="otros"></textarea></td>
  </tr>
</table>
<br>
<br>
<div align="center" style="text-align:center">
<input type="submit" class="boton color_btn_azul" value="Guardar" onClick="javascript:enviar_datos('fomulariook','g_activos.php','mensajes')">

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>

        </form>
        
<br>

</div>

<div class="ventanas" id="contenedor" >
<h3 id="<?php echo $colorfondo?>"align="center">Activos </h3>
    <div>
    <a href="#" class="boton color_btn_azul" onClick="javascript:cerrar_abrir('contenedor','nuevo'); document.forms.fomulariook.reset();" ><img style="vertical-align:middle; margin-right:7px;" src="imag/add.png">Nuevo</a>
    <form style="display:inline; float:right; margin-right:20px;" name="" >
    <input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:30px; " type="text" name="buscar"></form>
    </div>
<br>



<div class="" style="margin:10px;" align="center">
  <table align="center" id="report" width="100%">
  <thead>
        <tr>
            <th>Código Activo</th>
            <th>Descripción</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th width="10">&nbsp;</th>
        </tr>
  </thead>
  <tbody>      
<?php 
  while($regactivo=mysql_fetch_array($sqlactivos))
  {
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $regactivo["codigoactivo"]; ?></td>
            <td><?php echo $regactivo["nombre"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="5">
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
                <img src="imag/pc_escritorio_2.jpg" height="128"  width="128" alt="Foto del Usuario" />
                <h4>Descripción completa del Activo: <?php echo $regactivo["nombre"]." - ".$regactivo["marca"] ; ?></h4>
                <ul>
                    <li><strong>Marca:</strong> <?php echo $regactivo["marca"]; ?></li>
                    <li><strong>Modelo:</strong> <?php echo $regactivo["modelo"]; ?></li>
                    <li><strong>Serie:</strong> <?php echo $regactivo["serie"]; ?></li>
                    <li><strong>Estado:</strong> <?php echo $regactivo["estado"]; ?></li>
                    <li><strong>Fecha de Registro:</strong> <?php echo $regactivo["fecha_registro"]; ?></li>
                    <li><strong>Procedencia:</strong> <?php echo $regactivo["procedencia"]; ?></li>
                    <li><strong>Otros:</strong> <?php echo $regactivo["otros"]; ?></li>
                 </ul>   
               <input type="button" value="Editar" class=" boton_pequenio color_btn_verde">
               <input type="button" value="Eliminar" class=" boton_pequenio color_btn_rojo">
               
               </div>
            </td>
        </tr>
 <?php 
  }
  ?>       
      </tbody> 
       
  </table>
</div>


<script>


document.getElementById('nuevo').style.display="none";


</script>
<script type="text/javascript">
            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#fecharegistro').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
			$(document).ready(function () {
                
                $('#fechaadd').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>