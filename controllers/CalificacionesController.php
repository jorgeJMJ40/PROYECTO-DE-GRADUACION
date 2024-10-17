<?php
require_once 'config/database.php';

class CalificacionesController {
    public function registrar($estudiante_id, $maestro_id, $asignatura, $calificacion, $periodo, $observaciones = null) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO calificaciones (estudiante_id, maestro_id, asignatura, calificación, periodo, observaciones) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$estudiante_id, $maestro_id, $asignatura, $calificacion, $periodo, $observaciones]);
        echo "Calificación registrada.";
    }

    public function verCalificacionesPorEstudiante($estudiante_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM calificaciones WHERE estudiante_id = ?");
        $stmt->execute([$estudiante_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
