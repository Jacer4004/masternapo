<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<div align="center" style="text-align:center">
<div align="left" class="menu_exploracion"><a href="inicio.php" onClick="javascript:js_general('pag_suministros','');"><img  style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a>
<a href="#" onClick="javascript:cerrar_abrir('formulario_Agregar','formulario_suministros');"><img  style="vertical-align:middle" src="imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar">&nbsp;&nbsp;</div>

</div>

<?php 
include_once("conf.php");
$sql=mysql_query("select * from inv_suministros",$conectar);
?>
  <table align="center" id="report" width="100%" >
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
  while($registros=mysql_fetch_array($sql))
  {
	  $anio=date("Y", strtotime($registros["fechaadquisicion"]));
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $anio." - ".$registros["cod_bodega"]; ?></td>
            <td><?php echo $registros["suministro"]; ?></td>
            <td align="center" valign="middle"><?php echo $registros["stock"]." / ".$registros["cantidad"]; ?></td>
            <td>&nbsp;</td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="5">
            <div style="border:1px inset #AFAEAE; border-radius:5px; padding:5px;">
                <img src="imag/tintas.png" height="72"  width="75" alt="Foto del Usuario" />
                <h4>Descripción completa del Suministro: <?php echo $registros["suministro"]." - ".$registros["marca"] ; ?></h4>
                <ul>
                    <li><strong>Marca:</strong> <?php echo $registros["marca"]; ?></li>
                    <li><strong>Cantidad de compra:</strong> <?php echo $registros["cantidad"]; ?></li>
                    <li><strong>Stock:</strong> <?php echo $registros["stock"]; ?></li>
                    <li><strong>Valor Unitario: </strong><?php echo $registros["val_uni"]; ?></li>
                    <li><strong>Valor Total: </strong><?php echo $registros["val_total"]; ?></li>
                    <li><strong>Presentación:</strong><?php echo $registros["presentacion"]; ?></li>
                    <li><strong>Fecha de Registro:</strong> <?php echo $registros["fecharegistro"]; ?></li>
                    <li><strong>Fecha de Compra:</strong> <?php echo $registros["fechaadquisicion"]; ?></li>
                    <li><strong>Otros:</strong> <?php echo $registros["otros"]; ?></li>
                 </ul>
               <input type="button" value="Agregar" class=" boton_pequenio color_btn_azul" onClick="javascript:document.getElementById('addsuministro').reset();cerrar_abrir('formulario_Agregar','formulario_agr_sum'); Pas_val('<?php echo $registros["suministro"]." - ".$registros["marca"] ; ?>','suministro_selecto');Pas_val('<?php echo $registros["id_invsuministros"]; ?>','id_suministro_selecto');cargarcombo('<?php echo $registros["id_invsuministros"]; ?>','combos/cb_cant_suministros.cbo.php','cantidad_selecto');">
              
              </div>
            </td>
        </tr>
 <?php 
  }
  ?>       
  
     </tbody>  
  </table>


