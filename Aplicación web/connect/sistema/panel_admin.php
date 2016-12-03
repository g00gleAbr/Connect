<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
require_once("navegacion_admin.php"); 
include("conexion.php");
?>

	<div class="col s9 z-depth-1" style="background-color:#ffffff;">
		<?php 
		if (isset($_GET['crear_nota_admin'])) {
			include("crear_nota_admin.php");
		}elseif (isset($_GET['subir_anuncio'])) {
			include("subir_anuncio.php");
		}elseif (isset($_GET['subir_calificacion'])) {
			include("subir_calificacion.php");
		}else{
			echo "
					<div class='card-panel'>
						<span class='pink-text'><i class='material-icons left'>mood</i>Bienvenido, aquí tienes un tablero de acciones, puedes crear tus notas si lo requieres.</span>
					</div>
				";
			echo "<p style='font-size:18px; padding-left:23px;'>Mis notas:</p>";
			$usuario = $_SESSION['correo'];
			$select_id = "SELECT * FROM administradores WHERE correo = '$usuario'";
			$res_id = mysqli_query($conexion,$select_id);
			while ($row_id = mysqli_fetch_array($res_id)) {
				$id_admin= $row_id['id'];

				$selec_nota = "SELECT * FROM notas_admin WHERE id = '$id_admin'";
				$query_nota = mysqli_query($conexion,$selec_nota);
				$revisa_nota = mysqli_num_rows($query_nota);
				if ($revisa_nota == 0) {
						echo "<center>
						<img src='../img/note.png' width='100' />
						<p>No tienes ninguna nota, deseas crear una?<br><a href='panel_admin.php?crear_nota_admin'>Crear nota</a></p>
						</center>";
					}elseif ($revisa_nota >= 1) {
						while ($row_nota = mysqli_fetch_array($query_nota)) {
							$id_nota = $row_nota['id'];
							$titulo_nota = $row_nota['titulo'];
							$descripcion_nota = $row_nota['descripcion'];
							$prioridad = $row_nota['prioridad'];
					?>	
					 <div style="display:inline-block; padding-left:50px;">
        				<div class="col s12 m6">
          					<div class="card z-depth-2" style="background-color:#34495e;">
            					<div class="card-content white-text">
              						<span class="card-title"><?php echo $titulo_nota; ?></span>
              						<p><?php echo $descripcion_nota; ?></p>
              						<p style="font-size:15px; padding-top:10px;">Prioridad: <?php echo $prioridad; ?></p>
            					</div>
            					<div class="card-action">
              						<a class="modal-trigger" href="#modal1">Eliminar nota</a>
              						<a href="edita_nota_admin.php?edita_nota=<?php echo $titulo_nota; ?>">Editar nota</a>
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
      				$elimina_nota = "DELETE FROM notas_admin WHERE titulo  = '$titulo_nota' AND descripcion = '$descripcion_nota'";
      			 	$query_elimina_nota = mysqli_query($conexion, $elimina_nota);
      			 	header("Location: panel_admin.php");
      			}
      			if (isset($_POST['no'])) {
      			 	header("Location: panel_admin.php");
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