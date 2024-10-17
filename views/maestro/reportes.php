<?php
// Archivo: reportes.php
include('../../config/database.php');

// Lógica para listar reportes
$sql = "SELECT id, tipo, fecha_generado, formato FROM reportes";
$stmt = $pdo->query($sql);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Mostrar reportes generados -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Fecha de Generación</th>
            <th>Tipo de Reporte</th>
            <th>Formato</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Mostrar reportes generados
        $sql = "SELECT fecha_generado, tipo, formato FROM reportes";
        $stmt = $pdo->query($sql);
        while ($reporte = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$reporte['fecha_generado']}</td>";
            echo "<td>{$reporte['tipo']}</td>";
            echo "<td>{$reporte['formato']}</td>";
            echo "<td><a href='descargar_reporte.php?id={$reporte['id']}' class='btn btn-success'>Descargar</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

