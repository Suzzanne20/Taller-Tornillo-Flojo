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
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $no_requi = $_POST['no_requi'];
        $prox_serv = $_POST['prox_serv'];
        $placa = $_POST['placa'];
        $id_usuario = $_POST['id_usuario'];
        $id_tserv = $_POST['id_tserv'];
        $id_mec = $_POST['id_mec'];

        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

        $query = 'INSERT INTO SERVICIO (FECHA, DESCRIPCION, NO_REQUI, PROX_SERV, PLACA, ID_USUARIO, ID_TSERV, ID_MEC) 
                  VALUES (:fecha, :descripcion, :no_requi, :prox_serv, :placa, :id_usuario, :id_tserv, :id_mec)';
        $stmt = oci_parse($conn, $query);
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
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listOservicios.php' class='btn btn-dark mb-3'>Listado de Ordenes de Servicio</a>";
        echo "<a href='regOservicios.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
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
