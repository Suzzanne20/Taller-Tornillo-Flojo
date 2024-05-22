<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>TALLER TF</title>
    
    <style>
        .background {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url('assets/fondot.jpg');
            background-size: cover;
            background-position: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Negro con 50% de opacidad */
        }

        .content {
            position: relative;
            color: white;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
        }
                .button-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px; /* Espacio entre los botones */
            justify-items: center;
            margin-top: 20px;
        }
        .button-container button {
            width: 400px; /* Ancho fijo para los botones */
            height: 50px; /* Alto fijo para los botones */
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            background-color: #007BFF; /* Color de fondo del botón */
            color: white;
            cursor: pointer;
            border-radius: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .button-container button:hover {
            background-color: #0056b3; /* Color de fondo del botón al pasar el ratón */
        }

    </style>
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>


<div class="container mt-5">
    <a href="regClientes.php" class="btn btn-dark mb-3">Nuevo Registro</a>
        <?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }else {
        $query = "SELECT ID_CLIENTE, NOMBRE_CLI, TELEFONO, NIT, DIRECCION FROM CLIENTE ORDER BY ID_CLIENTE ASC";

        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        echo "<h1>Listado de Clientes</h1>";
        echo "<table class='table table-dark table-hover'>
                <thead>
                    <tr>
                        <th>ID CLIENTE</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>NIT</th>
                        <th>Dirección</th>
                        <th>Acciones</th> 
                    </tr>
                </thead>
                <tbody>";

        // Recorrer los resultados
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . $row['ID_CLIENTE'] . "</td>";
            echo "<td>" . $row['NOMBRE_CLI'] . "</td>";
            echo "<td>" . $row['TELEFONO'] . "</td>";
            echo "<td>" . $row['NIT'] . "</td>";
            echo "<td>" . $row['DIRECCION'] . "</td>";
            echo "<td>
                <a href='actuClientes.php?id=" . $row['ID_CLIENTE'] . "' class='btn btn-primary btn-sm'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill=.'currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                </svg></a>
                <a href='eliClientes.php?id=" . $row['ID_CLIENTE'] . "' class='btn btn-danger btn-sm'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                </svg></a>
                </td>";
            echo "</tr>";
        }

        echo "</tbody></table>";

        oci_free_statement($stmt);
        oci_close($conn);
    }
        ?>
</div>

</body>
</html>