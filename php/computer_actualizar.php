<?php
    require_once "main.php";
    $id=limpiar_cadena($_POST['inventario_id']);

    # ALMACENANDO DATOS #
    $serie                  =limpiar_cadena($_POST['serie']);
    $prei                   =intval(limpiar_cadena($_POST['prei']));
    $nni                    =limpiar_cadena($_POST['nni']);
    $modelo                 =limpiar_cadena($_POST['modelo']);
    $nombre_equipo          =limpiar_cadena($_POST['nombre_equipo']);
    $usuario                =limpiar_cadena($_POST['usuario']);
    $nombre_usuario         =limpiar_cadena($_POST['nombre_usuario']);
    $matricula              =limpiar_cadena($_POST['matricula']);
    $cargo                  =limpiar_cadena($_POST['cargo']);
    $ip                     =limpiar_cadena($_POST['ip']);
    $area                   =limpiar_cadena($_POST['area']);
    $departamento           =limpiar_cadena($_POST['departamento']);
    $unidad                 =limpiar_cadena($_POST['unidad']);
    $nodo                   =limpiar_cadena($_POST['nodo']);
    $extension              =limpiar_cadena($_POST['extension']);
    $comentarios            =limpiar_cadena($_POST['comentarios']);
    $estatus                =limpiar_cadena($_POST['estatus']);
    $ultimo_mantenimiento   =limpiar_cadena($_POST['ultimo_mantenimiento']);

    #ACTUALIZAR INCIDENCIA
    $actualizar=conexion();
    $actualizar=$actualizar->prepare("UPDATE inventario SET 
    serie=:serie, 
    prei=:prei, 
    nni=:nni, 
    modelo=:modelo, 
    nombre_equipo=:nombre_equipo, 
    usuario=:usuario, 
    nombre_usuario=:nombre_usuario, 
    matricula=:matricula, 
    cargo=:cargo, 
    ip=:ip, 
    area=:area, 
    departamento=:departamento, 
    unidad=:unidad, 
    nodo=:nodo, 
    extension=:extension, 
    comentarios=:comentarios, 
    estatus=:estatus, 
    ultimo_mantenimiento=:ultimo_mantenimiento
    WHERE inventario_id =:id");

    $marcadores=[
    ":serie"=>$serie,
    ":prei"=>$prei,
    ":nni"=>$nni,
    ":modelo"=>$modelo,
    ":nombre_equipo"=>$nombre_equipo,
    ":usuario"=>$usuario,
    ":nombre_usuario"=>$nombre_usuario,
    ":matricula"=>$matricula,
    ":cargo"=>$cargo,
    ":ip"=>$ip,
    ":area"=>$area,
    ":departamento"=>$departamento,
    ":unidad"=>$unidad,
    ":nodo"=>$nodo,
    ":extension"=>$extension,
    ":comentarios"=>$comentarios,
    ":estatus"=>$estatus,
    ":ultimo_mantenimiento"=>$ultimo_mantenimiento,
    ":id"=>$id
    ];

    if($actualizar->execute($marcadores)){
        echo '
            <div class="notification is-info is-ligth">
                <strong>EQUIPO ACTUALIZADO!</strong><br>
                El equipo se actualizo con exito.
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error!</strong><br>
                No se pudo actualizar el equipo, por favor intente nuevamente.
            </div>
        ';
    }
    $actualizar=null;