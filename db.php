<?php
$servername = "localhost";
$username = "id22199877_leslyalonzo58";
$password = "Reservas123*";
$dbname = "id22199877_reservas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>