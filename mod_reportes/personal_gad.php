<?php 
$sqlpersonal=mysql_query("select * from gad_personal 
LEFT JOIN gad_dependencia ON gad_personal.id_dependencia=gad_dependencia.id_dependencia
where gad_personal.id_personal !=1",$conectar) or die ("ERROR_");

?><head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>


</head>


<div class="ventanas" id="contenedor" >
  <h3 id="<?php echo $colorfondo?>"align="center">Consulta de datos de Talento Humano </h3>

    
    <div class="menu_exploracion">
	<input id="buscador" placeholder="Buscar: Cédula, Apellidos o Nombres ..." class="cajas_texto_buscar" style="width:350px; height:25px; float:right " type="text" name="buscar">&nbsp;&nbsp;
	
</div>
<br>
<div class="" style="margin:10px; width:100%" align="center">
  <table align="center" id="report" style="width:95%">
  <thead>
        <tr>
            <th>Código</th>
            <th>Funcionario</th>
            <th>Cédula</th>
            <th>Correo</th>
            <th></th>
        </tr>
  </thead>
  <tbody>      
<?php 
  while($regpersonal=mysql_fetch_array($sqlpersonal))
  {
	  $cont=$cont+1;
  ?>        
        <tr id="buscaraqui">
            <td><?php echo $regpersonal["id_personal"]; ?></td>
            <td><?php echo $regpersonal["tratamiento"]." ".$regpersonal["apellidos"]." ".$regpersonal["nombres"]; ?></td>
            <td><?php echo $regpersonal["cedula"]; ?></td>
            <td><?php echo $regpersonal["correo"]; ?></td>
            <td><div class="arrow"></div></td>
        </tr>
        <tr id="nobuscaraqui">
            <td colspan="5"><img src="imag/usuario2.gif"  alt="Foto del Usuario" /><br>

              <h4>Información Adicional del funcionario</h4>
                <ul style="list-style:square">
                    <li><strong style="font-size:13px">ÁREA: </strong><?php echo $regpersonal["nombre"]?></li>
                    <li><strong style="font-size:13px">CARGO: </strong><?php echo $regpersonal["puesto"]?></li>
                    <li><strong style="font-size:13px">CORREO INSTITUCIONAL: </strong><?php echo $regpersonal["correo"]?></li>
                    <li><strong style="font-size:13px">DIRECCIÓN DOMICILIO: </strong><?php echo $regpersonal["dir_domicilio_gp"]?></li>
                    <li><strong style="font-size:13px">CORREO PERSONAL: </strong><?php echo $regpersonal["correo_per_gp"]?></li>
                    <li><strong style="font-size:13px">TELÉFON MÓVIL: </strong><?php 
					$telefonos_ok=explode(":",$regpersonal["movil_per_gp"]);
					echo "Movistar: ".$telefonos_ok[0]." &nbsp;&nbsp;Claro: ". $telefonos_ok[1]." &nbsp;&nbsp;CNT: ".$telefonos_ok[2]?></li>
                    <li><strong style="font-size:13px">TELÉFONO CONVENCIONAL: </strong><?php echo $regpersonal["telfcasa_gp"]?></li>
                    <li><strong style="font-size:13px">OTROS DATOS: </strong><?php echo $regpersonal["observaciones"]?></li>
                    <!--<li><strong style="font-size:13px"><a onClick="window.open(this.href, this.target, 'width=600,height=500'); return false;" href="http://www.senescyt.gob.ec/web/guest/exportarPDF/<?php #echo $regpersonal["cedula"]; ?>" target="_blank" >Verificar Títulos en la Senecyt: </a></strong>
                    <form name="ss" method="post" action="http://www.senescyt.gob.ec/web/guest/exportarPDF/<?php #echo $regpersonal["cedula"]; ?>" target="_blank">
                    <input type="hidden" value="<?php # echo $regpersonal["cedula"]; ?>" name="identificacion">
                    <input name="ss" value="ssss" type="submit">
                    </form>
                    </li>-->
              </ul>   
              
<br>
<br>
          </td>
        </tr>
 <?php 
  }
  ?>       
      </tbody> 
       
  </table>
</div>

<hr>

</div>
</div>
<script>
document.getElementById("nuevo").style.display="none";
function Pasar_Datos_personal(contar)
{
	valor="everydata["+contar+"]";
	document.getElementById("fomulariook").reset();
	//$('#area_personal > option[value=""]').attr('selected', 'selected');

	var DATOS=document.getElementById(valor).value;
	//alert (DATOS);
	var DATOSP=DATOS.split(';');
	document.getElementById("id_personal").value=DATOSP[0];
	document.getElementById("apellidos").value=DATOSP[2];
	document.getElementById("nombres").value=DATOSP[3];
	document.getElementById("cedula").value=DATOSP[4];
	document.getElementById("correo").value=DATOSP[5];
	document.getElementById("observaciones").value=DATOSP[6];
	document.getElementById("area_personal").value=DATOSP[1];
	document.getElementById("tratamiento").value=DATOSP[7];
	document.getElementById("genero").value=DATOSP[8];
	document.getElementById("cargo").value=DATOSP[9];
		
}
</script>

