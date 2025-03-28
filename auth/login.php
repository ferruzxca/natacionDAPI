<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Centro de Natación</title>
    <link rel="stylesheet" href="../assets/estilos.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="validar_login.php">
        <input type="text" name="usuario" placeholder="Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <label><input type="checkbox" name="recordar"> Recordarme</label><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
