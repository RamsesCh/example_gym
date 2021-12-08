<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Arnold GYM</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body style="background-color: #151515;">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card" style="margin-top: 100px;" align="center">
					<div class="card-header">
						<img src="./img/logo.jpg" height="100px" width="150px">
					</div>
					<div class="card-body">
						<form action="login_validacion.php" method="POST">
							<h2>Inicia sesion con tu cuenta de usuario</h2>
							<input type="email" name="correo" placeholder="Ingresa tu correo"><br><br>
							<input type="password" name="password" placeholder="Ingresa tu contraseña"><br><br>
							<button type="submit" class="btn btn-warning">Iniciar Sesion</button>	
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>