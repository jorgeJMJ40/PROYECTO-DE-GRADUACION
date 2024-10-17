<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="assets/css/admin_dashboard.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header (Encabezado) -->
    <header class="bg-primary text-white text-center py-4">
        <h1 class="mb-0">Panel de Administración</h1>
    </header>

    <div class="row flex-grow-1">
        <!-- Sidebar (Barra lateral) -->
        <nav id="sidebar" class="col-md-3 col-lg-2 bg-dark text-white sidebar">
            <!-- Título del Menú -->
            <div class="sidebar-header p-3">
                <h4 class="text-white">Menú</h4>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="usuarios.php">
                        <i class="fas fa-users"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="calendario.php">
                        <i class="fas fa-calendar-alt"></i> Calendario
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="crear_curso.php">
                        <i class="fas fa-book"></i> Crear Curso
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="gestionarEstudiantes.php" data-toggle="collapse">
                        <i class="fas fa-user-graduate"></i> Gestionar Estudiantes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="gestionarMaestros.php" data-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher"></i> Gestionar Maestros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="asignar_materia.php">
                        <i class="fas fa-chalkboard-teacher"></i> Materias
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../admin/login_admin.php">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h2>Bienvenido al Panel de Administración</h2>
            </div>
            <!-- Aquí puedes agregar más secciones o contenido -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sección de Administración</h5>
                    <p class="card-text">Aquí puedes gestionar las diferentes secciones del sistema.</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer fijo -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>