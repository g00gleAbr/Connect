<?php 
$conexion = mysqli_connect('localhost','root','','connect');
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$comentario = $_POST['comentario'];

$insertar = "INSERT INTO comentarios(nombre,correo,comentario)VALUES('".$nombre."','".$correo."','".$comentario.")";
$query = mysqli_query($conexion,$insertar);
 
?>