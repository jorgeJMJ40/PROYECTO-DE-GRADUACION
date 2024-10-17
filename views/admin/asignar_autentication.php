<?php
// Iniciar sesión y mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Verificar si la sesión está activa y si el rol del usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'administrador') {
    header("Location: ../auth/login.php"); // Redirigir al login si no está autenticado o no es administrador
    exit();
}

// Incluir la conexión a la base de datos
include '../../config/database.php'; // Ruta de la conexión a la base de datos

$mensaje = ""; // Inicializamos la variable de mensaje

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maestro_id = $_POST['maestro_id'];
    $curso_id = $_POST['curso_id'];
    $asignatura_id = $_POST['asignatura_id'];

    // Validar que los IDs no estén vacíos y sean numéricos
    if (!empty($maestro_id) && !empty($curso_id) && !empty($asignatura_id) &&
        is_numeric($maestro_id) && is_numeric($curso_id) && is_numeric($asignatura_id)) {

        // Consulta para insertar la asignación
        $sql_insert = "INSERT INTO asignaciones_maestro (maestro_id, curso_id, asignatura_id) VALUES (:maestro_id, :curso_id, :asignatura_id)";
        $stmt = $pdo->prepare($sql_insert);
        
        // Enlazar parámetros
        $stmt->bindParam(':maestro_id', $maestro_id, PDO::PARAM_INT);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->bindParam(':asignatura_id', $asignatura_id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                $mensaje = "Curso asignado correctamente.";
            } else {
                $mensaje = "Error al asignar el curso.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error: " . $e->getMessage(); // Capturar errores de SQL
        }
    } else {
        $mensaje = "Por favor, asegúrese de que todos los campos estén seleccionados correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Asignación</title>
</head>
<body>
    <h1>Resultado de Asignación</h1>

    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <h2>Volver a Asignar Cursos</h2>
    <form action="asignar_materia.php" method="GET">
        <button type="submit">Regresar al Formulario</button>
    </form>
</body>
</html>
