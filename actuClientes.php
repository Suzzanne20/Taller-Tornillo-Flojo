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
        // Obtener los datos
        $id_cliente = $_POST['id_cliente'];
        $nombre_cli = $_POST['nombre_cli'];
        $telefono = $_POST['telefono'];
        $nit = $_POST['nit'];
        $direccion = $_POST['direccion'];

        $query = "UPDATE CLIENTE SET NOMBRE_CLI = :nombre_cli, TELEFONO = :telefono, NIT = :nit, DIRECCION = :direccion WHERE ID_CLIENTE = :id_cliente";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
        oci_bind_by_name($stmt, ':nombre_cli', $nombre_cli);
        oci_bind_by_name($stmt, ':telefono', $telefono);
        oci_bind_by_name($stmt, ':nit', $nit);
        oci_bind_by_name($stmt, ':direccion', $direccion);

        if (oci_execute($stmt)) {
                        echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
                        echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualización de datos correctamente.</div>";
                        echo "<a href='listClientes.php' class='btn btn-dark mb-3'>Listado de Clientes</a>";
                        echo "<a href='regClientes.php' class='btn btn-primary mb-3'>Realizar un Registro</a>";
                        echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar" . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {
        $id_cliente = $_GET['id'];

        // Consultar los datos
        $query = "SELECT ID_CLIENTE, NOMBRE_CLI, TELEFONO, NIT, DIRECCION FROM CLIENTE WHERE ID_CLIENTE = :id_cliente";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
        oci_execute($stmt);

        $cliente = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);

        oci_free_statement($stmt);
    }
    oci_close($conn);
    
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualiza Cliente</title>
        <link rel="stylesheet" href="estilos.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <div class="modal-dialog"><div class="modal-content"><div class="container">
        <h1>Actualización Datos de Cliente</h1><br>
        <form action="actuClientes.php" method="post">
            <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['ID_CLIENTE']); ?>">
            <div class="form-group">
                <label for="nombre_cli">Nombre</label>
                <input type="text" class="form-control" id="nombre_cli" name="nombre_cli" value="<?php echo htmlspecialchars($cliente['NOMBRE_CLI']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente['TELEFONO']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="text" class="form-control" id="nit" name="nit" value="<?php echo htmlspecialchars($cliente['NIT']); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente['DIRECCION']); ?>" required>
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



