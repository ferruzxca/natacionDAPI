<?php
require_once '../database/conexion.php';

$sql = $conn->query("SELECT * FROM graficas_mensuales");
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

$meses = array_column($data, 'mes');
$inscritos = array_column($data, 'inscritos');
$rehabs = array_column($data, 'rehabilitaciones');
$comps = array_column($data, 'competencias');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfica de Estadísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Estadísticas Mensuales</h2>
    <a href="../admin/dashboard.php">← Volver</a><br><br>

    <canvas id="grafica" width="600" height="300"></canvas>

    <script>
        const ctx = document.getElementById('grafica').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($meses) ?>,
                datasets: [
                    {
                        label: 'Inscritos',
                        data: <?= json_encode($inscritos) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    },
                    {
                        label: 'Rehabilitaciones',
                        data: <?= json_encode($rehabs) ?>,
                        backgroundColor: 'rgba(255, 206, 86, 0.6)'
                    },
                    {
                        label: 'Competencias',
                        data: <?= json_encode($comps) ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)'
                    }
                ]
            }
        });
    </script>
</body>
</html>
