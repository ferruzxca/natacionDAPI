<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO promociones (titulo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin]);

    header("Location: crear_promocion.php?ok=1");
    exit();
}
?>

<h2>Crear Nueva Promoción</h2>
<a href="dashboard.php">← Volver</a><br><br>

<?php if (isset($_GET['ok'])): ?>
    <p style="color: green;">✅ Promoción registrada correctamente</p>
<?php endif; ?>

<form method="post">
    <input type="text" name="titulo" placeholder="Título" required><br>
    <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
    <label>Inicio:</label><input type="date" name="fecha_inicio" required><br>
    <label>Fin:</label><input type="date" name="fecha_fin" required><br>
    <button type="submit">Crear Promoción</button>
</form>
