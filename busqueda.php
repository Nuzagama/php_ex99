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

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $busqueda = $_POST["busqueda"];
    
        $sql = $conexion->prepare("SELECT * FROM videojuegos WHERE titulo = ?");
        $sql->bind_param("s", $busqueda);
        $sql->execute();
        $resultBusqueda = $sql->get_result();
    
        }

?>

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
           <th>Título</th>
           <th>Distribuidora</th>
           <th>Precio</th>

        </tr>
        </thead>
        <tbody>
        <?php

if(isset($busqueda)){
    while ($row = $resultBusqueda->fetch_assoc()) {
        echo " 
        <tr>
        <td>" . $row['titulo'] . "</td>
        <td>" . $row['distribuidora'] . "</td>
        <td>" . $row['precio'] . "</td>
        <br>
        </tr>";
        }
    
    if($resultBusqueda->num_rows==0){
       echo "<td>" . $busqueda . " no se encuentra en nuestra 
       base de datos" . "</td>";
    }    
    }

?>
        </tbody>
    </table>
</div>







</body>
</html>