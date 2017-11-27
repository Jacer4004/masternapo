<?php 
//$sql_areas=mysql_query("select distinct dependencia,nombre, id_dependencia from gad_dependencia group by dependencia",$conectar);
?><head>
<link rel="stylesheet" href="estilos/css.css" type="text/css" charset="utf-8"/>
<style type="text/css">
	ul{
		list-style: none;
	}
	</style>
	<script>
	$(document).ready(function()
	{
		$(".btn-folder").on("click", function(e)
		{
			e.preventDefault();
			if($(this).attr("data-status") === "1")
			{
				$(this).attr("data-status", "0");
				$(this).find("span").removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign")
			}
			else
			{
				$(this).attr("data-status", "1");
				$(this).find("span").removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign")
			}
			$(this).next("ul").slideToggle();
		})
	});
	</script>
</head>


<div class="ventanas" id="contenedor">
<h3 align="center" id="<?php echo $colorfondo?>">Orgánico Institucional</h3>
<div >
<ul>
<?php 
$sql_subarea=mysql_query("SELECT *
    FROM   gad_dependencia",$conectar) or die("ERROR");
	while($reg_areas=mysql_fetch_array($sql_subarea))
	{
				
?>

	<li><?php echo $reg_areas["dependencia"]." - ". $reg_areas["nombre"];?>
    	
    </li>
    
    <?php 
	}
	?>
</ul>
</div>


</div>
