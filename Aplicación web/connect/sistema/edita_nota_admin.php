<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
include("conexion.php");
require_once("navegacion_admin.php");
?>
<div class="row">
	<div class="col s9 z-depth-1" style="background-color:#ffffff;">
		<div class="card-panel">
			<span class="blue-text text-darken-2"><i class="material-icons left">mode_edit</i>Editar nota</span>
		</div>
		<?php 
			$titulo_nota = $_GET['edita_nota'];
			$select_nota = "SELECT * FROM notas_admin WHERE titulo = '$titulo_nota'";
			$res_select = mysqli_query($conexion,$select_nota);
			while ($row_edita = mysqli_fetch_array($res_select)) {
				$titulo_edita = $row_edita['titulo'];
				$descripcion_edita = $row_edita['descripcion'];
				$prioridad_edita = $row_edita['prioridad'];
			}
			?>
			<form action="" method="post">
				<div class="row container">
					<div class="input-field col s7">
						<i class="material-icons prefix">subtitles</i>
						<input type="text" name="titulo" id="sub" value="<?php echo $titulo_edita; ?>">
						<label for="sub">Titulo de la nota</label>
					</div>
					<div class="input-field col s7">
						<i class="material-icons prefix">description</i>
							<input type="text" name="descripcion" length="255" value="<?php echo $descripcion_edita; ?>">
						<label for="desc">Desripcion de la nota</label>
					</div>
					<div class="input-field col s7">
						<p>Prioridad de la nota</p>
						<p class="range-field">
						<input type="range" name="prioridad" min="0" max="10" value="<?php echo $prioridad_edita; ?>">
						</p>
					</div>
					<div class="input-field col s7">
						<button class="pink z-depth-2 btn waves-effect waves-light" type="submit" name="actualiza_nota">Actualizar</button>
						<button class="btn-flat waves-effect waves-light" type="reset">Limpiar todo</button>
					</div>
				</div>
			</form>
	</div>
</div>
<?php
if (isset($_POST['actualiza_nota'])) {
	$titulo_nuevo = $_POST['titulo'];
	$descripcion_nuevo = $_POST['descripcion'];
	$prioridad_nuevo = $_POST['prioridad'];
	$actualiza = "UPDATE notas_admin SET titulo = '$titulo_nuevo', descripcion = '$descripcion_nuevo', prioridad = '$prioridad_nuevo' WHERE titulo = '$titulo_nota'";
	$query_actualiza = mysqli_query($conexion,$actualiza);
	if ($query_actualiza) {
		header('Location: panel_admin.php');
	}else{
		echo "Algo salió mal, intenta de nuevo o verifica.";
	}
}
?>
<script type="text/javascript">
	$(".dropdown-button").dropdown();
</script>
<script type="text/javascript">
	 $(document).ready(function(){
    $('.modal-trigger').leanModal();
  });   
</script>
</body>
</html>
<?php ob_end_flush(); ?>