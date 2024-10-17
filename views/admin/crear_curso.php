<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Curso o Asignatura</title>
    <link rel="stylesheet" href="../assents/css/crear_users.css"> <!-- CSS separado -->
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Nuevo Curso o Asignatura</h1>

        <!-- Formulario para crear un nuevo curso -->
        <h2>Crear Nuevo Curso</h2>
        <form action="../admin/dashboard_autentication.php" method="POST">
            <input type="hidden" name="crear_curso" value="1">
            <div class="form-group">
                <label for="nombre_curso">Nombre del Curso</label>
                <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" required placeholder="Ingrese el nombre del curso">
            </div>
            <div class="form-group">
                <label for="grado">Grado</label>
                <select class="form-control" id="grado" name="grado" required>
                    <option value="">Seleccione el grado</option>
                    <option value="Parvulos">Parvulos</option>
                    <option value="Primero">Primero Primaria</option>
                    <option value="Segundo">Segundo Primaria</option>
                    <option value="Tercero">Tercero Primaria</option>
                    <option value="Cuarto">Cuarto Primaria</option>
                    <option value="Quinto">Quinto Primaria</option>
                    <option value="Sexto">Sexto Primaria</option>
                    <!-- más opciones según necesites -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm btn-block">Guardar Curso</button>
        </form>

        <!-- Formulario para crear una nueva asignatura -->
        <h2 class="mt-5">Crear Nueva Asignatura</h2>
        <form action="../admin/dashboard_autentication.php" method="POST">
            <input type="hidden" name="crear_asignatura" value="1">
            <div class="form-group">
                <label for="nombre_asignatura">Nombre de la Asignatura</label>
                <input type="text" class="form-control" id="nombre_asignatura" name="nombre_asignatura" required placeholder="Ingrese el nombre de la asignatura">
            </div>
            <button type="submit" class="btn btn-primary btn-sm btn-block">Guardar Asignatura</button>
        </form>

        <!-- Botones para navegar -->
        <div class="d-flex justify-content-between mt-3">
            <a href="../admin/admin_dashboard.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
            <a href="../admin/ver_cursos.php" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Ver Cursos
            </a>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
