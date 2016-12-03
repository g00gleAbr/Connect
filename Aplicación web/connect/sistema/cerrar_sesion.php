<?php ob_start(); ?>

<?php 
if (isset($_GET['cerrar_usuario'])) {
	session_start();
	session_destroy();
	header('Location: index.php');
}elseif (isset($_GET['cerrar_admin'])) {
	session_start();
	session_destroy();
	header('Location: index.php');
}
?>

<?php ob_end_flush(); ?>