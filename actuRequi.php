<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Actualizar Requisicion</title>
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<div class="container mt-5">
<?php
    require_once 'conexion.php'; // Conexión BD
    $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Procesar la actualización
        $no_requi = $_POST['no_requi'];
        $id_insumo = $_POST['id_insumo'];
        $id_servi = $_POST['id_servi'];
        $c_insu = $_POST['c_insu'];
    
        $query = "UPDATE REQUI SET ID_INSUMO = :id_insumo, ID_SERVI = :id_servi, NO_REQUI = :no_requi, C_INSU = :c_insu WHERE NO_REQUI = :no_requi";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':no_requi', $no_requi);
        oci_bind_by_name($stmt, ':id_insumo', $id_insumo);
        oci_bind_by_name($stmt, ':id_servi', $id_servi);
        oci_bind_by_name($stmt, ':c_insu', $c_insu);

        if (oci_execute($stmt)) {
            echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
            echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
            echo "<a href='listRequisiciones.php' class='btn btn-dark mb-3'>Listado de Requisiciones</a>";
            echo "<a href='regRequi.php' class='btn btn-primary mb-3'>Nueva Requisicion</a>";
            echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {

        $no_requi = $_GET['id'];

        $query = "SELECT NO_REQUI, C_INSU, ID_SERVI, ID_INSUMO FROM REQUI WHERE NO_REQUI = :no_requi";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':no_requi', $no_requi);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);

//------SELECTS
        $insumos_query = 'SELECT ID_INSUMO, NOMBRE_I FROM INSUMO';
        $insumos_stmt = oci_parse($conn, $insumos_query);
        oci_execute($insumos_stmt);

        $ordenes_query = 'SELECT ID_SERVI, PLACA FROM SERVICIO';
        $ordenes_stmt = oci_parse($conn, $ordenes_query);
        oci_execute($ordenes_stmt);

        if ($row) {
?>
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Actualización Requisición</h1><br>
                    <form action="actuRequi.php" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-5">No. de Requisición</span>
                            <input type="number" step="0.01" class="form-control" id="no_requi" name="no_requi" value="<?php echo $row['NO_REQUI']; ?>" required>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="id_servi">Orden de Servicio</label>
                            <select class="form-select" id="id_servi" name="id_servi" required>
                                <?php
                                while ($servicio = oci_fetch_array($ordenes_stmt, OCI_ASSOC)) {
                                    $selected = ($servicio['ID_SERVI'] == $row['ID_SERVI']) ? 'selected' : '';
                                    echo "<option value='" . $servicio['ID_SERVI'] . "' $selected>" . $servicio['ID_SERVI'] .' - ' . $servicio['PLACA'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="id_insumo">Insumo</label>
                            <select class="form-select" id="id_insumo" name="id_insumo" required>
                                <?php
                                while ($insumo = oci_fetch_array($insumos_stmt, OCI_ASSOC)) {
                                    $selected = ($insumo['ID_INSUMO'] == $row['ID_INSUMO']) ? 'selected' : '';
                                    echo "<option value='" . $insumo['ID_INSUMO'] . "' $selected>" . $insumo['NOMBRE_I'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cant_insu">Cantidad de Insumo</label>
                            <input type="number" step="0.01" class="form-control" id="c_insu" name="c_insu" value="<?php echo $row['C_INSU']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
<?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>No se encontró el servicio con ID $no_requi.</div>";
        }
        oci_free_statement($stmt);
        oci_free_statement($ordenes_stmt);
        oci_free_statement($insumos_stmt);

        
        }
    oci_close($conn);
?>
</div>
</body>
</html>