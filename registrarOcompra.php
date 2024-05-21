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
    $id_oc = $_POST['id_oc'];
    $id_insumo = $_POST['id_insumo'];
    $cant_insu = $_POST['cant_insu'];
    $fecha= $_POST['fecha'];
    $descri = $_POST['descri'];
    $id_prov = $_POST['id_prov'];
    $id_usuario = $_POST['id_usuario'];

        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

        $query = 'INSERT INTO ORDEN_COM (ID_OC, ID_INSUMO, CANT_INSU, FECHA, DESCRI, ID_PROV, ID_USUARIO) VALUES (:id_oc, :id_insumo, :cant_insu, :fecha, :descri, :id_prov, :id_usuario)';
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
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listOcompra.php' class='btn btn-dark mb-3'>Listado de Ordenes de Compra</a>";
        echo "<a href='regOcompra.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
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
