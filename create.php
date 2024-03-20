<?php
require 'conexion/conecction.php';
$db = new Database();
$con = $db->conectar();
?>


<!--  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Formulario vehiculos con Javascript</title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Crear Prestamo</h1>
    <main>
        <form class="formulario" method="POST" autocomplete="off" id="formulario">
            <!-- div para capturar el documento -->

            <div class="formulario__grupo" id="grupo__codigo_prest">
                <label for="codigo_prest" class="formulario__label">Codigo_Prestamo *</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="codigo_prest" id="codigo_prest" placeholder="Ingrese el codigo">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">
                    El codigo debecontener solo numeros de 4 digitos.</p>
            </div>

            <div class="formulario__grupo-input" id="grupo__vehiculo">
            <label for="id_vehiculo" class="formulario__label">Tipo de Vehiculo *</label>
            <div class="formulario__grupo-select">
                <select name="id_tip_vehiculo" id="id_tip_vehiculo" class="formulario__select" required>
                    <option value="">Seleccione el tipo_vehiculo</option>
                    <?php
                    /*Consulta para mostrar las opciones en el select */
                    $statement = $con->prepare('SELECT * from tipo_vehiculo');
                    $statement->execute();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=" . $row['id_tip_vehiculo'] . ">" . $row['nom_vehiculo'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="formulario__grupo-input" id="select2lista">
                <label for="marca" class="formulario__label">Marca *</label>
                <select name="id_marca" id="id_marca" class="formulario__select" required>
                </select>
            </div>
        </div>

        <div class="formulario__grupo" id="grupo__usuario">
                <label for="usuario" class="formulario__label">Documento *</label>
                <div class="formulario__grupo-input">
                    <input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="Documento">
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">
                    El documento tiene que ser de 8 a 10 dígitos y solo puede contener numeros.</p>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#id_tip_vehiculo').val(0);
            recargarLista();

            $('#id_tip_vehiculo').change(function(){
                recargarLista();
            });
        });
    </script>

<script type="text/javascript">
        function recargarLista(){
            $.ajax({
                type:"POST",
                url:"vehiculo.php",
                data:"id_tip_vehiculo=" + $('#id_tip_vehiculo').val(),
                success:function(r){
                    $('#id_marca').html(r);
                }
            });
         }
    </script>

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