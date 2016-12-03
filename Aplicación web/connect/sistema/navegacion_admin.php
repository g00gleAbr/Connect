<?php ob_start(); ?>
<?php 
session_start();
if (!isset($_SESSION['correo'])) {
  header("Location: index.php?no_user=No te has identificado!");
  exit();
}else{
?>
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
	<title>Administrador</title>
</head>
<body>
<script src="css/sweetalert-master/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>
<style type="text/css">
  .input-field .prefix.active {
     color: #FF3F80;
   }
   .input-field input[type=text]:focus + label {
     color: #FF3F80;
   }
   .input-field input[type=textarea]:focus + label {
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
   .input-field input[type=textarea]:focus {
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
<nav class="indigo">
	<div class="nav-wrapper">
		<a href="panel_admin.php" class="brand-logo" style="padding-left:15px;">Connect</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a class="modal-trigger waves-effect waves-light" href="#modal5"><i class="material-icons left">contact_mail</i>Contacto</a></li>
        	<li><a class="waves-effect waves-light datepicker"><i class="material-icons left">date_range</i>Ver calendario</a></li>
        	<li><a class="waves-effect waves-light" href="cerrar_sesion.php?cerrar_admin">Cerrar sesión<i class="material-icons left">exit_to_app</i></a></li>
		</ul>
	</div>
</nav>
<!--modal-->
<div id="modal5" class="modal">
  <div class="modal-content">
      <h5>Área de contacto</h5>
      <p>Si tienes alguna duda de la plataforma o alguna corrección escribe al siguiente correo y se te dará respuesta</p>
      <a href="#!">ayala.jap@gmail.com</a>
      <p>Si tienes más inquietudes puedes escribir por chat dando click <a href="https://twitter.com/abr_ap">aquí</a></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>
<!--Navegacion lateral-->
<div class="row">
	<div class="col s3">
		<section id="contenedor" class="z-depth-1" style="background-image: url('../img/flat.png');">
			<article class="center-align">
				<img src="../img/mysql.png" width="100">
				<p style="font-size:16px;" class="white-text"><b>Administrador</b></p>
			</article>
		</section>
		<section style="background-color:#FFFFFF;" id="enlaces-admin" class="z-depth-1" align="left">
		<br>
			<a class="btn-flat waves-effect waves-grey" href="panel_admin.php">Tablero<i style="font-size:30px;" class="material-icons left">dashboard</i></a>
			<p class="divider"></p>
			<a class="btn-flat waves-effect waves-grey" href="panel_admin.php?crear_nota_admin">Crear nota<i style="font-size:30px;" class="material-icons left">note_add</i></a>
			<p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="panel_admin.php?recibe_comentarios">Comentarios<i style="font-size: 30px;" class="material-icons left">comment</i></a>
      <p class="divider"></p>
			<a class="btn-flat waves-effect waves-grey" href="busca_usuario.php"><i style="font-size:30px;" class="material-icons left">group</i>Buscar Usuario</a>


		</section>
	</div>

<script type="text/javascript">
	  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15
  });
</script>
<script type="text/javascript">
 $(document).ready(function(){
    $('.modal-trigger').leanModal();
});
</script>
</body>
</html>
<?php } ?>
<?php ob_end_flush(); ?>