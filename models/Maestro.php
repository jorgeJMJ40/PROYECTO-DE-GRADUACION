<?php
class Maestro {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerMaestroPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM maestros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
