<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Insertar nueva promoción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO promociones (titulo, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin]);

    header("Location: gestionar_promociones.php");
    exit();
}

// Consultar promociones
$sql = $conn->query("SELECT * FROM promociones ORDER BY fecha_inicio DESC");
$promociones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Promociones</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Promociones</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Agregar Nueva Promoción</h3>
    <form method="post">
        <input type="text" name="titulo" placeholder="Título de la promoción" required><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
        <label>Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" required><br>
        <label>Fecha de fin:</label>
        <input type="date" name="fecha_fin" required><br>
        <button type="submit">Agregar</button>
    </form>

    <h3>Promociones Registradas</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promociones as $p): ?>
            <tr>
                <td><?= $p['titulo'] ?></td>
                <td><?= $p['descripcion'] ?></td>
                <td><?= $p['fecha_inicio'] ?></td>
                <td><?= $p['fecha_fin'] ?></td>
                <td>
                    <a href="editar_promocion.php?id=<?= $p['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_promocion.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar esta promoción?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
