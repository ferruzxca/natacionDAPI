<?php require_once '../database/conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información para Clientes - Innovex</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Centro de Natación Innovex</h2>
    <p>Bienvenido al sitio oficial del centro de natación. Aquí puedes consultar toda la información disponible:</p>

    <h3>🏛 Instalaciones</h3>
    <?php
    $sql = $conn->query("SELECT * FROM instalaciones");
    foreach ($sql as $i):
    ?>
        <h4><?= $i['nombre'] ?></h4>
        <img src="../assets/img/<?= $i['imagen'] ?>" width="250">
        <p><?= $i['descripcion'] ?></p>
    <?php endforeach; ?>

    <h3>🎉 Promociones</h3>
    <?php
    $sql = $conn->query("SELECT * FROM promociones WHERE fecha_fin >= CURDATE()");
    foreach ($sql as $p):
    ?>
        <strong><?= $p['titulo'] ?></strong><br>
        <p><?= $p['descripcion'] ?> (Del <?= $p['fecha_inicio'] ?> al <?= $p['fecha_fin'] ?>)</p>
    <?php endforeach; ?>

    <h3>📜 Reglamento</h3>
    <ul>
        <?php
        $sql = $conn->query("SELECT * FROM reglamento");
        foreach ($sql as $r):
            echo "<li>" . $r['regla'] . "</li>";
        endforeach;
        ?>
    </ul>

    <h3>🕐 Horarios</h3>
    <table border="1">
        <tr><th>Día</th><th>Inicio</th><th>Fin</th><th>Actividad</th></tr>
        <?php
        $sql = $conn->query("SELECT * FROM horarios");
        foreach ($sql as $h):
            echo "<tr>
                    <td>{$h['dia']}</td>
                    <td>{$h['hora_inicio']}</td>
                    <td>{$h['hora_fin']}</td>
                    <td>{$h['actividad']}</td>
                </tr>";
        endforeach;
        ?>
    </table>

    <h3>🏅 Competencias</h3>
    <ul>
        <?php
        $sql = $conn->query("SELECT * FROM competencias ORDER BY fecha DESC");
        foreach ($sql as $c):
            echo "<li><strong>{$c['nombre']}</strong> ({$c['fecha']}) - {$c['descripcion']}</li>";
        endforeach;
        ?>
    </ul>

    <footer>
        <p><a href="../auth/login.php">🔐 Iniciar sesión</a> | <a href="../index.php">Inicio</a></p>
    </footer>
</body>
</html>
