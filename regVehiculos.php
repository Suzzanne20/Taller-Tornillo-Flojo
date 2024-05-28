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
    <h1>Registrar Vehículo</h1><br>
    <form action="registrarVehiculo.php" method="post">
        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" class="form-control" id="placa" name="placa" required>
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" required>
        </div>
        <div class="form-group">
            <label for="kilometraje">Kilometraje</label>
            <input type="number" step="0.01" class="form-control" id="kilometraje" name="kilometraje" required>
        </div>
        
       <div class="input-group mb-3">
            <label class="input-group-text col-5" for="id_cliente">Cliente</label>
            <select class="form-select" id="id_cliente" name="id_cliente" required>
                <?php                                                      
                    require_once 'conexion.php';
                    $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
                    if (!$conn) {
                        $e = oci_error();
                        trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
                    } 
                    else {
                        $query = "SELECT ID_CLIENTE, NOMBRE_CLI FROM CLIENTE ORDER BY ID_CLIENTE ASC";
                        $stmt = oci_parse($conn, $query);
                        oci_execute($stmt);
                        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                            echo "<option value='" . $row['ID_CLIENTE'] . "'>" . $row['NOMBRE_CLI'] . "</option>";
                        }
                        oci_free_statement($stmt);
                    }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrar Vehículo</button>
    </form>
     <br></div></div></div>
</div>

</body>
</html>