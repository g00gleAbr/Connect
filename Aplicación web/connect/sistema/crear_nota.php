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
				<i class="material-icons prefix">date_range</i>
				<input type="date" name="fechaLim" id="fe">
			</div>
			<div class="input-field col s6">
				<select name="prioridad">
					<option disabled selected>Prioridad</option>
					<option value="Alta">Alta</option>
					<option value="Media">Media</option>
					<option value="Baja">Baja</option>
				</select>
			</div>
			<div class="input-field col s6">
				<select name="categoria">
					<option disabled selected>Categoría</option>
					<option value="Escuela">Escuela</option>
					<option value="Trabajo">Trabajo</option>
				</select>
			</div>
			<div class="input-field col s7">
				<button class="pink lighten-1 z-depth-1 btn waves-effect waves-light" type="submit" name="subir_nota">Crear nota</button>
				<button class="btn-flat waves-effect waves-light" type="reset">Limpiar todo</button>
			</div>
		</div>
	</form>
</center>
<script type="text/javascript">
	$(document).ready(function() {
    $('select').material_select();
  });   
</script>
</body>
</html>
<?php 
$usuario = $_SESSION['correo'];
if (isset($_POST['subir_nota'])) {
	//Recibir id del usuario para subirla a la tabla notas
	$select_id_user = "SELECT * FROM usuarios WHERE correo = '$usuario'";
	$query_user = mysqli_query($conexion,$select_id_user);
	$row_id = mysqli_fetch_array($query_user);
	$id_usuario = $row_id['id'];
	$correo_usuario = $row_id['correo'];

	$titulo_nota = $_POST['titulo'];
	$descripcion_nota = $_POST['descripcion'];
	$prioridad_nota = $_POST['prioridad'];
	$fecha_nota = $_POST['fechaLim'];
	$categoria_nota = $_POST['categoria'];
	$subir_nota = "INSERT INTO meta(idUsuario,correo,titulo,descripcion,prioridad,fechaLim,categoria)VALUES('$id_usuario','$correo_usuario','$titulo_nota','$descripcion_nota','$prioridad_nota','$fecha_nota','$categoria_nota')";
	$query_nota = mysqli_query($conexion,$subir_nota);
	if ($query_nota) {
		header('Location: panel_usuario.php');
	}else{
		echo "Hubo un error al subir la nota, verifica e intenta de nuevo";
	}
}
?>