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
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<div class="container mt-5">
<?php
    // Datos
    $id_insumo = $_POST['id_insumo'];
    $nombre_i = $_POST['nombre_i'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    $mini = $_POST['mini'];
    $id_tipo = $_POST['id_tipo'];
    $descri_i = $_POST['descri_i'];
    $id_oc = $_POST['id_oc'];

        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

        $query = 'INSERT INTO INSUMO (ID_INSUMO, NOMBRE_I, COSTO, STOCK, MINI, ID_TIPO, DESCRI_I, ID_OC) VALUES (:id_insumo, :nombre_i, :costo, :stock, :mini, :id_tipo, :descri_i, :id_oc)';
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
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listInsumos.php' class='btn btn-dark mb-3'>Inventario de Insumos</a>";
        echo "<a href='regInsumos.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
        echo "<br></div></div></div>";
    } else {
        $error = oci_error($stmt);
        echo "<div class='alert alert-danger' role='alert'>Error al realizar el Registro " . $error['message'] . "</div>";
    }
    oci_free_statement($stmt);
    oci_close($conn);
?>

    </body>
</html>
