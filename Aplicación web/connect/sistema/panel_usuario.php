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
  <li style="margin-right: 25px;"><a class="indigo-text" href="panel_usuario.php?cuenta_usuario">Mi cuenta<i class="material-icons left">account_circle</i></a></li>
  <li style="margin-right: 25em;"><a class="indigo-text" href="panel_usuario.php?modificar_datos">Modificar<i class="material-icons left">settings</i></a></li>
  <li style="margin-right: 25px;"><a class="indigo-text" href="cerrar_sesion.php?cerrar_usuario">Salir<i class="material-icons left">exit_to_app</i></a></li>
</ul>
	<div class="col s9 z-depth-1" style="background-color:#ffffff;">
		<?php
			if (isset($_GET['cambiar_pass'])) {
				include("cambiar_pass.php");
			}elseif (isset($_GET['ver_calificaciones'])) {
				include("calificaciones.php");
			}elseif (isset($_GET['enviar_comentario'])) {
				include("comentarios.php");
			}elseif (isset($_GET['cuenta_usuario'])) {
				include("cuenta_usuario.php");
			}elseif (isset($_GET['modificar_datos'])) {
				include("modificar_datos.php");
			}elseif (isset($_GET['crear_nota'])) {
				include("crear_nota.php");
			}else if(isset($_GET['instalacion'])){
				include("instalacion.php");
			}else{
				echo "
					<div class='card-panel'>
						<span class='pink-text'><i class='material-icons left'>mood</i>Bienvenido, aquí tienes un tablero de acciones, puedes crear tus notas si lo requieres.</span>
					</div>
				";
				echo "<p style='font-size:18px; padding-left:23px;'>Mis notas:</p>";
				$select_id = "SELECT * FROM usuarios WHERE correo = '$usuario'";
				$res_id = mysqli_query($conexion,$select_id);
				while ($row_id = mysqli_fetch_array($res_id)) {
					$id_usuario = $row_id['id'];

					$selec_nota = "SELECT * FROM meta WHERE idUsuario = '$id_usuario'";
					$query_nota = mysqli_query($conexion,$selec_nota);
					$revisa_nota = mysqli_num_rows($query_nota);
					if ($revisa_nota == 0) {
						echo "<center>
						<img src='../img/note.png' width='100' />
						<p>No tienes ninguna nota, deseas crear una?<br><a href='panel_usuario.php?crear_nota'>Crear nota</a></p>
						</center>";
					}elseif ($revisa_nota >= 1) {
						while ($row_nota = mysqli_fetch_array($query_nota)) {
							$id_nota = $row_nota['idMeta'];
							$titulo_nota = $row_nota['titulo'];
							$descripcion_nota = $row_nota['descripcion'];
							$prioridad = $row_nota['prioridad'];
							$fecha = $row_nota['fechaLim'];
					?>	
					 <div style="display:inline-block; padding-left:50px;">
        				<div class="col s12 m6">
          					<div class="card z-depth-2" style="background-color:#5C6BC0;">
            					<div class="card-content white-text">
              						<span class="card-title"><?php echo $titulo_nota; ?></span>
              						<p><?php echo $descripcion_nota; ?></p>
              						<p style="font-size:15px; padding-top:10px; color: #FF80AB;">Prioridad:</p><?php echo $prioridad; ?>
              						<p style="font-size: 15px; padding-top: 10px; color: #FF80AB;">Fecha límite:</p><?php echo $fecha; ?>
            					</div>
            					<div class="card-action">
              						<a style="color: #FF80AB;" class="modal-trigger" href="#modal1">Eliminar nota</a>
              						<a style="color: #FF80AB;" href="editar_nota.php?edita_nota=<?php echo $titulo_nota; ?>">Editar nota</a>
            					</div>
          					</div>
        				</div>
      				</div>
					<?php
						}
					}
				}
			}
		?>
	</div>
</div>
	<!--Elimina nota-->
	    <div id="modal1" class="modal">
	    	<div class="modal-content">
	    		<h5>¿Estás seguro?</h5>
	    		<p>Esta accíón ya no se puede deshacer, ten cuidado.</p>
	    	</div>
	    	<div class="modal-footer">
	    		<form action="" method="post">
	    			<button class="btn waves-effect waves-light blue-grey lighten-2" name="no">Cancelar</button>
	    			<button class="btn-flat waves-effect waves-light" name="si">Eliminar</button>
      			</form>
      		<?php 
      			if (isset($_POST['si'])) {
      				$elimina_nota = "DELETE FROM meta WHERE titulo  = '$titulo_nota' AND correo = '$usuario'";
      			 	$query_elimina_nota = mysqli_query($conexion, $elimina_nota);
      			 	header("Location: panel_usuario.php");
      			}
      			if (isset($_POST['no'])) {
      			 	header("Location: panel_usuario.php");
      			 }
      		?>
	    	</div>
	    </div>
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