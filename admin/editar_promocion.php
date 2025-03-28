<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM promociones WHERE id = ?");
$sql->execute([$id]);
$promo = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $update = $conn->prepare("UPDATE promociones SET titulo=?, descripcion=?, fecha_inicio=?, fecha_fin=? WHERE id=?");
    $update->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin, $id]);

    header("Location: gestionar_promociones.php");
    exit();
}
?>

<h2>Editar Promoción</h2>
<form method="post">
    <input type="text" name="titulo" value="<?= $promo['titulo'] ?>" required><br>
    <textarea name="descripcion" required><?= $promo['descripcion'] ?></textarea><br>
    <label>Fecha de inicio:</label>
    <input type="date" name="fecha_inicio" value="<?= $promo['fecha_inicio'] ?>" required><br>
    <label>Fecha de fin:</label>
    <input type="date" name="fecha_fin" value="<?= $promo['fecha_fin'] ?>" required><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_promociones.php">← Volver</a>
