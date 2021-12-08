<?php 
session_start();
if(@!$_SESSION['correo'])
{
  header("location:index.php");
}
$id_usuario=$_SESSION['id_usuario'];
$correo=$_SESSION['correo'];
$nombre = $_SESSION['nombre'];
$tipo_us=$_SESSION['tipo_us'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrador GYM</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<script>
	$(document).ready(function() {
    $('#example1, #example2, #example3').DataTable( {
        "language": {
        	"search": "Buscar: ",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "paginate":
            {
            	"previous":"Anterior",
            	"next":"Siguiente"
            }
        }
    } );
} );
</script>
<script>
  function consultarmod(datos)
  {
    console.log(datos);
  	d=datos.split('||');

  	$('#id_modalidad').val(d[0]);
  	$('#tipo_modalidad').val(d[1]);
  	$('#costo').val(d[2]);
    $('#statusmod').val(d[3]);

  }

  function consultarclien(datos)
  {
    console.log(datos);
  	d=datos.split('||');

  	$('#id_cliente').val(d[0]);
  	$('#nombre').val(d[1]);
  	$('#apaterno').val(d[2]);
    $('#amaterno').val(d[3]);
    $('#telefono').val(d[4]);
    $('#sexo').val(d[5]);
    $('#correo').val(d[6]);
    $('#password').val(d[7]);
    $('#observaciones').val(d[8]);
    $('#tipo_us').val(d[9]);

  }

  function consultargral(datos)
  {
    console.log(datos);
  	d=datos.split('||');

  	$('#id_gral').val(d[0]);
  	$('#nombre2').val(d[1]);
  	$('#apaterno2').val(d[2]);
    $('#amaterno2').val(d[3]);
    $('#tipo_modalidad2').val(d[4]);
    $('#costo2').val(d[5]);
    $('#fecha_inicio').val(d[6]);
    $('#fecha_fin').val(d[7]);
    $('#statusgral').val(d[8]);
    $('#notas').val(d[9]);

  }
</script>
<style>
  #status{
    color:green;
  }
  
  #status2{
    color:red;
  }
</style>

<div class="container-fluid">
    <nav class="navbar navbar-dark bg-dark">
        <img src="./img/logo.jpg" height="80px" width="100px" style="margin-left: 10px;">
        <h1 style="color: white;">Bienvenido al sistema <?php echo $nombre; ?></h1>
        <a href="desconectar.php"><button class="btn btn-danger" style="margin-right: 10px;">Cerrar sesion</button></a>
    </nav>
</div>
	<div class="container-fluid" style="margin-top:30px">
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h1><center>LISTA GENERAL</center></h1>
            </div>
            <div class="card-body">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modalinsertgral">Agregar nuevo</button><br><br>
                <table class="display table" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>CLIENTE</th>
                                <th>MODALIDAD</th>
                                <th>COSTO</th>
                                <th>FECHA DE INICIO</th>
                                <th>FECHA DE FIN</th>
                                <th>STATUS</th>
                                <th>NOTAS</th>
                                <th>Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require("conexion.php");
                                $consulta=$mysqli->query("SELECT general.id_gral, clientes.nombre, clientes.apaterno, clientes.amaterno, modalidad.tipo_modalidad, modalidad.costo, general.fecha_inicio, general.fecha_fin, status_pago.status, general.notas FROM `general` INNER JOIN clientes ON clientes.id_cliente=general.id_cliente INNER JOIN modalidad ON modalidad.id_modalidad=general.id_modalidad INNER JOIN status_pago on status_pago.id_status=general.id_status");

                                $cont=1;
                                while($datos=$consulta->fetch_array())
                            {
                              $dato=$datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[3]."||".$datos[4]."||".$datos[5]."||".$datos[6]."||".$datos[7]."||".$datos[8]."||".$datos[9];
                            ?>
                                <tr>
                                    <td><?php echo $cont?></td>
                                    <td><?php echo $datos['nombre'].' '.$datos['apaterno'].' '.$datos['amaterno']?></td>
                                    <td><?php echo $datos['tipo_modalidad']?></td>
                                    <td><?php echo '$'.$datos['costo']?></td>
                                    <td><?php echo $datos['fecha_inicio']?></td>
                                    <td><?php echo $datos['fecha_fin']?></td>
                                    <?php if($datos['status'] == 'PAGADO')
                                            { ?>
                                              <td id="status"><?php echo $datos['status']?></td>
                                      <?php } 
                                      else 
                                            { ?>
                                               <td id="status2"><?php echo $datos['status']?></td>
                                      <?php } ?>
                                    <td><?php echo $datos['notas']?></td>
                                    <td><center><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#consultargral" onClick="consultargral('<?php echo $dato ?>')">Modificar</button></a></td>
                                </tr>
                            <?php
                            $cont=$cont+1;
                            }  
                            ?>
                    </tbody>
                 </table>
            </div>
        </div>
    </div><br><br>
		<div class="card">
			<div class="card-header">
				<h1><center>CLIENTES</center></h1>
			</div>
			<div class="card-body">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modalinsertclient">Agregar Cliente</button><br><br>
			     <table class="display table" id="example2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>SEXO</th>
                            <th>OBSERVACIONES</th>
                            <th>MODIFICAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require("conexion.php");
                            $consulta=$mysqli->query("SELECT * FROM clientes WHERE tipo_us='cliente'");
                            $cont=1;

                            while($datos=$consulta->fetch_array())
                        {
                          $dato=$datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[3]."||".$datos[4]."||".$datos[5]."||".$datos[6]."||".$datos[7]."||".$datos[8]."||".$datos[9];
                        ?>
                            <tr>
                                <td><?php echo $cont?></td>
                                <td><?php echo $datos['nombre'].' '.$datos['apaterno'].' '.$datos['amaterno']?></td>
                                <td><?php echo $datos['telefono']?></td>
                                <td><?php echo $datos['correo']?></td>
                                <td><?php echo $datos['sexo']?></td>
                                <td><?php echo $datos['observaciones']?></td>
                                <td><center><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#consultarclien" onClick="consultarclien('<?php echo $dato ?>')">Modificar</button></a></td>
                            </tr>
                        <?php
                        $cont=$cont+1;
                        }  
                        ?>
                    </tbody>
                 </table>
			</div>
		</div><br>
		<div class="card">
			<div class="card-header">
				<h1><center>MODALIDADES</center></h1>
			</div>
				<div class="card-body">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Modalinsertmodalidad">Agregar Modalidad</button><br><br>
					<table class="display table" id="example3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>MODALIDAD</th>
                                <th>COSTO</th>
                                <th>STATUS</th>
                                <th>MODIFICAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require("conexion.php");
                                $consulta=$mysqli->query("SELECT * FROM modalidad");

                                while($datos=$consulta->fetch_array())
                            {
                              $dato=$datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[3];
                            ?>
                                <tr>
                                    <td><?php echo $datos['id_modalidad']?></td>
                                    <td><?php echo $datos['tipo_modalidad']?></td>
                                    <td><?php echo '$'.$datos['costo']?></td>
                                    <td><?php echo $datos['status']?></td>

                                    <td><center><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#consultarmod" onClick="consultarmod('<?php echo $dato ?>')">Modificar</button></a></td>
                                </tr>
                            <?php
                            }  
                            ?>
                    </tbody>
                 </table>
				</div>
		</div>
	</div>
<!-- SECCION DE MODALES -->
<!-- modal de insercion a la tabla generla -->
<div class="modal fade" id="Modalinsertgral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="alta_gral.php" method="POST">
          <Label>Cliente</Label>
          <select class="form-select" aria-label="Default select example" name="id_cliente">
            <?php
              $consulta=$mysqli->query("SELECT * FROM clientes where tipo_us='cliente'");

              while($datos=$consulta->fetch_array())
              {
            ?>
              <option value="<?php echo $datos['id_cliente']?>"><?php echo $datos['nombre'].' '.$datos['apaterno'].' '.$datos['amaterno'];?></option>

            <?php 
              }
            ?>
          </select></p>
          <Label>Modalidad</Label>
          <select class="form-select" aria-label="Default select example" name="id_modalidad">
            <?php
              $consulta=$mysqli->query("SELECT * FROM modalidad");

              while($datos=$consulta->fetch_array())
              {
            ?>
              <option value="<?php echo $datos['id_modalidad']?>"><?php echo $datos['tipo_modalidad'];?></option>

            <?php 
              }
            ?>
          </select></p>
          <label>Fecha de Inicio</label>
          <input type="date" name="fecha_inicio"></p>
          <label>Fecha de Fin</label>
          <input type="date" name="fecha_fin"></p>
          <Label>Modalidad</Label>
          <select class="form-select" aria-label="Default select example" name="id_status">
            <?php
              $consulta=$mysqli->query("SELECT * FROM status_pago");

              while($datos=$consulta->fetch_array())
              {
            ?>
              <option value="<?php echo $datos['id_status']?>"><?php echo $datos['status'];?></option>

            <?php 
              }
            ?>
          </select></p>
          <label>Notas</label>
          <input type="text" class="form-control" name="notas">
        
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="button btn btn-warning">AGREGAR</button>
            </div>
      </form>
    </div>
  </div>
</div>
<!-- modal de insercion a la tabla clientes-->
<div class="modal fade" id="Modalinsertclient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="alta_cliente.php" method="POST">
                <input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required></p>
                <input type="text" class="form-control" name="apaterno" placeholder="APELLIDO PATERNO" required></p>
                <input type="text" class="form-control" name="amaterno" placeholder="APELLIDO MATERNO" required></p>
                <input type="number" class="form-control" name="telefono" placeholder="TELEFONO" required></p>
                <select class="form-select" aria-label="Default select example" name="sexo">
                    <option selected>Sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select></p>
                <input type="email" class="form-control" name="correo" placeholder="CORREO" required></p>
                <input type="password" class="form-control" name="password" placeholder="CONTRASEÑA" required></p>
                <input type="text" class="form-control" name="observaciones" placeholder="OBSERVACIONES" required></p>
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="button btn btn-warning">AGREGAR</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- modal de insercion a la tabla Modalidades-->
<div class="modal fade" id="Modalinsertmodalidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar un nueva Modalidad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="alta_modalidad.php" method="POST">
                <input type="text" class="form-control" name="modalidad" placeholder="MODALIDAD" required></p>
                <input type="int" class="form-control" name="costo" placeholder="COSTO" required></p>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option selected>Status</option>
                    <option value="Activado">Activado</option>
                    <option value="Desactivado">Desactivado</option>
                </select></p>
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="button btn btn-warning">AGREGAR</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!--------------MODAL Actualizar Modalidad---------------->
<div class="modal fade" id="consultarmod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CONSULTA MODALIDAD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="Actualizar_modalidad.php" method="POST">
      		<input type="number" hidden=" " id="id_modalidad" name="id_modalidad">
      		<label>Modalidad</label>
      		<input class="form-control" id="tipo_modalidad" name="tipo_modalidad"></p>
      		<label>Costo</label>
      		<input type="text" name="costo" id="costo" class="form-control"></p>
      		<label>Estado</label>
          <select class="form-select" aria-label="Default select example" name="status_mod" id="statusmod">
                    <option value="Activado">Activado</option>
                    <option value="Desactivado">Desactivado</option>
          </select></p>
      		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="button btn btn-warning">Actualizar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
<!--------------MODAL Actualizar Clientes---------------->
<div class="modal fade" id="consultarclien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CONSULTA CLIENTES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="Actualizar_cliente.php" method="POST">
      		<input type="number" hidden=" " id="id_cliente" name="id_cliente">
      		<label>Nombre</label>
      		<input type="text" class="form-control" id="nombre" name="nombre"></p>
      		<label>Apellido Paterno</label>
      		<input type="text" name="apaterno" id="apaterno" class="form-control"></p>
          <label>Apellido Materno</label>
      		<input type="text" name="amaterno" id="amaterno" class="form-control"></p>
          <label>Telefono</label>
      		<input type="number" name="telefono" id="telefono" class="form-control"></p>
      		<label>Sexo</label>
          <select class="form-select" aria-label="Default select example" name="sexo" id="sexo">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
          </select></p>
          <label>Correo</label>
      		<input type="email" name="correo" id="correo" class="form-control"></p>
          <label>Password</label>
      		<input type="text" name="password" id="password" class="form-control"></p>
          <label>Observaciones</label>
      		<input type="text" name="observaciones" id="observaciones" class="form-control"></p>
          <label>Tipo de Usuario</label>
          <select class="form-select" aria-label="Default select example" name="tipo_us" id="tipo_us">
                    <option value="admin">Administrador</option>
                    <option value="cliente">Cliente</option>
          </select></p>
      		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="button btn btn-warning">Actualizar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
<!--------------MODAL Actualizar General---------------->
<div class="modal fade" id="consultargral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CONSULTA GENERAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="Actualizar_gral.php" method="POST">
      		<input type="number" hidden=" " id="id_gral" name="id_gral">
      		<label>Nombre</label>
      		<input type="text" class="form-control" id="nombre2" name="nombre" disabled></p>
      		<label>Apellido Paterno</label>
      		<input type="text" name="apaterno" id="apaterno2" class="form-control" disabled></p>
          <label>Apellido Materno</label>
      		<input type="text" name="amaterno" id="amaterno2" class="form-control" disabled></p>
          <label>Tipo de Mensualidad</label>
          <select class="form-select" aria-label="Default select example" name="id_modalidad">
            <?php
              $consulta=$mysqli->query("SELECT * FROM modalidad");
              while($datos=$consulta->fetch_array())
              {
            ?>
              <option value="<?php echo $datos['id_modalidad']?>"><?php echo $datos['tipo_modalidad'];?></option>

            <?php 
              }
            ?>
          </select></p>
          <label>Costo</label>
      		<input type="number" name="costo" id="costo2" class="form-control" disabled></p>
          <label>Fecha de Inicio</label>
      		<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"></p>
          <label>Fecha de Fin</label>
      		<input type="date" name="fecha_fin" id="fecha_fin" class="form-control"></p>
          <label>Status</label>
          <select class="form-select" aria-label="Default select example" name="statusgral">
                    <option value="1">PAGADO</option>
                    <option value="2">DEUDOR</option>
          </select></p>
          <label>Notas</label>
      		<input type="text" name="notas" id="notas" class="form-control"></p>
      		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="button btn btn-warning">Actualizar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>