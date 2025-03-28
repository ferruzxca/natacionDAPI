<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$sql->execute([$id]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nivel = $_POST['nivel'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, nivel = ? WHERE id = ?");
    $stmt->execute([$nombre, $nivel, $id]);

    header("Location: gestionar_usuarios.php");
    exit();
}
?>

<h2>Editar Usuario</h2>
<form method="post">
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>
    <select name="nivel" required>
        <option value="Administrador" <?= $usuario['nivel'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
        <option value="Vendedor" <?= $usuario['nivel'] == 'Vendedor' ? 'selected' : '' ?>>Vendedor</option>
        <option value="Cliente" <?= $usuario['nivel'] == 'Cliente' ? 'selected' : '' ?>>Cliente</option>
    </select><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_usuarios.php">← Volver</a>
