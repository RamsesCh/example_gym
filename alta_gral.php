<?php
session_start();
require("conexion.php");

$id_cliente = $_POST['id_cliente'];
$id_modalidad = $_POST['id_modalidad'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$id_status = $_POST['id_status'];
$notas = $_POST['notas'];

$insertar = $mysqli->query("INSERT INTO general VALUES ('', '$id_cliente', '$id_modalidad', '$fecha_inicio', '$fecha_fin', '$id_status', '$notas')");

echo '<script>alert("Registro dado de alta")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>