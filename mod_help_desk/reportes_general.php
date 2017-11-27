<?php 
include("../conf.php");
$idusuario=$_SESSION['userid'];
$querypersonaldep=mysql_query("select gad_personal.id_dependencia from gad_personal
where gad_personal.id_personal='$idusuario'",$conectar);

$regpersonaldep=mysql_fetch_array($querypersonaldep);

$idusuariodepe=$regpersonaldep["id_dependencia"];
$queryusuariosdepe=mysql_query("select gad_personal.id_personal, concat_ws(' ',gad_personal.tratamiento,gad_personal.nombres ,gad_personal.apellidos ) as nominapersona from gad_personal
where gad_personal.id_dependencia='$idusuariodepe'",$conectar);


?>

<div id="contenidosreportesdis" >
<form name="reportes" target="SGTREPORTES"  method="get" action="mod_help_desk/reportes/misincidentes_filtrado.php"  class="formularios">
<table width="407" border="0" align="center" cellpadding="0" cellspacing="3">
 <tr>
    <td colspan="2"><br>

    <!--<a href="#" class="botocuadrado color_naranja" onClick="window.open('mod_help_desk/reportes/misincidentes_filtrado.php','SGTREPORTES','width=800,height=600,menubar=Yes,scrollbars=Yes,top=10, left=10')">Mis Atenciones</a>-->
   </td>
    </tr>
  <tr>
    <td width="129"><strong>Asistente</strong></td>
    <td width="278">
      
      <select style="width:270px !important" name="id_usasistente" id="id_usasistente">
        <option value="">Todos</option>
        <?php 
		
			
			while($regusudepeasis=mysql_fetch_array($queryusuariosdepe))
			{
		?>
        <option value="<?php echo $regusudepeasis["id_personal"];?>"><?php echo $regusudepeasis["nominapersona"];?></option>
        <?php 
			}
		?>
        </select>
      
    </td>
    </tr>
    
    <tr>
    <td width="129"><strong>Tipo Insidencia</strong></td>
    <td width="278">
      
      <select style="width:270px !important" name="id_incidencia" id="id_incidencia">
        <option value="Todos">Todos</option>
        <?php 
		
			$querydistr=mysql_query("select * from gad_tipoinsidencia order by tiponombre desc",$conectar);
			while($regconectar=mysql_fetch_array($querydistr))
			{
		?>
        <option value="<?php echo $regconectar["tiponombre"];?>"><?php echo $regconectar["tiponombre"];?></option>
        <?php 
			}
		?>
        </select>
      
    </td>
    </tr>
    
  <tr>
    <td><strong>Fecha desde</strong></td>
    <td>
      <input type="text" name="idesde" id="idesde"  class="">
    </td>
    </tr>
    <tr>
    <td><strong>Fecha hasta</strong></td>
    <td>
      <div id="nivelestructural">
        <input type="text"  name="ihasta" id="ihasta" class="">
      </div>
    </td>
    </tr>
  <tr>
    <td colspan="2" align="center"><br>

    <input type="submit" value="Continuar" class="botocuadrado color_naranja" onClick="abreemergente();">
   
    </td>
    </tr>
    
</table>
<br>

</form>
</div>
<script>
function abreemergente()
{
	
   /* win = window.open('','myWin','toolbars=0');            
   document.myForm.target='myWin';
   document.myForm.submit();*/
	
window.open('mod_help_desk/reportes/misincidentes_filtrado.php', 'SGTREPORTES', 'width=800,height=700,menubar=Yes,scrollbars=Yes,top=10, left=10');
    document.login.setAttribute('target', 'SGTREPORTES');
    document.login.setAttribute('onsubmit', '');
    document.login.submit();
	window.focus();
}


            // calnedario bootstrap
            $(document).ready(function () {
                
                $('#idesde').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
				
				 $('#ihasta').datepicker({
                    format: "yyyy-mm-dd",
					autoclose:true
                });  
            });

</script>