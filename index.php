<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal - Videojuegos</title>
    <?php require 'conec_videogame.php' ?>
    <link rel="stylesheet" href="styles/all.min.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
</head>

<body>

    <?php
    $sql = $conexion->prepare("SELECT * FROM videojuegos");
    $sql->execute();
    $result = $sql->get_result();
    $conexion->close();
    ?>
    <div class="container mt-5">
        <form action="busqueda.php" method="POST">
            <div class="mb-3">
                <input class="form-control" type="text" name="busqueda" placeholder="Búsqueda de Videojuegos">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Buscar Título">
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Distribuidora</th>
                    <th>Precio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($fila = $result->fetch_assoc()) {
                    echo "<tr>
            <td>{$fila['titulo']}</td>
            <td>{$fila['distribuidora']}</td>
            <td>{$fila['precio']}</td>
            <td><a href='actualizar_videogame.php?id={$fila['id']}' class='btn btn-warning'>Modificar</a></td>
            <td><a href='eliminar_videogame.php?id={$fila['id']}' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este videojuego?\");'>Eliminar</a></td>
            </tr>";
                }


            ?>
            </tbody>
        </table>
    </div>

</body>

</html>