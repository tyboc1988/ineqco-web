<?php
    require_once "../php/main.php";

    # ALMACENANDO DATOS #
    $nombre=limpiar_cadena($_POST['usuario_nombre']);
    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);

    # Verificando campos obligatorios #
    if($nombre=="" || $usuario=="" || $clave_1=="" || $clave_2==""){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Al parecer no haz llenado todos los campos.
            </div>
        ';
        exit();
    }

    # VERIFICANDO INTEGRIDAD DE LOS DATOS #
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en el Nombre!</strong><br>
                Toma en cuenta que el nombre no admite numeros o carácteres especiales.
            </div>
        ';
        exit();
    }

    # VERIFICANDO USUARIO
    $usuario_check=conexion();
    $usuario_check=$usuario_check->query("SELECT usuario FROM usuario WHERE usuario='$usuario'");
    if($usuario_check->rowCount()>0){
        echo '
        <div class="notification is-danger is-ligth">
            <strong>¡Error!</strong><br>
            El nombre de usuario que intenta registrar ya existe en la base de datos, Verifique o intente con otro nombre de usuario.
        </div>
        ';
        exit();
    }

    # VERIFICANDO LA CONTRASEÑA
    if($clave_1!=$clave_2){
        echo '
        <div class="notification is-danger is-ligth">
            <strong>¡Error!</strong><br>
            Las Contraseñas ingresadas no coinciden, verifique antes de continuar.
        </div>
        ';
        exit();
    }else{
        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
    }

    $usuario_check=null;

    # GUARDANDO USUARIO #
    // Conectarse a la base de datos
    $guardar_usuario=conexion();
    // Preparando sentencia para insertar valores
    $guardar_usuario=$guardar_usuario->prepare("INSERT INTO usuario (
        nombre,
        usuario,
        clave) 
        VALUES(
            :nombre,
            :usuario, 
            :clave)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":usuario"=>$usuario,
        ":clave"=>$clave
    ];
    // Ejecutaado sentencia y guardando valores en la base de datos
    $guardar_usuario->execute($marcadores);

    if($guardar_usuario->rowCount()==1){        
        echo '
            <div class="notification is-info is-light">
                <strong>!REGISTRO EXITOSO!</strong><br>
                Usuario Registrado Con Exito.
            </div>
            ';
    }else{
        echo '
        <div class="notification is-danger is-light">
            <strong>!Ocurrio un error inesperado!</strong><br>
            No se pudo regustrar al empleado, por favor intente de nuevo.
        </div>
        ';        
    }
    $guardar_usuario=null;