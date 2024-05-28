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
    <h1>Registrar nuevo insumo</h1><br>
                <form action="registrarInsumo.php" method="post">
                    <div class="form-group">
                        <label for="nombre_i">Nombre del Insumo</label>
                        <input type="text" class="form-control" id="nombre_i" name="nombre_i" required>
                    </div>
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="costo" name="costo" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="mini">Mínimo</label>
                        <input type="number" class="form-control" id="mini" name="mini" required>
                    </div>
                    <div class="form-group">
                        <label for="descri_i">Descripción</label>
                        <input type="text" class="form-control" id="descri_i" name="descri_i" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_tipo">Tipo de Insumo</label>
                        <select class="form-select" id="id_tipo" name="id_tipo" required>
                            <?php                                                      
                                require_once 'conexion.php';
                                $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
                                if (!$conn) {
                                    $e = oci_error();
                                    trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
                                } 
                                else {
                                    $query = "SELECT ID_TIPO, T_INSU FROM TIPO_INSU ORDER BY ID_TIPO ASC";
                                    $stmt = oci_parse($conn, $query);
                                    oci_execute($stmt);
                                    while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                        echo "<option value='" . $row['ID_TIPO'] . "'>" . $row['T_INSU'] . "</option>";
                                    }
                                    oci_free_statement($stmt);
                                    oci_close($conn);
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Insumo</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>
