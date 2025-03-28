<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Administrador') {
    header("Location: ../auth/login.php");
    exit();
}
include '../includes/navbar.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> (Administrador)</h2>

    <nav>
        <ul>
            <li><a href="gestionar_usuarios.php">Usuarios</a></li>
            <li><a href="gestionar_horarios.php">Horarios</a></li>
            <li><a href="gestionar_promociones.php">Promociones</a></li>
            <li><a href="gestionar_reglamento.php">Reglamento</a></li>
            <li><a href="gestionar_instalaciones.php">Instalaciones</a></li>
            <li><a href="gestionar_competencias.php">Competencias</a></li>
            <li><a href="gestionar_rehabilitacion.php">Rehabilitación</a></li>
            <li><a href="../reports/reporte_pdf.php" target="_blank">Generar PDF</a></li>
            <li><a href="../reports/grafica_mes.php" target="_blank">Gráfica Mensual</a></li>
            <li><a href="../auth/logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>
