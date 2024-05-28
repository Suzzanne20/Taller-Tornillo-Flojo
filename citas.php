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
      <div class="row justify-content-center">
   
    <div class="col-3"><div class="modal-content"><div class="container">
    <br><h2>Nueva Cita</h2><br>
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
            <div class="form-group">
                <label for="descri">Telefono</label>
                <input type="text" class="form-control" id="descri" name="descri" required>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text col-5" for="id_tipo">Vehiculo</label>
                <select class="form-select" id="placa" name="placa" required>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text col-5" for="id_tserv">Tipo de Servicio</label>
                <select class="form-select" id="id_tserv" name="id_tserv" required>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del Servicio</label>
                <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agendar Cita</button></div>
        </form>
        <br></div></div></div>
        <div class="col-5">  
        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
            <div class="elfsight-app-331a64f2-6800-49c5-8155-dc514abc3e17" data-elfsight-app-lazy></div>
        </div></div> <br>   
         
    </div></div>      

</html>
