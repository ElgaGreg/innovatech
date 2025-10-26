<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Integrantes</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; }
        table { width: 70%; margin: 50px auto; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #333; color: white; }
        form { margin: 0; }
        input[type="submit"] { 
            background-color: crimson; 
            color: white; 
            border: none; 
            padding: 6px 10px; 
            cursor: pointer; 
            border-radius: 4px; 
        }
        input[type="submit"]:hover { background-color: darkred; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Integrantes Registrados</h2>

<?php
$conexion = new mysqli("localhost", "root", "mike0610", "innovatech");


if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM integrantes";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Rol</th><th>Acción</th></tr>";
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["edad"] . "</td>";
        echo "<td>" . $fila["rol"] . "</td>";
        echo "<td>
                <form action='borrar_integrante.php' method='POST'>
                    <input type='hidden' name='id' value='" . $fila["id"] . "'>
                    <input type='submit' value='Borrar'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No hay integrantes registrados.</p>";
}

$conexion->close();
?>

</body>
</html>
