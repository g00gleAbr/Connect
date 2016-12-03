<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">settings</i>Modifica tu los datos de tu cuenta</span>
</div>
<?php 
$usuario = $_SESSION['correo'];

$select = "SELECT * FROM usuarios WHERE correo = '$usuario'";
$query_select = mysqli_query($conexion,$select);
while ($row_edita = mysqli_fetch_array($query_select)) {
	$nombre_edita = $row_edita['nombre'];
	$apellido_paterno_edita = $row_edita['apellido_paterno'];
	$apellido_materno_edita = $row_edita['apellido_materno'];
	$username_edita = $row_edita['username'];
	$telefono_edita = $row_edita['telefono'];
	$correo_edita = $row_edita['correo'];
	$direccion_edita = $row_edita['direccion'];
	$localidad_edita = $row_edita['localidad'];

	$select_loc = "SELECT * FROM localidad WHERE id = '$localidad_edita'";
	$query_loc = mysqli_query($conexion,$select_loc);
	$row_loc = mysqli_fetch_array($query_loc);
	$nombre_localidad_edita = $row_loc['nombre'];
	$id_localidad_edita = $row_loc['id'];
}
?>
<div class="row" style="padding-left:20x;">
	<form action="" method="post">
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="nombre" id="nam" value="<?php echo $nombre_edita; ?>" required>
			<label for="nam">Nombre</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="apellido_paterno" value="<?php echo $apellido_paterno_edita; ?>" id="ap" required>
			<label for="ap">Apellido paterno</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="apellido_materno" id="am" value="<?php echo $apellido_materno_edita; ?>">
			<label for="am">Apellido materno (opcional)</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">android</i>
			<input type="text" name="username" id="un" value="<?php echo $username_edita; ?>" required>
			<label for="un">Nombre de usuario</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">contact_phone</i>
			<input type="text" name="telefono" id="phone" value="<?php echo $telefono_edita; ?>" required>
			<label for="phone">Teléfono</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">email</i>
			<input type="email" name="correo" id="mail" value="<?php echo $correo_edita; ?>" required>
			<label for="mail">Correo</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">home</i>
			<input type="text" name="direccion" id="dir" value="<?php echo $direccion_edita; ?>" required>
			<label for="dir">Dirección</label>
		</div>
		<div class="input-field col s6">
			<select name="localidad">
				<option value="<?php echo $id_localidad_edita; ?>"><?php echo $nombre_localidad_edita; ?></option>
				<?php 
				$select_loc = "SELECT * FROM localidad";
				$query_select = mysqli_query($conexion,$select_loc);
				while ($row = mysqli_fetch_array($query_select)) {
					$id_localidad_nuevo = $row['id'];
					$nombre_localidad_nuevo = $row['nombre'];

					echo "<option value='$id_localidad_nuevo'>$nombre_localidad_nuevo</option>";
				}
				?>
			</select>
		</div>
		<div style="padding-left: 10em; padding-top: 22em;">
			<button type="submit" name="actualizar" class="btn waves-effect waves-light" style="background-color: #FF3F80; width: 16em;">Actualizar</button>
			<button type="reset" name="cancelar" class="btn-flat waves-effect waves-light">Cancelar</button>
		</div>
	</form>
	</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
</script>
</body>
</html>
<?php 
if (isset($_POST['actualizar'])) {
	$nombre_nuevo = $_POST['nombre'];
	$apellido_paterno_nuevo = $_POST['apellido_paterno'];
	$apellido_materno_nuevo = $_POST['apellido_materno'];
	$username_nuevo = $_POST['username'];
	$telefono_nuevo = $_POST['telefono'];
	$correo_nuevo = $_POST['correo'];
	$direccion_nuevo = $_POST['direccion'];
	$localidad_nuevo = $_POST['localidad'];

	$actualiza_usuario = "UPDATE usuarios SET nombre = '$nombre_nuevo', apellido_paterno = '$apellido_paterno_nuevo', apellido_materno = '$apellido_materno_nuevo', username = '$username_nuevo', telefono = '$telefono_nuevo', correo = '$correo_nuevo', direccion = '$direccion_nuevo', localidad = '$localidad_nuevo' WHERE correo = '$usuario'";

	$query_actualiza = mysqli_query($conexion,$actualiza_usuario);
	if ($query_actualiza) {
		header('Location: panel_usuario.php?cuenta_usuario');
	}else if(isset($_GET['cancelar'])){
		header('Location: panel_usuario.php');
	}else{
		echo "Hubo un error, verifica o intenta de nuevo.";
	}
}
?>