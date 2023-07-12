<script src="https://unpkg.com/html5-qrcode"></script>
<div class="container is-fluid mb-6">
    <h1 class="title has-text-centered">EQUIPOS DE CÓMPUTO</h1>
    <h2 class="subtitle has-text-centered">Buscar Equipo</h2>
</div>

<div class="container pb-6 pt-1 has-text-centered">

    <?php
    require_once "./php/main.php";
    ?>    

<div class="columns">
        <div class="column">
            <div class="box">
                <form id="searchForm" method="POST" autocomplete="off">

                    <div class="field is-grouped">
                        <p class="control is-expanded">
                            <input class="input has-text-centered" type="text" id="buscar" name="buscar"
                                   placeholder="INGRESA: SERIE / NNI / PREI / USUARIO / IP / AREA / DEPARTAMENTO"
                                   pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ /*-+.]{1,80}" maxlength="30"
                                   oninput="this.value = this.value.toUpperCase()">
                        </p>
                        <p class="control">
                            <button class="button is-info" type="submit"><img src="./img/search.png" width="32"></button>
                        </p>
                        <p class="control">
                            <button id="toggle_scan" type="button" onclick="openScanner()"><img src="./img/qrscan.png" width="32"></button>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $buscar = isset($_POST['buscar']) ? limpiar_cadena($_POST['buscar']) : '';
        $tabla = "";
        $consulta_datos = "SELECT * FROM inventario WHERE serie LIKE '%$buscar%' OR prei LIKE '%$buscar%' OR nni LIKE '%$buscar%' OR usuario LIKE '%$buscar%' OR ip LIKE '%$buscar%' OR area LIKE '%$buscar%' OR departamento LIKE '%$buscar%' OR unidad LIKE '%$buscar%'";
        $resultados = conexion()->query($consulta_datos)->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultados) > 0) {
            $tabla = '
                <div class="table-container">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <tbody>
            ';

            foreach ($resultados as $fila) {
                $tabla .= '
                    <tr>
                        <td class="has-text-right"><strong>SERIE:</strong></td>
                        <td class="has-text-left">' . $fila['serie'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>STATUS:</strong></td>
                        <td class="has-text-left">' . $fila['estatus'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>MODELO:</strong></td>
                        <td class="has-text-left">' . $fila['modelo'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>NOMBRE DEL EQUIPO:</strong></td>
                        <td class="has-text-left">' . $fila['nombre_equipo'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>USUARIO:</strong></td>
                        <td class="has-text-left">' . $fila['usuario'] . '</td>
                    </tr>
                    <tr>
                    <td class="has-text-right"><strong>NOMBRE DEL USUARIO:</strong></td>
                        <td class="has-text-left">' . $fila['nombre_usuario'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>MATRÍCULA:</strong></td>
                        <td class="has-text-left">' . $fila['matricula'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>CARGO:</strong></td>
                        <td class="has-text-left">' . $fila['cargo'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>IP:</strong></td>
                        <td class="has-text-left">' . $fila['ip'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>AREA:</strong></td>
                        <td class="has-text-left">' . $fila['area'] . ' / ' . $fila['departamento'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>NODO:</strong></td>
                        <td class="has-text-left">' . $fila['nodo'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>EXTENSION:</strong></td>
                        <td class="has-text-left">' . $fila['extension'] . '</td>
                    </tr>
                    <tr>
                        <td class="has-text-right"><strong>MANTENIMIENTO:</strong></td>
                        <td class="has-text-left">' . $fila['ultimo_mantenimiento'] . '</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="has-text-centered">
                            <a href="index.php?vista=computer_update&computer_id_up=' . $fila['inventario_id'] . '" class="button is-primary">Actualizar</a>
                        </td>
                    </tr>
                ';
            }

            $tabla .= '</tbody></table></div>';
            echo $tabla;
        } else {
            echo '<p>No se encontraron resultados.</p>';
        }
    }
    ?>        
</div>
<script>
    function openScanner() {
        // Obtener el valor actual del input
        var buscarInput = document.getElementById("buscar");
        var inputValue = buscarInput.value;

        // Guardar el valor en localStorage
        localStorage.setItem("inputValue", inputValue);

        // Abrir la ventana del escáner QR
        var screenWidth = window.screen.availWidth;
var screenHeight = window.screen.availHeight;
var windowWidth = 600;
var windowHeight = 400;
var leftPosition = (screenWidth - windowWidth) / 2;
var topPosition = (screenHeight - windowHeight) / 2;

var scannerWindow = window.open("./php/qr.php", "_blank", "width=600,height=400,left=" + leftPosition + ",top=" + topPosition);

            

        // Esperar a que la ventana se cierre
        scannerWindow.addEventListener("beforeunload", function() {
        // Restaurar el valor del input desde localStorage
        var restoredValue = localStorage.getItem("inputValue");
        buscarInput.value = restoredValue;
        });
    }
  </script>