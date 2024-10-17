<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cursos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assents/css/ver_cursos.css"> <!-- CSS separado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Iconos FontAwesome -->
</head>

<body>
    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1 class="text-center mb-4">Ver Cursos</h1>

        <!-- Tabla para mostrar los cursos -->
        <table class="table table-bordered table-hover table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre curso o Materia</th>
                    <th>Grado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los cursos mediante PHP -->
                <?php 
                    include('../admin/dashboard_autentication.php'); 

                    // Mostrar cursos desde la base de datos
                    try {
                        $stmt = $pdo->prepare("SELECT * FROM cursos");
                        $stmt->execute();
                        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($cursos) {
                            foreach ($cursos as $curso) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($curso['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($curso['nombre']) . "</td>";
                                echo "<td>" . htmlspecialchars($curso['grado']) . "</td>";
                                echo "<td class='text-center'>
                                        <a href='../admin/edit_course_form.php?id=" . $curso['id'] . "' class='btn btn-warning btn-sm'>
                                            <i class='fas fa-edit'></i> Editar
                                        </a>
                                        <a href='../admin/edit_course.php?eliminar_curso=" . $curso['id'] . "' class='btn btn-danger btn-sm' 
                                           onclick='return confirm(\"¿Estás seguro de eliminar este curso?\");'>
                                            <i class='fas fa-trash-alt'></i> Eliminar
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No hay cursos disponibles.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='4' class='text-center'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Botones de navegación -->
        <div class="text-center mt-3">
            <!-- Botón para regresar a la página anterior -->
            <a href="../admin/crear_curso.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>

            <!-- Botón para regresar al inicio -->
            <a href="../admin/admin_dashboard.php" class="btn btn-primary">
                <i class="fas fa-home"></i> Inicio
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
