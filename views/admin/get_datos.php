<?php
// Incluir la conexión a la base de datos
include '../../config/database.php'; // Asegúrate de que la ruta sea correcta

header('Content-Type: application/json'); // Definir el tipo de contenido como JSON

// Comprobar si se ha especificado un tipo de datos
if (isset($_GET['type'])) {
    $type = $_GET['type'];

    try {
        switch ($type) {
            case 'maestros':
                // Consulta para obtener todos los maestros
                $sql = "SELECT id, nombre, apellido FROM maestros";
                break;

            case 'cursos':
                // Consulta para obtener todos los cursos
                $sql = "SELECT id, nombre FROM cursos";
                break;

            case 'asignaturas':
                // Consulta para obtener todas las asignaturas
                $sql = "SELECT id, nombre FROM asignaturas";
                break;

            default:
                echo json_encode(array('error' => 'Tipo de datos no válido.'));
                exit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Obtener los resultados
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los resultados como JSON
        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
} else {
    echo json_encode(array('error' => 'No se especificó tipo de datos.'));
}
?>
