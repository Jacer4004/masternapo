<?php 
include("../../conf.php");
?>

<div id="contenidosreportesdis" >
<form name="reportes" target="SGTREPORTES"  method="get" action="mod_talento_humano/reportes/distributivo.php" >
<table width="407" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td width="129"><strong>Dsitributivo</strong></td>
    <td width="278">
      
      <select style="width:270px !important" name="id_distributivo" id="id_distributivo" onChange="cargar_general(this.value,'mod_talento_humano/script/cbo_dependencias_distr.php','cargaraquidep_general');">
        <option value="">.: Seleccione :.</option>
        <?php 
		
			$querydistr=mysql_query("select * from th_distributivo order by id_distributivo desc",$conectar);
			while($regconectar=mysql_fetch_array($querydistr))
			{
		?>
        <option value="<?php echo $regconectar["id_distributivo"];?>"><?php echo $regconectar["dis_periodo"];?></option>
        <?php 
			}
		?>
        </select>
      
    </td>
    </tr>
  <tr>
    <td><strong>Dependencias</strong></td>
    <td>
      <div id="cargaraquidep_general">
        <select name="id_distributivo_dep" id="id_distributivo_dep" style="width:270px !important">
          <option value="todos">Todos</option>
          
          </select>
        </div>
    </td>
    </tr>
    <tr>
    <td><strong>Nivel Estructural</strong></td>
    <td>
      <div id="nivelestructural">
        <select name="nivelestructural" id="nivelestructural" style="width:270px">
    	<option value="todos">Todos</option>
		<?php 
		$querynivel=mysql_query("select * from gad_nivel",$conectar)or die("Error ".mysql_error());
		while($regnivel=mysql_fetch_array($querynivel))
		{
		?>
        <option value="<?php echo $regnivel["nivel"]?>"><?=$regnivel["nivel"]?></option>
        <?php 
		}
		?>
        
    </select>
        </div>
    </td>
    </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <input type="submit" value="Continuar" class="botocuadrado color_naranja" onClick="abreemergente();">
   
    </td>
    </tr>
    
</table>

</form>
</div>
<script>
function abreemergente()
{
	
   /* win = window.open('','myWin','toolbars=0');            
   document.myForm.target='myWin';
   document.myForm.submit();*/
	
window.open('mod_talento_humano/reportes/distributivo.php', 'SGTREPORTES', 'width=800,height=600,menubar=Yes,scrollbars=Yes,top=10, left=10');
    document.login.setAttribute('target', 'SGTREPORTES');
    document.login.setAttribute('onsubmit', '');
    document.login.submit();
}


</script>