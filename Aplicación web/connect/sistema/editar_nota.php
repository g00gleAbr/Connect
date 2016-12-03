<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Usuario</title>
</head>
<body>
<?php 
require_once("navegacion_usuario.php"); 
include("conexion.php");
?>
<ul id="dropdown1" class="dropdown-content">
  <li><a style="color:#2196f3;" href="panel_usuario.php?cuenta_usuario">Mi cuenta<i class="material-icons left">account_circle</i></a></li>
  <li><a style="color:#2196f3;" href="panel_usuario.php?modificar_datos">Editar datos<i class="material-icons left">settings</i></a></li>
  <li><a style="color:#2196f3;" class="waves-effect waves-light" href="cerrar_sesion.php?cerrar_usuario">Cerrar sesión<i class="material-icons left">exit_to_app</i></a></li>
</ul>
<div class="row">
	<div class="col s9 z-depth-1" style="background-color:#ffffff;">
		<?php
			if (isset($_GET['cambiar_pass'])) {
				include("cambiar_pass.php");
			}elseif (isset($_GET['ver_calificaciones'])) {
				include("calificaciones.php");
			}elseif (isset($_GET['ver_anuncios'])) {
				include("anuncios.php");
			}elseif (isset($_GET['enviar_comentario'])) {
				include("comentarios.php");
			}elseif (isset($_GET['cuenta_usuario'])) {
				include("cuenta_usuario.php");
			}elseif (isset($_GET['modificar_datos'])) {
				include("modificar_datos.php");
			}elseif (isset($_GET['crear_nota'])) {
				include("crear_nota.php");
			}
			?>
			<div class="card-panel">
				<span class="blue-text text-darken-2">Editar nota</span>
			</div>
			<?php 
			$titulo_nota = $_GET['edita_nota'];
			$select_nota = "SELECT * FROM meta WHERE titulo = '$titulo_nota'";
			$res_select = mysqli_query($conexion,$select_nota);
			while ($row_edita = mysqli_fetch_array($res_select)) {
				$titulo_edita = $row_edita['titulo'];
				$descripcion_edita = $row_edita['descripcion'];
				$prioridad_edita = $row_edita['prioridad'];
				$categoria_edita = $row_edita['categoria'];
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
					<div class="input-field col s6">
						<select name="prioridad">
							<option value="<?php echo $prioridad_edita; ?>"><?php echo $prioridad_edita; ?></option>
							<p class="divider"></p>
							<option value="Alta">Alta</option>
							<option value="Media">Media</option>
							<option value="Baja">Baja</option>
						</select>
					</div>
					<div class="input-field col s6">
						<select name="categoria">
							<option value="<?php echo $categoria_edita; ?>"><?php echo $categoria_edita; ?></option>
							<p class="divider"></p>
							<option value="Escuela">Escuela</option>
							<option value="Trabajo">Trabajo</option>
						</select>
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
$usuario = $_SESSION['correo'];
if (isset($_POST['actualiza_nota'])) {
	$titulo_nuevo = $_POST['titulo'];
	$descripcion_nuevo = $_POST['descripcion'];
	$prioridad_nuevo = $_POST['prioridad'];
	$categoria_nuevo = $_POST['categoria'];
	$actualiza = "UPDATE meta SET titulo = '$titulo_nuevo', descripcion = '$descripcion_nuevo', prioridad = '$prioridad_nuevo', categoria = '$categoria_nuevo' WHERE titulo = '$titulo_nota' AND correo = '$usuario'";
	$query_actualiza = mysqli_query($conexion,$actualiza);
	if ($query_actualiza) {
		header('Location: panel_usuario.php');
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
<script type="text/javascript">
	$(document).ready(function() {
    $('select').material_select();
  });   
</script>
</body>
</html>
<?php ob_end_flush(); ?>