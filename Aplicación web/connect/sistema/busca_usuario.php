<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Buscar alumno</title>
</head>
<body>
<?php
include("conexion.php");
require_once("navegacion_admin.php");
?>
<div class="col s9 z-depth-1" style="background-color:#ffffff;">
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">search</i>Puedes ver la información de cada alumno</span>
</div>
<div style="padding-left:20px;">
	<form action="resultados_usuario.php" method="get" class="busqueda">
		<div class="input-field">
	    	<input id="search" type="search" placeholder="Buscar usuario" name="buscar_alumn" required>
	        <i class="material-icons">close</i>
	     </div>
	</form>
</div>
<center>
<?php 
$url = "busca_alumno.php";
$consulta_noticias = "SELECT * FROM usuarios";
$rs_noticias = mysqli_query($conexion, $consulta_noticias);
$num_total_registros = mysqli_num_rows($rs_noticias);
if ($num_total_registros > 0) {
	$TAMANO_PAGINA = 10;
        $pagina = false;
        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
	echo '<p>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</p>';
	$consulta = "SELECT * FROM usuarios ORDER BY localidad DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
	$rs = mysqli_query($conexion,$consulta);
	?>
<form action="" method="post">
	<table class="centered highlight">
        <thead>
          <tr>
          	 <th data-field="elimina">Eliminar</th>
             <th>Nombre</th>
             <th>Correo</th>
             <th>Teléfono</th>
             <th>Detalles</th>
          </tr>
        </thead>
	<?php 
	while ($row = mysqli_fetch_array($rs)) {
		$id_usuario = $row['id'];
		$nombre_usuario = $row['nombre'];
		$apellido_usuario = $row['apellido_paterno'];
		$correo_usuario = $row['correo'];
		$telefono_usuario = $row['telefono'];
	?>
        <tbody>
        	<tr>
        		<td>
					<div class="switch">
    					<label>
      						No
      						<input type="checkbox" name="remove[]" value="<?php echo $id_usuario;?>"/>
      						<span class="lever"></span>
      						Si
    					</label>
  					</div>
				</td>
				<td><?php echo $nombre_usuario."&nbsp;".$apellido_usuario ?></td>
				<td><?php echo $correo_usuario; ?></td>
				<td><?php echo $telefono_usuario; ?></td>
				<td><a href='resultados_usuario.php?id_usuario=<?php echo $id_usuario; ?>'>Ver más</a></td>
			</tr>
	<?php } ?>
	<tr>
		<td><button href="#!" class="btn pink tooltipped waves-effect waves-light" data-position="bottom" data-delay="50" data-tooltip="Actualizar alumnos" type="submit" id="boton-redondo" name="actualizar"><i class="material-icons">refresh</i></button></td>
	</tr>
	<?php 
	if (isset($_POST['actualizar'])) {
		foreach ($_POST['remove'] as $elimina_id) {
			$elimina_producto = "DELETE FROM usuarios WHERE id = '$elimina_id'";
			$query_elimina = mysqli_query($conexion,$elimina_producto);
			if ($query_elimina) {
				$elimina_notas = "DELETE FROM notas WHERE id = '$elimina_id'";
				$query_notas = mysqli_query($conexion,$elimina_notas);
				if ($query_notas) {
					header('Location: busca_usuario.php');
				}
			}else{
				echo "No se eliminó";
			}
		}
	}
	?>
	</tbody>
   </table>
   </form>
	<?php 
	echo '<ul class="pagination">';

	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<a class="waves-effect" href="'.$url.'?pagina='.($pagina-1).'"><i class="material-icons">chevron_left</i></a>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i){
				echo '<li class="waves-effect active" style="color:#ffffff;">';
				echo $pagina;
				echo '</li>';
			}
			else{
				echo "<li class='waves-effect'>";
				echo '<a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
				echo "</li>";
			}
		}
		if ($pagina != $total_paginas)
			echo '<a class="waves-effect" href="'.$url.'?pagina='.($pagina+1).'"><i class="material-icons">chevron_right</i></a>';
	}
	echo '</ul>';
}
?>
</center>
</div>
<script type="text/javascript">
	 $(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
</script>
</body>
</html>
<?php ob_end_flush(); ?>