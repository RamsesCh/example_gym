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
	<title>Cliente GYM</title>
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
    $('#example1').DataTable( {
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
  function consultarhist(datos)
  {
    console.log(datos);
  	d=datos.split('||');

  	$('#id_hist').val(d[0]);
  	$('#tipo_modalidad').val(d[2]);
  	$('#costo').val('$'+ d[3]);
    $('#fecha_inicio').val(d[4]);
    $('#fecha_fin').val(d[5]);
    $('#status').val(d[6]);
    $('#notas').val(d[7]);

  }

  function consultargral(datos)
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
</script>

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
                <h1><center>MIS DATOS GENERALES</center></h1>
            </div>
            <div class="card-body">
                <table class="display table">
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELIDO PATERNO</th>
                                <th>APELLIDO MATERNO</th>
                                <th>TELEFONO</th>
                                <th>Modificar</th>
                            </tr>
                            <?php
                                require("conexion.php");
                                $consulta=$mysqli->query("SELECT * FROM clientes WHERE correo='$correo'");
                                while($datos=$consulta->fetch_array())
                            {
                              $dato=$datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[3]."||".$datos[4]."||".$datos[5]."||".$datos[6]."||".$datos[7]."||".$datos[8]."||".$datos[9];
                            ?>
                                <tr>
                                    <td><?php echo $datos['nombre']?></td>
                                    <td><?php echo $datos['apaterno']?></td>
                                    <td><?php echo $datos['amaterno']?></td>
                                    <td><?php echo $datos['telefono']?></td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#consultargral" onClick="consultargral('<?php echo $dato ?>')">Modificar</button></a></td>
                                </tr>
                                <tr>
                                    <th>SEXO</th>
                                    <th>CORREO</th>
                                    <th>CONTRASEÑA</th>
                                    <th>OBSERVACIONES</th>
                                </tr>
                                <tr>
                                    <td><?php echo $datos['sexo']?></td>
                                    <td><?php echo $datos['correo']?></td>
                                    <td><?php echo $datos['password']?></td>
                                    <td><?php echo $datos['observaciones']?></td>
                                </tr>
                            <?php
                                }  
                            ?>
                 </table>
            </div>
        </div>
    </div><br><br>
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h1><center>HISTORIAL DE PAGOS</center></h1>
            </div>
            <div class="card-body">
                <table class="display table" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
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
                                $consulta=$mysqli->query("SELECT general.id_gral, clientes.id_cliente, modalidad.tipo_modalidad, modalidad.costo, general.fecha_inicio, general.fecha_fin, status_pago.status, general.notas FROM general INNER JOIN modalidad ON modalidad.id_modalidad=general.id_modalidad INNER JOIN status_pago on status_pago.id_status=general.id_status INNER JOIN clientes ON clientes.id_cliente=general.id_cliente where clientes.id_cliente='$id_usuario'");

                                $cont=1;
                                while($datos=$consulta->fetch_array())
                            {
                              $dato=$datos[0]."||".$datos[1]."||".$datos[2]."||".$datos[3]."||".$datos[4]."||".$datos[5]."||".$datos[6]."||".$datos[7];
                            ?>
                                <tr>
                                    <td><?php echo $cont?></td>
                                    <td><?php echo $datos['tipo_modalidad']?></td>
                                    <td><?php echo '$'.$datos['costo']?></td>
                                    <td><?php echo $datos['fecha_inicio']?></td>
                                    <td><?php echo $datos['fecha_fin']?></td>
                                    <td><?php echo $datos['status']?></td>
                                    <td><?php echo $datos['notas']?></td>
                                    <td><center><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#consultarhist" onClick="consultarhist('<?php echo $dato ?>')">Ver Detalles</button></a></td>
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
	</div>
<!-- SECCION DE MODALES -->
<!--------------MODAL Actualizar Datos---------------->
<div class="modal fade" id="consultargral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">MIS DATOS GENERALES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="Actualizar_datos.php" method="POST">
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
          <select class="form-select" aria-label="Default select example" name="sexo">
                    <option selected>Sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
          </select></p>
          <label>Correo</label>
      		<input type="email" name="correo" id="correo" class="form-control"></p>
          <label>Password</label>
      		<input type="text" name="password" id="password" class="form-control"></p>
          <label>Observaciones</label>
      		<input type="text" name="observaciones" id="observaciones" class="form-control"></p>
        
      		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="button btn btn-warning">Actualizar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
<!--------------MODAL Consultar Historico---------------->
<div class="modal fade" id="consultarhist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALLE HISTORICO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST">
      		<input type="number" hidden=" " id="id_hist" name="id_cliente">
      		<label>Modalidad</label>
      		<input type="text" class="form-control" id="tipo_modalidad" name="tipo_modalidad" disabled></p>
      		<label>Costo</label>
      		<input type="text" name="costo" id="costo" class="form-control" disabled></p>
          <label>Fecha de Inicio</label>
      		<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" disabled></p>
          <label>Fecha de Fin</label>
      		<input type="date" name="fecha_fin" id="fecha_fin" class="form-control" disabled></p>
          <label>Status</label>
      		<input type="text" name="status" id="status" class="form-control" disabled></p>
          <label>Notas</label>
      		<input type="text" name="notas" id="notas" class="form-control" disabled></p>
      		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>