<?php
class Calificacion {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrarCalificacion($estudiante_id, $maestro_id, $asignatura, $calificacion, $periodo, $observaciones = null) {
        $stmt = $this->pdo->prepare("INSERT INTO calificaciones (estudiante_id, maestro_id, asignatura, calificación, periodo, observaciones) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$estudiante_id, $maestro_id, $asignatura, $calificacion, $periodo, $observaciones]);
    }

    public function obtenerCalificacionesPorEstudiante($estudiante_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM calificaciones WHERE estudiante_id = ?");
        $stmt->execute([$estudiante_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
