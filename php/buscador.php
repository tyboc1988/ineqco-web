<?php
$modulo_buscador = $_POST['modulo_buscador'] ?? '';

$modulos = ["usuario", "empleado", "incidencia", "property"];

if (in_array($modulo_buscador, $modulos)) {
    $modulos_url = [
        "usuario" => "user_search",
        "empleado" => "employee_search",
        "incidencia" => "incidencia_search",
        "property" => "property_search"
    ];

    $modulo_buscador_url = $modulos_url[$modulo_buscador];
    $modulo_buscador = "busqueda_" . $modulo_buscador;

    // Iniciar búsqueda
    if (isset($_POST['txt_buscador'])) {
        $txt = limpiar_cadena($_POST['txt_buscador']);

        if ($txt === "") {
            echo '
                <div class="notification is-danger is-ligth">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Introduce un término de búsqueda
                </div>
            ';
        } elseif (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ . ]{1,80}", $txt)) {
            echo '
                <div class="notification is-danger is-ligth">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    El término de búsqueda no coincide con el formato solicitado
                </div>
            ';
        } else {
            $_SESSION[$modulo_buscador] = $txt;
            header("Location: index.php?vista=$modulo_buscador_url", true, 303);
            exit();
        }
    }

    // Eliminar búsqueda
    if(isset($_POST['eliminar_buscador'])){
        unset($_SESSION[$modulo_buscador]);
        header("Location: index.php?vista=$modulo_buscador_url", true, 303);
        exit();
    }

} else {
    echo '
        <div class="notification is-danger is-ligth">
            <strong>¡Error!</strong><br>
            No podemos procesar la petición
        </div>
    ';
}
?>
