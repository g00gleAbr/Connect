<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/sweetalert-master/dist/sweetalert.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link type="text/css" rel="stylesheet" href="css/materialize/css/materialize.min.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Inica sesión</title>
</head>
<body>
<script src="css/sweetalert-master/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>
<?php include("conexion.php");
session_start(); ?>
<nav class="indigo">
	<div class="nav-wrapper">
		<a href="../index.php" class="brand-logo" style="padding-left:20px;">Connect</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="#modal1" class="waves-effect waves-light modal-trigger">Iniciar sesión</a></li>
			<li><a href="#modal2" class="waves-effect waves-light modal-trigger">Admin</a></li>
		</ul>
	</div>
</nav>
<!-- Inicio se sesión usuario -->
<div id="modal1" class="modal">
	<div class="modal-content" align="center">
    	<h4 class="grey-text">Usuarios</h4>
      	<p class="indigo-text">Ingreso de usuarios, si no tienes una cuenta regístrate</p>
      	<form action="" method="post">
      		<div class="row container">
      			<div class="input-field col s10">
      				<i class="material-icons prefix">account_circle</i>
      				<input type="text" name="correo_usuario" id="mail">
      				<label for="mail">Correo</label>
      			</div>
      			<div class="input-field col s10">
      				<i class="material-icons prefix">vpn_key</i>
      				<input type="password" name="pass_usuario" id="pass">
      				<label for="pass">Contraseña</label>
      			</div>
      			<button type="submit" style="width:250px; background-color: #FF3F80;" class="btn waves-effect waves-light" name="inicia_usuario">Iniciar Sesión</button>
      		</div>
      	</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<?php 
if (isset($_POST['inicia_usuario'])) {
	$correo_usuario = $_POST['correo_usuario'];
	$pass_usuario = $_POST['pass_usuario'];

	$selecciona_usuario = "SELECT * FROM usuarios WHERE correo = '$correo_usuario' AND pass = '$pass_usuario'";
	$query_selecciona = mysqli_query($conexion,$selecciona_usuario);
	$revisa_usuario = mysqli_num_rows($query_selecciona);
	if ($revisa_usuario == 1) {
		$_SESSION['correo'] = $correo_usuario;
		header('Location: panel_usuario.php');
	}else{
		echo "Correo o contraseña incorrectos, intenta de nuevo.";
	}
}
?>
<!-- Inicio se sesión administrador-->
<div id="modal2" class="modal">
	<div class="modal-content" align="center">
    	<h4 class="grey-text">Administrador</h4>
      	<p class="indigo-text">Sólo personal autorizado tiene acceso</a></p>
      	<form action="" method="post">
      		<div class="row container">
      			<div class="input-field col s10">
      				<i class="material-icons prefix">account_circle</i>
      				<input type="text" name="correo_admin" id="mail">
      				<label for="mail">Correo</label>
      			</div>
      			<div class="input-field col s10">
      				<i class="material-icons prefix">vpn_key</i>
      				<input type="password" name="pass_admin" id="pass">
      				<label for="pass">Contraseña</label>
      			</div>
      			<button type="submit" class="btn waves-effect waves-light" style="background-color: #FF3F80; width: 16em;" name="inicia_admin">Iniciar Sesión</button>
      		</div>
      	</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<?php 
if (isset($_POST['inicia_admin'])) {
	$correo_admin = $_POST['correo_admin'];
	$pass_admin = $_POST['pass_admin'];

	$selecciona_admin = "SELECT * FROM administradores WHERE correo = '$correo_admin' AND pass = '$pass_admin'";
	$query_selecciona_admin = mysqli_query($conexion,$selecciona_admin);
	$revisa_admin = mysqli_num_rows($query_selecciona_admin);
	if ($revisa_admin == 0) {
		echo "Contraseña o correo incorrectos, intenta de nuevo, regresa e inicia de nuevo";
		echo "<br><br> <a href='index.php'>Iniciar de nuevo</a>";
		exit();
	}else{
		$_SESSION['correo'] = $correo_admin;
		header('Location: panel_admin.php');		
	}
}
?>
<style type="text/css">
	.input-field .prefix.active {
     color: #FF3F80;
   }
   .input-field input[type=text]:focus + label {
     color: #FF3F80;
   }
   .input-field input[type=password]:focus + label {
     color: #FF3F80;
   }
   .input-field input[type=email]:focus + label {
     color: #FF3F80;
   }
   .input-field input[type=text]:focus {
     border-bottom: 1px solid #FF3F80;
     box-shadow: 0 1px 0 0 #FF3F80;
   }
   .input-field input[type=password]:focus {
     border-bottom: 1px solid #FF3F80;
     box-shadow: 0 1px 0 0 #FF3F80;
   }
   .input-field input[type=email]:focus {
     border-bottom: 1px solid #FF3F80;
     box-shadow: 0 1px 0 0 #FF3F80;
   }
</style>
<!--area de registro-->
<center>
	<h4>Área de registro</h4>
</center>
	<form class="row container white z-depth-1" action="" method="post">
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="nombre" id="nam" required>
			<label for="nam">Nombre</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="apellido_paterno" id="ap" required>
			<label for="ap">Apellido paterno</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input type="text" name="apellido_materno" id="am">
			<label for="am">Apellido materno (opcional)</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">android</i>
			<input type="text" name="username" id="un" required>
			<label for="un">Nombre de usuario</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">dialpad</i>
			<input type="password" name="pass" id="ps" required>
			<label for="ps">Contraseña</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">contact_phone</i>
			<input type="text" name="telefono" id="phone" required>
			<label for="phone">Teléfono</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">email</i>
			<input type="email" name="correo" id="mail" required>
			<label for="mail">Correo</label>
		</div>
		<div class="input-field col s6">
			<i class="material-icons prefix">home</i>
			<input type="text" name="direccion" id="dir" required>
			<label for="dir">Dirección</label>
		</div>
		<div class="input-field col s6">
			<select name="localidad">
				<option disabled selected>Escoge tu localidad</option>
				<?php 
				$select_loc = "SELECT * FROM localidad";
				$query_select = mysqli_query($conexion,$select_loc);
				while ($row = mysqli_fetch_array($query_select)) {
					$id_localidad = $row['id'];
					$nombre_localidad = $row['nombre'];

					echo "<option value='$id_localidad'>$nombre_localidad</option>";
				}
				?>
			</select>
		</div>
		<div style="padding-left: 40em; padding-top: 22em;">
			<button type="submit" name="registro" class="btn waves-effect waves-light" style="background-color: #FF3F80; width: 16em;">Regístrame</button>
		</div>
	</form>
<?php 
if (isset($_POST['registro'])) {
	$nombre = $_POST['nombre'];
	$apellido_paterno = $_POST['apellido_paterno'];
	$apellido_materno = $_POST['apellido_materno'];
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$direccion = $_POST['direccion'];
	$localidad = $_POST['localidad'];

	$insert = "INSERT INTO usuarios(nombre,apellido_paterno,apellido_materno,username,pass,telefono,correo,direccion,localidad)VALUES('$nombre','$apellido_paterno','$apellido_materno','$username','$pass','$telefono','$correo','$direccion','$localidad')";
	$query_insert = mysqli_query($conexion,$insert);

	$destinatario = $correo;
	$asunto = "Acceso a Connect";
	$cuerpo = "
		<!DOCTYPE html>
		<html>
		<head>
			<title>Bienvenido</title>
		</head>
		<body>
			<h4>Recientemente te registraste en Connect</h4>
			<p>Te damos la bienvenida a este servicio donde puedes acceder desde cualquier lugar y mejorar tu calidad de vida.</p>
		</body>
		</html>
	";
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers .= "De: Abraham Ayala <abr_ap@hotmail.com>\r\n";
	$headers .= "Responder a: <ayala.jap@gmail.com>";

	mail($destinatario,$asunto,$cuerpo,$headers);

	if ($query_insert) {
		$_SESSION['correo'] = $correo;
		header('Location: panel_usuario.php');
	}
	echo "Algo salió mal, verifica o intenta de nuevo.";
}
?>
</center>
<script type="text/javascript">
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});
$(document).ready(function() {
    $('select').material_select();
  });
</script>
<script type="text/javascript">
	  $(document).ready(function(){
      $('.parallax').parallax();
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>