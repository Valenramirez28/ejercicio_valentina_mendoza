<?php
require 'conexion/conecction.php'; 
$db = new Database();
$con = $db->conectar();

// Recibe los datos del formulario
$veh = $_POST['id_vehiculo'];
$nom = $_POST['nombre'];
$des = $_POST['id_destino'];
$km = $_POST['km_inicial'];
$feini = $_POST['fecha_ini'];
$fefin = $_POST['fecha_fin'];

// Consulta SQL para insertar los datos en la tabla 'prest_vehiculo'
$sql = "INSERT INTO prest_vehiculo (id_vehiculo, documento, id_destino, km_inicial, fecha_ini, fecha_fin) 
        VALUES ('$veh', '$nom', '$des', '$km', '$feini', '$fefin')";

// Ejecuta la consulta
if ($con->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
