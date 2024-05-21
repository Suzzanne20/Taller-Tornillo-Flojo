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
<?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id_oc = $_POST['id_oc'];
                    $id_insumo = $_POST['id_insumo'];
                    $cant_insu = $_POST['cant_insu'];
                    $fecha= $_POST['fecha'];
                    $descri = $_POST['descri'];
                    $id_prov = $_POST['id_prov'];
                    $id_usuario = $_POST['id_usuario'];

                    $query = "UPDATE ORDEN_COM SET ID_INSUMO = :id_insumo, CANT_INSU = :cant_insu, FECHA = :fecha, DESCRI = :descri, ID_PROV = :id_prov, ID_USUARIO = :id_usuario WHERE ID_OC = :id_oc";
                    $stmt = oci_parse($conn, $query);

                    oci_bind_by_name($stmt, ':id_oc', $id_oc);
                    oci_bind_by_name($stmt, ':id_insumo', $id_insumo);
                    oci_bind_by_name($stmt, ':cant_insu', $cant_insu);
                    oci_bind_by_name($stmt, ':fecha', $fecha);
                    oci_bind_by_name($stmt, ':descri', $descri);
                    oci_bind_by_name($stmt, ':id_prov', $id_prov);
                    oci_bind_by_name($stmt, ':id_usuario', $id_usuario);

                    if (oci_execute($stmt)) {
                        echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
                        echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
                        echo "<a href='listOcompra.php' class='btn btn-dark mb-3'>Listado de Ordenes de Compra</a>";
                        echo "<a href='regOcompraphp' class='btn btn-primary mb-3'>Registrar una Orden</a>";
                        echo "<br></div></div></div>";
                    } else {
                        $error = oci_error($stmt);
                        echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
                    }
                    oci_free_statement($stmt);
                } else {
                    $id_oc = $_GET['id'];

                    $query = "SELECT ID_OC, ID_INSUMO, CANT_INSU, FECHA, DESCRI, ID_PROV, ID_USUARIO FROM ORDEN_COM WHERE ID_OC = :id_oc";
                    $stmt = oci_parse($conn, $query);
                    oci_bind_by_name($stmt, ':id_oc', $id_oc);
                    oci_execute($stmt);

                    $row = oci_fetch_array($stmt, OCI_ASSOC);

                    if ($row) {
                        ?>
                <div class="container mt-5">
                    <div class="modal-dialog"><div class="modal-content"><div class="container">
                        <h1>Actualizar Orden de Compra</h1><br>
                        <form action="actuOcompra.php" method="post">
                            <input type="hidden" name="id_oc" value="<?php echo $row['ID_OC']; ?>">
                            
                            <div class="form-group">
                                <label for="id_insumo">Id Insumo</label>
                                <input type="number" step="0.01" class="form-control" id="id_insumo" name="id_insumo" value="<?php echo $row['ID_INSUMO']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cant_insu">Cantidad</label>
                                 <input type="number" step="0.01" class="form-control" id="cant_insu" name="cant_insu" value="<?php echo $row['CANT_INSU']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" placeholder="00/00/00" id="fecha" name="fecha" value="<?php echo $row['FECHA']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descri">Descripción</label>
                                <input type="text" class="form-control" id="descri" name="descri" value="<?php echo $row['DESCRI']; ?>" required>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="id_tipo">Proveedor</label>
                                <select class="form-select" id="id_prov" name="id_prov" required>
                                    <option value="10001" <?php echo ($row['ID_PROV'] == 10001) ? 'selected' : ''; ?>>DYSHER</option>
                                    <option value="10002" <?php echo ($row['ID_PROV'] == 10002) ? 'selected' : ''; ?>>AUTOTOTAL</option>
                                    <option value="10003" <?php echo ($row['ID_PROV'] == 10003) ? 'selected' : ''; ?>>MOTUL</option>
                                    <option value="10004" <?php echo ($row['ID_PROV'] == 10004) ? 'selected' : ''; ?>>MASTER</option>
                                    <option value="10005" <?php echo ($row['ID_PROV'] == 10005) ? 'selected' : ''; ?>>VALVOLINE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_usuario">ID Usuario</label>
                                <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $row['ID_USUARIO']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Insumo</button>
                        </form>
                    <br></div></div></div>
                </div>
                    <?php
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>No se encontró el insumo con ID $id_insumo.</div>";
                    }

                    oci_free_statement($stmt);
                }

                oci_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>