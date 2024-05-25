<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Nueva Orden servicio</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<body>
<div class="container mt-5">
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Nueva Orden de Servicio</h1><br>
                <form action="registrarOservicio.php" method="post">
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">Fecha</span>
                        <input type="text" class="form-control col-3" placeholder="00/00/00" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del Servicio</label>
                        <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required></textarea>

                    </div>
                    <div><label>Insumos</label><br>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Prox. Servicio</span>
                        <input type="number" class="form-control" id="prox_serv" name="prox_serv">
                    </div> </div>          
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_tipo">Placa</label>
                        <select class="form-select" id="placa" name="placa" required>
                            <?php                                                      
                                require_once 'conexion.php';
                                $conn = oci_connect(DB_USER, DB_PASSWORD, DB_HOST);
                                if (!$conn) {
                                    $e = oci_error();
                                    trigger_error(htmlentities($e['ERROR DE CONEXION'], ENT_QUOTES), E_USER_ERROR);
                                } 
                                else {
                                    $query = "SELECT PLACA FROM VEHICULO ORDER BY PLACA ASC";
                                    $stmt = oci_parse($conn, $query);
                                    oci_execute($stmt);
                                    while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                        echo "<option value='" . $row['PLACA'] . "'>" . $row['PLACA'] . "</option>";
                                    }
                                    oci_free_statement($stmt);
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_usuario">Id Usuario</label>
                        <select class="form-select" id="id_usuario" name="id_usuario" required>
                            <?php
                                $query = "SELECT ID_USUARIO, NOMBRE_U FROM USUARIO ORDER BY NOMBRE_U ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_USUARIO'] . "'>" . $row['ID_USUARIO'] .' - ' . $row['NOMBRE_U'] . "</option>";
                                }
                                oci_free_statement($stmt);
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_tipo">Tipo de Servicio</label>
                        <select class="form-select" id="id_tserv" name="id_tserv" required>
                            <option value="1">Mantenimiento Menor</option>
                            <option value="2">Mantenimiento Medio</option>
                            <option value="3">Mantenimiento Mayor</option>
                            <option value="4">Reparación</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_tipo">Mecanico Responsable</label>
                        <select class="form-select" id="id_mec" name="id_mec" required>
                            <?php
                                $query = "SELECT ID_MEC, NOMBRE_MEC FROM MECANICO ORDER BY NOMBRE_MEC ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_MEC'] . "'>" . $row['NOMBRE_MEC'] . "</option>";
                                }
                                oci_free_statement($stmt);
                                oci_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_estado">Estado de la Orden</label>
                        <select class="form-select" id="id_estado" name="id_estado" required>
                            <option value="1">Creada</option>
                            <option value="2">Asignada</option>
                            <option value="3">En Curso</option>
                            <option value="4">En Espera</option>
                            <option value="5">Finalizada</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Registrar Orden de Servicio</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>
