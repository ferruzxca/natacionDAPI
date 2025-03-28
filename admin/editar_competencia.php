<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM competencias WHERE id = ?");
$sql->execute([$id]);
$comp = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("UPDATE competencias SET nombre=?, fecha=?, descripcion=? WHERE id=?");
    $stmt->execute([$nombre, $fecha, $descripcion, $id]);

    header("Location: gestionar_competencias.php");
    exit();
}
?>

<h2>Editar Competencia</h2>
<form method="post">
    <input type="text" name="nombre" value="<?= $comp['nombre'] ?>" required><br>
    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $comp['fecha'] ?>" required><br>
    <textarea name="descripcion" required><?= $comp['descripcion'] ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_competencias.php">← Volver</a>
