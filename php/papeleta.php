<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require '../dompdf/vendor/autoload.php';
require_once "../php/main.php";

$id = (limpiar_cadena($_GET['id_papeleta']));

$conexion = conexion();
$conexion = $conexion->query("SELECT * FROM incidencia WHERE incidencia_id='$id'");
$datos = $conexion->fetch();

$codigo = $datos['incidencia_tipo'];
$plaza = $datos['incidencia_plaza'];
$del = $datos['incidencia_fecha_inicial'];
$al = $datos['incidencia_fecha_final'];
$servicio = $datos['incidencia_servicio'];
$fecha = $datos['incidencia_fecha_elaboracion'];
$matriculaT = $datos['incidencia_matricula_titular'];
$nombreT = $datos['incidencia_nombre_titular'];
$categoriaT = $datos['incidencia_categoria_titular'];
$horarioT = $datos['incidencia_horario_titular'];
$descansosT = $datos['incidencia_descanso_titular'];
$matriculaS = $datos['incidencia_matricula_sustituto'];
$nombreS = $datos['incidencia_nombre_sustituto'];
$categoriaS = $datos['incidencia_categoria_sustituto'];
$horarioS = $datos['incidencia_horario_sustituto'];
$descansosS = $datos['incidencia_descanso_sustituto'];
$observacion = $datos['incidencia_observaciones'];
$jefeServicio = $datos['incidencia_jefe_servicio'];
$jefePersonal = $datos['incidencia_jefe_personal'];
$motivo = $datos['incidencia_motivo'];

$options = new Options();
$options->set('chroot', realpath(''));

$dompdf = new Dompdf($options);

$imagePath = 'C:/laragon/www/overtime/img/imss.png';
$image = file_get_contents($imagePath);
$imageBase64 = base64_encode($image);
$html = '

<html>
<head>
    <meta charset="UTF-8">
    <title>Papeleta de sustitución</title>        
    <style>
        /* CSS para aplicar un borde a todas las celdas de la tabla */
        html {
            margin: 11pt 15pt;
        }
        table {
            border-collapse: collapse;  /* Combina los bordes adyacentes */
            margin: auto; /* Centra la tabla */
            width: 750px;
        }
        .fechas {
            width: 120px;
        }
        .encabezado {
            background-color: lightgray;
        }
        .logo{        
            height: 50px;
        }
        .pie-pagina {
            text-align: right;
            border: none;   /* Esto eliminará todos los bordes */
        }
        .division{
            text-align: center;      /* Centra el contenido horizontalmente */
            border: none;   /* Esto eliminará todos los bordes */
            vertical-align: middle;  /* Centra el contenido verticalmente */
            height: 18;
        } 
        .izquierda{
            text-align: left;      /* Centra el contenido horizontalmente */
        }
        th, td {
            border: 1px solid black;   /* Aplica un borde de 1px y color negro a todas las celdas */
            text-align: center;      /* Centra el contenido horizontalmente */
            vertical-align: middle;  /* Centra el contenido verticalmente */
            font-size: 10px;
            height: 10;
            word-wrap: break-word;
        }
          
        .firmas {
        width: 275;
        vertical-align: bottom;
        }
        .observacion {
        width: 100px;
        height: 50;
        }
    </style     
</head>
<body>
    <table>
        <tr class="encabezado">
            <th colspan="8">SOLICITUD DE SUSTITUCIÓN</th>
        </tr>

        <tr>
            <td class="logo"><img src="data:image/png;base64,' . $imageBase64 . '" alt="LOGO IMSS" style="width:30;height:35;"></td> 
            <th class="izquierda" colspan="2">DELEGACION: 03<br>HOSPITAL GENERAL DE SUBZONA N°38<br>SAN JOSE DEL CABO B.C.S.</th> 
            <td colspan="2"> ' . $codigo . ' </td>
            <th>(XXX)</th> 
            <th>PLAZA</th> 
            <td> ' . $plaza . ' </td>
        </tr>

        <tr>
            <th class="izquierda" rowspan="2" >PERIODO DE<br> LA COMISIÓN</th> 
            <th >DEL</th> 
            <th colspan="2" >AL</th> 
            <th colspan="2">SERVICIO SOLICITANTE</th> 
            <th colspan="2">FECHA DE SOLICITUD</th>             
        </tr>
        <tr>
            <td > ' . $del . ' </td> 
            <td colspan="2"> ' . $al . ' </td> 
            <td colspan="2">' . $servicio . ' </td> 
            <td colspan="2"> ' . $fecha . ' </td>
        </tr>  
        <tr>
            <th class="encabezado" colspan="8">DATOS DEL TITULAR</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CATEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>
            <td> ' . $matriculaT . ' </td> 
            <td colspan="3"> ' . $nombreT . ' </td> 
            <td colspan="2"> ' . $categoriaT . ' </td> 
            <td> ' . $horarioT . ' </td> 
            <td> ' . $descansosT . ' </td> 
        </tr>

        <tr>
            <th class="encabezado" colspan="8">DATOS DEL SUSTITUTO</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CAEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>

        <tr>
            <td> ' . $matriculaS . ' </td> 
            <td colspan="3"> ' . $nombreS . ' </td> 
            <td colspan="2"> ' . $categoriaS . ' </td> 
            <td> ' . $horarioS . ' </td> 
            <td> ' . $descansosS . ' </td> 
        </tr>

        </tr>

        <tr>
            <th >OBSERVACIONES</th>
            
            <th colspan="2">FIRMA DE JEFE DE SERVICIO</th>
            
            <th colspan="3">AUTORIZACION JEFE</th> 
            
            <th colspan="2">MOTIVO</th>
        </tr>

        <tr>
            <td class="observacion"> ' . $observacion . ' </td>

            <td class="firmas"colspan="2"> ' . $jefeServicio . ' </td>
            
            <td class="firmas" colspan="3"> ' . $jefePersonal . ' </td> 
            
            <td colspan="2" > ' . $motivo . ' </td>
        </tr>

        <tr >
            <th class="pie-pagina" colspan="8">Clave 7110-009-004</th>
        </tr>
                
    </table>
          
    <table>
        <tr>
        <th class="division" colspan="8">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </th>
        </tr>
    </table>
    
    <table>
        <tr class="encabezado">
            <th colspan="8">SOLICITUD DE SUSTITUCIÓN</th>
        </tr>

        <tr>
            <td class="logo"><img src="data:image/png;base64,' . $imageBase64 . '" alt="LOGO IMSS" style="width:30;height:35;"></td> 
            <th class="izquierda" colspan="2">DELEGACION: 03<br>HOSPITAL GENERAL DE SUBZONA N°38<br>SAN JOSE DEL CABO B.C.S.</th> 
            <td colspan="2"> ' . $codigo . ' </td>
            <th>(XXX)</th> 
            <th>PLAZA</th> 
            <td> ' . $plaza . ' </td>
        </tr>

        <tr>
            <th class="izquierda" rowspan="2" >PERIODO DE<br> LA COMISIÓN</th> 
            <th >DEL</th> 
            <th colspan="2" >AL</th> 
            <th colspan="2">SERVICIO SOLICITANTE</th> 
            <th colspan="2">FECHA DE SOLICITUD</th>             
        </tr>
        <tr>
            <td > ' . $del . ' </td> 
            <td colspan="2"> ' . $al . ' </td> 
            <td colspan="2">' . $servicio . ' </td> 
            <td colspan="2"> ' . $fecha . ' </td>
        </tr>  
        <tr>
            <th class="encabezado" colspan="8">DATOS DEL TITULAR</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CATEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>
            <td> ' . $matriculaT . ' </td> 
            <td colspan="3"> ' . $nombreT . ' </td> 
            <td colspan="2"> ' . $categoriaT . ' </td> 
            <td> ' . $horarioT . ' </td> 
            <td> ' . $descansosT . ' </td> 
        </tr>

        <tr>
            <th class="encabezado" colspan="8">DATOS DEL SUSTITUTO</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CAEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>

        <tr>
            <td> ' . $matriculaS . ' </td> 
            <td colspan="3"> ' . $nombreS . ' </td> 
            <td colspan="2"> ' . $categoriaS . ' </td> 
            <td> ' . $horarioS . ' </td> 
            <td> ' . $descansosS . ' </td> 
        </tr>

        </tr>

        <tr>
            <th >OBSERVACIONES</th>
            
            <th colspan="2">FIRMA DE JEFE DE SERVICIO</th>
            
            <th colspan="3">AUTORIZACION JEFE</th> 
            
            <th colspan="2">MOTIVO</th>
        </tr>

        <tr>
            <td class="observacion"> ' . $observacion . ' </td>

            <td class="firmas"colspan="2"> ' . $jefeServicio . ' </td>
            
            <td class="firmas" colspan="3"> ' . $jefePersonal . ' </td> 
            
            <td colspan="2" > ' . $motivo . ' </td>
        </tr>

        <tr >
            <th class="pie-pagina" colspan="8">Clave 7110-009-004</th>
        </tr>
                
    </table>

    <table>
        <tr>
        <th class="division" colspan="8">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </th>
        </tr>
    </table>

    <table>
        <tr class="encabezado">
            <th colspan="8">SOLICITUD DE SUSTITUCIÓN</th>
        </tr>

        <tr>
            <td class="logo"><img src="data:image/png;base64,' . $imageBase64 . '" alt="LOGO IMSS" style="width:30;height:35;"></td> 
            <th class="izquierda" colspan="2">DELEGACION: 03<br>HOSPITAL GENERAL DE SUBZONA N°38<br>SAN JOSE DEL CABO B.C.S.</th> 
            <td colspan="2"> ' . $codigo . ' </td>
            <th>(XXX)</th> 
            <th>PLAZA</th> 
            <td> ' . $plaza . ' </td>
        </tr>

        <tr>
            <th class="izquierda" rowspan="2" >PERIODO DE<br> LA COMISIÓN</th> 
            <th >DEL</th> 
            <th colspan="2" >AL</th> 
            <th colspan="2">SERVICIO SOLICITANTE</th> 
            <th colspan="2">FECHA DE SOLICITUD</th>             
        </tr>
        <tr>
            <td > ' . $del . ' </td> 
            <td colspan="2"> ' . $al . ' </td> 
            <td colspan="2">' . $servicio . ' </td> 
            <td colspan="2"> ' . $fecha . ' </td>
        </tr>  
        <tr>
            <th class="encabezado" colspan="8">DATOS DEL TITULAR</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CATEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>
            <td> ' . $matriculaT . ' </td> 
            <td colspan="3"> ' . $nombreT . ' </td> 
            <td colspan="2"> ' . $categoriaT . ' </td> 
            <td> ' . $horarioT . ' </td> 
            <td> ' . $descansosT . ' </td> 
        </tr>

        <tr>
            <th class="encabezado" colspan="8">DATOS DEL SUSTITUTO</th>
        </tr>

        <tr>
            <th>MAT</th> 
            <th colspan="3">NOMBRE</th> 
            <th colspan="2">CAEGORIA Y JORNADA</th> 
            <th>HORARIO</th> 
            <th>DESCANSOS</th> 
        </tr>

        <tr>

        <tr>
            <td> ' . $matriculaS . ' </td> 
            <td colspan="3"> ' . $nombreS . ' </td> 
            <td colspan="2"> ' . $categoriaS . ' </td> 
            <td> ' . $horarioS . ' </td> 
            <td> ' . $descansosS . ' </td> 
        </tr>

        </tr>

        <tr>
            <th >OBSERVACIONES</th>
            
            <th colspan="2">FIRMA DE JEFE DE SERVICIO</th>
            
            <th colspan="3">AUTORIZACION JEFE</th> 
            
            <th colspan="2">MOTIVO</th>
        </tr>

        <tr>
            <td class="observacion"> ' . $observacion . ' </td>

            <td class="firmas"colspan="2"> ' . $jefeServicio . ' </td>
            
            <td class="firmas" colspan="3"> ' . $jefePersonal . ' </td> 
            
            <td colspan="2" > ' . $motivo . ' </td>
        </tr>

        <tr >
            <th class="pie-pagina" colspan="8">Clave 7110-009-004</th>
        </tr>
                
    </table>

</body>
</html>

';

$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();

$output = $dompdf->output();
$dompdf->stream('document.pdf', array('Attachment' => 0));
?>
