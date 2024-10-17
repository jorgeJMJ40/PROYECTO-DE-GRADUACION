<?php
include('../admin/dashboard_autentication.php');

// Verificar si se ha pasado un ID de curso
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $curso_id = $_GET['id'];

    // Preparar consulta para obtener el curso
    $stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = :id");
    $stmt->bindParam(':id', $curso_id, PDO::PARAM_INT);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el curso existe
    if (!$curso) {
        echo "<script>alert('Curso no encontrado.'); window.location.href = 'ver_cursos.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID de curso inválido.'); window.location.href = 'ver_cursos.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1>Editar Curso</h1>

    <!-- Mostrar el error si existe -->
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <!-- Formulario de edición del curso -->
    <form action="edit_course.php?id=<?php echo htmlspecialchars($curso['id']); ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($curso['nombre']); ?>" required>
        </div>

        <div class="form-group">
            <label for="grado">Grado</label>
            <input type="text" id="grado" name="grado" class="form-control" value="<?php echo htmlspecialchars($curso['grado']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Curso</button>
    </form>

    <!-- Botón para volver -->
    <a href="ver_cursos.php" class="btn btn-secondary mt-3">Volver</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
