<?php
    require_once("conexion/conecction.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Prestamos de Vehiculos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text">Lista de prestamos de vehiculos</h1>
    <br>
    <div class="text-center">
    <div class="row mt-3">
        <div class="col-md-6">
            <a href="crear.php" class="btn btn-success"><i class="fas fa-user-plus"></i>Crear prestamo de vehiculo</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Tipo_vehiculo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Destino</th>
                <th>Km_inicial</th>
                <th>fecha_prestamo</th>
                <th>fecha_fin_prestamo</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $consulta = "SELECT * FROM prest_vehiculo, vehiculo, tipo_vehiculo, marca, destino, usuarios
            WHERE prest_vehiculo.id_vehiculo = vehiculo.id_vehiculo AND prest_vehiculo.id_destino = destino.id_destino
            AND prest_vehiculo.documento = usuarios.documento AND vehiculo.id_tip_veh = tipo_vehiculo.id_tip_veh
            AND vehiculo.id_marca = marca.id_marca";
            $resultado = $con->query($consulta);

            while ($fila = $resultado->fetch()) {
                echo '
                <tr>
                    <td>' . $fila["documento"] . '</td>
                    <td>' . $fila["nombre"] . '</td>
                    <td>' . $fila["nom_vehiculo"] . '</td>
                    <td>' . $fila["marca"] . '</td>
                    <td>' . $fila["modelo"] . '</td>
                    <td>' . $fila["nom_destino"] . '</td>
                    <td>' . $fila["km_inicial"] . '</td>
                    <td>' . $fila["fecha_ini"] . '</td>
                    <td>' . $fila["fecha_fin"] . '</td>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>