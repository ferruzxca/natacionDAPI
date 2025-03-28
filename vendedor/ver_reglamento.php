<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';


$sql = $conn->query("SELECT * FROM reglamento");
$reglas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Reglamento del Centro</h2>
<a href="dashboard.php">← Volver</a><br><br>

<ul>
    <?php foreach ($reglas as $r): ?>
        <li>🔹 <?= $r['regla'] ?></li>
    <?php endforeach; ?>
</ul>
