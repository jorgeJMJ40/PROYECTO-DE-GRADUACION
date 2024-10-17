<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/AsistenciaController.php';
require_once 'controllers/CalificacionesController.php';
require_once 'controllers/ReportesController.php';

$authController = new AuthController();
$dashboardController = new DashboardController();
$asistenciaController = new AsistenciaController();
$calificacionesController = new CalificacionesController();
$reportesController = new ReportesController();

// Rutas de autenticación
if ($_SERVER['REQUEST_URI'] == '/login') {
    $authController->login($_POST['email'], $_POST['password']);
}

// Rutas del dashboard
if ($_SERVER['REQUEST_URI'] == '/dashboard') {
    $dashboardController->index();
}

// Rutas de asistencia
if ($_SERVER['REQUEST_URI'] == '/asistencia/registrar') {
    $asistenciaController->registrar($_POST['estudiante_id'], $_POST['estado'], $_POST['justificación']);
}

// Rutas de calificaciones
if ($_SERVER['REQUEST_URI'] == '/calificaciones/registrar') {
    $calificacionesController->registrar($_POST['estudiante_id'], $_POST['maestro_id'], $_POST['asignatura'], $_POST['calificacion'], $_POST['periodo'], $_POST['observaciones']);
}

// Rutas de reportes
if ($_SERVER['REQUEST_URI'] == '/reportes/asistencia') {
    $reportesController->generarReporteAsistencia($_POST['curso_id']);
}
?>
