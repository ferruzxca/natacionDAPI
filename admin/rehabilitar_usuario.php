<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$sql = $conn->prepare("UPDATE usuarios SET estado = 1 WHERE id = ?");
$sql->execute([$id]);

header("Location: gestionar_usuarios.php");
exit();
