<?php
// Iniciar sesión y mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Verificar si la sesión está activa y si el rol del usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'administrador') {
    header("Location: ../auth/login.php"); // Redirigir al login si no está autenticado o no es administrador
    exit();
}

// Incluir la conexión a la base de datos
include '../../config/database.php';  // Ruta de la conexión a la base de datos

// =========================
// Crear curso
// =========================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_curso'])) {
    $nombre_curso = trim($_POST['nombre_curso']);
    $grado = trim($_POST['grado']);

    // Validar que los campos no estén vacíos
    if (!empty($nombre_curso) && !empty($grado)) {
        // Preparar e insertar nuevo curso en la base de datos
        $stmt = $pdo->prepare("INSERT INTO cursos (nombre, grado) VALUES (:nombre, :grado)");
        $stmt->bindParam(':nombre', $nombre_curso);
        $stmt->bindParam(':grado', $grado);
        
        if ($stmt->execute()) {
            echo "<script>
                    alert('Curso creado exitosamente.');
                    window.location.href = 'crear_curso.php';
                  </script>";
        } else {
            echo "<script>alert('Error al crear el curso.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    }
}

// =========================
// Crear asignatura
// =========================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_asignatura'])) {
    $nombre_asignatura = trim($_POST['nombre_asignatura']);

    // Validar que el campo no esté vacío
    if (!empty($nombre_asignatura)) {
        // Preparar e insertar nueva asignatura en la base de datos
        $stmt = $pdo->prepare("INSERT INTO asignaturas (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre_asignatura);
        
        if ($stmt->execute()) {
            echo "<script>alert('Asignatura creada exitosamente.');
            window.location.href = 'crear_curso.php';
            </script>";
        } else {
            echo "<script>alert('Error al crear la asignatura.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete el nombre de la asignatura.');</script>";
    }
}

// =========================
// Crear usuario
// =========================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_usuario'])) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    // Validar campos
    if (!empty($nombre) && !empty($email) && !empty($password) && !empty($rol)) {
        // Preparar e insertar nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            echo "<script>alert('Usuario creado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al crear el usuario.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    }
}

// =========================
// Editar usuario
// =========================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_usuario'])) {
    $user_id = $_POST['user_id'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $rol = $_POST['rol'];

    // Validar campos
    if (!empty($user_id) && !empty($nombre) && !empty($email) && !empty($rol)) {
        // Preparar e actualizar la información del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, rol = :rol WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            echo "<script>alert('Usuario editado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al editar el usuario.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    }
}

// =========================
// Eliminar usuario
// =========================
if (isset($_GET['eliminar_usuario'])) {
    $user_id = $_GET['eliminar_usuario'];

    // Validar el id de usuario
    if (is_numeric($user_id)) {
        // Preparar e eliminar el usuario de la base de datos
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Usuario eliminado exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al eliminar el usuario.');</script>";
        }
    } else {
        echo "<script>alert('ID de usuario inválido.');</script>";
    }
}
?>
