<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Videogame</title>
    <link rel="stylesheet" href="styles/all.min.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <?php require 'conec_videogame.php' ?>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id']; // Asegurando que el ID es un entero
        $sql = $conexion->prepare("SELECT * FROM videojuegos WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            $videojuego_name = $fila['titulo'];
            $distribuidora = $fila['distribuidora'];
            $precio = $fila['precio'];
        } else {
            // Manejar el caso en que no se encuentre el videojuego
        }
        $conexion->close();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = (int) $_POST['id']; // Asegurando que el ID es un entero
        $titulo = $_POST["titulo"];
        $distribuidora = $_POST["distribuidora"];
        $precio = (double) $_POST["precio"];
    
        $sql = $conexion->prepare("UPDATE videojuegos SET titulo = ?, distribuidora, precio = ? WHERE id = ?");
        $sql->bind_param("ssdi", $titulo, $distribuidora, $precio, $id);
        if ($sql->execute()) {
            header("location: index.php");
        } else {
            echo "Error al actualizar el videojuego";
        }
        $conexion->close();
    }
    
    ?>


    <div class="container">
        <h1>Update Videojuego</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input class="form-control" type="text" name="titulo"
                    value="<?php echo htmlspecialchars($videojuego_name ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Distribuidora</label>
                <input class="form-control" type="text" name="distribuidora"
                    value="<?php echo htmlspecialchars($distribuidora ?? '', ENT_QUOTES); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="number" step="0.1" name="precio"
                    value="<?php echo htmlspecialchars($precio ?? '', ENT_QUOTES); ?>">
            </div>
            <!-- Añadir un campo oculto para mantener el ID del videojuego -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id ?? '', ENT_QUOTES); ?>">
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Actualizar">
            </div>
        </form>

    </div>
</body>

</html>