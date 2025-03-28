<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Insertar nueva sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $_POST['paciente_nombre'];
    $fecha = $_POST['fecha'];
    $terapia = $_POST['tipo_terapia'];
    $observaciones = $_POST['observaciones'];

    $stmt = $conn->prepare("INSERT INTO rehabilitacion (paciente_nombre, fecha, tipo_terapia, observaciones) VALUES (?, ?, ?, ?)");
    $stmt->execute([$paciente, $fecha, $terapia, $observaciones]);

    header("Location: gestionar_rehabilitacion.php");
    exit();
}

// Consultar sesiones
$sql = $conn->query("SELECT * FROM rehabilitacion ORDER BY fecha DESC");
$sesiones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Rehabilitación</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Rehabilitación de Nadadores</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Registrar Nueva Sesión</h3>
    <form method="post">
        <input type="text" name="paciente_nombre" placeholder="Nombre del paciente" required><br>
        <label>Fecha:</label>
        <input type="date" name="fecha" required><br>
        <input type="text" name="tipo_terapia" placeholder="Tipo de terapia" required><br>
        <textarea name="observaciones" placeholder="Observaciones..." required></textarea><br>
        <button type="submit">Registrar</button>
    </form>

    <h3>Sesiones Registradas</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Terapia</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sesiones as $s): ?>
            <tr>
                <td><?= $s['paciente_nombre'] ?></td>
                <td><?= $s['fecha'] ?></td>
                <td><?= $s['tipo_terapia'] ?></td>
                <td><?= $s['observaciones'] ?></td>
                <td>
                    <a href="editar_rehabilitacion.php?id=<?= $s['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_rehabilitacion.php?id=<?= $s['id'] ?>" onclick="return confirm('¿Eliminar esta sesión?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
