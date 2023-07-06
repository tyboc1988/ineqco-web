<?php
    require_once "../php/main.php";

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
    

    # Verificando campos obligatorios #
    if($serie==""){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Por favor ingresa el numero de serie del equipo.
            </div>
        ';
        exit();
    }

    # VERIFICANDO INTEGRIDAD DE LOS DATOS #

    

    # VERIFICANDO EQUIPO EXISTENTE
    
        $check_serie=conexion();
        $check_serie=$check_serie->query("SELECT serie FROM inventario WHERE serie='$serie'");
        if($check_serie->rowCount()>0){
            echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error!</strong><br>
                Esta serie ya se encuentra registrada en la base de datos.
            </div>
            ';
            exit();
        }
    
    $check_serie=null;
      
    # GUARDANDO EQUIPO #
    // Conectarse a la base de datos
    $guardar_equipo=conexion();
    // Preparando sentencia para insertar valores
    $guardar_equipo=$guardar_equipo->prepare("INSERT INTO inventario (
        serie,
        prei, 
        nni,
        modelo,
        nombre_equipo,
        usuario,
        nombre_usuario,
        matricula,
        cargo,
        ip,
        area,
        departamento,
        unidad,
        nodo,
        extension,
        comentarios,
        estatus,
        ultimo_mantenimiento) 
        VALUES(
            :serie,
            :prei, 
            :nni,
            :modelo,
            :nombre_equipo, 
            :usuario,
            :nombre_usuario,
            :matricula,
            :cargo,
            :ip,
            :area,
            :departamento,
            :unidad,
            :nodo,
            :extension,
            :comentarios,
            :estatus,
            :ultimo_mantenimiento)");

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
        ":ultimo_mantenimiento"=>$ultimo_mantenimiento
    ];
    // Ejecutaado sentencia y guardando valores en la base de datos
    $guardar_equipo->execute($marcadores);

    if($guardar_equipo->rowCount()==1){        
        echo '
            <div class="notification is-info is-light">
                <strong>!REGISTRO EXITOSO!</strong><br>
                Equipo Registrado Con Exito.
            </div>
            ';
    }else{
        echo '
        <div class="notification is-danger is-light">
            <strong>!Ocurrio un error inesperado!</strong><br>
            No se pudo registrar el equipo, por favor intente de nuevo.
        </div>
        ';        
    }
    $guardar_equipo=null;