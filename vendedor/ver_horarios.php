<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}

$sql = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Consulta de Horarios</h2>
<a href="dashboard.php">← Volver al panel</a><br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Día</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Actividad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($horarios as $h): ?>
        <tr>
            <td><?= $h['dia'] ?></td>
            <td><?= $h['hora_inicio'] ?></td>
            <td><?= $h['hora_fin'] ?></td>
            <td><?= $h['actividad'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
