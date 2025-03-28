<?php
if (!isset($_SESSION)) session_start();

$nivel = $_SESSION['nivel'] ?? 'Invitado';
$usuario = $_SESSION['usuario'] ?? 'Desconocido';
?>

<nav style="background-color: #006699; padding: 10px; color: white;">
    <strong>Bienvenido, <?= $usuario ?> (<?= $nivel ?>)</strong>
    <div style="margin-top: 5px;">
        <?php if ($nivel == 'Administrador'): ?>
            <a href="../admin/dashboard.php">🏠 Dashboard</a>
            <a href="../admin/gestionar_usuarios.php">👥 Usuarios</a>
            <a href="../admin/gestionar_horarios.php">🕐 Horarios</a>
            <a href="../admin/gestionar_promociones.php">🎉 Promociones</a>
            <a href="../admin/gestionar_reglamento.php">📜 Reglamento</a>
            <a href="../admin/gestionar_instalaciones.php">🏛 Instalaciones</a>
            <a href="../admin/gestionar_competencias.php">🏊 Competencias</a>
            <a href="../admin/gestionar_rehabilitacion.php">🩺 Rehabilitación</a>
            <a href="../reports/reporte_pdf.php" target="_blank">📄 PDF</a>
            <a href="../reports/grafica_mes.php" target="_blank">📊 Gráfica</a>
        <?php elseif ($nivel == 'Vendedor'): ?>
            <a href="../vendedor/dashboard.php">🏠 Dashboard</a>
            <a href="../vendedor/agregar_usuario_natacion.php">➕ Usuario Natación</a>
            <a href="../vendedor/ver_horarios.php">🕐 Horarios</a>
            <a href="../vendedor/crear_promocion.php">🎉 Nueva Promoción</a>
            <a href="../vendedor/ver_reglamento.php">📜 Reglamento</a>
            <a href="../vendedor/ver_competencias.php">🏊 Ver Competencias</a>
            <a href="../vendedor/crear_competencia.php">➕ Crear Competencia</a>
        <?php elseif ($nivel == 'Cliente'): ?>
            <a href="../cliente/index.php">🏠 Inicio</a>
        <?php endif; ?>
        <a href="../auth/logout.php">🚪 Cerrar Sesión</a>
    </div>
</nav>
