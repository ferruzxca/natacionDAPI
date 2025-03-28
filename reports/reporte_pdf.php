<?php
require('../fpdf/fpdf.php');
require('../database/conexion.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(190, 10, utf8_decode('Centro de Natación Innovex'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, utf8_decode('Reporte de Usuarios Inscritos'), 0, 1, 'C');
$pdf->Ln(10);

// Tabla de usuarios de natación
$stmt = $conn->query("SELECT * FROM usuarios_natacion");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Nombre', 1);
$pdf->Cell(20, 10, 'Edad', 1);
$pdf->Cell(40, 10, 'Nivel', 1);
$pdf->Cell(40, 10, 'Inscripción', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
foreach ($usuarios as $u) {
    $pdf->Cell(10, 10, $u['id'], 1);
    $pdf->Cell(60, 10, utf8_decode($u['nombre']), 1);
    $pdf->Cell(20, 10, $u['edad'], 1);
    $pdf->Cell(40, 10, $u['nivel'], 1);
    $pdf->Cell(40, 10, $u['fecha_inscripcion'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
