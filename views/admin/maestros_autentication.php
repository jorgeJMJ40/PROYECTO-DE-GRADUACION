<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Incluir la conexión a la base de datos
include('../../config/database.php'); // Asegúrate de que esta conexión sea la correcta

// Verifica si la conexión fue exitosa
if (!$pdo) {
    die("Error de conexión: " . $pdo->errorInfo());
}

// Agregar Maestro
if (isset($_POST['agregarMaestro'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    try {
        // Insertar el nuevo maestro usando PDO
        $query = "INSERT INTO maestros (nombre, apellido) VALUES (:nombre, :apellido)";
        $stmt = $pdo->prepare($query);
        
        // Vincular los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo "<script>alert('Maestro agregado correctamente'); window.location.href='gestionarMaestros.php';</script>";
    } catch (PDOException $e) {
        // Capturar y mostrar el error si falla la inserción
        echo "<script>alert('Error al agregar maestro: " . $e->getMessage() . "');</script>";
    }
}

// Eliminar Maestro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    try {
        // Eliminar maestro usando PDO
        $query = "DELETE FROM maestros WHERE id = :id";
        $stmt = $pdo->prepare($query);
        
        // Vincular el parámetro
        $stmt->bindParam(':id', $id);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo "<script>alert('Maestro eliminado correctamente'); window.location.href='gestionarMaestros.php';</script>";
    } catch (PDOException $e) {
        // Capturar y mostrar el error si falla la eliminación
        echo "<script>alert('Error al eliminar maestro: " . $e->getMessage() . "');</script>";
    }
}

// Obtener todos los maestros
try {
    $query = "SELECT * FROM maestros";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Obtener el resultado como un array asociativo
    $resultMaestros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Capturar y mostrar el error si falla la consulta
    die('Error al obtener maestros: ' . $e->getMessage());
}
?>
