<?php
require("conexion.php");

$id_cliente = $_POST['id_cliente'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$observaciones = $_POST['observaciones'];

$insertar = $mysqli->query("UPDATE clientes SET
	nombre='$nombre',
	apaterno='$apaterno',
    amaterno='$amaterno',
    telefono='$telefono',
    sexo='$sexo',
    correo='$correo',
    pass='$password', 
    observaciones='$observaciones'
    where id_cliente='$id_cliente'");

    echo '<script>alert("Datos actualizados con exito")</script>';
    echo "<script>location.href='perfil_cliente.php'</script>";

?>