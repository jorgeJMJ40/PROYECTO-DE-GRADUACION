<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Curso a Maestro</title>
    <link rel="stylesheet" href="../assents/css/asignar_materia.css"> <!-- Vincula tu CSS aquí -->
</head>
<body>
    <h1>Asignar Curso a Maestro</h1>

    <form action="asignar_autentication.php" method="POST">
        <label for="maestro_id">Seleccione un Maestro:</label>
        <select name="maestro_id" id="maestro_id" required>
            <!-- Las opciones de maestros se llenarán dinámicamente con JavaScript -->
        </select>

        <label for="curso_id">Seleccione un Curso:</label>
        <select name="curso_id" id="curso_id" required>
            <!-- Las opciones de cursos se llenarán dinámicamente con JavaScript -->
        </select>

        <label for="asignatura_id">Seleccione una Asignatura:</label>
        <select name="asignatura_id" id="asignatura_id" required>
            <!-- Las opciones de asignaturas se llenarán dinámicamente con JavaScript -->
        </select>

        <button type="submit">Asignar Curso</button>
    </form>

    <button onclick="location.href='admin_dashboard.php'" style="margin-top: 20px; padding: 12px; width: 100%; background-color: #6c757d; color: white; border: none; border-radius: 5px; font-size: 18px; cursor: pointer; transition: background-color 0.3s;">Regresar al Dashboard</button>

    <script>
        // Función para cargar los datos de maestros, cursos y asignaturas
        async function cargarDatos() {
            try {
                const [maestros, cursos, asignaturas] = await Promise.all([
                    fetch('get_datos.php?type=maestros'),
                    fetch('get_datos.php?type=cursos'),
                    fetch('get_datos.php?type=asignaturas')
                ]);

                const maestrosData = await maestros.json();
                const cursosData = await cursos.json();
                const asignaturasData = await asignaturas.json();

                const maestroSelect = document.getElementById('maestro_id');
                maestrosData.forEach(maestro => {
                    const option = document.createElement('option');
                    option.value = maestro.id;
                    option.textContent = `${maestro.nombre} ${maestro.apellido}`;
                    maestroSelect.appendChild(option);
                });

                const cursoSelect = document.getElementById('curso_id');
                cursosData.forEach(curso => {
                    const option = document.createElement('option');
                    option.value = curso.id;
                    option.textContent = curso.nombre;
                    cursoSelect.appendChild(option);
                });

                const asignaturaSelect = document.getElementById('asignatura_id');
                asignaturasData.forEach(asignatura => {
                    const option = document.createElement('option');
                    option.value = asignatura.id;
                    option.textContent = asignatura.nombre;
                    asignaturaSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error al cargar los datos:', error);
            }
        }

        // Cargar los datos al cargar la página
        window.onload = cargarDatos;
    </script>
</body>
</html>
