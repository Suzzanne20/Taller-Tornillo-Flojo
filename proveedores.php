<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Proveedores</title>
</head>
<body>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>

<div class="container mt-5">
        <?php
        require_once 'conexion.php';//<---------------------CONEXION BD
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }else {
        //<------------------------------REFERENCIA A LA TABLA DE LA BD      
        $query = "SELECT ID_PROV, NOM_PROV FROM PROV ORDER BY ID_PROV ASC";
        $stmt = oci_parse($conn, $query);
        oci_execute($stmt);
        //--------------------------------------------------------------
        echo "<h1>Proveedores</h1>";
        echo "<table class='table table-dark table-hover'>
            <thead><tr>
                    <th>ID</th>
                    <th>Proveedor</th>
            </tr></thead>
            <tbody>";
        //----------------------------------LISTAR LOS DATOS DE LA TABLA
        while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo "<tr>";
                echo "<td>" . $row['ID_PROV'] . "</td>";
                echo "<td>" . $row['NOM_PROV'] . "</td>";
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
