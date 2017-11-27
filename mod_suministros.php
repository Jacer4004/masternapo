<head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
</head>

<div >
<div class="ventanas" id="contenedor">
<div id="<?php echo $colorfondo?>"><h3 align="center"> Administración de Suministros </h3></div>
  
  <ul class="menucentral">
	  
    <?php if (in_array("M4SUMASEO", $accesos)) {?><li ><a iclass="colortextoiconos" href="#" ><img src="imag/traspaso.png" style="vertical-align:middle"><br>
    Suministros de Aseo</a></li> <?php }?> 
   <?php if (in_array("M4SUMIMPR", $accesos)) {?> <li ><a class="colortextoiconos" href="inicio.php" onClick="js_general('pag_suministros','<?php echo $colorfondo?>')" ><img src="imag/tintas.png" style="vertical-align:middle"><br>
   Suministros Tecnológicos</a></li><?php }?>  
       
  </ul>
</div>
</div>
</div>
