<?php
include 'db.php';

if (isset($_POST['id_reserva'])) {
    $id_reserva = $_POST['id_reserva'];

    $sql = "DELETE FROM reservas WHERE id = $id_reserva";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Reserva eliminada exitosamente";
    } else {
        $mensaje = "Error al eliminar la reserva: " . $conn->error;
    }
} else {
    $mensaje = "ID de reserva no especificado";
}
header("Location: index.php?mensaje=" . urlencode($mensaje));
exit();
?>