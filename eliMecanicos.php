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
<div class="container mt-5">
<?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }
    if (isset($_GET['id'])) {
        $id_mec = $_GET['id'];

        $query = "DELETE FROM MECANICO WHERE ID_MEC = :id_mec";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_mec', $id_mec);

        if (oci_execute($stmt)) {
            echo "<div class='alert alert-success' role='alert'>Se elimino el registro.</div>";
            echo "<a href='listMecanicos.php' class='btn btn-dark mb-3'>Regresar a listado de Mecanicos</a>";
            
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al eliminar el registro" . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al obtener los datos.</div>";
    }
    oci_close($conn);
    ?>

</html>