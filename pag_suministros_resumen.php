<link href="estilos/css.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="height:100%">
  <tr>
    <td align="center" valign="top" id="tablaalto">
<div class="ventanas" id="veracta" style="width:98%">
<h3 id="<?php echo $colorfondo?>"align="center">Actas </h3>
<div align="center" class="menu_exploracion" style="width:50%; margin-bottom:5px; text-align:center"><a href="inicio.php" onClick="javascript:js_general('pag_suministros_resumen','<?php echo $colorfondo?>');"><img class="menu_exploracion_atras" style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a>
</div>


<iframe  style=" border: none" id="preview" name="preview" src="about:blank" frameborder="0" marginheight="0" marginwidth="0"  width="95%"></iframe>

</div>

<div class="ventanas" id="contenedor"  >

<h3 id="<?php echo $colorfondo?>" align="center"> Operaciones Realizadas</h3>
<div align="left" class="menu_exploracion"><a href="inicio.php" onClick="javascript:js_general('pag_suministros','');"><img class="menu_exploracion_atras" style="vertical-align:middle" src="imag/atras.png" onClick="javascript:obtenertamanio();"></a>
<input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:25px; float:right; vertical-align:middle; margin-top:1px; " type="text" name="buscar">&nbsp;&nbsp;
</div>


    
    
    <div class="datagrid" style="margin:10px; font-size:10px; width:95%">

<table border="1" cellpadding="0" cellspacing="0" id="tabla_ver_transaccion" width="100%" >
<thead><tr>
  <th width="" style="width:20px" align="center">N° Trans. </th>
  <th width="" style="width:350px" align="center">Sumnistro</th>
  <th width="" align="center">Custodio</th>
  <th width="" align="center">Fecha</th>
  <th width="" align="center">N° Acta</th>
  </tr>
  
  </thead> 
<tbody>
<?php 


$sql_trans=mysql_query("select * from inv_sum_entregados group by n_transaccion order by id_sum_entregados desc",$conectar)or die("Error");
while($reg_trans=mysql_fetch_array($sql_trans))
{
	$id_trans=$reg_trans["n_transaccion"];
		
	$sql_trans_ver=mysql_query("select inv_sum_entregados.*,  concat_ws(' ',gad_personal.nombres,gad_personal.apellidos) as personal,gad_personal.id_personal, gad_personal.tratamiento, gad_personal.puesto, inv_suministros.suministro,gad_dependencia.nombre
from inv_sum_entregados
inner join gad_personal on inv_sum_entregados.id_personal=gad_personal.id_personal
inner join inv_suministros on inv_sum_entregados.id_suministro=inv_suministros.id_invsuministros
inner join gad_dependencia on inv_sum_entregados.id_dependencia=gad_dependencia.id_dependencia
where n_transaccion='$id_trans'",$conectar)or die("Error___");

$n_transaccion=$reg_trans["n_transaccion"];
?>
	<tr style="border:1px solid #E1EEF4; ">
    <td width="20" align="center" style="width:20px"><?php echo $reg_trans["n_transaccion"]?></td>
    <td style="padding:5px">
    <?php 
	$totalfilas=mysql_num_rows($sql_trans_ver);
	while($reg_sum_ver=mysql_fetch_array($sql_trans_ver))
	{
		$usuario= $reg_sum_ver["tratamiento"]." ".$reg_sum_ver["personal"];
		$fecha=$reg_sum_ver["fecha"];
	echo "[".$reg_sum_ver["cantidad"]."] - ".$reg_sum_ver["suministro"]."<br>";
	echo '<ul class="observaciones"  > 
	<li >'.$reg_sum_ver["observaciones"].'</li></ul>';
	 
	if($totalfilas>1){echo "";}
	}
	?>
    </td>
    <td width="" align="left">
	<?php 
	echo $usuario;
	?>
    </td>
    <td width="" align="center">
	<?php 
	echo $fecha;
	?>
    </td>
    <td width="" align="left">
    
    <?php 
	$sql_g_acta=mysql_query("select * from inv_sum_actas where n_transaccion='$n_transaccion'",$conectar)or die("ERROR_");
	$num_acta=mysql_fetch_array($sql_g_acta);
	?>
    <a  title="<?php echo $num_acta["observaciones_estado"];?>"  href="reportes/ver_actas.php?valid=false&acta=<?php echo $num_acta["nacta"];?>" target="preview" onClick="javascript: Ver_Acta();actaulizar_link('<?php echo $num_acta["nacta"];?>');ajustar_a_tamanio('tablaalto','preview')" class="link_simple"><img src="imag/ver.png" width="17" style="vertical-align:middle">&nbsp;&nbsp;<?php 
	$estadotras="";
	if($num_acta["estado"]<>""){$estadotras=' [<span style="color:red">'.$num_acta["estado"]."</span>]";}
	echo $num_acta["nacta"].$estadotras;
	?></a>
	</td>
    
    </tr>
<?php 
}
?>
</tbody>
</table>
</div>
</div>

</td>
  </tr>
</table>
<script>
document.getElementById("veracta").style.display="none";

function Ver_Acta()
{
	
	document.getElementById("veracta").style.display="block";
	document.getElementById("contenedor").style.display="none";	
	ajustar_a_tamanio('tablaalto','preview');
}
///para buscar en la tabla 
$(document).ready(function(){
	// ejecuta la funcion al  momento que alza la tecla
	$("#buscador").keyup(function(){
		// ejecuta cuando el valor no es vacio
		if( $(this).val() != "")
		{
			// oculta todo y muestra solo los resultados, oculta la inf. adicional
			$("#tabla_ver_transaccion tbody>tr").hide();
			$("#tabla_ver_transaccion td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			$("#tabla_ver_transaccion tbody>#nobuscaraqui").hide();
		}
		else
		{
			// cuanto esta vacion la caja de buscar muestra todo menos la inf. adicional
			
			$("#tabla_ver_transaccion tbody>tr").show();
			$("#tabla_ver_transaccion tbody>#nobuscaraqui").hide();
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

function actaulizar_link(valor)
{
	document.getElementById("editar_acta").href = "edit_acta.php?acta="+valor;
}

function ajustar_a_tamanio(objeto_base,objeto_ajustado)
{

//alto_objetobase = document.getElementById('tablaalto').offsetWidth;
alto_objetobase = document.getElementById(objeto_base).offsetHeight;
alto_objetoajustado=document.getElementById(objeto_ajustado).height=alto_objetobase-100;
alert(Objeto_base);
}
</script>
<style>
.observaciones
{
 font-size:11px; color:#2F2DF4;
	margin:0px;
	list-style:square;
	margin-bottom:5px;
}
</style>
