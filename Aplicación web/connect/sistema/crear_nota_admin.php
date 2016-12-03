<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">note_add</i>Crea una nueva nota</span>
</div>
<center>
	<form action="" method="post">
		<div class="row container">
			<div class="input-field col s7">
				<i class="material-icons prefix">subtitles</i>
				<input type="text" name="titulo" id="sub">
				<label for="sub">Titulo de la nota</label>
			</div>
			<div class="input-field col s7">
				<i class="material-icons prefix">description</i>
				<textarea name="descripcion" class="materialize-textarea" length="255" id="desc"></textarea>	
				<label for="desc">Desripcion de la nota</label>
			</div>
			<div class="input-field col s7">
				<p>Prioridad de la nota</p>
				<p class="range-field">
					<input type="range" name="prioridad" min="0" max="10">
				</p>
			</div>
			<div class="input-field col s7">
				<button class="pink z-depth-2 btn waves-effect waves-light" type="submit" name="subir_nota">Crear nota</button>
				<button class="btn-flat waves-effect waves-light" type="reset">Limpiar todo</button>
			</div>
		</div>
	</form>
</center>
</body>
</html>
<?php 
$usuario = $_SESSION['correo'];
if (isset($_POST['subir_nota'])) {
	//Recibir id del usuario para subirla a la tabla notas
	$select_id_user = "SELECT * FROM administradores WHERE correo = '$usuario'";
	$query_user = mysqli_query($conexion,$select_id_user);
	$row_id = mysqli_fetch_array($query_user);
	$id_admin = $row_id['id'];

	$titulo_nota = $_POST['titulo'];
	$description_nota = $_POST['descripcion'];
	$prioridad_nota = $_POST['prioridad'];
	$subir_nota = "INSERT INTO notas_admin(id,titulo,descripcion,prioridad)VALUES('$id_admin','$titulo_nota','$description_nota','$prioridad_nota')";
	$query_nota = mysqli_query($conexion,$subir_nota);
	if ($query_nota) {
		header('Location: panel_admin.php');
	}else{
		echo "Hubo un error al subir la nota, verifica e intenta de nuevo";
	}
}
?>