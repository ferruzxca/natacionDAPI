<?php
session_start();
require_once '../database/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] != 'Vendedor') {
    header("Location: ../auth/login.php");
    exit();
}

// Guardar nuevo usuario de natación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $nivel = $_POST['nivel'];
    $fecha = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO usuarios_natacion (nombre, edad, nivel, fecha_inscripcion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $edad, $nivel, $fecha]);

    header("Location: agregar_usuario_natacion.php?success=1");
    exit();
}
?>

<h2>Registrar Nuevo Usuario de Natación</h2>
<a href="dashboard.php">← Volver al panel</a><br><br>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Usuario registrado correctamente ✅</p>
<?php endif; ?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="number" name="edad" placeholder="Edad" min="3" max="100" required><br>
    <select name="nivel" required>
        <option value="">-- Nivel --</option>
        <option value="Básico">Básico</option>
        <option value="Intermedio">Intermedio</option>
        <option value="Avanzado">Avanzado</option>
    </select><br>
    <button type="submit">Registrar</button>
</form>
