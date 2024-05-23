<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Actualizar Orden de Servicio</title>
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
        $id_servi = $_POST['id_servi'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $no_requi = $_POST['no_requi'];
        $prox_serv = $_POST['prox_serv'];
        $placa = $_POST['placa'];
        $id_usuario = $_POST['id_usuario'];
        $id_tserv = $_POST['id_tserv'];
        $id_mec = $_POST['id_mec'];

        $query = "UPDATE SERVICIO SET FECHA = :fecha, DESCRIPCION = :descripcion, NO_REQUI = :no_requi, PROX_SERV = :prox_serv, PLACA = :placa, ID_USUARIO = :id_usuario, ID_TSERV = :id_tserv, ID_MEC = :id_mec WHERE ID_SERVI = :id_servi";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_servi', $id_servi);
        oci_bind_by_name($stmt, ':fecha', $fecha);
        oci_bind_by_name($stmt, ':descripcion', $descripcion);
        oci_bind_by_name($stmt, ':no_requi', $no_requi);
        oci_bind_by_name($stmt, ':prox_serv', $prox_serv);
        oci_bind_by_name($stmt, ':placa', $placa);
        oci_bind_by_name($stmt, ':id_usuario', $id_usuario);
        oci_bind_by_name($stmt, ':id_tserv', $id_tserv);
        oci_bind_by_name($stmt, ':id_mec', $id_mec);

        if (oci_execute($stmt)) {
            echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
            echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
            echo "<a href='listOservicios.php' class='btn btn-dark mb-3'>Listado de Ordenes de Servicio</a>";
            echo "<a href='regOservicios.php' class='btn btn-primary mb-3'>Registrar una Orden de Servicio</a>";
            echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {

        $id_servi = $_GET['id'];

        $query = "SELECT ID_SERVI, FECHA, DESCRIPCION, NO_REQUI, PROX_SERV, PLACA, ID_USUARIO, ID_TSERV, ID_MEC FROM SERVICIO WHERE ID_SERVI = :id_servi";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':id_servi', $id_servi);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);

//------SELECTS
        $vehiculos_query = 'SELECT PLACA FROM VEHICULO';
        $vehiculos_stmt = oci_parse($conn, $vehiculos_query);
        oci_execute($vehiculos_stmt);

        $mecanicos_query = 'SELECT ID_MEC, NOMBRE_MEC FROM MECANICO';
        $mecanicos_stmt = oci_parse($conn, $mecanicos_query);
        oci_execute($mecanicos_stmt);

        if ($row) {
?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <h1>Actualizar Orden de Servicio</h1>
                    <br>
                    <form action="actuOservicio.php" method="post">
                        <input type="hidden" name="id_servi" value="<?php echo $row['ID_SERVI']; ?>">

                        <div class="input-group mb-3">
                            <span class="input-group-text">Fecha</span>
                            <input type="text" class="form-control col-3" placeholder="00/00/00" id="fecha" name="fecha" value="<?php echo $row['FECHA']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del Servicio</label>
                            <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required><?php echo $row['DESCRIPCION']; ?></textarea>
                        </div>
                        <div><label>Insumos</label><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Ingrese # de Requisición</span>
                                <input type="number" class="form-control" id="no_requi" name="no_requi" value="<?php echo $row['NO_REQUI']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prox_serv">Próximo Servicio</label>
                            <input type="number" step="0.01" class="form-control" id="prox_serv" name="prox_serv" value="<?php echo $row['PROX_SERV']; ?>">
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="placa">Placa</label>
                            <select class="form-select" id="placa" name="placa" required>
                                <?php
                                while ($vehiculo = oci_fetch_array($vehiculos_stmt, OCI_ASSOC)) {
                                    $selected = ($vehiculo['PLACA'] == $row['PLACA']) ? 'selected' : '';
                                    echo "<option value='{$vehiculo['PLACA']}' $selected>{$vehiculo['PLACA']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_usuario">ID Usuario</label>
                            <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $row['ID_USUARIO']; ?>" required>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="id_tserv">Tipo de Servicio</label>
                            <select class="form-select" id="id_tserv" name="id_tserv" required>
                                <option value="1" <?php echo ($row['ID_TSERV'] == 1) ? 'selected' : ''; ?>>Mantenimiento Menor</option>
                                <option value="2" <?php echo ($row['ID_TSERV'] == 2) ? 'selected' : ''; ?>>Mantenimiento Medio</option>
                                <option value="3" <?php echo ($row['ID_TSERV'] == 3) ? 'selected' : ''; ?>>Mantenimiento Mayor</option>
                                <option value="4" <?php echo ($row['ID_TSERV'] == 4) ? 'selected' : ''; ?>>Reparación</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="id_mec">Mecánico Responsable</label>
                            <select class="form-select" id="id_mec" name="id_mec" required>
                                <?php
                                while ($mecanico = oci_fetch_array($mecanicos_stmt, OCI_ASSOC)) {
                                    $selected = ($mecanico['ID_MEC'] == $row['ID_MEC']) ? 'selected' : '';
                                    echo "<option value='{$mecanico['ID_MEC']}' $selected>{$mecanico['NOMBRE_MEC']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
<?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>No se encontró el servicio con ID $id_servi.</div>";
        }
        oci_free_statement($stmt);
        oci_free_statement($vehiculos_stmt);
        oci_free_statement($mecanicos_stmt);
    }
    oci_close($conn);
?>
</div>
</body>
</html>
