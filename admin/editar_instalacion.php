<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$sql = $conn->prepare("SELECT * FROM instalaciones WHERE id = ?");
$sql->execute([$id]);
$instalacion = $sql->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $ruta = "../assets/img/" . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    } else {
        $imagen = $instalacion['imagen'];
    }

    $update = $conn->prepare("UPDATE instalaciones SET nombre=?, descripcion=?, imagen=? WHERE id=?");
    $update->execute([$nombre, $descripcion, $imagen, $id]);

    header("Location: gestionar_instalaciones.php");
    exit();
}
include '../includes/navbar.php';

?>

<h2>Editar Instalación</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="nombre" value="<?= $instalacion['nombre'] ?>" required><br>
    <textarea name="descripcion" required><?= $instalacion['descripcion'] ?></textarea><br>
    <label>Imagen actual:</label>
    <img src="../assets/img/<?= $instalacion['imagen'] ?>" width="100"><br>
    <label>Cambiar imagen:</label>
    <input type="file" name="imagen" accept="image/*"><br>
    <button type="submit">Actualizar</button>
</form>
<a href="gestionar_instalaciones.php">← Volver</a>
