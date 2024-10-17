<?php
// Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include '../../config/database.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Verificar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Por favor, complete todos los campos");
        exit();
    }

    // Consultar la base de datos para verificar las credenciales
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la contraseña ingresada coincide con la almacenada (usamos password_verify)
        if (password_verify($password, $user['contraseña'])) {
            // Autenticación exitosa, redirigir según el rol
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_role'] = $user['rol'];  // Guardamos el rol del usuario

            // Redirigir al panel principal (o dashboard) según el rol
            switch ($user['rol']) {
                case 'administrador':
                    header("Location: ../admin/admin_dashboard.php");  // Panel para administrador
                    break;
                case 'maestro':
                    header("Location: ../maestro/maestro_dashboard.php");  // Panel para maestro
                    break;
                case 'estudiante':
                    header("Location: ../estudiante/estudiante_dashboard.php");  // Panel para estudiante
                    break;
                case 'padre':
                    header("Location: ../padre/padre_dashboard.php");  // Panel para padre/tutor
                    break;
                default:
                    header("Location: login.php?error=Rol de usuario no válido");
                    exit();
            }
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        // Correo no encontrado
        header("Location: login.php?error=Correo electrónico no registrado");
        exit();
    }
} else {
    // Redirigir si alguien accede directamente a este archivo sin enviar datos
    header("Location: login.php");
    exit();
}
