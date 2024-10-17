<?php
// Incluir conexión a la base de datos y autenticación
include('dashboard_autentication.php');
include('../../config/database.php');

// Activar reporte de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicializar variables
$curso_id = null;
$asignatura_id = null;
$periodo = null;
$estudiantes = [];

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asegurarse de que las claves existen en $_POST
    if (isset($_POST['curso'])) {
        $curso_id = $_POST['curso'];
    }

    if (isset($_POST['asignatura'])) {
        $asignatura_id = $_POST['asignatura'];
    }

    if (isset($_POST['periodo'])) {
        $periodo = $_POST['periodo'];
    }

    // Obtener estudiantes del curso seleccionado
    $sql = "
        SELECT e.id, e.nombre, e.apellido
        FROM estudiantes e
        JOIN estudiantes_cursos ec ON e.id = ec.estudiante_id
        WHERE ec.curso_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$curso_id]);
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Procesar las calificaciones enviadas
    if (isset($_POST['calificaciones'])) {
        foreach ($_POST['calificaciones'] as $estudiante_id => $calificacion) {
            $observaciones = $_POST['observaciones'][$estudiante_id] ?? '';

            // Insertar o actualizar la calificación
            $sql = "
                INSERT INTO calificaciones (estudiante_id, maestro_id, asignatura_id, calificación, periodo, observaciones)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE calificación = VALUES(calificación), observaciones = VALUES(observaciones)
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$estudiante_id, $_SESSION['maestro_id'], $asignatura_id, $calificacion, $periodo, $observaciones]);
        }

        echo '<div class="alert alert-success">Calificaciones guardadas con éxito.</div>';
    }
}
?>

<!-- Formulario para Subir Calificaciones -->
<div id="calificaciones">
    <h3>Registrar Calificaciones</h3>
    <form action="calificaciones.php" method="POST">
        <div class="form-group">
            <label for="curso">Seleccionar Curso</label>
            <select name="curso" class="form-control" required>
                <option value="">Seleccionar un curso</option>
                <?php
                // Verificar si el ID del maestro está establecido
                if (!isset($_SESSION['maestro_id'])) {
                    echo '<div class="alert alert-danger">No se ha encontrado el ID del maestro en la sesión.</div>';
                } else {
                    // Obtener cursos asignados al maestro
                    $sql = "SELECT c.id, c.nombre FROM cursos c
                            JOIN asignaciones_maestro am ON c.id = am.curso_id
                            WHERE am.maestro_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$_SESSION['maestro_id']]);
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['id']}'" . (($curso_id == $row['id']) ? " selected" : "") . ">{$row['nombre']}</option>";
                        }
                    } else {
                        echo '<option value="">No hay cursos asignados.</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="asignatura">Seleccionar Asignatura</label>
            <select name="asignatura" class="form-control" required>
                <option value="">Seleccionar una asignatura</option>
                <?php
                // Obtener asignaturas del maestro
                $sql = "SELECT a.id, a.nombre FROM asignaturas a
                        JOIN asignaciones_maestro am ON a.id = am.asignatura_id
                        WHERE am.maestro_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION['maestro_id']]);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'" . (($asignatura_id == $row['id']) ? " selected" : "") . ">{$row['nombre']}</option>";
                    }
                } else {
                    echo '<option value="">No hay asignaturas asignadas.</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="periodo">Seleccionar Periodo</label>
            <select name="periodo" class="form-control" required>
                <option value="">Seleccionar un periodo</option>
                <option value="Primer Periodo">Primer Periodo</option>
                <option value="Segundo Periodo">Segundo Periodo</option>
                <option value="Tercer Periodo">Tercer Periodo</option>
            </select>
        </div>

        <?php if (!empty($estudiantes)): ?>
            <h4>Lista de Estudiantes</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre del Estudiante</th>
                        <th>Calificación</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $estudiante): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($estudiante['nombre'] . ' ' . $estudiante['apellido']); ?></td>
                            <td>
                                <input type="number" step="0.01" name="calificaciones[<?php echo $estudiante['id']; ?>]" class="form-control" placeholder="Calificación" required>
                            </td>
                            <td>
                                <input type="text" name="observaciones[<?php echo $estudiante['id']; ?>]" class="form-control" placeholder="Observaciones">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Guardar Calificaciones</button>
        <?php endif; ?>
    </form>
</div>
