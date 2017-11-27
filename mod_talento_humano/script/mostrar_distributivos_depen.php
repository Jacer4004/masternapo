<?php 
include("../../conf_mysqli.php");

?>


<link rel="stylesheet" href="dist/themes/default/style.min.css" />

<script src="dist/jstree.min.js"></script>
	
	<script>
	// html demo
	$('#html').jstree();
	// inline data demo
	$('#data').jstree({
		'core' : {
			'data' : [
				{ "text" : "Root node", "children" : [
						{ "text" : "Child node 1" },
						{ "text" : "Child node 2" }
				]}
			]
		}
	});

	</script>
<div style="min-height:300px;  overflow-style:marquee-line; border:1px solid rgba(185,185,185,1.00); padding:5px" class="table-container" >

<div id="html" class="demo">
		<!--<ul style="margin:0px; padding:0px; list-style:none">
			<li data-jstree='{ "opened" : true }'>0-->
<?php 
//call the recursive function to print category listing
category_tree(0);

//Recursive php function
function category_tree($catid){
global $conn;
$aut=$_REQUEST["aut"];

$sql = "select * from th_distributivo_dep where nivel_padre ='".$catid."'"." and id_distributivo='".$aut."'";
$result = $conn->query($sql) or die(mysql_error());

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0) echo '<ul> ';


 echo '<li>'. $row->dependencia_nom;

 
 category_tree($row->nivel_dependencia);
 
 echo '</li>';
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
?>
<!--</li>
</ul>-->
</div>
</div>
<script>
/*function pasardep(valores_dep)
{
	
	cambiar_vetana('#frmnuevo','#contenidosinternosdis')
	var string = valores_dep;
var array = string.split(".*.");
$('#idprincipal').val(array[0]);
$('#dis_periodo').val(array[1]);
$('#dis_descripcion').val(array[2]);


}*/
</script>

