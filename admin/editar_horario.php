<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM horarios WHERE id = ?");
$sql->execute([$id]);
$horario = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $actividad = $_POST['actividad'];

    $update = $conn->prepare("UPDATE horarios SET dia=?, hora_inicio=?, hora_fin=?, actividad=? WHERE id=?");
    $update->execute([$dia, $hora_inicio, $hora_fin, $actividad, $id]);

    header("Location: gestionar_horarios.php");
    exit();
}
?>

<h2>Editar Horario</h2>
<form method="post">
    <input type="text" name="dia" value="<?= $horario['dia'] ?>" required><br>
    <input type="time" name="hora_inicio" value="<?= $horario['hora_inicio'] ?>" required><br>
    <input type="time" name="hora_fin" value="<?= $horario['hora_fin'] ?>" required><br>
    <input type="text" name="actividad" value="<?= $horario['actividad'] ?>" required><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_horarios.php">← Volver</a>
