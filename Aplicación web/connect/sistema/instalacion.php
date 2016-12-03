<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php include("conexion.php"); ?>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">verified_user</i>Datos de instalación</span>
</div>
<div class="row" style="padding-left: 20px;">
	<form action="" method="post">
		<div class="input-field col s5">
			<input type="number" name="puerta" id="door" required>
			<label for="door">Número de puertas</label>
		</div>
		<div class="input-field col s5">
			<input type="number" name="foco" id="light" required>
			<label for="light">Número de focos</label>
		</div>
		<div class="input-field col s5">
			<input type="number" name="ventana" id="win" required>
			<label for="win">Número de ventanas</label>
		</div>
		<div class="input-field col s5">
			<input type="number" name="dispositivo" id="dev" required>
			<label for="dev">Número de dispositivos</label>
		</div>
		<div class="input-field col s5">
			<p class="grey-text">¿Cuentas con cochera?</p>
			<input class="with-gap" name="cochera" value="Si" type="radio" id="test1"  required />
      		<label for="test1">Sí</label>
      		<input class="with-gap" name="cochera" value="No" type="radio" id="test2"  required />
      		<label for="test2">No</label>
		</div>
		<div style="padding-left: 30em; padding-top: 14em;">
			<button type="submit" name="subir" class="btn waves-effect waves-light" style="background-color: #FF3F80; width: 16em;">Envíar</button>
		</div>
	</form>
</div>
<?php 
$usuario = $_SESSION['correo'];
if(isset($_POST['subir'])){
	$select_id_user = "SELECT * FROM usuarios WHERE correo = '$usuario'";
	$query_user = mysqli_query($conexion,$select_id_user);
	$row_id = mysqli_fetch_array($query_user);
	$id_usuario = $row_id['id'];
	$correo_usuario = $row_id['correo'];

	$puertas = $_POST['puerta'];
	$ventanas = $_POST['ventana'];
	$foco = $_POST['foco'];
	$cochera = $_POST['cochera'];
	$dispositivo = $_POST['dispositivo'];

	$inserta = "INSERT INTO instalacion(id,correo,puerta,ventana,foco,dispositivo,cochera)VALUES('$id_usuario','$correo_usuario','$puertas','$ventanas','$foco','$dispositivo','$cochera')";
	$res = mysqli_query($conexion,$inserta);
	if($res){
		header('Location: panel_usuario.php?cuenta_usuario');
	}else{
		echo "Datos no envíados";
	}
}
?>
</body>
</html>