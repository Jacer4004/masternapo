<?php 
include_once("../conf.php");
$buscar=$_POST["buscar"];
$sqlqyery=mysql_query("SELECT DISTINCT(gad_personal.nombres), gad_personal.* ,gad_dependencia.*,m5sts_ip.*,m5sts_us_ad.* FROM gad_personal
inner join gad_dependencia
on gad_dependencia.id_dependencia= gad_personal.id_dependencia
inner join m5sts_ip on gad_personal.id_personal=m5sts_ip.id_personal
inner join m5sts_us_ad on gad_personal.id_personal= m5sts_us_ad.id_personal
where gad_personal.nombres like '%$buscar%'
or gad_personal.apellidos like '%$buscar%'
or gad_personal.cedula like '%$buscar%'
or m5sts_ip.ip like '%$buscar%'
or m5sts_us_ad.nom_usu_ad like '%$buscar%'",$conectar);
 
?>
<div style="overflow-y: scroll; max-height:300px;padding:5px;">
<?php while($regmy=mysql_fetch_array($sqlqyery))
{
	$sqlcon=$sqlcon+1;
?>
	
    <table border="0" cellspacing="0" cellpadding="0" class="estilo_tabla1" rules="all" style="font-size:14px">
    <thead>
    <tr >
    <th colspan="2" align="center" valign="middle"><strong>Resultado N°-:</strong><strong> <?php echo $sqlcon;?></strong></th>
    </tr>
    </thead>
    <tbody>
  <tr>
    <td width="90" align="right"><strong>Funcionario:</strong></td>
    <td width="158"><?php echo $regmy["apellidos"]." ".$regmy["nombres"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Cédula:</strong></td>
    <td><?php echo $regmy["cedula"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Dependencia:</strong></td>
    <td><?php echo $regmy["nombre"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Correo:</strong></td>
    <td><?php echo $regmy["correo"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Puesto:</strong></td>
    <td><?php echo $regmy["puesto"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Ubicación:</strong></td>
    <td><?php echo $regmy["ugeografica"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Dispositivo:</strong></td>
    <td><?php echo $regmy["dispositivo"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>IP:</strong></td>
    <td><?php echo $regmy["ip"];?>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Usuario AD:</strong></td>
    <td><?php echo $regmy["nom_usu_ad"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>Perfil:</strong></td>
    <td><?php echo $regmy["perfilusuario"];?></td>
  </tr>
  <tr>
    <td align="right"><strong>PSW:</strong></td>
    <td><?php echo $regmy["contrasenia"];?></td>
  </tr>
  </tbody>
</table>
<br>

<?php 
}
?>
</div>