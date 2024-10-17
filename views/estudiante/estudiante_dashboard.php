<?php
// Incluir conexión a la base de datos y autenticación
include('../../config/database.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'estudiante') {
    header("Location: ../auth/login.html");
    exit();
}

// Obtener el ID del estudiante desde la sesión
$estudiante_id = $_SESSION['user_id'];

// Obtener calificaciones del estudiante
$sql_calificaciones = "
    SELECT c.calificación, c.periodo, a.nombre AS asignatura
    FROM calificaciones c
    JOIN asignaturas a ON c.asignatura_id = a.id
    WHERE c.estudiante_id = ?
";
$stmt_calificaciones = $pdo->prepare($sql_calificaciones);
$stmt_calificaciones->execute([$estudiante_id]);
$calificaciones = $stmt_calificaciones->fetchAll(PDO::FETCH_ASSOC);

// Obtener asistencia del estudiante
$sql_asistencia = "
    SELECT a.fecha, a.estado, a.justificación
    FROM asistencia a
    WHERE a.estudiante_id = ?
    ORDER BY a.fecha DESC
";
$stmt_asistencia = $pdo->prepare($sql_asistencia);
$stmt_asistencia->execute([$estudiante_id]);
$asistencia = $stmt_asistencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Estudiante</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bienvenido, Estudiante</h1>
        
        <h2>Calificaciones</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Calificación</th>
                    <th>Periodo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($calificaciones)): ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay calificaciones disponibles.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($calificaciones as $calificacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($calificacion['asignatura']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['calificación']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['periodo']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Asistencia</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Justificación</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($asistencia)): ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay registros de asistencia.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($asistencia as $registro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($registro['estado']); ?></td>
                            <td><?php echo htmlspecialchars($registro['justificación']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../auth/login.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>
