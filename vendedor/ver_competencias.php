<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}

$sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
$competencias = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Competencias Acuáticas</h2>
<a href="dashboard.php">← Volver</a><br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($competencias as $c): ?>
        <tr>
            <td><?= $c['nombre'] ?></td>
            <td><?= $c['fecha'] ?></td>
            <td><?= $c['descripcion'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
