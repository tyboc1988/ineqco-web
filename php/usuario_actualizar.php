<?php
    require_once "../inc/session_start.php";

    require_once "main.php";

    $id=limpiar_cadena($_POST['usuario_id']);

    //Verificar el usuario
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id' ");

    if($check_usuario->rowCount()<=0){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no Existe en el sistema
            </div>
        ';
        exit();
    }else{
         $datos=$check_usuario->fetch();
    }
    $check_usuario=null;
   
    $admin_usuario=limpiar_cadena($_POST['administrador_usuario']);
    $admin_clave=limpiar_cadena($_POST['administrador_clave']);

    # Verificando campos obligatorios #
    if($admin_usuario=="" || $admin_clave==""){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Los campos de USUARIO y CLAVE son obligatorios.
            </div>
        ';
        exit();
    }

    # VERIFICANDO INTEGRIDAD DE LOS DATOS #
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ .0-9]{5,25}",$admin_usuario)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en las CREDENCIALES!</strong><br>
                El USUARIO ingresado no cumple con los requerimientos
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en las CREDENCIALES!</strong><br>
                La CLAVE ingresada no cumple con los requerimientos
            </div>
        ';
        exit();
    }

    #VERIFICANDO ADMIN
    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario, clave FROM usuario WHERE usuario='$admin_usuario' AND usuario_id ='".$_SESSION['id']."'");


    if($check_admin->rowCount()==1){
        $check_admin=$check_admin->fetch();

        if($check_admin['usuario']!=$admin_usuario || !password_verify($admin_clave,$check_admin['clave']) ){
            echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en las CREDENCIALES!</strong><br>
                USUARIO o CLAVE de administrador incorrectos
            </div>
        ';
        exit();
        }
    }else{
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en la Matrícula!</strong><br>
                USUARIO o CLAVE de administrador incorrectos
            </div>
        ';
        exit();
    }
    $check_admin=null;

    # ALMACENANDO DATOS #
    $nombre=limpiar_cadena($_POST['nombre']);
    $usuario=limpiar_cadena($_POST['usuario']);
    $clave_1=limpiar_cadena($_POST['usuario_clave_1']);
    $clave_2=limpiar_cadena($_POST['usuario_clave_2']);
    
    # VERIFICANDO INTEGRIDAD DE LOS DATOS #
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,70}",$nombre)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en el NOMBRE!</strong><br>
                Verifica que el campo de NOMBRE no contenga caracteres especiales.
            </div>
        ';
        exit();
    }
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ.]{5,25}",$usuario)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error en el USUARIO!</strong><br>
                Verifica que el campo de USUARIO cumpla con el formato solicitado (ej. nombre.apellido)
            </div>
        ';
        exit();
    }

        # VERIFICANDO USUARIO
    if($usuario!=$datos['usuario']){
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
    }

    if($clave_1!="" || $clave_2!=""){
        if(verificar_datos("[a-zA-Z0-9 $@.-]{7,100}",$clave_1) || verificar_datos("[a-zA-Z0-9 $@.-]{7,100}",$clave_2) ){
            echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Error!</strong><br>
                Las Claves no coinciden con el formato solicitado
            </div>
            ';
            exit();
        }else{
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
        }        
    }else{
        $clave=$datos['clave']; 
    }

    # ACTUALIZAR USUARIO
$actualizar_usuario = conexion();
$actualizar_usuario = $actualizar_usuario->prepare("UPDATE usuario SET nombre=:nombre, usuario=:usuario, clave=:clave WHERE usuario_id=:id");

$marcadores = [
    ":nombre" => $nombre,
    ":usuario" => $usuario,
    ":clave" => $clave,
    ":id" => $id
];

# Enlazar los valores utilizando bindValue()
$actualizar_usuario->bindValue(':nombre', $nombre);
$actualizar_usuario->bindValue(':usuario', $usuario);
$actualizar_usuario->bindValue(':clave', $clave);
$actualizar_usuario->bindValue(':id', $id);

if ($actualizar_usuario->execute()) {
    echo '
        <div class="notification is-info is-light">
            <strong>¡USUARIO ACTUALIZADO!</strong><br>
            El usuario se actualizó con éxito.
        </div>
    ';
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error!</strong><br>
            No se pudo actualizar el usuario, por favor intente nuevamente.
        </div>
    ';
}
$actualizar_usuario = null;
