<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Estudiantes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/gestionarEstudiantes.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Gestionar Estudiantes</h2>

        <!-- Botón de regresar -->
        <div class="mb-3">
            <a href="../admin/admin_dashboard.php" class="btn btn-primary">Regresar</a>
        </div>

        <!-- Formulario para agregar estudiantes -->
        <div class="card mb-4">
            <div class="card-header">Agregar Estudiante</div>
            <div class="card-body">
                <form action="estudiante_autentication.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="grado">Grado:</label>
                        <select id="grado" name="grado" class="form-control" required>
                            <option value="">Seleccione un grado</option>
                            <option value="Parvulos">Parvulos</option>
                            <option value="Primero">Primero Primaria</option>
                            <option value="Segundo">Segundo Primaria</option>
                            <option value="Tercero">Tercero Primaria</option>
                            <option value="Cuarto">Cuarto Primaria</option>
                            <option value="Quinto">Quinto Primaria</option>
                            <option value="Sexto">Sexto Primaria</option>
                            <!-- Agrega aquí los demás grados si es necesario -->
                        </select>
                    </div>

                    <!-- Campo para seleccionar cursos (múltiples) -->
                    <div class="form-group">
                        <label for="curso_id">Cursos:</label>
                        <select id="curso_id" name="curso_id[]" class="form-control" multiple required>
                            <option value="">Seleccione cursos</option>
                            <!-- Los cursos serán cargados dinámicamente por AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tutor_id">ID del Tutor:</label>
                        <input type="number" name="tutor_id" class="form-control" required>
                    </div>

                    <button type="submit" name="agregarEstudiante" class="btn btn-success">Agregar Estudiante</button>
                </form>
            </div>
        </div>

        <!-- Tabla para listar estudiantes -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultEstudiantes as $estudiante): ?>
                    <tr>
                        <td><?= $estudiante['id'] ?></td>
                        <td><?= $estudiante['nombre'] ?></td>
                        <td><?= $estudiante['apellido'] ?></td>
                        <td>
                            <a href="?eliminar=<?= $estudiante['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este estudiante?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Manejar el cambio de grado para cargar cursos disponibles
        $('#grado').change(function() {
            var grado = $(this).val();
            if (grado) {
                $.ajax({
                    type: 'POST',
                    url: 'estudiante_autentication.php',
                    data: {
                        grado: grado
                    },
                    success: function(response) {
                        $('#curso_id').html(response);
                    }
                });
            } else {
                $('#curso_id').html('<option value="">Seleccione un curso</option>');
            }
        });
    </script>
</body>

</html>