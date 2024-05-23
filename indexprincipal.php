<!doctype html>
<html> lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="{{ asset('assets/form.css') }}" rel="stylesheet">

    <title>Sistema para administradores</title>

   <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="indexprincipal.php">
            <img src="assets/logo.jfif" alt="TF" width="50" height="50">
        </a>
          <a class="navbar-brand text-center" href="indexprincipal.php"><h3>TALLER MECANICO EL TORNILLO SUELTO</h3></a>
        
        <span class="ml-auto">
      <a class="btn btn-outline-info" href="login.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
          </svg></a>
    </span>

      </div>
    </nav> 

    
    
  </head>
  <--<!-- FONDO DEL INDEX -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fondo con Capa Transparente</title>
    <style>
        .background {
            position: relative;
            width: 100%;
            height: 100vh;
            background-image: url('assets/fondot.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
            top: 40%; 
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
            background-color: #00A7CF; /* Color de fondo del botón */
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
        .card-title{
            color: black;
        }

    </style>
</head>

<body>
   
    <div class="background">
        <div class="overlay">
        <div class="content">
  <div class="justify-content-center align-items-center">
        <div class="container">
            <br><h1>BIENVENIDO AL SISTEMA ADMINISTRATIVO</h1><br>
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <img src="https://img.freepik.com/foto-gratis/trabajador-servicio-coche-musculoso-reparando-vehiculo_146671-19605.jpg" class="card-img-top" alt="30">
                    <div class="card">
                        <div class="card-body">
                        <h3 class="card-title">Servicios</h3>
                        <a href="listOservicios.php" class="btn btn-dark mb-3">Ordenes de Servicio</a>
                        <a href="regOservicios.php" class="btn btn-dark mb-3">Nueva Orden de Servicio</a>
                        <a href="listRequi.php" class="btn btn-dark mb-3">Requisiciones</a>
                        <a href="listOpagos.php" class="btn btn-dark mb-3">Ordenes de Pago</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://static.vecteezy.com/system/resources/previews/014/938/293/non_2x/oil-filter-air-filter-oil-lubricant-fuel-filter-and-cabin-filter-in-the-auto-parts-shop-photo.jpg" class="card-img-top" height="217">
                    <div class="card">
                        <div class="card-body">
                        <h3 class="card-title">Insumos</h3>
                        <a href="listInsumos.php" class="btn btn-dark mb-3">Inventario de Insumos</a>
                        <a href="listOcompra.php" class="btn btn-dark mb-3">Ordenes de Compra</a>
                        <a href="regOcompra.php" class="btn btn-dark mb-3">Nueva Orden de Compra</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://st.depositphotos.com/28515490/56668/v/450/depositphotos_566681580-stock-illustration-car-service-illustration-concept-flat.jpg" class="card-img-top" height="217">
                    <div class="card">
                        <div class="card-body">
                        <h3 class="card-title">Registros</h3>
                        <a href="listClientes.php" class="btn btn-dark mb-3">Clientes</a>
                        <a href="listVehiculos.php" class="btn btn-dark mb-3">Vehiculos</a><br>
                        <a href="listMecanicos.php" class="btn btn-dark mb-3">Mecanicos</a><br>
                        <a href="proveedores.php" class="btn btn-dark mb-3">Proveedores</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
        </div></div>
    </div>
    
    
    
    
    
    
</body>
  

</html>
