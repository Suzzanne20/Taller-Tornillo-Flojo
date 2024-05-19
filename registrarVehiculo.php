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
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $kilometraje = $_POST['kilometraje'];
    $id_cliente = $_POST['id_cliente'];

    if (empty($placa) || empty($marca) || empty($kilometraje) || empty($id_cliente)) {
        echo "<p>Por favor, complete todos los campos.</p>";
        exit;
}
        require_once 'conexion.php';//<---CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }
    $query = "INSERT INTO VEHICULO (PLACA, MARCA, KILOMETRAJE, ID_CLIENTE) VALUES (:placa, :marca, :kilometraje, :id_cliente)";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':placa', $placa);
    oci_bind_by_name($stmt, ':marca', $marca);
    oci_bind_by_name($stmt, ':kilometraje', $kilometraje);
    oci_bind_by_name($stmt, ':id_cliente', $id_cliente);

    if (oci_execute($stmt)) {
        echo "<div class='alert alert-success' role='alert'>Se ha realizado el registro con éxito.</div>";
        echo "<a href='listVehiculos.php' class='btn btn-dark mb-3'>Listado de Vehiculos</a>";
        echo "<a href='regVehiculos.php' class='btn btn-primary mb-3'>Realizar otro Registro</a>";
    } else {
        $error = oci_error($stmt);
        echo "<div class='alert alert-danger' role='alert'>Error al realizar el Registro " . $error['message'] . "</div>";
    }
    oci_free_statement($stmt);
    oci_close($conn);
?>

    </body>
</html>