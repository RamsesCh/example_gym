<?php
session_start();
require("conexion.php");

$modalidad = $_POST['modalidad'];
$costo = $_POST['costo'];
$status = $_POST['status'];

$insertar = $mysqli->query("INSERT INTO modalidad VALUES ('','$modalidad', '$costo', '$status')");

echo '<script>alert("Modalidad dada de alta")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>