<?php
// Verificar si la sesión está activa
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'padre') {
    // Si no hay sesión o el rol no es el de padre, redirigir al login
    header("Location: ../auth/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Padre/Tutor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bienvenido, Padre/Tutor</h1>
        <p class="text-center">Aquí puedes consultar la información de tus hijos, ver notas, asistencia, y más.</p>
        
        <!-- Información para el padre, como ver el progreso de los hijos, asistencia, etc. -->
        
        <div class="text-center">
            <a href="../auth/login.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
