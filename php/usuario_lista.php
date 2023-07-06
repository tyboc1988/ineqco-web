<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

if (!empty($busqueda)) {
    $consulta_datos = "SELECT * FROM usuario WHERE nombre LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' ORDER BY 
    nombre ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE nombre LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%'";
} else {
    $consulta_datos = "SELECT * FROM usuario ORDER BY nombre ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(usuario_id) FROM usuario";
}

$conexion = conexion();
$datos = $conexion->query($consulta_datos)->fetchAll();
$total = (int) $conexion->query($consulta_total)->fetchColumn();
$Npaginas = ceil($total / $registros);

$tabla .= '
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered" >#</th>
                    <th class="has-text-centered" >Nombre</th>
                    <th class="has-text-centered" >Usuario</th>
                    <th class="has-text-centered" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
';

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td>'.$contador.'</td>
                <td>'.$rows['nombre'].'</td>
                <td>'.$rows['usuario'].'</td>
                <td>
                    <a href="index.php?vista=user_update&user_id_up='.$rows['usuario_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                </td>
                <td>
                    <a href="'.$url.$pagina.'&user_id_del='.$rows['usuario_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                </td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="7">
                    <a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="7">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total >= 1 && $pagina <= $Npaginas) {
    $tabla .= '
        <p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>
        ';
    }    

    $conexion= null;
    echo $tabla;

    if($total>=1 && $pagina<=$Npaginas){
        echo paginador_tablas($pagina,$Npaginas,$url,7);
    }  
?>