<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$delete = $conn->prepare("DELETE FROM rehabilitacion WHERE id = ?");
$delete->execute([$id]);

header("Location: gestionar_rehabilitacion.php");
exit();
