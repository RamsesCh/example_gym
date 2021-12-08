<?php 
session_start();
if ($_SESSION['correo'])
{
	session_destroy();
	header("location:index.php");
}
else
{
	header("location:index.php");
}

?>