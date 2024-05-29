<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Insumos Recibidos</title>
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
    $ingresado = $_POST['ingresado'];

    // Verificar si la cantidad ingresada no supera la cantidad comprada
    $query = "SELECT ID_OC, CANT_INSU, INGRESADO FROM ORDEN_COM WHERE ID_OC = :id_oc";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_oc', $id_oc);
    oci_execute($stmt);

    $row = oci_fetch_array($stmt, OCI_ASSOC);
    if ($row) {
        $cantidad_insumo = $row['CANT_INSU'];
        $cantidad_ingresada = $row['INGRESADO'];

        if (($cantidad_ingresada + $ingresado) > $cantidad_insumo) {
            echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
            echo "<div class='alert alert-danger' role='alert'>La cantidad de insumo ingresado sobrepasa a la comprada. Puede que esta orden ya este en estado Finalizado, recomendamos verificar los datos o bien realizar una nueva orden de compra.</div>";
            echo "<a href='listOcompra.php' class='btn btn-dark mb-3'>Listado de Ordenes de Compra</a>";
            echo "<a href='regOcompra.php' class='btn btn-primary mb-3'>Registrar una Orden</a>";
            echo "<br></div></div></div>";
        } else {
            // Llamar al procedimiento UPDATE_OC después de verificar la cantidad
            $proc_query = "BEGIN UPDATE_OC(:id_oc, :ingresado); END;";
            $proc_stmt = oci_parse($conn, $proc_query);
            oci_bind_by_name($proc_stmt, ':id_oc', $id_oc);
            oci_bind_by_name($proc_stmt, ':ingresado', $ingresado);

            if (oci_execute($proc_stmt)) {
                echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
                echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente, el Stock de insumos también fue actualizado.</div>";
                echo "<a href='listOcompra.php' class='btn btn-dark mb-3'>Listado de Ordenes de Compra</a>";
                echo "<a href='regOcompra.php' class='btn btn-primary mb-3'>Registrar una Orden</a>";
                echo "<br></div></div></div>";
            } else {
                $error = oci_error($proc_stmt);
                echo "<div class='alert alert-danger' role='alert'>Error al actualizar: " . $error['message'] . "</div>";
            }

            oci_free_statement($proc_stmt);
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>No se encontró la orden de compra ID $id_oc.</div>";
    }

    oci_free_statement($stmt);
} else {
    $id_oc = $_GET['id'];

    $query = "SELECT ID_OC, INGRESADO FROM ORDEN_COM WHERE ID_OC = :id_oc";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_oc', $id_oc);
    oci_execute($stmt);

    $row = oci_fetch_array($stmt, OCI_ASSOC);

    if ($row) {
        ?>
        <div class="container mt-5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <h3>Ingrese la cantidad de Insumos que se recibieron</h3><br>
                        <form action="insuRecibido.php" method="post">
                            <input type="hidden" name="id_oc" value="<?php echo $row['ID_OC']; ?>">
                            <div class="form-group">
                                <label for="ingresado">Cantidad Ingresada</label>
                                <input type="number" step="0.01" class="form-control" id="ingresado" name="ingresado" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Producto Ingresado</button>
                        </form>
                    <br></div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>No se encontró la orden de compra ID $id_oc.</div>";
    }

    oci_free_statement($stmt);
}

oci_close($conn);
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
