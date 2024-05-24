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
        $insumo_id_insumo = $_POST['insumo_id_insumo'];
        $servicio_id_servi = $_POST['servicio_id_servi'];
        $servicio_id_usuario = $_POST['servicio_id_usuario'];
        $no_requi = $_POST['no_requi'];
        $c_insu = $_POST['c_insu'];

                $query = 'INSERT INTO REQUI (INSUMO_ID_INSUMO, SERVICIO_ID_SERVI, SERVICIO_ID_USUARIO, NO_REQUI, C_INSU) 
                  VALUES (:insumo_id_insumo, :servicio_id_servi, :servicio_id_usuario, :no_requi, :c_insu)';
        
        $query = "UPDATE REQUI SET INSUMO_ID_INSUMO = :fecha, SERVICIO_ID_SERVI = :descripcion, SERVICIO_ID_USUARIO = :no_requi, PLACA = :placa, ID_USUARIO = :id_usuario WHERE ID_SERVI = :id_servi";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':insumo_id_insumo', $insumo_id_insumo);
        oci_bind_by_name($stmt, ':servicio_id_servi', $servicio_id_servi);
        oci_bind_by_name($stmt, ':servicio_id_usuario', $servicio_id_usuario);
        oci_bind_by_name($stmt, ':no_requi', $no_requi);
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

        $id_servi = $_GET['id'];

        $query = "SELECT ID_SERVI, FECHA, DESCRIPCION, NO_REQUI, PLACA, ID_USUARIO, ID_TSERV, ID_MEC, ID_ESTADO FROM SERVICIO WHERE ID_SERVI = :id_servi";
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
                        <div class="input-group mb-3">
                            <label class="input-group-text col-5" for="id_estado">Estado de la Orden</label>
                            <select class="form-select" id="id_estado" name="id_estado" required>
                                <option value="1" <?php echo ($row['ID_ESTADO'] == 1) ? 'selected' : ''; ?>>Creada</option>
                                <option value="2" <?php echo ($row['ID_ESTADO'] == 2) ? 'selected' : ''; ?>>Asignada</option>
                                <option value="3" <?php echo ($row['ID_ESTADO'] == 3) ? 'selected' : ''; ?>>En Curso</option>
                                <option value="4" <?php echo ($row['ID_ESTADO'] == 4) ? 'selected' : ''; ?>>En Espera</option>
                                <option value="5" <?php echo ($row['ID_ESTADO'] == 5) ? 'selected' : ''; ?>>Finalizada</option>
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