<?php 
// Activar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'santa_sofia';
$username = 'root';
$password = '54321';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Consulta para obtener los padres (usuarios con rol de 'padre')
$queryPadres = "SELECT id, nombre FROM usuarios WHERE rol = 'padre'";
$stmtPadres = $pdo->prepare($queryPadres);
$stmtPadres->execute();
$resultPadres = $stmtPadres->fetchAll(PDO::FETCH_ASSOC);

// Verificar si hay resultados de padres
if (empty($resultPadres)) {
    // Imprimir mensaje de depuración
    echo "<script>alert('No se encontraron padres en la base de datos.');</script>";
    echo "<pre>";
    print_r($resultPadres); // Depurar si la consulta está vacía
    echo "</pre>";
} else {
    // Mostrar los resultados de los padres para depuración
    echo "<pre>";
    print_r($resultPadres); // Imprimir los padres obtenidos
    echo "</pre>";
}

// Función para agregar un estudiante
if (isset($_POST['agregarEstudiante'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $curso_ids = $_POST['curso_id'];  // Usamos un array para la multi-selección
    $tutor_id = $_POST['tutor_id'];

    // Depuración: imprimir el ID del tutor recibido
    echo "<script>alert('Tutor ID recibido: " . htmlspecialchars($tutor_id) . "');</script>";

    // Verificar si el tutor_id existe y tiene el rol de "padre"
    $queryTutor = "SELECT id FROM usuarios WHERE id = ? AND rol = 'padre'";
    $stmtTutor = $pdo->prepare($queryTutor);
    $stmtTutor->execute([$tutor_id]);

    // Si no se encuentra el tutor o el rol no es 'padre', mostramos un error
    if ($stmtTutor->rowCount() == 0) {
        echo "<script>alert('El ID del tutor no existe o no tiene el rol de padre.');</script>";
        exit(); // Detener la ejecución
    }

    // Insertar el estudiante (solo si es exitoso)
    $query = "INSERT INTO estudiantes (nombre, apellido, fecha_nacimiento, tutor_id) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    if ($stmt->execute([$nombre, $apellido, $fecha_nacimiento, $tutor_id])) {
        $estudiante_id = $pdo->lastInsertId();

        // Luego insertamos los cursos seleccionados en la tabla estudiantes_cursos
        foreach ($curso_ids as $curso_id) {
            $queryCursosEstudiantes = "INSERT INTO estudiantes_cursos (estudiante_id, curso_id) VALUES (?, ?)";
            $stmtCursosEstudiantes = $pdo->prepare($queryCursosEstudiantes);
            $stmtCursosEstudiantes->execute([$estudiante_id, $curso_id]);
        }

        // Redireccionar a la página de gestión de estudiantes con mensaje de éxito
        header("Location: gestionarEstudiantes.php?mensaje=Estudiante agregado exitosamente");
        exit();
    } else {
        echo "<script>alert('Error al agregar el estudiante');</script>";
    }
}

// Consulta para obtener todos los estudiantes
$queryEstudiantes = "SELECT * FROM estudiantes";
$stmtEstudiantes = $pdo->prepare($queryEstudiantes);
$stmtEstudiantes->execute();
$resultEstudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los cursos disponibles para el dropdown
$queryCursos = "SELECT id, nombre, grado FROM cursos";
$stmtCursos = $pdo->prepare($queryCursos);

// Ejecutar la consulta de cursos
try {
    $stmtCursos->execute();
    $resultCursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);
    if (empty($resultCursos)) {
        echo "<script>alert('No se han encontrado cursos disponibles');</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('Error al consultar cursos: " . $e->getMessage() . "');</script>";
}

// Si la petición AJAX llega
if (isset($_POST['grado'])) {
    $grado = $_POST['grado'];
    $queryCursosPorGrado = "SELECT id, nombre FROM cursos WHERE grado = ?";
    $stmtCursosPorGrado = $pdo->prepare($queryCursosPorGrado);
    $stmtCursosPorGrado->execute([$grado]);

    // Verifica si se encuentran cursos para ese grado
    if ($stmtCursosPorGrado->rowCount() > 0) {
        while ($row = $stmtCursosPorGrado->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
    } else {
        echo "<option value=''>No se encontraron cursos para el grado seleccionado</option>";
    }
    exit();
}     
?>
