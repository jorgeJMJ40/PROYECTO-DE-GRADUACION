<?php
// Incluir el archivo de conexión
include '../../config/database.php';

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];  // 'estudiante' o 'padre'

    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (:nombre, :email, :password, :rol)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            echo "Usuario registrado correctamente.";
            header("Location: login.php"); // Redirige al login después de registrarse
            exit();
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
?>
