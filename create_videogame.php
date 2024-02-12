<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Videogame</title>
    <link rel="stylesheet" href="styles/all.min.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <?php require 'conec_videogame.php' ?>
    </head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $distribuidora = $_POST["distribuidora"];
        $precio = (double) $_POST["precio"];
        // Fase de Preparación (Prepare)
        $sql = $conexion -> prepare("INSERT INTO videojuegos VALUES (?, ?, ?)");
        // Fase de Enlazado (Bind)
        $sql -> bind_param("ssd", $titulo, $distribuidora, $precio);
        // Fase de Producción (Execute)
        $sql -> execute();

        $conexion -> close();
    }
    ?>
    <div class="container">
        <h1>Nuevo Videojuego</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input class="form-control" type="text" name="titulo">
            </div>
            <div class="mb-3">
                <label class="form-label">Distribuidora</label>
                <input class="form-control" type="text" name="distribuidora">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="number" step="0.1" name="precio">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Crear">
            </div>
        </form>
    </div>
</body>
</html>