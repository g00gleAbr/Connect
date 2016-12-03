<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">account_box</i>Información de usuario</span>
</div>
<?php 
$usuario = $_SESSION['correo'];
$select = "SELECT * FROM usuarios WHERE correo = '$usuario'";
$query_select = mysqli_query($conexion,$select);
while ($row = mysqli_fetch_array($query_select)) {
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
}
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
		<a class="pink-text" href="panel_usuario.php?modificar_datos">Modificar datos</a>
	</section>
</div>
<div class="card-panel">
	<span class="pink-text"><i class="material-icons left">account_box</i>Información de instalación</span>
</div>
<?php 
$select = "SELECT * FROM instalacion WHERE correo = '$usuario'";
$query_select = mysqli_query($conexion,$select);
$revisa = mysqli_num_rows($query_select);
if($revisa == 0) {
	echo "<br>";
	echo "<center>No tienes nada aún :(</center>";
	echo "<br>";
}else{
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
<?php } ?>
</body>
</html>