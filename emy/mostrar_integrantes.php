<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Integrantes</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f7f9fc; 
            margin: 0; 
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        form {
            display: inline-block;
        }
        input[type="submit"] { 
            background-color: #e63946; 
            color: white; 
            border: none; 
            padding: 6px 12px; 
            cursor: pointer; 
            border-radius: 4px; 
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover { 
            background-color: #b91c1c; 
        }
        .mensaje {
            text-align: center;
            color: #555;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<h2>Integrantes Registrados</h2>

<?php
$conexion = new mysqli("localhost", "root", "mike0610", "innovatech");

if ($conexion->connect_errno) {
    echo "<p class='mensaje'>⚠️ Error al conectar a la base de datos: " . htmlspecialchars($conexion->connect_error) . "</p>";
    exit();
}

$sql = "SELECT id, nombre, edad, rol FROM integrantes";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($fila['id']) ?></td>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= htmlspecialchars($fila['edad']) ?></td>
                <td><?= htmlspecialchars($fila['rol']) ?></td>
                <td>
                    <form action="borrar_integrante.php" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este integrante?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($fila['id']) ?>">
                        <input type="submit" value="Borrar">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="mensaje">No hay integrantes registrados.</p>
<?php endif; ?>

<?php $conexion->close(); ?>

</body>
</html>
