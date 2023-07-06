<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

if (!empty($busqueda)) {
    $consulta_datos = "SELECT * FROM inventario WHERE serie LIKE '%$busqueda%' OR prei LIKE '%$busqueda%' OR nni LIKE '%$busqueda%' OR area LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR ip LIKE '%$busqueda%' ORDER BY serie ASC LIMIT $inicio,$registros";
    
    $consulta_total = "SELECT COUNT(inventario_id ) FROM inventario serie WHERE serie LIKE '%$busqueda%' OR prei LIKE '%$busqueda%' OR nni LIKE '%$busqueda%' OR area LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR ip LIKE '%$busqueda%'";
} else {
    $consulta_datos = "SELECT * FROM inventario WHERE unidad='T38' ORDER BY ip ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(inventario_id ) FROM inventario";
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
                    <th class="has-text-centered"  >#</th>
                    <th class="has-text-centered" >SERIE</th>
                    <th class="has-text-centered" >IP</th>
                    <th class="has-text-centered" >NOMBRE DEL EQUIPO</th>
                    <th class="has-text-centered" >USUARIO</th>
                    <th class="has-text-centered" >NOMBRE DEL USUARIO</th>
                    <th class="has-text-centered" >MATRICULA</th>
                    <th class="has-text-centered" >CARGO</th>
                    <th class="has-text-centered" >AREA</th>
                    <th class="has-text-centered" >DEPARTAMENTO</th>
                    <th class="has-text-centered" >UNIDAD</th>                    
                    <th class="has-text-centered" colspan="2">OPCIONES</th>
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
                <td>'.$rows['serie'].'</td>
                <td>'.$rows['ip'].'</td>
                <td>'.$rows['nombre_equipo'].'</td>
                <td>'.$rows['usuario'].'</td>
                <td>'.$rows['nombre_usuario'].'</td>
                <td>'.$rows['matricula'].'</td>
                <td>'.$rows['cargo'].'</td>
                <td>'.$rows['area'].'</td>
                <td>'.$rows['departamento'].'</td>
                <td>'.$rows['unidad'].'</td>                
                <td>
                    <a href="index.php?vista=computer_update&computer_id_up='.$rows['inventario_id'].'"><img src="./img/update.png"></a>
                </td>
                <td>
                    <a href="'.$url.$pagina.'&computer_id_del='.$rows['inventario_id'].'"><img src="./img/delete.png"></a>
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
                <td colspan="12">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total >= 1 && $pagina <= $Npaginas) {
    $tabla .= '
        <p class="has-text-right">Mostrando inventario <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>
        ';
    }    

    $conexion= null;
    echo $tabla;

    if($total>=1 && $pagina<=$Npaginas){
        echo paginador_tablas($pagina,$Npaginas,$url,7);
    }  
?>