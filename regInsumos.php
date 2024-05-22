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
    <h1>Registrar nuevo insumo</h1><br>
                <form action="registrarInsumo.php" method="post">
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">ID</span>
                        <input type="number" step="0.01" class="form-control col-2" id="id_insumo" name="id_insumo" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_i">Nombre del Insumo</label>
                        <input type="text" class="form-control" id="nombre_i" name="nombre_i" required>
                    </div>
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="costo" name="costo" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="mini">Mínimo</label>
                        <input type="number" class="form-control" id="mini" name="mini" required>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="id_tipo">Tipo de Insumo</label>
                        <select class="form-select" id="id_tipo" name="id_tipo" required>
                            <option value="1">Filtro</option>
                            <option value="2">Aceite</option>
                            <option value="3">Repuesto</option>
                            <option value="4">Consumible</option>
                        </select>
                    </div>                   
                    <div class="form-group">
                        <label for="descri_i">Descripción</label>
                        <input type="text" class="form-control" id="descri_i" name="descri_i" required>
                    </div>
                    <div class="form-group">
                        <label for="id_oc">ID OC</label>
                        <input type="number" class="form-control" id="id_oc" name="id_oc" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Insumo</button>
                </form>
    <br></div></div></div>
</div>

</body>
</html>
