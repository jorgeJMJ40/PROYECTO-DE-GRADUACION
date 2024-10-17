<?php
class Estudiante {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerEstudiantePorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM estudiantes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarEstudiantesPorCurso($curso_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM estudiantes WHERE curso_id = ?");
        $stmt->execute([$curso_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
