<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="layout/Fondos.css" rel="stylesheet"> <!-- FONDOOOO -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>TALLER TF</title>
    
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>

<div class="">
    <div class="">
    <h1 style='color: white; font-size: 50px; text-shadow: 5px 5px 7px black' class="text-center">Reclamos</h1>  <br> 

      <div class="row justify-content-center">
   
    <div class="col-3"><div class="modal-content"><div class="container">
    <br><h2>Registro de Reclamo</h2><br>
        <form action="registrarOservicio.php" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text">Fecha</span>
                <input type="text" class="form-control col-3" placeholder="00/00/00" id="fecha" name="fecha" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text col-5" for="id_tipo">Cliente</label>
                <select class="form-select" id="placa" name="placa" required>
                </select>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text col-5" for="id_tipo">No. Orden de Trabajo</label>
                <select class="form-select" id="placa" name="placa" required>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del Reclamo</label>
                <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar</button></div>
        </form>
        <br></div></div></div>
        <div class="col-5">  

            <table class="table table-striped table-hover">
              <thead class='table-dark'>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">No.OT</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>21/05/24</td>
                  <td>Cliente 1</td>
                  <td>155</td>
                  <td>El silvin del Vehiculo se descompuso horas despues de la reparacion realizada</td>
                  <td>Verificando Incidente</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>23/05/24</td>
                  <td>Cliente 2</td>
                  <td>340</td>
                  <td>El Vehiculo presento Tornillos sueltos</td>
                  <td>Incidente Resuelto</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>27/05/24</td>
                  <td>Cliente 8</td>
                  <td>508</td>
                  <td>El asiento del Piloto no fue instalado correctamente</td>
                  <td>En Curso</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>27/05/24</td>
                  <td>Cliente 8</td>
                  <td>510</td>
                  <td>El vehiculo presenta fuga de aceite despues del servicio</td>
                  <td>Incidente Resuelto</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>27/05/24</td>
                  <td>Cliente 3</td>
                  <td>522</td>
                  <td>El vehiculo presento nuevamente sobrecalentamiento</td>
                  <td>En Curso</td>
                </tr>
              </tbody>
            </table>
                    <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
        
        </div>
            
          
      </div> <br>   
         
    </div></div>      

</html>
