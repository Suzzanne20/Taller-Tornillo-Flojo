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
        $insumo_id_insumo = $_POST['insumo_id_insumo'];
        $servicio_id_servi = $_POST['servicio_id_servi'];
        $servicio_id_usuario = $_POST['servicio_id_usuario'];
        $no_requi = $_POST['no_requi'];
        $c_insu = $_POST['c_insu'];

        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

        $query = 'INSERT INTO REQUI (INSUMO_ID_INSUMO, SERVICIO_ID_SERVI, SERVICIO_ID_USUARIO, NO_REQUI, C_INSU) 
                  VALUES (:insumo_id_insumo, :servicio_id_servi, :servicio_id_usuario, :no_requi, :c_insu)';
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':insumo_id_insumo', $insumo_id_insumo);
        oci_bind_by_name($stmt, ':servicio_id_servi', $servicio_id_servi);
        oci_bind_by_name($stmt, ':servicio_id_usuario', $servicio_id_usuario);
        oci_bind_by_name($stmt, ':no_requi', $no_requi);
        oci_bind_by_name($stmt, ':c_insu', $c_insu);

    if (oci_execute($stmt)) {
        echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";      
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listRequisiciones.php' class='btn btn-dark mb-3'>Listado de Requisiciones</a>";
        echo "<a href='regRequi.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
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

