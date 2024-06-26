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
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<body>
<div class="container mt-5">
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Registrar Mecánico</h1><br>
    <form action="registrarMecanico.php" method="post">
        <div class="form-group">
            <label for="nombre_mec">Nombre</label>
            <input type="text" class="form-control" id="nombre_mec" name="nombre_mec" required>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
        </div>
        
        <div class="form-group">
            <label for="especialidad">Direccion</label>
            <input type="text" class="form-control">
        </div>
        <label for="especialidad">Fotografia</label>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Mecánico</button>
    </form>
    <br></div></div></div>
</div>

</body>
</html>
