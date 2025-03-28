<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = hash('sha256', $_POST['password']);
    $nivel = $_POST['nivel'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, password, nivel) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $usuario, $password, $nivel]);

    header("Location: gestionar_usuarios.php");
    exit();
}
?>

<h2>Registrar Nuevo Usuario</h2>
<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <select name="nivel" required>
        <option value="">-- Selecciona Nivel --</option>
        <option value="Administrador">Administrador</option>
        <option value="Vendedor">Vendedor</option>
        <option value="Cliente">Cliente</option>
    </select><br>
    <button type="submit">Registrar</button>
</form>
<a href="gestionar_usuarios.php">← Volver</a>
