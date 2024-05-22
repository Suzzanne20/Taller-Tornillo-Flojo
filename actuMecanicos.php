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
        $id_mec = $_POST['id_mec'];
        $nombre_mec = $_POST['nombre_mec'];
        $especialidad = $_POST['especialidad'];

        $query = "UPDATE MECANICO SET NOMBRE_MEC = :nombre_mec, ESPECIALIDAD = :especialidad WHERE ID_MEC = :id_mec";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_mec', $id_mec);
        oci_bind_by_name($stmt, ':nombre_mec', $nombre_mec);
        oci_bind_by_name($stmt, ':especialidad', $especialidad);

        if (oci_execute($stmt)) {
            echo "<div class='modal-dialog text-center'><div class='modal-content'><div class='container'><br>";
            echo "<div class='alert alert-success' role='alert'>Se ha realizado la actualizacion de Datos</div>";
            echo "<a href='listMecanicos.php' class='btn btn-dark mb-3'>Listado de Mecanicos</a>";
            echo "<a href='regMecanicos.php' class='btn btn-primary mb-3'>Realizar un Registro</a>";
            echo "<br></div></div></div>";
        } else {
            $error = oci_error($stmt);
            echo "<div class='alert alert-danger' role='alert'>Error al actualizar" . $error['message'] . "</div>";
        }
        oci_free_statement($stmt);
    } else {
        $id_mec = $_GET['id'];

        $query = "SELECT ID_MEC, NOMBRE_MEC, ESPECIALIDAD FROM MECANICO WHERE ID_MEC = :id_mec";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ':id_mec', $id_mec);
        oci_execute($stmt);

        $mecanico = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);

        oci_free_statement($stmt);
    }

    oci_close($conn);
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Datos Mecanicos</title>
        <link rel="stylesheet" href="estilos.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <div class="modal-dialog"><div class="modal-content"><div class="container">
        <h1>Actualizar Registro de Mecanico</h1><br>
        <form action="actuMecanicos.php" method="post">
            <input type="hidden" name="id_mec" value="<?php echo htmlspecialchars($mecanico['ID_MEC']); ?>">
            <div class="form-group">
                <label for="nombre_mec">Nombre</label>
                <input type="text" class="form-control" id="nombre_mec" name="nombre_mec" value="<?php echo htmlspecialchars($mecanico['NOMBRE_MEC']); ?>" required>
            </div>
            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($mecanico['ESPECIALIDAD']); ?>" required>
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



