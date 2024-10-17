<?php
// Incluye la autenticación del maestro
include('dashboard_autentication.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Maestro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/maestro_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Sistema Escolar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> Bienvenido, Maestro</a>
                </li>
                <li class="nav-item">
                    <a href="../admin/login_admin.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar de navegación -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="list-group">
                    <a href="#asistencia-content" class="list-group-item list-group-item-action" data-toggle="collapse">
                        <i class="fas fa-users"></i> Gestión de Asistencia
                    </a>
                    <a href="#calificaciones" class="list-group-item list-group-item-action" data-toggle="collapse">
                        <i class="fas fa-chalkboard"></i> Subir Calificaciones
                    </a>
                    <a href="#reportes" class="list-group-item list-group-item-action" data-toggle="collapse">
                        <i class="fas fa-chart-line"></i> Ver Reportes
                    </a>
                </div>
            </nav>

            <!-- Panel principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Panel del Maestro</li>
                    </ol>
                </nav>

                <!-- Contenedor para la Gestión de Asistencia -->
                <div id="asistencia-content" class="collapse">
                    <h3>Gestión de Asistencia</h3>
                    <?php include('gestion_asistencia.php'); ?>
                </div>

                <!-- Subir Calificaciones -->
                <div id="calificaciones" class="collapse">
                    <h3>Subir Calificaciones</h3>
                    <form action="calificaciones.php" method="POST">
                        <div class="form-group">
                            <label for="curso">Seleccionar Curso</label>
                            <select name="curso" class="form-control">
                                <?php
                                // Lógica para listar cursos y asignaturas
                                ?>
                            </select>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Estudiante</th>
                                    <th>Calificación</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se ingresarán las calificaciones -->
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Guardar Calificaciones</button>
                    </form>
                </div>

                <!-- Ver Reportes -->
                <div id="reportes" class="collapse">
                    <h3>Ver Reportes</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha de Generación</th>
                                <th>Tipo de Reporte</th>
                                <th>Formato</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Lógica para mostrar reportes
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
