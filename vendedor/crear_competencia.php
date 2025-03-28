<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO competencias (nombre, fecha, descripcion) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $fecha, $descripcion]);

    header("Location: crear_competencia.php?ok=1");
    exit();
}
?>

<h2>Crear Nueva Competencia</h2>
<a href="dashboard.php">← Volver</a><br><br>

<?php if (isset($_GET['ok'])): ?>
    <p style="color: green;">✅ Competencia registrada exitosamente</p>
<?php endif; ?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre del evento" required><br>
    <input type="date" name="fecha" required><br>
    <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
    <button type="submit">Registrar Competencia</button>
</form>
