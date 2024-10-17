

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión Escolar</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container p-5 bg-white rounded shadow-sm">
            <h2 class="text-center text-primary mb-4">Iniciar Sesión</h2>

            <!-- Mostrar error si existe -->
            <?php
            if (isset($_GET['error'])) {
                $error_msg = htmlspecialchars($_GET['error']);
                echo '<div class="alert alert-danger">' . $error_msg . '</div>';
            }
            ?>

            <!-- Formulario de Login -->
            <form action="../auth/login_autentication.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ingrese su correo electrónico">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Ingrese su contraseña">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>
            <p class="text-center mt-3">¿No tienes cuenta? <a href="register.php">.</a></p>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
