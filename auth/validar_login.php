<?php
session_start();
require_once '../database/conexion.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND estado = 1");
$sql->execute([$usuario]);
$user = $sql->fetch(PDO::FETCH_ASSOC);

if ($user && hash('sha256', $password) === $user['password']) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['nivel'] = $user['nivel'];
    $_SESSION['id'] = $user['id'];

    if (isset($_POST['recordar'])) {
        setcookie("usuario", $user['usuario'], time() + (86400 * 30), "/");
        setcookie("nivel", $user['nivel'], time() + (86400 * 30), "/");
    }

    switch ($user['nivel']) {
        case 'Administrador': header("Location: ../admin/dashboard.php"); break;
        case 'Vendedor': header("Location: ../vendedor/dashboard.php"); break;
        case 'Cliente': header("Location: ../cliente/index.php"); break;
    }
} else {
    echo "<script>alert('Datos incorrectos'); location.href='login.php';</script>";
}
?>
