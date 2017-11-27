<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>

</head>

<!--DIRECCIONES IP-->
<div class="ventanas" id="contenedor">
    <h3 id="<?php echo $colorfondo?>"align="center"> Soporte Técnico Gestión Técnológica</h3>
  <ul class="menucentral">
    	<?php if (in_array("M5SDIP", $accesos)) {?><li  ><a class="colortextoiconos" href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_dir_ip','')"><img src="imag/direccionesIP.png" style="vertical-align:middle"><br>
     Configuración de Red</a></li>  <?php }?>
     <?php if (in_array("M5SUAD", $accesos)) {?><li  ><a class="colortextoiconos"  id="" href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_us_ad','')"><img src="imag/usuariosAD.png" style="vertical-align:middle"><br>
      Active Directory</a></li>  
     <?php }?>
     
      <?php if (in_array("M5SRE", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_equipos_computo','')"><img src="imag/equiposdecomputo.png" style="vertical-align:middle"><br> 
	
Equipos Informáticos</a></li>
      <?php }?>
      
       <?php if (in_array("M5SEE", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_equipos_computo_entrega','')"><img src="imag/darequiposdecomputo.png" style="vertical-align:middle"><br> Entrega de
Equipos</a></li>
      <?php }?>

<?php if (in_array("M5SMANT", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('mod_soporte_sistemas/sub_equipos_computo','')"><img src="imag/mantenimientopc.png" style="vertical-align:middle"><br> 
	Mantenimiento
</a></li><?php }?>

<?php #if (in_array("M5SMANT", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('mod_help_desk/home_help_desk','')"><img src="imag/Help_Desk.png" style="vertical-align:middle"><br> 
	Help Desk
</a></li><?php # }?>

    </ul>
</div>