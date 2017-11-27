<?php 
include("../../conf.php");
$id =$_POST["variable"];
	
	
$querydepadre=mysql_query("select * from th_distributivo_per where id_personal='$id' ")or die("Error: ".mysql_error()) ;	
 	
$reg_cu= mysql_fetch_array($querydepadre);		
?>

<table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr >
    <td width="167" align="right"><strong>Mod. Contrato</strong></td>
    <td width="457">
    <input type="text" readonly name="mod_contrato_ac" value="<?php echo $reg_cu["mod_contrato"];?>">
    </td>
  </tr>
  <tr> 
    <td align="right"><strong>Denominación de Puesto</strong></td>
    <td><input type="text" readonly name="puestoactual" id="puestoactual" value="<?php echo $reg_cu["denominacion_puesto"];?>">
   
    </td>
  </tr>
  <tr>
    <td align="right"><strong>Rol de Puesto</strong></td>
    <td>
    <input type="text" name="rol_de_puesto_ac" id="rol_de_puesto_ac" readonly style="width:250px" value="<?php echo $reg_cu["rol_de_puesto"];?>">
    </td>
  </tr>
  <tr>
    <td align="right"><strong>R.M.U</strong></td>
    <td>
    <input type="text" name="rmu_ac" value="<?php echo $reg_cu["rmu"];?>" id="rmu_ac" readonly >
    </td>
  </tr>
   <tr>
    <td align="right"><strong>N°- Partida</strong></td>
    <td>
    <input type="text" name="partida" value="<?php echo $reg_cu["partida"];?>" id="partida" readonly style="width:250px">
    </td>
  </tr>
   <tr>
    <td align="right"><strong>Fecha de Ingreso</strong></td>
    <td>
    <input type="text" value="<?php echo $reg_cu["fecha_ing"];?>" name="fecha_ing_ac" id="fecha_ing_ac" placeholder="aaaa-mm-dd" readonly>
    </td>
  </tr>
</table>
