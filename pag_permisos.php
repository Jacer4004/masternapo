<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
</head>




<div class="ventanas" id="contenedor">
<div id="<?php echo $colorfondo?>">
<h3 align="center" id="<?php echo $colorfondo?>">Autorización de Accesos</h3>
</div>
<?php 
$sqlareas_sum=mysql_query("select * from gad_dependencia order by nombre",$conectar) or die("ERROR_");

?>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
   


    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
    <td width="84" align="right">Area: </td>
    <td width="516"><select name="area_" id="area_" onChange="cargarcombo(area_.value,'combos/cb_usuarios_permisos.cbo.php','usuarios_area');document.getElementById('res_permisos').innerHTML='Seleccione un Usuario'">
      <option	value="">.: Seleccione :.</option>
      <?php 
	  while($re_areas_sum=mysql_fetch_array($sqlareas_sum))
	  {
	  ?>
      <option	value="<?php echo $re_areas_sum["id_dependencia"];?>"><?php echo $re_areas_sum["nombre"];?></option>
      
      <?php 
	  }
	  ?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Usuario:</td>
    <td>
  
    <select name="usuarios_area" id="usuarios_area" onChange="cargarcombo(usuarios_area.value,'combos/pag_permisos.pag.php','res_permisos');" >
      <option	value="">.: Seleccione :.</option>
    
    </select></td>
  </tr>
</table>
<br>
<br>
<br>
<br>

<div id="res_permisos">
&nbsp;&nbsp;
</div>

</div>
