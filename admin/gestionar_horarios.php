<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Insertar horario nuevo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $actividad = $_POST['actividad'];

    $stmt = $conn->prepare("INSERT INTO horarios (dia, hora_inicio, hora_fin, actividad) VALUES (?, ?, ?, ?)");
    $stmt->execute([$dia, $hora_inicio, $hora_fin, $actividad]);

    header("Location: gestionar_horarios.php");
    exit();
}

// Consultar horarios
$sql = $conn->query("SELECT * FROM horarios");
$horarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Horarios</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Horarios</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Agregar nuevo horario</h3>
    <form method="post">
        <input type="text" name="dia" placeholder="Día (ej. Lunes)" required><br>
        <input type="time" name="hora_inicio" required><br>
        <input type="time" name="hora_fin" required><br>
        <input type="text" name="actividad" placeholder="Nombre de la actividad" required><br>
        <button type="submit">Agregar</button>
    </form>

    <h3>Horarios Registrados</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Día</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Actividad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horarios as $h): ?>
            <tr>
                <td><?= $h['dia'] ?></td>
                <td><?= $h['hora_inicio'] ?></td>
                <td><?= $h['hora_fin'] ?></td>
                <td><?= $h['actividad'] ?></td>
                <td>
                    <a href="editar_horario.php?id=<?= $h['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_horario.php?id=<?= $h['id'] ?>" onclick="return confirm('¿Eliminar este horario?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
