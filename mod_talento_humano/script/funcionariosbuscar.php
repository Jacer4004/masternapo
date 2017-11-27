<?php 
#funcionarios del gad para heldesk
include_once("../../conf.php");
$funcioanrios=mysql_query("select gad_personal.cedula,concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres,gad_personal.apellidos)as nomina,gad_personal.id_personal,gad_dependencia.nombre from gad_personal 
left join gad_dependencia on gad_personal.id_dependencia=gad_dependencia.id_dependencia
",$conectar)or die("ERROR");
#where gad_personal.per_estado='activo'
?>

<script>
	////////////////***************++++++BUSCAR DENTRO DE UNA TABLA******//

$(document).ready(function(){
	// Write on keyup event of keyword input element
	$("#buscarfuncionarioins").keyup(function(){
		// When value of the input is not blank
		if( $(this).val() != "")
		{
			// Show only matching TR, hide rest of them
			$("#tblbuscado tbody>tr").hide();
			$("#tblbuscado td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("#tblbuscado tbody>tr").show();
		}
	});
});
// jQuery expression for case-insensitive filter
$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

//////HASTA A QUI BUSCAR EN UNA TABLA**/
</script>

<div style="background:rgba(255,255,255,1.00); padding:10px; padding-left:20px; padding-right:20px;" >
<div align="left" class="menu_exploracion">
<a href="#" onClick="$('#fun_heldesk').fadeOut(800);"><img  style="vertical-align:middle" src="imag/cancel.png" title="Cancelar" onClick="javascript:obtenertamanio();"></a>
Buscar: <input id="buscarfuncionarioins" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; vertical-align:middle " type="text" name="buscar"></div>
<br>
<br>


<div style="height:200px; overflow:scroll">
<table width="95%" border="1" id="tblbuscado">
<thead>
  <tr>
    
    <th width="76" align="center"><strong>CÉDULA</strong></th>
    <th width="383" align="center"><strong>FUNCIONARIO</strong></th>
    <th width="245" align="center"><strong>ÚLTIMA DEPENDENCIA</strong></th>
    <th width="68" align="center">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  while($regfuncionario=mysql_fetch_array($funcioanrios))
  {
	  $contarok=$contarok+1;
  ?>
  <tr>
    
    <td><?php echo $regfuncionario["cedula"];?></td>
    <td><?php echo $regfuncionario["nomina"];?></td>
    <td><?php echo $regfuncionario["nombre"];?></td>
    <td><input type="button" id="atendersolicitud" class="boton color_btn_azul" value="Aceptar" style=" padding:3px !important" onClick="$('#funcionario').val('<?php echo $regfuncionario["nomina"];?>');$('#id_personal').val('<?php echo $regfuncionario["id_personal"];?>'); $('#fun_heldesk').fadeOut(800);"><input type="hidden" name="funcionariodata" value="<?php echo $regfuncionario["nomina"];?>" ></td>
  </tr>
  <?php 
  }
  ?>
  <tbody>
</table>
</div>
</div>
