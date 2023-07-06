<?php
    
    # Almacenando datos #
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $clave=limpiar_cadena($_POST['login_clave']);

    # Verificando campos obligatorios #
    if($usuario==""){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡ERROR!</strong><br>
                Favor de Ingresar el Usuario.
            </div>
        ';
        exit();
    }else{
        if($clave==""){
            echo '
                <div class="notification is-danger is-ligth">
                    <strong>¡ERROR!</strong><br>
                    Favor de Ingresar la contraseña.
                </div>
            ';
            exit();
        }
    }

    # VERIFICANDO INTEGRIDAD DE LOS DATOS #
    if(verificar_datos("[a-zA-Z0-9_$@.-]{7,100}",$usuario)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado 
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9_$@.-]{7,100}",$clave)){
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado 
            </div>
        ';
        exit();
    }

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario='$usuario'");

    if($check_user->rowCount()==1){
        $check_user=$check_user->fetch();

        if($check_user['usuario']==$usuario && password_verify($clave,$check_user['clave'])){
            
            $_SESSION['id']=$check_user['usuario_id'];
            $_SESSION['nombre']=$check_user['nombre'];
            $_SESSION['usuario']=$check_user['usuario'];

            if(headers_sent()){
                echo "<script> windows.location.href='index.php?vista=home'</script>";
            }else{
                header('Location: index.php?vista=home');
            }

        }else{
            echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error!</strong><br>
                Contraseña Incorrecta.
            </div>
        ';
        }
    }else{
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error!</strong><br>
                Usuario Incorrecto
            </div>
        ';
    }
    $check_user=null;