<?php
include('../admin/dashboard_autentication.php');

// Lógica para eliminar un curso
if (isset($_GET['eliminar_curso']) && is_numeric($_GET['eliminar_curso'])) {
    $curso_id = $_GET['eliminar_curso'];

    // Preparar la consulta para eliminar el curso
    $stmt = $pdo->prepare("DELETE FROM cursos WHERE id = :id");
    $stmt->bindParam(':id', $curso_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Curso eliminado exitosamente.'); window.location.href = 'ver_cursos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el curso.'); window.location.href = 'ver_cursos.php';</script>";
    }
    exit;
}

// Verificar si se ha pasado un ID de curso para editar
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

// Lógica para actualizar el curso
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $grado = $_POST['grado'];

    // Validar datos (añadir más validaciones si es necesario)
    if (empty($nombre) || empty($grado)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Preparar la actualización
        $stmt = $pdo->prepare("UPDATE cursos SET nombre = :nombre, grado = :grado WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':grado', $grado);
        $stmt->bindParam(':id', $curso_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Curso actualizado exitosamente.'); window.location.href = 'ver_cursos.php';</script>";
        } else {
            $error = "Error al actualizar el curso.";
        }
    }
}
?>
