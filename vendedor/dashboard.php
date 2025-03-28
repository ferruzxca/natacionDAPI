<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Vendedor</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> (Vendedor)</h2>

    <nav>
        <ul>
            <li><a href="agregar_usuario_natacion.php">Agregar Usuario de Natación</a></li>
            <li><a href="ver_horarios.php">Consultar Horarios</a></li>
            <li><a href="crear_promocion.php">Crear Promoción</a></li>
            <li><a href="ver_reglamento.php">Consultar Reglamento</a></li>
            <li><a href="ver_competencias.php">Ver Competencias</a></li>
            <li><a href="crear_competencia.php">Crear Competencia</a></li>
            <li><a href="../auth/logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>
