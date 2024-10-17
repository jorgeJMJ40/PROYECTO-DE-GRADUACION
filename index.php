<?php
session_start();

// Cargar configuración de la base de datos y otros archivos necesarios
require_once 'config/database.php';

// Rutas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Función para manejar las rutas
function handleRoute($uri, $pdo) {
    if ($uri === '/login') {
        require 'controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->login();
    } elseif ($uri === '/register') {
        require 'controllers/AuthController.php';
        $controller = new AuthController($pdo);
        $controller->register();
    } elseif ($uri === '/dashboard') {
        if (isset($_SESSION['rol'])) {
            switch ($_SESSION['rol']) {
                case 'administrador':
                    require 'views/dashboard/admin.php';
                    break;
                case 'maestro':
                    require 'views/dashboard/maestro.php';
                    break;
                case 'estudiante':
                    require 'views/dashboard/estudiante.php';
                    break;
                case 'padre':
                    require 'views/dashboard/padre.php';
                    break;
                default:
                    // Si el rol no coincide, redirige al login
                    header('Location: /login');
                    exit();
            }
        } else {
            // Si no está autenticado, redirige al login
            header('Location: /login');
            exit();
        }
    } elseif ($uri === '/asistencia/gestionar') {
        require 'controllers/AsistenciaController.php';
        $controller = new AsistenciaController($pdo);
        $controller->gestionar();
    } elseif ($uri === '/calificaciones/gestionar') {
        require 'controllers/CalificacionesController.php';
        $controller = new CalificacionesController($pdo);
        $controller->gestionar();
    } elseif ($uri === '/reportes/ver') {
        require 'controllers/ReportesController.php';
        $controller = new ReportesController($pdo);
        $controller->ver();
    } elseif ($uri === '/admin/gestionar-usuarios') {
        require 'controllers/AdminController.php';
        $controller = new AdminController($pdo);
        $controller->gestionarUsuarios();
    } else {
        // Si la URL no coincide con ninguna ruta, redirige al dashboard si está autenticado
        if (isset($_SESSION['rol'])) {
            header('Location: /dashboard');
            exit();
        } else {
            header('Location: /login');
            exit();
        }
    }
}

// Ejecutar la función de manejo de rutas
handleRoute($uri, $pdo);
?>
