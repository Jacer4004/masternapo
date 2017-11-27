<link href="estilos/css.css" rel="stylesheet" type="text/css">

<div class="ventanas" id="veracta" style="width:98%" align="left">
<h3 id="<?php echo $colorfondo?>"align="center">Reportes de Suministros</h3>
<div align="center" style="text-align:center">
<div align="center" class="menu_exploracion" style="margin-bottom:5px; text-align:center">
<a href="inicio.php" onClick="javascript:js_general('pag_suministros','<?php echo $colorfondo?>');"><img  style="vertical-align:middle" src="imag/atras.png" ></a>
<a href="#" onClick="javascript:mostrar_tabuladores('this','entregados')" title="Entregados por fechas"><img  style="vertical-align:middle" src="imag/calendario.png"></a>
<a href="#" onClick="javascript:mostrar_tabuladores('this','stock')" title="Revisar Stock por fechas de adquisición"><img  style="vertical-align:middle" src="imag/stock.png"></a>
<a href="#" onClick="javascript:mostrar_tabuladores('this','buscar')" title="Buscar por suministros entregados"><img  style="vertical-align:middle" src="imag/buscar3.png"></a>

</div>
</div>

<div align="center">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="371" align="center" valign="top" style="padding-left:20px;">
    <div class="contenido_menu" id="contenido_menu">
    	<div class="">
   
  <div id="entregados" style="display:inline-block">
  <h4>CONSULTA DE TONER ENTREGADOS POR FECHAS</h4>
  <form action="reportes/inv_sum_entregados.php" target="_blank" method="post">
  Desde: 
  
  <input id="fedesde" name="fedesde" type="text" class="cajas_text"> 
  Hasta: 
  <input id="fhasta" name="fhasta" type="text" class="cajas_text">
   <input type="submit" value="Ver" class="boton_pequenio color_btn_verde">
   </form>
   </div>
   <div id="stock" style="display:inline-block">
   <h4>CONSULTA DE STOCK POR FECHA DE ADQUISICIÓN</h4>

<form action="reportes/inv_sum_stock.php" target="_blank" method="post">
   Fecha de Adquisición desde:&nbsp;&nbsp;
   <select name="fechaadquisiciondesde" class="cajas_text">
  <?php 
  $sql_fechas=mysql_query("SELECT DISTINCT fechaadquisicion FROM inv_suministros",$conectar)or die("ERROR_");
  while($reg_fecha=mysql_fetch_array($sql_fechas))
  {
  ?>
  	<option value="<?php echo $reg_fecha["fechaadquisicion"]?>"><?php echo date("Y", strtotime($reg_fecha["fechaadquisicion"])).": ".$reg_fecha["fechaadquisicion"]?></option>
    
   <?php 
  }
   ?>
  </select> 
   hasta 
   <select name="fechaadquisicionhasta" class="cajas_text">
     <?php 
  $sql_fechas=mysql_query("SELECT DISTINCT fechaadquisicion FROM inv_suministros",$conectar)or die("ERROR_");
  while($reg_fecha=mysql_fetch_array($sql_fechas))
  {
  ?>
     <option value="<?php echo $reg_fecha["fechaadquisicion"]?>"><?php echo date("Y", strtotime($reg_fecha["fechaadquisicion"])).": ".$reg_fecha["fechaadquisicion"]?></option>
     <?php 
  }
   ?>
   </select>
   <input type="submit" value="Ver" class="boton_pequenio color_btn_verde"> 
</form>

  </div>
  
  <div id="buscar" style="display:inline-block">
   <h4>BUSCAR</h4>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<form style="margin-right:20px; text-align:center; margin-bottom:5px;" name="" >
    <input id="buscador" placeholder="Buscar..." class="cajas_texto_buscar" style="width:350px; height:30px; " type="text" name="buscar">&nbsp;&nbsp;
    <input type="button" class="boton color_btn_rojo" value="Cancelar" onClick="javascript:cerrar_abrir('formulario_Agregar','formulario_suministros');">
    </form>
<?php 
include_once("conf.php");
$sql=mysql_query("select * from inv_suministros",$conectar);
?>
  <table align="center" id="report" width="97%" style="font-size:14px;" >
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
	  $idsuministro=$registros["id_invsuministros"];
  ?>        
        <tr id="buscaraqui" >
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
                    <li><strong>Marca:</strong> <?php echo $registros["marca"]; ?>; <strong>Stock:</strong> <?php echo $registros["stock"]; ?> de <?php echo $registros["cantidad"]; ?></li>
                    <li><strong>Fecha de Compra:</strong> <?php echo $registros["fechaadquisicion"]; ?><br>
                    </li>
                </ul>
               <strong> Entregados</strong>
   
      
      <div style="margin:10px;">
      
 		<ul>
        <?php 
		
		$sqlentregados="
		select inv_sum_entregados.cantidad entrecantidad,gad_dependencia.nombre,inv_sum_entregados.fecha,gad_personal.tratamiento,gad_personal.nombres, gad_personal.apellidos,inv_sum_entregados.estado from inv_sum_entregados
inner join inv_suministros on inv_sum_entregados.id_suministro=inv_suministros.id_invsuministros
inner join gad_personal on inv_sum_entregados.id_personal=gad_personal.id_personal
inner join gad_dependencia on inv_sum_entregados.id_dependencia=gad_dependencia.id_dependencia
where id_suministro='$idsuministro' order by nombre,fecha";

$queryentregados=mysql_query($sqlentregados,$conectar)or die("ERROR_");
		while($registroentregados=mysql_fetch_array($queryentregados))
		{
		?>
        	<li><?php echo $registroentregados["entrecantidad"]." | ".$registroentregados["fecha"]." | ".$registroentregados["nombre"]." (".$registroentregados["tratamiento"]." ".$registroentregados["nombres"]." ".$registroentregados["apellidos"].") - Estado: ".'<span style="color:rgba(187,10,13,1.00)">'.$registroentregados["estado"].'</span>'; ?></li>
            
        <?php 
		}
		?>
        
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

<!--<iframe  style=" border: " id="preview" name="preview" src="about:blank" frameborder="0" marginheight="0" marginwidth="0"  height="550" width="95%"></iframe>

-->


</div>
<input type="hidden" name="comodin" id="comodin" value="entregados">
<script>



//calendario
$(document).ready(function () {
                
                $('#fedesde').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
$(document).ready(function () {
                
                $('#fhasta').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });

///////////////////////////////////////////////////
$(document).ready(function(){
	//$('#nodata').find(".odd").removeClass("odd");
            
			
            
            $("#nodata tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
			
			$("#nodata tbody tr:odd").removeClass("odd");
			$("#nodata").find(".odd").removeClass("odd");
            $("#nodata tbody tr:not(.odd)").show();
            $("#nodata tbody tr:first-child").show();
            //$("#report").jExpand();
        });
//////////////////////////////////////////////////
//document.getElementById('entregados').style.display="none";
document.getElementById('stock').style.display="none";
document.getElementById('buscar').style.display="none";
document.getElementsByClassName("odd").className="escogido";

function mostrar_tabuladores(actual,mostrar)
{
	var oculta= document.getElementById('comodin').value;
		
	$('#'+oculta).slideUp(300);
	$('#'+mostrar).slideDown(300);
	
	document.getElementById('comodin').value=mostrar;
	
	//$('#'+cambio);
	//$('#'+tabs).fadeIn(300);
	//$(actual).css('display','none');	
}

function removerclaseodd(){
	//$('#nodata').find(".odd").removeClass("odd");

			$("#nodata tr").removeClass("odd");
           
            //$("#report").jExpand();
        }
</script>

<style>
.escogido
{
	
	background:#E13235;
}


</style>