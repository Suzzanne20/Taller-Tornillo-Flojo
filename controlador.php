<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Consultar la base de datos para verificar las credenciales
    $query = 'SELECT ID_USUARIO FROM USUARIO WHERE ID_USUARIO = :username AND CONTRA = :password';
    $stmt = oci_parse($conn, $query);

    // Vincular los parámetros
    oci_bind_by_name($stmt, ':username', $username);
    oci_bind_by_name($stmt, ':password', $password);

    // Ejecutar la consulta
    oci_execute($stmt);

    // Verificar si se encontró un resultado
    if ($row = oci_fetch_assoc($stmt)) {
        // Credenciales correctas, verificar en la tabla MECANICO
        $query_mecanico = 'SELECT ID_MEC FROM MECANICO WHERE ID_MEC = :username';
        $stmt_mecanico = oci_parse($conn, $query_mecanico);
        oci_bind_by_name($stmt_mecanico, ':username', $username);
        oci_execute($stmt_mecanico);

        if ($row_mecanico = oci_fetch_assoc($stmt_mecanico)) {
            // Usuario es un mecánico, redirigir a indexsecundario.php
            $_SESSION['username'] = $username;
            header('Location: indexsecundario.php');
            exit();
        } else {
            // Usuario no es un mecánico, redirigir a indexprincipal.php
            $_SESSION['username'] = $username;
            header('Location: indexprincipal.php');
            exit();
        }
    } else {
        // Credenciales incorrectas
        echo "<script>alert('Usuario o contraseña incorrectos, EL DEPARTAMENTO DE IT LES RECUERDA A TODOS LOS EMPLEADOS QUE LA ASIGNACION DE UNA NUEVA CONTRASEÑA TIENE UN COSTO DE Q250.00 PA LAS AGUITAS DEL DEPARTAMENTO'); window.location.href = 'login.php';</script>";
        exit();
    }

    // Liberar recursos
    oci_free_statement($stmt);
    oci_close($conn);
}
?>
