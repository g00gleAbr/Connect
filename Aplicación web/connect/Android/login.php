<?php 
include("../sistema/conexion.php");

$username = $_POST['correo'];
$password = $_POST['pass'];

$query = "SELECT * FROM usuarios WHERE correo = '$username' AND pass = '$password'";
$res = mysqli_query($conexion,$query);

$revisa = mysqli_fetch_array($res);
if (isset($revisa)) {
	echo "success";
}else{
	echo "failed";
}
mysqli_close($conexion);
?>