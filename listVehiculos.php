<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="layout/Fondos.css" rel="stylesheet"> <!-- FONDOOOO -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Mecanicos</title>
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>

<div class="container mt-5">
    <div class="container"><div class="row justify-content-between">
        <div class="col-4"><a href="regVehiculos.php" class="btn btn-secondary">Nuevo Registroo</a></div>
        <div class="col-4">
          <form method="GET" action="listVehiculos.php" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por placa" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg></button>
            </div></form></div></div></div> 
        <?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }else {
        //-------------------------------BARRA DE BUSQUEDA        
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $query = "SELECT V.PLACA, V.MARCA, V.KILOMETRAJE, V.ID_CLIENTE, C.NOMBRE_CLI
                FROM VEHICULO V
                JOIN CLIENTE C ON V.ID_CLIENTE = C.ID_CLIENTE";
        if (!empty($search)) {
            $query .= " WHERE V.PLACA LIKE '%' || :search || '%'";
        }
        $query .= " ORDER BY V.PLACA ASC";
        $stmt = oci_parse($conn, $query);

        if (!empty($search)) {
            oci_bind_by_name($stmt, ':search', $search);
        }
        oci_execute($stmt);
        //--------------------------------------------------------------
        echo "<h1 style='color: white;'>Listado de Vehiculos</h1>";
        echo "<table class='table table-striped table-hover'>
            <thead class='table-dark'>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Kilometraje</th>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Acciones</th>                     
                </thead>
                <tbody>";

        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . $row['PLACA'] . "</td>";
            echo "<td>" . $row['MARCA'] . "</td>";
            echo "<td>" . $row['KILOMETRAJE'] . "</td>";
            echo "<td>" . $row['ID_CLIENTE'] . "</td>";
            echo "<td>" . $row['NOMBRE_CLI'] . "</td>";
            echo "<td>
                <a href='actuVehiculos.php?id=" . $row['PLACA'] . "' class='btn btn-primary btn-sm'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill=.'currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                </svg></a>
                <a href='eliVehiculos.php?id=" . $row['PLACA'] . "' class='btn btn-danger btn-sm'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                </svg></a>
                </td>";
            echo "</tr>";
        }

        echo "</table>";

        oci_free_statement($stmt);
        oci_close($conn);
    }
        ?>
</div>

</body>
</html>
