<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Asistencia</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">Registrar Asistencia</h2>
        <form action="agregar_asistencia.php" method="POST">
            <div class="form-group">
                <label for="curso">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" required placeholder="Ingrese el nombre del curso">
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="alumno">Alumno</label>
                <input type="text" class="form-control" id="alumno" name="alumno" required placeholder="Ingrese el nombre del alumno">
            </div>
            <div class="form-group">
                <label for="asistencia">Asistencia</label>
                <select class="form-control" id="asistencia" name="asistencia">
                    <option value="Presente">Presente</option>
                    <option value="Ausente">Ausente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar Asistencia</button>
        </form>
    </div>

</body>
</html>
