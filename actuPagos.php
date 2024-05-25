<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Actualizar Pago</title>
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
        $no_op = $_POST['no_op'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $monto = $_POST['monto'];
        $id_servi = $_POST['id_servi'];
    
        $query = "UPDATE ORDEN_P SET FECHA = :fecha, DESCRIPCION = :descripcion, MONTO = :monto, ID_SERVI = :id_servi WHERE NO_OP = :no_op";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':no_op', $no_op);
        oci_bind_by_name($stmt, ':fecha', $fecha);
        oci_bind_by_name($stmt, ':descripcion', $descripcion);
        oci_bind_by_name($stmt, ':monto', $monto);
        oci_bind_by_name($stmt, ':id_servi', $id_servi);

        if (oci_execute($stmt)) {
            echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
            echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
            echo "<a href='listOpagos.php' class='btn btn-dark mb-3'>Listado de Ordenes de Pago</a>";
            echo "<a href='regPagos.php' class='btn btn-primary mb-3'>Nueva Orden de Pago</a>";
            echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {

        $no_op = $_GET['id'];

        $query = "SELECT NO_OP, FECHA, DESCRIPCION, MONTO, ID_SERVI FROM ORDEN_P WHERE NO_OP = :no_op";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':no_op', $no_op);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);

//------SELECTS

        $ordenes_query = 'SELECT ID_SERVI, PLACA FROM SERVICIO';
        $ordenes_stmt = oci_parse($conn, $ordenes_query);
        oci_execute($ordenes_stmt);

        if ($row) {
?>
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Actualización Requisición</h1><br>
                    <form action="actuPagos.php" method="post">
                        <input type="hidden" class="form-control" id="no_op" name="no_op" value="<?php echo $row['NO_OP']; ?>">
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="fecha">Fecha</label>
                            <input type="text" class="form-control" placeholder="00/00/00" id="fecha" name="fecha" value="<?php echo $row['FECHA']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required><?php echo $row['DESCRIPCION']; ?></textarea>
                        </div>
                        <div class="input-group mb-3p">
                            <label class="input-group-text col-5" for="monto">Monto   Q.</label>
                            <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="<?php echo $row['MONTO']; ?>" required>
                        </div>
                        <br>
                        
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
        }
    oci_close($conn);
?>
</div>
</body>
</html>