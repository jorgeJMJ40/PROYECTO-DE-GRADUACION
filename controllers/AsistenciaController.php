<?php
require_once 'config/database.php';

class AsistenciaController {
    public function registrar($estudiante_id, $estado, $justificación = null) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO asistencia (estudiante_id, fecha, estado, justificación) VALUES (?, CURDATE(), ?, ?)");
        $stmt->execute([$estudiante_id, $estado, $justificación]);
        echo "Asistencia registrada.";
    }

    public function verAsistenciaPorCurso($curso_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM asistencia WHERE estudiante_id IN (SELECT id FROM estudiantes WHERE curso_id = ?)");
        $stmt->execute([$curso_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
