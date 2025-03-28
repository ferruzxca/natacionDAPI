<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

// Registrar nueva instalación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Subida de imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta = "../assets/img/" . $imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $stmt = $conn->prepare("INSERT INTO instalaciones (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $imagen]);

    header("Location: gestionar_instalaciones.php");
    exit();
}

// Consultar instalaciones
$sql = $conn->query("SELECT * FROM instalaciones");
$instalaciones = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Instalaciones</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Gestión de Instalaciones</h2>
    <a href="dashboard.php">← Volver al Panel</a>

    <h3>Agregar Nueva Instalación</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre de la instalación" required><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
        <label>Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required><br>
        <button type="submit">Registrar</button>
    </form>

    <h3>Instalaciones Registradas</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instalaciones as $i): ?>
            <tr>
                <td><?= $i['nombre'] ?></td>
                <td><?= $i['descripcion'] ?></td>
                <td><img src="../assets/img/<?= $i['imagen'] ?>" width="100"></td>
                <td>
                    <a href="editar_instalacion.php?id=<?= $i['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_instalacion.php?id=<?= $i['id'] ?>" onclick="return confirm('¿Eliminar esta instalación?')">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
