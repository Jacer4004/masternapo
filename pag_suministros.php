<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
   
</head>

<div class="ventanas" id="nuevo" style="width:98%;display:none">
<h3 id="<?php echo $colorfondo?>"align="center">Registro de Suminstros de Impresión .</h3>

<form name="nuevoactivo" id="fomulariook" class="formularios" onSubmit="javascript:js_general('g_suministros','color_cyan','<?php echo $tiempo_cookie;?>')" method="post">
    <table width="433" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="175" align="right">Código : </td>
    <td width="258">
    <input type="text" class="requerido" id="codigo" name="codigo" size="40" title="Ingrese el código del activo" required> </td>
  </tr>
  <tr>
    <td align="right">Nombre del Suministro:</td>
    <td><input type="text" name="nombre" id="nombre" size="40" class="requerido" required></td>
  </tr>
  <tr>
    <td align="right">Marca:</td>
    <td><input type="text" name="marca" id="marca" size="40" required></td>
  </tr>
  <tr>
    <td align="right">Cantidad:</td>
    <td><input type="text" name="cantidad" id="cantidad" size="40" required style="width:70px; text-align:right"></td>
  </tr>
  <tr>
    <td align="right">Valor Unitario:</td>
    <td><input type="text" name="vunitario" id="vunitario" size="40" required style="width:70px; text-align:right"></td>
  </tr>
  <tr>
    <td align="right">Valor Total:</td>
    <td><input type="text" name="vtotal" id="vtotal" size="40" required style="width:70px; text-align:right"></td>
  </tr>
  
  <tr>
    <td align="right">Presentación:</td>
    <td>
    <select name="presentacion" id="presentacion" required>
     	<option	value="Unidad">Unidad</option>
        <option	value="Libras">Libras</option>
        <option	value="Gramos">Gramos</option>
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
    <td align="right" valign="top">Otros Datos:</td>
    <td><textarea name="otros" id="otros" style="width:250px"></textarea></td>
  </tr>
</table>

<br>
<div align="center" style="text-align:center">
<input type="submit" class="boton color_btn_azul" value="Guardar" >

&nbsp;&nbsp;&nbsp;<input class="boton color_btn_rojo" type="button" value="Cancelar" onClick="javascript:cerrar_abrir('nuevo','contenedor');"> 
&nbsp;&nbsp;&nbsp;<input type="reset" class="boton color_btn_purpura" value="Limpiar" >
</div>
 </form>
</div>
<div id="paginasuministros" style="display:none">
<?php include_once("pag_suministros_entrega.php"); ?>
</div>
 

<div class="ventanas" id="contenedor" >

<h3 id="<?php echo $colorfondo?>" align="center">Suministros </h3>
<div class="menu_exploracion">
    
    <a href="inicio.php" onClick="javascript:js_general('mod_suministros','<?php echo $colorfondo?>');"><img style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a>
    <?php if (in_array("M4SUMIMPRan", $accesos)) {?>
    <a href="#" onClick="javascript:cerrar_abrir('contenedor','nuevo'); document.forms.fomulariook.reset();" ><img style="vertical-align:middle;" src="imag/add.png"> Nuevo </a><?php }?>
    <?php if (in_array("M4SUMIMPRes", $accesos)) {?>
    <a href="#" onClick="javascript:cerrar_abrir('contenedor','paginasuministros');" ><img style="vertical-align:middle;" src="imag/entregar2.png"> Entregar </a><?php }?>
    <?php if (in_array("M4SUMIMPRret", $accesos)) {?>
    <a href="#" onClick="javascript:js_general('pag_suministros_resumen','');location.reload();" ><img style="vertical-align:middle;" src="imag/ver2.png"> Revisar Transacción </a><?php }?>
    <?php if (in_array("M4SUMIMPRrep", $accesos)) {?>
    <a href="#" onClick="javascript:js_general('pag_suministros_reportes','');location.reload();" ><img style="vertical-align:middle;" src="imag/report.png"> Reportes </a><?php }?>
    
  </div><br><br>


<div id="buscar" style="display:inline-block; width:100% !important">
  <form style="margin-right:20px; text-align:center; margin-bottom:5px;" name="" >
    <input id="buscadorver" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:30px; " type="text" name="buscarver">&nbsp;&nbsp;
    </form>
<br>

  <table align="center" id="reportver" width="97%" style="font-size:14px;" >
  <thead>
        <tr>
            <th align="center" valign="middle">Código</th>
            <th>Suministros</th>
            <th align="center" valign="middle"><span style="text-align:center">Stock</span></th>
            <th>&nbsp;</th>
            <th width="10">&nbsp;</th>
        </tr>
  </thead>
      <tbody>
<?php 
$sqlver=mysql_query("select * from inv_suministros",$conectar);
  while($registrosver=mysql_fetch_array($sqlver))
  {
	  $aniover=date("Y", strtotime($registrosver["fechaadquisicion"]));
	  $idsuministrover=$registrosver["id_invsuministros"];
  ?>        
        <tr id="buscaraqui" >
            <td><?php echo $aniover." - ".$registrosver["cod_bodega"]; ?></td>
            <td><?php echo $registrosver["suministro"]; ?></td>
            <td align="center" valign="middle"><?php echo $registrosver["stock"]." / ".$registrosver["cantidad"]; ?></td>
            <td>&nbsp;</td>
            <td><div class="arrowver"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="5">
            
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
                <img src="imag/tintas.png" height="72"  width="75" alt="Foto del Usuario" />
                <h4>Descripción completa del Suministro: <?php echo $registrosver["suministro"]." - ".$registrosver["marca"] ; ?></h4>
                <ul>
                    <li><strong>Marca:</strong> <?php echo $registrosver["marca"]; ?></li>
                    <li><strong>Stock:</strong> <?php echo $registrosver["stock"]; ?> de <?php echo $registrosver["cantidad"]; ?></li>
                    <li><strong>Fecha de Compra:</strong> <?php echo $registrosver["fechaadquisicion"]; ?><br>
                    </li>
                    <li><strong>Valor Unitario:</strong> <?php echo $registrosver["val_uni"]; ?><br>
                    </li>
                    <li><strong>Valor Total:</strong> <?php echo $registrosver["val_total"]; ?><br>
                    </li>
                </ul>
               <strong> Entregados</strong>
      <div style="margin:10px;">
      
 		<ul>
        <?php 
		
		$sqlentregadosver="select inv_sum_entregados.cantidad entrecantidad,gad_dependencia.nombre,inv_sum_entregados.fecha,gad_personal.tratamiento,gad_personal.nombres, gad_personal.apellidos,inv_sum_actas.nacta  from inv_sum_entregados
inner join inv_suministros on inv_sum_entregados.id_suministro=inv_suministros.id_invsuministros
inner join gad_personal on inv_sum_entregados.id_personal=gad_personal.id_personal
inner join gad_dependencia on inv_sum_entregados.id_dependencia=gad_dependencia.id_dependencia
inner join inv_sum_actas on inv_sum_entregados.n_transaccion=inv_sum_actas.n_transaccion
where id_suministro='$idsuministrover' order by nombre,fecha";

$queryentregadosver=mysql_query($sqlentregadosver,$conectar)or die("ERROR_");
		while($registroentregadosver=mysql_fetch_array($queryentregadosver))
		{
		?>
        	<li><?php echo $registroentregadosver["entrecantidad"]." | ".$registroentregadosver["fecha"]." | ".$registroentregadosver["nombre"]." (".$registroentregadosver["tratamiento"]." ".$registroentregadosver["nombres"]." ".$registroentregadosver["apellidos"].") - Acta N°- ".$registroentregadosver["nacta"]; ?></li>
            
        <?php 
		}
		?>
        
        </ul>
        
   	  </div>
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
<script>


document.getElementById('nuevo').style.display="none";
document.getElementById('paginasuministros').style.display="none";


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
	$(document).ready(function(){
            $("#reportver tr:odd").addClass("odd");
            $("#reportver tr:not(.odd)").hide();
            $("#reportver tr:first-child").show();
            
            $("#reportver tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
			      
				  $(document).ready(function(){
	// ejecuta la funcion al  momento que alza la tecla
	$("#buscadorver").keyup(function(){
		// ejecuta cuando el valor no es vacio
		if( $(this).val() != "")
		{
			// oculta todo y muestra solo los resultados, oculta la inf. adicional
			$("#reportver tbody>tr").hide();
			$("#reportver td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			$("#reportver tbody>#nobuscaraqui").hide();
		}
		else
		{
			// cuanto esta vacion la caja de buscar muestra todo menos la inf. adicional
			
			$("#reportver tbody>tr").show();
			$("#reportver tbody>#nobuscaraqui").hide();
		}
	});
});
// jQuery expresion de buscar
$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});
//fin 5. 

				  
				  
				    </script>
                    <style>
                    
                    /********************ESTILO PARA LAS TABLAS QUE MUESTRA EL CONTENIDO Y SU DETALLE**************/
     
        #reportver { border-collapse:collapse;}
        #reportver h4 { margin:0px; padding:0px;}
        #reportver img { float:right;}
        #reportver ul { margin:10px 0 10px 40px; padding:0px;}
        #reportver th { background:#7CB8E2  repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #reportver td { background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #reportver tr.odd td { background:#fff url(../row_bkg.png) repeat-x scroll bottom left; cursor:pointer; }
		
        #reportver div.arrow { background:transparent url(../arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #reportver div.up { background-position:0px 0px;}
		
		

                    </style>
