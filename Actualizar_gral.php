<?php
require("conexion.php");

$id_gral = $_POST['id_gral'];
$id_modalidad = $_POST['id_modalidad'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$status = $_POST['status'];
$notas = $_POST['notas'];

$insertar = $mysqli->query("UPDATE general SET
	id_modalidad='$id_modalidad',
	fecha_inicio='$fecha_inicio',
    fecha_fin='$fecha_fin',
    id_status='$status',
    notas='$notas'
    where id_gral='$id_gral'");

echo '<script>alert("Datos actualizados con exito")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>