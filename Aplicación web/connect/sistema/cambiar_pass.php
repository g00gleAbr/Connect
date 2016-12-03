<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">visibility_off</i>Cambia tu contraseña</span>
</div>
<form action="" method="post">
		<div class="row">
			<div class="input-field col s7">
				<input type="password" name="current_pass" placeholder="Contraseña actual" required>
			</div>
			<div class="input-field col s7">
				<input type="password" name="new_pass" placeholder="Nueva contraseña" required>
			</div>
			<div class="input-field col s7">
				<input type="password" name="new_pass_ag" placeholder="Repite tu nueva contraseña" required>
			</div>
			<div class="input-field col s10">
				<button class="btn waves-effect waves-light pink" type="submit" name="cambia_pass">Actualizar</button>
				<button class=" btn-flat waves-effect waves-light" type="reset">Limpiar</button>
			</div>
		</div>
</form>
</body>
</html>
<?php
if (isset($_POST['cambia_pass'])) {
	$usuario = $_SESSION['correo'];

	$pass_actual = $_POST['current_pass'];
	$pass_nueva = $_POST['new_pass'];
	$repite_nuevo = $_POST['new_pass_ag'];

	$selecciona_pass = "SELECT * FROM usuarios WHERE pass = '$pass_actual' AND correo = '$usuario'";
	$query_pass = mysqli_query($conexion,$selecciona_pass);
	$revisa_pass = mysqli_num_rows($query_pass);

	if ($revisa_pass == 0) {
		echo "Tu contraseña actual es incorrecta, intenta de nuevo.";
		echo "<br>";
	}
	if ($pass_nueva != $repite_nuevo) {
		echo "La nueva contraseña no coincide, intenta de nuevo.";
		echo "<br>";
		exit();
	}else{
		$actualizar_pass = "UPDATE usuarios SET pass = '$pass_nueva' WHERE correo = '$usuario'";
		$query_actualiza = mysqli_query($conexion,$actualizar_pass);

		echo "Se actualizó tu contraseña correctamente.";
	}
}
?>
<?php 
ob_end_flush();
?>