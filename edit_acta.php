<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Acta</title>
<script src="ckeditor/ckeditor.js"></script>
	
	
</head>

<body>
<?php 
include("conf.php");
$nactaa=$_REQUEST["acta"];
$acta_abrir=mysql_query("select * from inv_sum_actas where nacta='$nactaa'",$conectar)or die ("ERROR_");
$reg_acta_abrir=mysql_fetch_array($acta_abrir);
?>

<div align="center">
<form  target="preview" action="reportes/view.php" method="post">
<input type="hidden" name="numeroacta" value="<?php echo $nactaa?>">
<input type="hidden" name="valid" value="TRUE">

<div style="width:100%">

<textarea cols="80" id="editor1" name="editor1" rows="10">
			<?php echo $reg_acta_abrir["texto_acta"];?>Escriba aqui el texto
</textarea>

		<script>

			CKEDITOR.replace( 'editor1',{
				uiColor: '#F2DB7D'});

		</script>
	</div>
    </form>
</div>
</body>
</html>