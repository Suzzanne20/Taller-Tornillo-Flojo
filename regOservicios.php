<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="layout/Fondos.css" rel="stylesheet"> <!-- FONDOOOO -->
    <title>Nueva Orden servicio</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<?php $contenido = ""; include 'layout/plantilla.blade.php';?>
<body>
<div class="">
      <div class="row justify-content-center">
   
    <div class="col-4"><div class="modal-content"><div class="container">
    <h1>Nueva Orden de Servicio</h1><br>
                <form action="registrarOservicio.php" method="post">
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">Fecha</span>
                        <input type="text" class="form-control col-3" placeholder="00/00/00" id="fecha" name="fecha" required>
                    </div>
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
                        <label class="input-group-text col-5" for="id_tserv">Tipo de Servicio</label>
                        <select class="form-select" id="id_tserv" name="id_tserv" required>
                            <?php
                                $query = "SELECT ID_TSERV, NOMBRE_SERV FROM TIPO_SERV ORDER BY ID_TSERV ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_TSERV'] . "'>" . $row['NOMBRE_SERV'] . "</option>";
                                }
                                oci_free_statement($stmt);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del Servicio</label>
                        <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion" required></textarea>

                    </div>
                    <div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Prox. Servicio</span>
                        <input type="number" class="form-control" id="prox_serv" name="prox_serv">
                    </div> </div>          
                  

                    <label for="especialidad">Formulario de Inspección</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                    <label for="especialidad">Fotografia del Vehículo</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
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
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text col-5" for="id_estado">Estado de la Orden</label>
                        <select class="form-select" id="id_estado" name="id_estado" required>
                            <?php
                                $query = "SELECT ID_ESTADO, ESTADO FROM ESTADO_OS ORDER BY ID_ESTADO ASC";
                                $stmt = oci_parse($conn, $query);
                                oci_execute($stmt);
                                while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                                    echo "<option value='" . $row['ID_ESTADO'] . "'>" . $row['ESTADO'] . "</option>";
                                }
                                oci_free_statement($stmt);

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
                                oci_close($conn);
                            ?>
                        </select>
                    </div>
                    
                    
                  
                    <button type="submit" class="btn btn-primary">Registrar Orden de Servicio</button>
                </form>
    <br></div></div></div>
          
        <div class="col-3 text-center">
            <div class="modal-content"><div class="container"><br><br>
            <img src="https://raw.githubusercontent.com/Suzzanne20/ResourceNekoStation/main/car-history-report-on-white-background-online-check-symbol-car-history-sign-vehicle-inspection-report-document-approved-on-computer-logo-flat-style-vector.png" height="200" >
<br><br><br>
            <img src="https://us.123rf.com/450wm/galimovma79/galimovma791510/galimovma79151000014/47423407-condici%C3%B3n-del-coche-lista-informe-coche-da%C3%B1os-auto-vector-inspecci%C3%B3n.jpg?ver=6" height="425" >
        <br><br><br><br></div></div></div>
          
</div></div>

</body>
</html>
