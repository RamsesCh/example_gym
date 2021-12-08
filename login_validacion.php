<?php
   session_start();
   require("conexion.php");

$correo=$_POST['correo']; 
$password=$_POST['password'];

$consultar=$mysqli->query("SELECT * FROM clientes WHERE correo='$correo'");
if($dato=$consultar->fetch_array())
{
	if($password==$dato['password'])
	{
		$_SESSION['id_usuario']=$dato['id_cliente'];
		$_SESSION['correo']=$dato['correo'];
		$_SESSION['tipo_us']=$dato['tipo_us'];
		$_SESSION['nombre']=$dato['nombre'].' '.$dato['apaterno'].' '.$dato['amaterno'];

		$id_usuario=$_SESSION['id_usuario'];
        $correo=$_SESSION['correo'];
        $nombre=$_SESSION['nombre'];
        $tipo_us=$_SESSION['tipo_us'];

        if ($tipo_us=='admin') 
        {
        		echo '<script>alert("Bienvenido:'.$nombre.' '.$tipo_us.'")</script>';
        		echo "<script>location.href='perfil_admin.php'</script>";
        }
        else 
        {
        		echo '<script>alert("Bienvenido:'.$nombre.' '.$tipo_us.'")</script>';
        		echo "<script>location.href='perfil_cliente.php'</script>";
        }
	}
	else
	{
		echo '<script>alert("PASSWORD INCORRECTO")</script>';
		echo "<script>location.href='index.php'</script>";
	}
}
else
{
	    echo '<script>alert("USUARIO INCORRECTO")</script>';
		echo "<script>location.href='index.php'</script>";
}

 ?>