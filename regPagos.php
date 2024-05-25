<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>TALLER TF</title>
</head>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<body>
<div class="container mt-5">
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Nueva Orden de Pago</h1><br>
                <form action="registrarPago.php" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text col-5">Fecha</span>
                        <input type="text" class="form-control" placeholder="00/00/00" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del Servicio</label>
                        <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="monto">Monto  Q.</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
                    </div>                    
                    
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_servi">Orden de Servicio</label>
                        <select class="form-select" id="id_servi" name="id_servi" required>
                            <?php
                                require_once 'conexion.php';
                                $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
                                if (!$conn) {
                                    $e = oci_error();
                                    trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
                                } 
                                else {
                                $query = "SELECT ID_SERVI, PLACA FROM SERVICIO ORDER BY ID_SERVI ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_SERVI'] . "'>" . $row['ID_SERVI'] .' - ' . $row['PLACA'] . "</option>";
                                }
                                oci_free_statement($stmt);}
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>
