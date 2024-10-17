<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Maestros</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/gestionarEstudiantes.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Gestionar Maestros</h2>

          <!-- Botón de regresar -->
          <div class="mb-3">
            <a href="../admin/admin_dashboard.php" class="btn btn-primary">Regresar</a>
        </div>

        <!-- Formulario para agregar maestro -->
        <div class="card mb-4">
            <div class="card-header">Agregar Maestro</div>
            <div class="card-body">
                <form action="maestros_autentication.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    <button type="submit" name="agregarMaestro" class="btn btn-success">Agregar Maestro</button>
                </form>
            </div>
        </div>

        <!-- Tabla para listar maestros -->
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
                <?php while ($maestro = mysqli_fetch_assoc($resultMaestros)): ?>
                    <tr>
                        <td><?= $maestro['id'] ?></td>
                        <td><?= $maestro['nombre'] ?></td>
                        <td><?= $maestro['apellido'] ?></td>
                        <td>
                            <!-- Botón para eliminar -->
                            <a href="?eliminar=<?= $maestro['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este maestro?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

       
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
