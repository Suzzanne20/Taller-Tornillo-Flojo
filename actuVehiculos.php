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
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<?php
        require_once 'conexion.php';
        $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
            }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $placa = $_POST['placa'];
        $marca = $_POST['marca'];
        $kilometraje = $_POST['kilometraje'];
        $id_cliente = $_POST['id_cliente'];

        $query = "UPDATE VEHICULO SET PLACA= :placa, MARCA = :marca, KILOMETRAJE = :kilometraje, ID_CLIENTE = :id_cliente WHERE PLACA = :placa";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':placa', $placa);
        oci_bind_by_name($stmt, ':marca', $marca);
        oci_bind_by_name($stmt, ':kilometraje', $kilometraje);
        oci_bind_by_name($stmt, ':id_cliente', $id_cliente);

        if (oci_execute($stmt)) {
                        echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
                        echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
                        echo "<a href='listVehiculos.php' class='btn btn-dark mb-3'>Listado de Vehiculos</a>";
                        echo "<a href='regVehiculos.php' class='btn btn-primary mb-3'>Realizar un Registro</a>";
                        echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar el vehículo: " . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {
        if (isset($_GET['placa'])) {
            $placa = $_GET['placa'];

            $query = "SELECT PLACA, MARCA, KILOMETRAJE, ID_CLIENTE FROM VEHICULO WHERE PLACA = :placa";
            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ':placa', $placa);
            oci_execute($stmt);

            $vehiculo = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);
            oci_free_statement($stmt);

            $queryClientes = "SELECT ID_CLIENTE, NOMBRE_CLI FROM CLIENTE";
            $stmtClientes = oci_parse($conn, $queryClientes);
            oci_execute($stmtClientes);

            $clientes = [];
            while ($row = oci_fetch_array($stmtClientes, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $clientes[] = $row;
            }
            oci_free_statement($stmtClientes);
        } else {
            echo "<div class='alert alert-danger' role='alert'>No se proporcionó la placa del vehículo.</div>";
            exit;
        }
    }
    oci_close($conn);
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Vehículo</title>
        <link rel="stylesheet" href="estilos.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <div class="modal-dialog"><div class="modal-content"><div class="container">
        <h1>Actualizar Datos del Vehículo</h1> <br>
        <form action="actuVehiculos.php" method="post">
            <input type="hidden" name="placa" value="<?php echo htmlspecialchars($vehiculo['PLACA']); ?>">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($vehiculo['MARCA']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kilometraje">Kilometraje</label>
                <input type="number" class="form-control" id="kilometraje" name="kilometraje" value="<?php echo htmlspecialchars($vehiculo['KILOMETRAJE']); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_cliente">Cliente</label>
                <select class="form-control" id="id_cliente" name="id_cliente" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo htmlspecialchars($cliente['ID_CLIENTE']); ?>" <?php if ($cliente['ID_CLIENTE'] == $vehiculo['ID_CLIENTE']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cliente['NOMBRE_CLI']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
        <br></div></div></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
</html>

