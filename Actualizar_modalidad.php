<?php
require("conexion.php");

$id_modalidad = $_POST['id_modalidad'];
$tipo_modalidad = $_POST['tipo_modalidad'];
$costo = $_POST['costo'];
$status_mod = $_POST['status_mod'];

$insertar = $mysqli->query("UPDATE modalidad SET
	tipo_modalidad='$tipo_modalidad',
	costo='$costo', 
    status_mod='$status_mod'
	where id_modalidad='$id_modalidad'");

echo '<script>alert("Datos actualizados con exito")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>