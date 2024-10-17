<?php
require_once 'config/database.php';

class ReportesController {
    public function generarReporteAsistencia($curso_id) {
        global $pdo;
        // Consulta para generar reporte de asistencia
        $stmt = $pdo->prepare("SELECT * FROM asistencia WHERE estudiante_id IN (SELECT id FROM estudiantes WHERE curso_id = ?)");
        $stmt->execute([$curso_id]);
        $asistencia = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lógica para exportar a PDF o Excel
        echo "Reporte generado.";
    }

    public function generarReporteCalificaciones($curso_id) {
        global $pdo;
        // Consulta para generar reporte de calificaciones
        $stmt = $pdo->prepare("SELECT * FROM calificaciones WHERE estudiante_id IN (SELECT id FROM estudiantes WHERE curso_id = ?)");
        $stmt->execute([$curso_id]);
        $calificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lógica para exportar a PDF o Excel
        echo "Reporte generado.";
    }
}
?>
