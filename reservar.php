<?php
include 'db.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$hora_inicio = $_POST['hora_inicio'];
$hora_inicio_ampm = $_POST['hora_inicio_ampm'];
$hora_fin = $_POST['hora_fin'];
$hora_fin_ampm = $_POST['hora_fin_ampm'];
$salon = $_POST['salon'];


$hora_inicio = date("H:i:s", strtotime($hora_inicio . " " . $hora_inicio_ampm));
$hora_fin = date("H:i:s", strtotime($hora_fin . " " . $hora_fin_ampm));

$sql = "SELECT * FROM reservas WHERE fecha = ? AND salon = ? AND (
        (hora_inicio < ? AND hora_fin > ?) OR
        (hora_inicio < ? AND hora_fin > ?) OR
        (hora_inicio >= ? AND hora_fin <= ?)
    )";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssss', $fecha, $salon, $hora_inicio, $hora_inicio, $hora_fin, $hora_fin, $hora_inicio, $hora_fin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mensaje = "Ya existe una reserva para el salón en la fecha y hora especificadas.";
} else {
    $sql = "INSERT INTO reservas (nombre, correo, fecha, hora_inicio, hora_fin, salon) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $nombre, $correo, $fecha, $hora_inicio, $hora_fin, $salon);
    
    if ($stmt->execute() === TRUE) {
        $mensaje = "Reserva realizada exitosamente";
    } else {
        $mensaje = "Error al realizar la reserva: " . $conn->error;
    }
}

$conn->close();

header("Location: index.php?mensaje=" . urlencode($mensaje));
exit();
?>