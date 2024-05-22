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
<body>
<div class="container mt-5">
    <div class="modal-dialog"><div class="modal-content"><div class="container">
    <h1>Nueva Orden de Compra</h1><br>
                <form action="registrarOcompra.php" method="post">
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text"># OC</span>
                        <input type="number" step="0.01" class="form-control col-2" id="id_oc" name="id_oc" required>
                    </div>
                    <div class="form-group">
                        <label for="id_insumo">Id Insumo</label>
                        <input type="number" step="0.01" class="form-control" id="id_insumo" name="id_insumo" required>
                    </div>
                    <div class="form-group">
                        <label for="cant_insu">Cantidad</label>
                        <input type="number" step="0.01" class="form-control" id="cant_insu" name="cant_insu" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="text" class="form-control" placeholder="00/00/00" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="descri">Descripción</label>
                        <input type="text" class="form-control" id="descri" name="descri" required>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="id_tipo">Proveedor</label>
                        <select class="form-select" id="id_prov" name="id_prov" required>
                            <option value="10001">DYSHER</option>
                            <option value="10002">AUTOTOTAL</option>
                            <option value="10003">MOTUL</option>
                            <option value="10004">MASTER AUTO</option>
                            <option value="10005">VALVOLINE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_usuario">ID Usuario</label>
                        <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Insumo</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>
