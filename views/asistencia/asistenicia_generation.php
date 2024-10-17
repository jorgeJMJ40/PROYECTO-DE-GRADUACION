<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "54321";
$dbname = "santa_sofia";

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso = mysqli_real_escape_string($conn, $_POST['curso']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $alumno = mysqli_real_escape_string($conn, $_POST['alumno']);
    $asistencia = mysqli_real_escape_string($conn, $_POST['asistencia']);
    
    // Insertar los datos en la tabla de asistencia
    $sql = "INSERT INTO asistencia (curso, fecha, alumno, estado) 
            VALUES ('$curso', '$fecha', '$alumno', '$asistencia')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Asistencia registrada exitosamente'); window.location.href = 'agregar_asistencia.php';</script>";
    } else {
        echo "<script>alert('Error al registrar asistencia: " . mysqli_error($conn) . "');</script>";
    }
}

$conn->close();
?>
