<?php
session_start();
require("conexion.php");

$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$observaciones = $_POST['observaciones'];
$tipo_us = 'cliente';


$insertar = $mysqli->query("INSERT INTO clientes VALUES ('','$nombre', '$apaterno', '$amaterno', '$telefono', '$sexo', '$correo', '$password', '$observaciones', '$tipo_us')");

echo '<script>alert("Cliente dado de alta")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>