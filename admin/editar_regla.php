<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM reglamento WHERE id = ?");
$sql->execute([$id]);
$regla = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['regla'];
    $update = $conn->prepare("UPDATE reglamento SET regla=? WHERE id=?");
    $update->execute([$texto, $id]);

    header("Location: gestionar_reglamento.php");
    exit();
}
?>

<h2>Editar Regla</h2>
<form method="post">
    <textarea name="regla" required><?= $regla['regla'] ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_reglamento.php">← Volver</a>
