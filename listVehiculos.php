<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Mecanicos</title>
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>

<div class="container mt-5">
    <a href="regVehiculos.php" class="btn btn-dark mb-3">Nuevo Registro</a>
        <?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }else {
        $query = "SELECT V.PLACA, V.MARCA, V.KILOMETRAJE, C.NOMBRE_CLI
          FROM VEHICULO V
          JOIN CLIENTE C ON V.ID_CLIENTE = C.ID_CLIENTE";


        // Ejecutar la consulta
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        // Mostrar los datos de la tabla MECANICO
        echo "<h1>Datos de la tabla VEHICULOS</h1>";
        echo "<table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Kilometraje</th>
                    <th>Cliente</th>
                    <th>Acciones</th>                     
                </thead>
                <tbody>";

        // Recorrer los resultados de la consulta y mostrar cada fila como una fila de la tabla HTML
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . $row['PLACA'] . "</td>";
            echo "<td>" . $row['MARCA'] . "</td>";
            echo "<td>" . $row['KILOMETRAJE'] . "</td>";
            echo "<td>" . $row['NOMBRE_CLI'] . "</td>";
            echo "<td>
                <a href='actuVehiculos.php?id=" . $row['PLACA'] . "' class='btn btn-primary btn-sm'>Actualizar</a>
                <a href='eliVehiculos.php?id=" . $row['PLACA'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                </td>";
            echo "</tr>";
        }

        echo "</table>";

        // Liberar recursos
        oci_free_statement($stmt);
        oci_close($conn);
    }

        ?>
</div>

</body>
</html>
