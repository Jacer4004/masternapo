<?php 
include_once("../../conf.php");
?>
<style>
    ol {
        counter-reset: li; /* Inicia el contador */
        list-style: none; /* Elimina el número por defecto */
        *list-style: decimal; /* Continúa usando el número por defecto en IE6/7 */
        font: 15px 'trebuchet MS', 'lucida sans';
        padding: 0;
        margin-bottom: 4em;
        text-shadow: 0 1px 0 rgba(255,255,255,.5);
    }
     
    ol ol {
        margin: 0 0 0 2em; /* Añade un poco de margen izquierdo */
    }
    .rounded-list a{
        position: relative;
        display: block;
        padding: .4em .4em .4em 2em;
        *padding: .4em;
        margin: .5em 0;
        background: #ddd;
        color: #444;
        text-decoration: none;
        border-radius: .3em;
        transition: all .3s ease-out; 
		cursor:pointer; 
		text-align:left;  
    }
     
    .rounded-list a:hover{
        background: #eee;
    }
     
    .rounded-list a:hover:before{
        /*transform: rotate(360deg); */
		cursor:pointer; 
		
    }
     
    .rounded-list a:before{
        content: counter(li);
        counter-increment: li;
        position: absolute; 
        left: -1.3em;
        top: 50%;
        margin-top: -1.3em;
        background: #87ceeb;
        height: 2em;
        width: 2em;
        line-height: 2em;
        border: .3em solid #fff;
        text-align: center;
        font-weight: bold;
        border-radius: 2em;
        transition: all .3s ease-out;
    }
</style>
<div id="contenidosreportesdis" >
<form name="reportes_ok" id="reportes_ok" target="SGTREPORTES"  method="get" action="mod_talento_humano/reportes/distributivo.php" >

<table width="407" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td width="129" align="right"><strong>Dsitributivo</strong></td>
    <td width="278">
      
      <select style="width:270px !important" name="id_distributivo" id="id_distributivo" onChange="cargar_general(id_distributivo.value,'mod_talento_humano/script/cbo_dependencias_distr.php','cargaraquidep');">
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
    <td align="right"><strong>Dependencias</strong></td>
    <td>
      <div id="cargaraquidep">
        <select name="id_distributivo_dep" id="id_distributivo_dep" style="width:270px !important">
          <option value="todos">Todos</option>
          
          </select>
        </div>
    </td>
    </tr>
    <tr>
    <td align="right"><strong>Nivel Estructural</strong></td>
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
      <td align="right"><strong>Tipos de Contrato</strong></td>
      <td align="left"><select name="mod_contrato" id="mod_contrato" style="width:270px">
        <option value="todos">Todos</option>
        <?php 
		$querynivel=mysql_query("select * from gad_tipocontrato",$conectar)or die("Error ".mysql_error());
		while($regnivel=mysql_fetch_array($querynivel))
		{
		?>
        <option value="<?php echo $regnivel["nom_tipocontrato"]?>">
          <?=$regnivel["nom_tipocontrato"]?>
          </option>
        <?php 
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="center"><strong>Cargos Laborales</strong></td>
      <td align="left"><select name="mod_cargo" id="mod_cargo" style="width:270px">
        <option value="todos">Todos</option>
        <?php 
		$querynivel=mysql_query("select * from gad_cargos",$conectar)or die("Error ".mysql_error());
		while($regnivel=mysql_fetch_array($querynivel))
		{
		?>
        <option value="<?php echo $regnivel["cargo"]?>">
          <?=$regnivel["cargo"]?>
          </option>
        <?php 
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><ol class="rounded-list">
        <li><a href="javascript:void()" onClick="enviar_ventana('mod_talento_humano/reportes/distributivo.php','#reportes_ok')" >Nómina General</a></li>
    <li><a href="javascript:void()" onClick="enviar_ventana('mod_talento_humano/reportes/nomina_general.php','#reportes_ok')">Nómina y Firmas</a></li>
    <li><a href="javascript:void()" onClick="enviar_ventana('mod_talento_humano/reportes/nomina_genero.php','#reportes_ok')">Distribución por Genero</a></li>
    <li><a href="javascript:void()" onClick="enviar_ventana('mod_talento_humano/reportes/nomina_modcontrato.php','#reportes_ok')">Distribución total por Tipos de Contratos</a></li>
</ol></td>
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

function enviar_ventana(pagina,formulario)
{
	var parametros = $(formulario).serialize()+ '&activate=true';
	var opciones="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=yes";

ventana=window.open(pagina+'?'+parametros,"Servicios_Reportes",opciones);
ventana.focus();
}



</script>