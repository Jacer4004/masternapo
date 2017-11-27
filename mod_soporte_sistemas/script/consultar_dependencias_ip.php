<?php 
include("../../conf.php");
$ipvalidar=$_POST["variable"];

?>
        
<?php 
$sqlipdependencias=mysql_query("select distinct
a.*,concat_ws(' ',p.tratamiento,p.nombres,p.apellidos) as nomina,d.*,m5sts_ip.*,m5sts_us_ad.*,
(select group_concat(id_equipo separator '<>') from m5sts_e_e_componentes where m5sts_e_e_componentes.id_ent_equi=a.id_ent_equi) as componentesss
from m5sts_entrega_equipos a
inner join m5sts_e_e_componentes l on l.id_ent_equi= a.id_ent_equi
inner join gad_personal p on p.id_personal=a.id_personal
inner join gad_dependencia d on d.id_dependencia=p.id_dependencia
left join m5sts_ip on m5sts_ip.id_ip=a.dir_ip
left join m5sts_us_ad on m5sts_us_ad.id_us_ad=a.us_ad
where m5sts_ip.ip='$ipvalidar'
",$conectar) or die("Error 1");
$regdependencias=mysql_fetch_array($sqlipdependencias);
$total=mysql_num_rows($sqlipdependencias);
#consulta dependencias
echo "<h4>Resultados encontrados</h4>";

if($total==1)
{

	?> 
                <ul>
                    <li><strong>Funcionario Asociado:</strong> <?php echo $regdependencias["nomina"]; ?></li>
                    <li><strong>Dependencia:</strong> <?php echo $regdependencias["nombre"]; ?></li>
                    <li><strong>Dirección IP:</strong> <?php echo $regdependencias["ip"]; ?></li>
                    <li><strong>Usuario AD:</strong> <?php echo $regdependencias["nom_usu_ad"]; ?></li>
                    <li><strong>Fecha de Entrega:</strong> <?php echo $regdependencias["fecha_entrega"]; ?></li>
                    <li><strong>Observaciones:</strong> <?php echo $regdependencias["otros"]; ?></li>
                    <li><strong>Estado:</strong> <?php echo $regdependencias["estadoee"]; ?></li>
                    
                    <li><strong>Software Instalado:</strong> <?php 					$sowft=split("<>",$regdependencias["software"]);
					for($r=0;$r<count($sowft);$r++)
					{
						?>
                     <ul style="padding:0px; margin:0px; margin-left:20px">
                     	<li style="padding:0px; margin:0px">
						<?php 
						#si encuentra en el array imprime
						if(count($sowft)==0)
						{
							echo "Ninguno";
						}
						else
						{
							echo $sowft[$r];
						}
						?></li>
                     </ul>
                    <?php
					}
					?>
                    </li>
                     <li><strong>Componentes:</strong> 
                     
                     <?php 					$componentess=split("<>",$regdependencias["componentesss"]);
					for($r2=0;$r2<count($componentess);$r2++)
					{
						$el_id=$componentess[$r2];
						$sqlactivosentregados=mysql_query("select * from m5sts_equipos where id_equipo='$el_id'",$conectar) or die("Error 1");
						$reg_ee=mysql_fetch_array($sqlactivosentregados);
						?>
                     <ul style="padding:0px; margin:0px; margin-left:20px">
                     	<li>
						<?php 
						#si encuentra en el array imprime
						if(count($componentess)==0)
						{
							echo "Ninguno";
						}
						else
						{
							echo "[".$reg_ee["codigoactivo"]."] - [".$reg_ee["nombre"]."] - [".$reg_ee["marca"]."]";
						}
						?></li>
                     </ul>
                    <?php
					}
					?>
                     
                     </li>
                 </ul>                
      
               
               <?php 
}
else
{
	echo "No se encontraron dependencias";
}
			   ?>