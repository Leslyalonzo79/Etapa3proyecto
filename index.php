<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Salas de Reunión</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Sistema de Reserva de Salas de Reunión</h1>
    </header>
    <main>
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<div class="mensaje">' . htmlspecialchars($_GET['mensaje']) . '</div>';
        }
        ?>
        <h2>Reservas</h2>
        <a href="reservar.html" class="btn">Reservar una Sala</a>
        <input type="text" id="buscar" placeholder="Buscar reservas..." class="buscar">
        <table id="tablaReservas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Salón</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $sql = "SELECT * FROM reservas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["correo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["hora_inicio"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["hora_fin"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["salon"]) . "</td>";
                        
                        echo "<td><form action='eliminar.php' method='post'>";
                        echo "<input type='hidden' name='id_reserva' value='" . $row["id"] . "'>";
                        echo "<button type='submit'>Eliminar</button>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No se encontraron reservas</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <script>
        document.getElementById('buscar').addEventListener('keyup', function() {
            var filtro = this.value.toLowerCase();
            var filas = document.getElementById('tablaReservas').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            Array.from(filas).forEach(function(fila) {
                var texto = fila.textContent || fila.innerText;
                if (texto.toLowerCase().indexOf(filtro) > -1) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>