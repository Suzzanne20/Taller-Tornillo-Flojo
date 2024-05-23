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

    <title>Sistema para el personal</title>

   <nav class="navbar navbar-dark bg-primary fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="indexsecundario.php">
            <img src="assets/logo.jfif" alt="TF" width="50" height="50">
        </a>
          <a class="navbar-brand text-center" href="indexsecundario.php"><h3>TALLER MECANICO EL TORNILLO SUELTO</h3></a>
        
        <span class="ml-auto">
      <a class="btn btn-danger" href="login.php">Cerrar Sesión</a>
    </span>

      </div>
    </nav> <br><br>

    
    
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
            top: 50%;
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
            background-color: #007BFF; /* Color de fondo del botón */
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

    </style>
</head>



<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="content">
            <h1>BIENVENIDO AL SISTEMA OPERATIVO</h1>
             <div class="button-container">
                <a href="listClientes.php"><button>CLIENTES</button></a>
                <a href="listVehiculos.php"><button>VEHICULOS</button></a>
                <a href="listinsumos.php"><button>INSUMOS</button></a>
                <a href="indexprincipal.php"><button>SERVICIO</button></a>
                <a href="listOcompra.php"><button>ORDENES DE COMPRA</button></a>
                <a href="listOpago.php"><button>ORDENES DE PAGO</button></a>
                <a href="listrequi.php"><button>REQUICISIONES</button></a>
                <a href="informacion.php"><button>INFORMACION</button></a>
            </div>
        </div>
    </div>
</body>
  
  
  

</html>
