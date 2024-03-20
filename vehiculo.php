<?php
$conexion = mysqli_connect("localhost", "root", "", "vehiculos");

$tip_vehiculo = $_POST['id_tip_vehiculo'];

$sql="SELECT marca_vehiculo.id_marca, marca_vehiculo.marca FROM tipo_vehiculo INNER JOIN marca_vehiculo ON tipo_vehiculo.id_tip_vehiculo = marca_vehiculo.id_tip_vehiculo
AND tipo_vehiculo.id_tip_vehiculo = '$tip_vehiculo'";

$result = mysqli_query($conexion, $sql);
$cadena = "<label>marca</label>";
while ($ver = mysqli_fetch_assoc($result)) {
    $cadena .= '<option value=' . $ver['id_marca'] . '>' . $ver['marca'] . '</option>';
}
echo $cadena . "</select>";

?>
