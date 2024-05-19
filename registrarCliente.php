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
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];

    if (empty($nombre) || empty($telefono) || empty($nit) || empty($direccion)) {
        echo "<p>Por favor, complete todos los campos.</p>";
        exit;
}
        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }

    $query = "INSERT INTO CLIENTE (NOMBRE_CLI, TELEFONO, NIT, DIRECCION) VALUES (:nombre, :telefono, :nit, :direccion)";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':telefono', $telefono);
    oci_bind_by_name($stmt, ':nit', $nit);
    oci_bind_by_name($stmt, ':direccion', $direccion);

    if (oci_execute($stmt)) {
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listClientes.php' class='btn btn-dark mb-3'>Listado de Clientes</a>";
        echo "<a href='regClientes.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
    } else {
        $error = oci_error($stmt);
        echo "<div class='alert alert-danger' role='alert'>Error al realizar el Registro " . $error['message'] . "</div>";
    }
    oci_free_statement($stmt);
    oci_close($conn);
?>

    </body>
</html>