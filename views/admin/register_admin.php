<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Gestión Escolar</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu propio archivo CSS -->
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container p-5 bg-white rounded shadow-sm">
            <h2 class="text-center text-primary mb-4">Registro de Administrador</h2>
            <form action="../auth/register_autentication.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese su nombre completo">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ingrese su correo electrónico">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Ingrese su contraseña">
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <!-- Agregamos la opción de Administrador solo si ya hay un Administrador -->
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </form>
            <p class="text-center mt-3">¿Ya tienes cuenta? <a href="../auth/login.php">Inicia sesión aquí</a></p>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
