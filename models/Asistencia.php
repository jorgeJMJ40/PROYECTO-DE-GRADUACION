<?php
class Asistencia {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrarAsistencia($estudiante_id, $estado, $justificacion = null) {
        $stmt = $this->pdo->prepare("INSERT INTO asistencia (estudiante_id, fecha, estado, justificación) VALUES (?, CURDATE(), ?, ?)");
        $stmt->execute([$estudiante_id, $estado, $justificacion]);
    }

    public function obtenerAsistenciaPorCurso($curso_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM asistencia WHERE estudiante_id IN (SELECT id FROM estudiantes WHERE curso_id = ?)");
        $stmt->execute([$curso_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
