<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';


// Insertar nueva competencia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conn->prepare("INSERT INTO competencias (nombre, fecha, descripcion) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $fecha, $descripcion]);

    header("Location: gestionar_competencias.php");
    exit();
}

// Consultar competencias
$sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
$competencias = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Competencias</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Competencias Acuáticas</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Registrar Nueva Competencia</h3>
    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre del evento" required><br>
        <label>Fecha:</label>
        <input type="date" name="fecha" required><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
        <button type="submit">Registrar</button>
    </form>

    <h3>Competencias Registradas</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competencias as $c): ?>
            <tr>
                <td><?= $c['nombre'] ?></td>
                <td><?= $c['fecha'] ?></td>
                <td><?= $c['descripcion'] ?></td>
                <td>
                    <a href="editar_competencia.php?id=<?= $c['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_competencia.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar esta competencia?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
