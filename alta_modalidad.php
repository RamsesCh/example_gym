<?php
session_start();
require("conexion.php");

$modalidad = $_POST['modalidad'];
$costo = $_POST['costo'];
$status = $_POST['status'];

//$insertar = $mysqli->query("INSERT INTO modalidad VALUES ('','$modalidad', '$costo', '$status')");
$insertar = $mysqli->query("INSERT INTO modalidad (modalidad.id_modalidad, modalidad.tipo_modalidad, modalidad.costo, modalidad.status ) VALUES (NULL,'$modalidad', '$costo', '$status')");

echo '<script>alert("Modalidad dada de alta")</script>';
echo "<script>location.href='perfil_admin.php'</script>";
?>