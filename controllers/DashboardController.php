<?php
class DashboardController {
    public function index() {
        $usuario = $_SESSION['user'];

        if ($usuario['rol'] == 'administrador') {
            require_once 'views/dashboard/admin.php';
        } elseif ($usuario['rol'] == 'maestro') {
            require_once 'views/dashboard/maestro.php';
        } elseif ($usuario['rol'] == 'estudiante') {
            require_once 'views/dashboard/estudiante.php';
        } else {
            require_once 'views/dashboard/padre.php';
        }
    }
}
?>
