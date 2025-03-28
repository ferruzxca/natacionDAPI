<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

// Consulta todos los usuarios
$sql = $conn->query("SELECT * FROM usuarios");
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Usuarios</h2>

    <a href="dashboard.php">← Volver al Panel</a> |
    <a href="registrar_usuario.php">➕ Agregar Usuario</a>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['nombre'] ?></td>
                <td><?= $u['usuario'] ?></td>
                <td><?= $u['nivel'] ?></td>
                <td><?= $u['estado'] ? 'Activo' : 'Inactivo' ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $u['id'] ?>">✏️ Editar</a> |
                    <?php if ($u['estado']): ?>
                        <a href="inhabilitar_usuario.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Seguro que deseas inhabilitar este usuario?')">❌ Inhabilitar</a>
                    <?php else: ?>
                        <a href="rehabilitar_usuario.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Reactivar este usuario?')">✅ Rehabilitar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
