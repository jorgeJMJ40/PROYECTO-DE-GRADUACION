<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Archivo: asistencia.php
include('../../config/database.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asistencia</title>

    <!-- Enlazar el archivo CSS personalizado -->
    <link rel="stylesheet" href="../../assets/css/asistencia.css">
    
    <!-- Enlazar Bootstrap CSS (si lo estás usando) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Gestión de Asistencia</h2>

    <?php
    // Inicializar las variables
    $curso_id = null; 
    $grado = null; 

    // Obtener el grado seleccionado y el curso si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['grado'])) {
            $grado = $_POST['grado'];
        }
        if (isset($_POST['curso'])) {
            $curso_id = $_POST['curso'];
        }

        // Obtener los estudiantes del curso seleccionado
        if ($curso_id) {
            $sql = "
                SELECT e.id, e.nombre, e.apellido 
                FROM estudiantes e
                JOIN estudiantes_cursos ec ON e.id = ec.estudiante_id
                WHERE ec.curso_id = ?
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$curso_id]);
            $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Si se ha enviado el formulario con la asistencia
            if (isset($_POST['asistencia'])) {
                foreach ($_POST['asistencia'] as $estudiante_id => $estado) {
                    // Insertar o actualizar la asistencia del estudiante
                    $sql = "INSERT INTO asistencia (estudiante_id, fecha, estado, justificación) VALUES (?, CURDATE(), ?, ?) 
                            ON DUPLICATE KEY UPDATE estado = VALUES(estado), justificación = VALUES(justificación)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$estudiante_id, $estado, $_POST['justificacion'][$estudiante_id]]);
                }

                echo '<div class="alert alert-success">Asistencia registrada con éxito</div>';
            }
        }
    }
    ?>

    <!-- Formulario para registrar la asistencia -->
    <form action="gestion_asistencia.php" method="POST">
        <div class="form-group">
            <label for="grado">Seleccionar Grado</label>
            <select name="grado" class="form-control" onchange="this.form.submit()">
                <option value="">Seleccionar un grado</option>
                <?php
                // Lógica para listar grados
                $sql = "SELECT DISTINCT grado FROM cursos"; 
                $result = $pdo->query($sql);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['grado']}'" . (($grado == $row['grado']) ? " selected" : "") . ">{$row['grado']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="curso">Seleccionar Curso</label>
            <select name="curso" class="form-control" onchange="this.form.submit()">
                <option value="">Seleccionar un curso</option>
                <?php
                // Lógica para listar cursos según el grado
                if ($grado) {
                    $sql = "SELECT id, nombre FROM cursos WHERE grado = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$grado]);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'" . (($curso_id == $row['id']) ? " selected" : "") . ">{$row['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <?php if (isset($estudiantes) && !empty($estudiantes)): ?>
            <h4>Lista de Estudiantes</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre del Estudiante</th>
                        <th>Asistencia</th>
                        <th>Justificación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $estudiante): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($estudiante['nombre'] . ' ' . $estudiante['apellido']); ?></td>
                            <td>
                                <select name="asistencia[<?php echo $estudiante['id']; ?>]" class="form-control">
                                    <option value="presente">Presente</option>
                                    <option value="ausente">Ausente</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="justificacion[<?php echo $estudiante['id']; ?>]" class="form-control" placeholder="Justificación">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Registrar Asistencia</button>
        <?php endif; ?>
    </form>

    <!-- Botón de regresar al dashboard del maestro -->
    <a href="maestro_dashboard.php" class="btn btn-secondary mt-3">Regresar al Dashboard</a>
</div>

</body>
</html>
