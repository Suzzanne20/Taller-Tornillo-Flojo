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
        $query = "SELECT ID_CLIENTE, NOMBRE_CLI, TELEFONO, NIT, DIRECCION FROM CLIENTE";

        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);

        echo "<h1>Tabla CLIENTE</h1>";
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

        // Recorrer los resultados de la consulta y mostrar cada fila como una fila de la tabla HTML
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . $row['ID_CLIENTE'] . "</td>";
            echo "<td>" . $row['NOMBRE_CLI'] . "</td>";
            echo "<td>" . $row['TELEFONO'] . "</td>";
            echo "<td>" . $row['NIT'] . "</td>";
            echo "<td>" . $row['DIRECCION'] . "</td>";
            echo "<td>
                <a href='actuClientes.php?id=" . $row['ID_CLIENTE'] . "' class='btn btn-primary btn-sm'>Actualizar</a>
                <a href='eliClientes.php?id=" . $row['ID_CLIENTE'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                </td>";            
                       
            echo "</tr>";
        }

        echo "</tbody></table>";

        // Liberar recursos
        oci_free_statement($stmt);
        oci_close($conn);
    }
        ?>
</div>

</body>
</html>