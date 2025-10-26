<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

   $conexion = new mysqli("localhost", "root", "mike0610", "innovatech");


    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "DELETE FROM integrantes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Integrante eliminado correctamente'); window.location.href='mostrar_integrantes.php';</script>";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método no permitido.";
}
?>
