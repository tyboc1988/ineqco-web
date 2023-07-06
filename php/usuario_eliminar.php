<?php
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    //VERIFICANDO USUARIO
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");
    if($check_usuario->rowCount()==1){
        $eliminar_usuario=conexion();
        $eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");


        $eliminar_usuario->execute([":id"=>$user_id_del]);

        if($eliminar_usuario->rowCount()==1){
            echo '
            <div class="notification is-info is-ligth">
                <strong>¡Usuario Eliminado!</strong><br>
                El usuario se elimino exitosamente!
            </div>
        ';
        }else{
            echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no se pudo eliminar, por favor intente nuevamente
            </div>
        ';
        }
        $eliminar_usuario=null;
    }else{
        echo '
            <div class="notification is-danger is-ligth">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario que intenta eliminar no existe
            </div>
        ';
    }

    $check_usuario=null;