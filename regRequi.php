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
    <h1>Nueva Requisicion</h1><br>
                <form action="registrarRequi.php" method="post">
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="insumo_id_insumo">Insumo</label>
                        <select class="form-select" id="insumo_id_insumo" name="insumo_id_insumo" required>
                            <?php                                                      
                                require_once 'conexion.php';
                                $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
                                if (!$conn) {
                                    $e = oci_error();
                                    trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
                                } 
                                else {
                                    $query = "SELECT ID_INSUMO, NOMBRE_I FROM INSUMO ORDER BY NOMBRE_I ASC";
                                    $stmt = oci_parse($conn, $query);
                                    oci_execute($stmt);
                                    while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                        echo "<option value='" . $row['ID_INSUMO'] . "'>" . $row['NOMBRE_I'] . "</option>";
                                    }
                                    oci_free_statement($stmt);
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="servicio_id_servi">Orden de Servicio</label>
                        <select class="form-select" id="servicio_id_servi" name="servicio_id_servi" required>
                            <?php
                                $query = "SELECT ID_SERVI, PLACA FROM SERVICIO ORDER BY ID_SERVI ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_SERVI'] . "'>" . $row['ID_SERVI'] .' - ' . $row['PLACA'] . "</option>";
                                }
                                oci_free_statement($stmt);
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="servicio_id_usuario">ID Usuario</label>
                        <select class="form-select" id="servicio_id_usuario" name="servicio_id_usuario" required>
                            <?php
                                $query = "SELECT ID_USUARIO, NOMBRE_U FROM USUARIO ORDER BY NOMBRE_U ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_USUARIO'] . "'>" . $row['ID_USUARIO'] .' - ' . $row['NOMBRE_U'] . "</option>";
                                }
                                oci_free_statement($stmt);
                                oci_close($conn);
                            ?>
                        </select>
                    </div>                  
                    <div class="input-group mb-3">
                        <span class="input-group-text col-5">No. de Requicisión</span>
                        <input type="number" step="0.01" class="form-control" id="no_requi" name="no_requi" required>
                    </div>
                    <div class="form-group">
                        <label for="cant_insu">Cantidad de Insumo</label>
                        <input type="number" step="0.01" class="form-control" id="c_insu" name="c_insu" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>