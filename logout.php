<?php 
session_start();
session_destroy();
echo '<br/><div align="center" style="margin-top:15px;"><h3 style="color:#F10004">La sesion ha finalizado.</h3><br/>';
echo '<br/><a style="text-decoration:none" href="login.php">Ingrese Nuevamente</a>
</div>';
unset($_COOKIE ["mod"]);

?>
<script>
document.cookie='mod=;expires=-1';
</script>