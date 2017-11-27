<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
</head>

<div >
<div class="ventanas" id="contenedor">
<div id="<?php echo $colorfondo;?>"><h3 align="center">Adminsitración </h3></div>
  
 
  <ul class="menucentral">
	<?php if (in_array("M1ADMMD", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('pag_misdatos','')"><img src="imag/misdatos.png" style="vertical-align:middle"><br> 
	Mis Datos
</a></li><?php }?>
    <?php if (in_array("M1ADMUS", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" ><img src="imag/configusuarios.png" style="vertical-align:middle"><br>
    Usuarios</a></li>  <?php }?>
    <?php if (in_array("M1ADMAUS", $accesos)) {?><li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('pag_permisos','')"><img src="imag/permisos.png" style="vertical-align:middle"><br>
    Permisos</a></li>  <?php }?>
    
    <!--<li ><a id="color_darkCrimson" href="#"><img src="imag/contratos.png" style="vertical-align:middle"><br>Buscar</a></li>   
 --> </ul>
  </div>
  </div>
</div>
