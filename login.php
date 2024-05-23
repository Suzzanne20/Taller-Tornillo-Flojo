<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('assets/fondol.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(5px); /* Aplicar el efecto de difuminado */
          
        }

        .content {
            position: relative;
            
            width: 100%;
            max-width: 400px; /* Ancho máximo del contenedor de login */
            padding: 20px;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%; /* Asegura que el contenedor de login use todo el ancho del contenedor de contenido */
        }
        
            .login-container img {
            width: 200px; /* Ajusta el tamaño según tus necesidades */
            height: auto;
            margin-bottom: 1px;
            display: block; /* Para centrar horizontalmente la imagen */
            margin-left: auto; /* Para centrar horizontalmente la imagen */
            margin-right: auto; /* Para centrar horizontalmente la imagen */
        }

        .login-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="login-container">
            <img src="assets/logo.jfif"  alt="Logo">
            <h2>Inicio de Sesión</h2>
            <form action="controlador.php" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
