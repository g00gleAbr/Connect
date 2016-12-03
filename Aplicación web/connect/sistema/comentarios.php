<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">comment</i>Envíanos tus opiniones o inquietudes</span>
</div>
<form action="" method="post">
	<div class="row container">
		<div class="input-field col s7">
			<i class="material-icons prefix">face</i>
			<input type="text" name="nombre" id="wn" required>
			<label for="wn">Nombre</label>
		</div>
		<div class="input-field col s7">
			<i class="material-icons prefix">contact_mail</i>
			<input type="email" name="correo" id="mail" required>
			<label for="mail">Correo</label>
		</div>
		<div class="input-field col s7">
			<i class="material-icons prefix">description</i>
			<textarea class="materialize-textarea" name="comentario" id="desc" length="255" required></textarea>
			<label for="desc">Descripción</label>
		</div>
		<div class="input-field col s7">
			<button type="submit" name="enviar" class="btn waves-effect waves-light pink">Enviar</button>
			<button type="submit" name="cancelar" class="btn-flat waves-effect waves-light">Cancelar</button>
		</div>
	</div>
</form>
</body>
</html>
<?php 
if (isset($_POST['enviar'])) {
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$descripcion = $_POST['comentario'];

	$query_inserta = "INSERT INTO comentarios(nombre,correo,comentario)VALUES('$nombre','$correo','$descripcion')";
	$result = mysqli_query($conexion,$query_inserta);
	if ($result) {
		echo "<script>swal('Hecho','Tus comentarios fueron enviados','success')</script>";
	}else{
		echo "<script>swal('Error','Hubo un problema al enviar los datos, intenta de nuevo','error')</script>";
	}
}
?>