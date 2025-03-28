<?php
$host = "localhost";
$dbname = "natacion_db";
$user = "root";  // o tu usuario de hosting
$pass = "ferr2812";      // o tu contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>
