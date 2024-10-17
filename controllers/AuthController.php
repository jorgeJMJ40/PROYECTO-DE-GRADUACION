<?php
require_once 'config/database.php';

class AuthController {
    public function login($email, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            $_SESSION['user'] = $usuario;
            header('Location: /dashboard');
        } else {
            echo "Correo o contraseña incorrectos.";
        }
    }

    public function register($data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)");
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt->execute([$data['nombre'], $data['email'], $passwordHash, $data['rol']]);
        echo "Usuario registrado exitosamente.";
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
    }
}
?>
