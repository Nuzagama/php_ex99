<?php
require 'conec_videogame.php'; // Asegúrate de tener este archivo para la conexión a la DB

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Preparar la sentencia SQL para eliminar el videojuego
    $sql = $conexion->prepare("DELETE FROM videojuegos WHERE id = ?");
    $sql->bind_param("i", $id);

    if($sql->execute()) {
        // Opcional: Mostrar un mensaje de éxito o redirigir
        header('Location: index.php'); // Suponiendo que 'index.php' es tu página principal
    } else {
        echo "Error al eliminar el videojuego.";
    }

    $conexion->close();
} else {
    // Redirigir si no hay un id especificado o manejar este caso como desees
    header('Location: index.php');
}
?>
