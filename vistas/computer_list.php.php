<div class="container is-fluid mb-6">
    <h1 class="title has-text-centered">LISTA DE EQUIPOS</h1>
    <h2 class="subtitle has-text-centered">H.G.S.Z. N°38</h2>
</div>
<style>
    th, td {    
        text-align: center;      /* Centra el contenido horizontalmente */
        vertical-align: middle;  /* Centra el contenido verticalmente */
        font-size: 10Px;    
    }
</style>
<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";
        
        //ELIMINAR EQUIPO
        if(isset($_GET['computer_id_del'])){
            require_once "./php/computer_eliminar.php";
        }
        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }
        
        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=computer_list.php&page=";
        $registros=140;
        $busqueda="";

        require_once "./php/computer_lista.php";
    ?>
</div>