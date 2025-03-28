<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

// Insertar nueva regla
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regla = $_POST['regla'];
    $stmt = $conn->prepare("INSERT INTO reglamento (regla) VALUES (?)");
    $stmt->execute([$regla]);

    header("Location: gestionar_reglamento.php");
    exit();
}

// Consultar reglas
$sql = $conn->query("SELECT * FROM reglamento");
$reglas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión del Reglamento</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión del Reglamento</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Agregar Nueva Regla</h3>
    <form method="post">
        <textarea name="regla" placeholder="Escribe la nueva regla..." required></textarea><br>
        <button type="submit">Agregar Regla</button>
    </form>

    <h3>Reglas Registradas</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Regla</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reglas as $r): ?>
            <tr>
                <td><?= $r['regla'] ?></td>
                <td>
                    <a href="editar_regla.php?id=<?= $r['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_regla.php?id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar esta regla?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
