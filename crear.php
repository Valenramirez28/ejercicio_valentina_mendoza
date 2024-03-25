<?php
require_once("conexion/conecction.php"); 
$conexion = new Database();
$con = $conexion->conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Préstamos de Vehículos</title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Formulario de Registro de Préstamos de Vehículos</h1>
    <main>
        <form class="formulario" method="POST" autocomplete="off" id="formulario">

        <div class="formulario__grupo-input" id="grupo__vehiculo">
        <label for="nom_vehiculo" class="formulario__label">Vehiculo *</label>
        <div class="formulario__grupo-select">
        <select name="nom_vehiculo" id="nom_vehiculo" class="formulario__select" required>
        <option value="">Seleccione el vehiculo</option>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "vehiculos");

            // Verificar conexión
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener los nombres de los vehículos
            $consulta = "SELECT id_vehiculo, nom_vehiculo, marca FROM vehiculo, tipo_vehiculo, marca
            WHERE vehiculo.id_tip_veh = tipo_vehiculo.id_tip_veh AND vehiculo.id_marca = marca.id_marca";
            $resultado = $conexion->query($consulta);

            // Mostrar opciones en el selector
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['id_vehiculo'] . "'>" . $fila['nom_vehiculo'] . " " . $fila['marca'] . "</option>";
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </select>
        </div>
        </div>


        <div class="formulario__grupo-input" id="grupo__usuario">
        <label for="nombre" class="formulario__label">Nombre_prestamista *</label>
        <div class="formulario__grupo-select">
        <select name="nombre" id="nombre" class="formulario__select" required>
        <option value="">Seleccione el nombre</option>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "vehiculos");

            // Verificar conexión
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener los nombres de los vehículos
            $consulta = "SELECT documento, nombre FROM usuarios";
            $resultado = $conexion->query($consulta);

            // Mostrar opciones en el selector
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['documento'] . "'>" . $fila['nombre'].  "</option>";
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </select>
        </div>
        </div>


        <div class="formulario__grupo-input" id="grupo__destino">
            <label for="id_destino" class="formulario__label">Destino *</label>
            <div class="formulario__grupo-select">
                <select name="id_destino" id="id_destino" class="formulario__select" required>
                    <option value="">Seleccione el Destino_Vehiculo</option>
                    <?php
                    /*Consulta para mostrar las opciones en el select */
                    $statement = $con->prepare('SELECT * from destino');
                    $statement->execute();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=" . $row['id_destino'] . ">" . $row['nom_destino'] . "</option>";
                    }
                    ?>
                </select>
                </div>
                </div>

        <div class="formulario__grupo" id="grupo__km_inicial">        
        <label for="km_inicial" class="formulario__label">KM Inicial:</label>
        <div class="formulario__grupo-input">
        <input type="text" class="formulario__input" onkeyup="mayus(this);" name="km_inicial" id="km_inicial" placeholder="KM_inicial">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">
                    El KM_inicial tiene que ser de 3 a 20 dígitos alfanumericos</p>
            </div>

        <div class="formulario__grupo" id="grupo__fecha_ini">
        <label for="fecha_ini" class="formulario__label">Fecha de Inicio:</label>
        <div class="formulario__grupo-input">
        <input type="date" class="formulario__input" onkeyup="mayus(this);" name="fecha_ini" id="fecha_ini" placeholder="fecha_inicio">
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
        </div>

        <div class="formulario__grupo" id="grupo__fecha_fin">
        <label for="fecha_fin" class="formulario__label">Fecha Fin:</label>
        <div class="formulario__grupo-input">
        <input type="date" class="formulario__input" onkeyup="mayus(this);" name="fecha_fin" id="fecha_fin" placeholder="fecha_fin">
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
        </div>

       <!-- Grupo: Terminos y Condiciones -->
       <div class="formulario__grupo-terminos" id="grupo__terminos">
                <label class="formulario__label">
                    <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
                    Acepto los Terminos y Condiciones
                </label>
            </div>

            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>

            <p class="text-center">

            <div class="formulario__grupo-btn-enviar">
                <button type="submit" class="formulario__btn" name="save" value="guardar">Enviar</button>
                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
            </div>

    </form>
    </main>

    <script src="js/jquery.js"></script>
    <script src="js/formulario.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!--  Javascript funcion para convertor en mayusculas y minusculas -->
    <!-- <script src="../js/main.js"></script> -->
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

        function minus(e) {
            e.value = e.value.toLowerCase();
        }
    </script>

</body>
</html>
