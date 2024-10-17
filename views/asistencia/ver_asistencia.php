<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Asistencia</title>
    <link rel="stylesheet" href="../assents/css/alumno.css">
</head>
<body>
    <h1>Asistencia</h1>
    
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Simulación de datos de asistencia
            $asistencia = [
                ["fecha" => "2024-10-01", "estado" => "Presente"],
                ["fecha" => "2024-10-02", "estado" => "Ausente"],
                ["fecha" => "2024-10-03", "estado" => "Presente"],
            ];

            foreach ($asistencia as $registro) {
                echo "<tr>
                        <td>{$registro['fecha']}</td>
                        <td>{$registro['estado']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="button-container">
        <form action="../dashboard/estudiante.php" method="GET">
            <button type="submit">Regresar</button>
        </form>
    </div>

    <div class="logout-container">
        <form action="../auth/login.php" method="POST">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>
