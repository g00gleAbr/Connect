<!DOCTYPE html>
<html>
<head>
	<title>Resultados</title>
</head>
<body>
<?php
include("conexion.php");
require_once("navegacion_admin.php");
?>
<div class="col s9 z-depth-1" style="background-color:#ffffff;">
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">search</i>Información del usuario</span>
</div>
<?php 
if (isset($_GET['buscar_alumn'])) {
	$buscar = $_GET['buscar_alumn'];
	$query = "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar%'";
	$resultado = mysqli_query($conexion,$query);

	$contador_busqueda = mysqli_num_rows($resultado);
	if ($contador_busqueda == 0) {
		echo "No se encontró ningun alumno.";
	}
	while ($row = mysqli_fetch_array($resultado)){
		$nombre = $row['nombre'];
		$apellido_paterno = $row['apellido_paterno'];
		$apellido_materno = $row['apellido_materno'];
		$username = $row['username'];
		$telefono = $row['telefono'];
		$correo = $row['correo'];
		$direccion = $row['direccion'];
		$localidad = $row['localidad'];

		$select_loc = "SELECT * FROM localidad WHERE id = '$localidad'";
		$query_loc = mysqli_query($conexion,$select_loc);
		$row_loc = mysqli_fetch_array($query_loc);
		$nombre_localidad = $row_loc['nombre'];
	?>
<div class="row" style="padding-left:45px;">
	<section class="col s4">
		<article>
			<p class="gris">Nombre</p>
			<?php echo $nombre; ?>

			<p class="gris">Apellido paterno</p>
			<?php echo $apellido_paterno; ?>

			<p class="gris">Apellido materno</p>
			<?php echo $apellido_materno; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Nombre de usuario</p>
			<?php echo $username; ?>

			<p class="gris">Teléfono</p>
			<?php echo $telefono; ?>

			<p class="gris">Correo</p>
			<?php echo $correo; ?>
		</article>
	</section>
	<section class="col s4">
		<p class="gris">Dirección</p>
		<?php echo $direccion; ?>

		<p class="gris">Localidad</p>
		<?php echo $nombre_localidad; ?>
		<br><br>
	</section>
</div>
	<?php
	}
}
?>
<?php 
if(isset($_GET['id_usuario'])) {
	$id_usuario = $_GET['id_usuario'];
	$selec_alumn = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
	$query_alumno = mysqli_query($conexion,$selec_alumn);

	while($row = mysqli_fetch_array($query_alumno)){
		$nombre = $row['nombre'];
		$apellido_paterno = $row['apellido_paterno'];
		$apellido_materno = $row['apellido_materno'];
		$username = $row['username'];
		$telefono = $row['telefono'];
		$correo = $row['correo'];
		$direccion = $row['direccion'];
		$localidad = $row['localidad'];

		$select_loc = "SELECT * FROM localidad WHERE id = '$localidad'";
		$query_loc = mysqli_query($conexion,$select_loc);
		$row_loc = mysqli_fetch_array($query_loc);
		$nombre_localidad = $row_loc['nombre'];
?>
<div class="row" style="padding-left:45px;">
	<section class="col s4">
		<article>
			<p class="gris">Nombre</p>
			<?php echo $nombre; ?>

			<p class="gris">Apellido paterno</p>
			<?php echo $apellido_paterno; ?>

			<p class="gris">Apellido materno</p>
			<?php echo $apellido_materno; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Nombre de usuario</p>
			<?php echo $username; ?>

			<p class="gris">Teléfono</p>
			<?php echo $telefono; ?>

			<p class="gris">Correo</p>
			<?php echo $correo; ?>
		</article>
	</section>
	<section class="col s4">
		<p class="gris">Dirección</p>
		<?php echo $direccion; ?>

		<p class="gris">Localidad</p>
		<?php echo $nombre_localidad; ?>
	</section>
</div>
<?php } }?>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">search</i>Datos de instalación</span>
</div>
<?php 
$select = "SELECT * FROM instalacion WHERE id = '$id_usuario'";
$query_select = mysqli_query($conexion,$select);
while($row_instala = mysqli_fetch_array($query_select)) {
	$puerta = $row_instala['puerta'];
	$ventana = $row_instala['ventana'];
	$foco = $row_instala['foco'];
	$dispositivo = $row_instala['dispositivo'];
	$cochera = $row_instala['cochera'];
}
?>
<div class="row" style="padding-left:45px;">
	<section class="col s4">
		<article>
			<p class="gris">Número de puertas</p>
			<?php echo $puerta; ?>
		</article>
		<article>
			<p class="gris">Número de ventanas</p>
			<?php echo $ventana; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Número de focos</p>
			<?php echo $foco; ?>
		</article>
		<article>
			<p class="gris">Número de dispositivos</p>
			<?php echo $dispositivo; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Cochera</p>
			<?php echo $cochera; ?>
		</article>
	</section>
</div>
</div>
</body>
</html>