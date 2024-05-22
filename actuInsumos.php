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
                    $id_insumo = $_POST['id_insumo'];
                    $nombre_i = $_POST['nombre_i'];
                    $costo = $_POST['costo'];
                    $stock = $_POST['stock'];
                    $mini = $_POST['mini'];
                    $id_tipo = $_POST['id_tipo'];
                    $descri_i = $_POST['descri_i'];
                    $id_oc = $_POST['id_oc'];

                    $query = "UPDATE INSUMO SET NOMBRE_I = :nombre_i, COSTO = :costo, STOCK = :stock, MINI = :mini, ID_TIPO = :id_tipo, DESCRI_I = :descri_i, ID_OC = :id_oc WHERE ID_INSUMO = :id_insumo";
                    $stmt = oci_parse($conn, $query);

                    oci_bind_by_name($stmt, ':id_insumo', $id_insumo);
                    oci_bind_by_name($stmt, ':nombre_i', $nombre_i);
                    oci_bind_by_name($stmt, ':costo', $costo);
                    oci_bind_by_name($stmt, ':stock', $stock);
                    oci_bind_by_name($stmt, ':mini', $mini);
                    oci_bind_by_name($stmt, ':id_tipo', $id_tipo);
                    oci_bind_by_name($stmt, ':descri_i', $descri_i);
                    oci_bind_by_name($stmt, ':id_oc', $id_oc);

                    if (oci_execute($stmt)) {
                        echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
                        echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
                        echo "<a href='listInsumos.php' class='btn btn-dark mb-3'>Inventario de Insumos</a>";
                        echo "<a href='regInsumos.php' class='btn btn-primary mb-3'>Realizar un Registro</a>";
                        echo "<br></div></div></div>";
                    } else {
                        $error = oci_error($stmt);
                        echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
                    }
                    oci_free_statement($stmt);
                } else {
                    $id_insumo = $_GET['id'];

                    $query = "SELECT ID_INSUMO, NOMBRE_I, COSTO, STOCK, MINI, ID_TIPO, DESCRI_I, ID_OC FROM INSUMO WHERE ID_INSUMO = :id_insumo";
                    $stmt = oci_parse($conn, $query);
                    oci_bind_by_name($stmt, ':id_insumo', $id_insumo);
                    oci_execute($stmt);

                    $row = oci_fetch_array($stmt, OCI_ASSOC);

                    if ($row) {
                        ?>
                <div class="container mt-5">
                    <div class="modal-dialog"><div class="modal-content"><div class="container">
                        <h1>Actualizar Insumo</h1><br>
                        <form action="actuInsumos.php" method="post">
                            <input type="hidden" name="id_insumo" value="<?php echo $row['ID_INSUMO']; ?>">
                            <div class="form-group">
                                <label for="nombre_i">Nombre del Insumo</label>
                                <input type="text" class="form-control" id="nombre_i" name="nombre_i" value="<?php echo $row['NOMBRE_I']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo</label>
                                <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="<?php echo $row['COSTO']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['STOCK']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mini">Mínimo</label>
                                <input type="number" class="form-control" id="mini" name="mini" value="<?php echo $row['MINI']; ?>" required>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="id_tipo">Tipo de Insumo</label>
                                <select class="form-select" id="id_tipo" name="id_tipo" required>
                                    <option value="1" <?php echo ($row['ID_TIPO'] == 1) ? 'selected' : ''; ?>>Filtro</option>
                                    <option value="2" <?php echo ($row['ID_TIPO'] == 2) ? 'selected' : ''; ?>>Aceite</option>
                                    <option value="3" <?php echo ($row['ID_TIPO'] == 3) ? 'selected' : ''; ?>>Repuesto</option>
                                    <option value="4" <?php echo ($row['ID_TIPO'] == 4) ? 'selected' : ''; ?>>Consumible</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descri_i">Descripción</label>
                                <input type="text" class="form-control" id="descri_i" name="descri_i" value="<?php echo $row['DESCRI_I']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="id_oc">ID OC</label>
                                <input type="number" class="form-control" id="id_oc" name="id_oc" value="<?php echo $row['ID_OC']; ?>" required>
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