<?php
/**

 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$verificador = 0;
$contador = 0;
$visible = 0;
$estado = "ATENDIDO";
$mes = $_POST["mes"];
$anio = $_POST["anio"];
$usuario = $_POST["id_usuario"];



// Comprobar si se ha cargado un archivo
if (isset($_FILES['dataConciliacion'])) {
    extract($_POST);

    // Definir la carpeta de destino
    $carpeta_destino = "data/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["dataConciliacion"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "xls" || $extension == "xlsx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["dataConciliacion"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


            $inputFileNamePath = $carpeta_destino . $nombre_archivo;
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = "0"; //primera fila

            function ultimoDiaMes($fecha)
            {
                return date("Y-m-t", strtotime($fecha)); //transforma la fecha al ultimo dia del mes
            }



            foreach ($data as $row) {

                if ($count > 0) {
                    #$fecha_ingreso = trim($row['0']);

                    switch ($mes) {
                        case 'ENERO':
                            $fechaX = "$anio-01-01";
                            break;
                        case 'FEBRERO':
                            $fechaX = "$anio-02-01";
                            break;
                        case 'MARZO':
                            $fechaX = "$anio-03-01";
                            break;
                        case 'ABRIL':
                            $fechaX = "$anio-04-01";
                            break;
                        case 'MAYO':
                            $fechaX = "$anio-05-01";
                            break;
                        case 'JUNIO':
                            $fechaX = "$anio-06-01";
                            break;
                        case 'JULIO':
                            $fechaX = "$anio-07-01";
                            break;
                        case 'AGOSTO':
                            $fechaX = "$anio-08-01";
                            break;
                        case 'SETIEMBRE':
                            $fechaX = "$anio-09-01";
                            break;
                        case 'OCTUBRE':
                            $fechaX = "$anio-10-01";
                            break;
                        case 'NOVIEMBRE':
                            $fechaX = "$anio-11-01";
                            break;
                        case 'DICIEMBRE':
                            $fechaX = "$anio-12-01";
                            break;


                    }

                    $fecha_ingreso = ultimoDiaMes($fechaX);


                    $clasificador = trim($row['1']);
                    $monto = trim($row['2']);

                    $monto = floatval($monto);
                    $monto = number_format($monto, 2, '.', '');

                    $siic = trim($row['3']);
                    $siaf = trim($row['4']);
                    $dependencia = trim($row['5']);

                    switch ($dependencia) {
                        case 'ADM. CENTRAL':
                            $dependencia = "ADMINISTRACION CENTRAL";
                            break;
                        case 'ADMINISTRACION':
                            $dependencia = "FACULTAD DE ADMINISTRACION";
                            break;
                        case 'ADMISION':
                            $dependencia = "ADMISION";
                            break;
                        case 'ARQUITECTURA':
                            $dependencia = "FACULTAD DE ARQUITECTURA Y URBANISMO";
                            break;
                        case 'CCFV':
                            $dependencia = "CENTRO CULTURAL FEDERICO VILLARREAL";
                            break;
                        case 'CEPREVI':
                            $dependencia = "CENTRO PRE-UNIVERSITARIO";
                            break;
                        case 'CNMM':
                            $dependencia = "FACULTAD DE CIENCIAS NATURALES Y MATEMATICAS";
                            break;
                        case 'CONTABILIDAD':
                            $dependencia = "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES";
                            break;
                        case 'CONTABLES':
                            $dependencia = "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES";
                            break;
                        case 'CUDED':
                            $dependencia = "CENTRO UNIVERSITARIA DE EDUCACION A DISTANCIA";
                            break;
                        case 'DERECHO':
                            $dependencia = "FACULTAD DE DERECHO Y CIENCIAS POLITICAS";
                            break;
                        case 'ECONOMICAS':
                            $dependencia = "FACULTAD DE CIENCIAS ECONÓMICAS";
                            break;
                        case 'EDUCACION':
                            $dependencia = "FACULTAD DE EDUCACION";
                            break;
                        case 'EUPG':
                            $dependencia = "ESCUELA UNIVERSITARIA DE POST GRADO";
                            break;
                        case 'FAPS':
                            $dependencia = "FACULTAD DE PSICOLOGIA";
                            break;
                        case 'FE':
                            $dependencia = "FACULTAD DE EDUCACION";
                            break;
                        case 'FIC':
                            $dependencia = "FACULTAD DE INGENIERIA CIVIL";
                            break;
                        case 'FIGAE':
                            $dependencia = "FACULTAD DE INGENIERIA GEOGRAFICA Y AMBIENTAL";
                            break;
                        case 'FIIS':
                            $dependencia = "FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS";
                            break;
                        case 'FMHU':
                            $dependencia = "FACULTAD DE MEDICINA HUMANA";
                            break;
                        case 'FOPCA':
                            $dependencia = "FACULTAD DE OCEONOGRAFIA, PESQUERIA CIENCIAS ALIMENTARIAS Y ACUICULTURA";
                            break;
                        case 'HUMANIDADES':
                            $dependencia = "FACULTAD DE HUMANIDADES";
                            break;
                        case 'IDIOMAS':
                            $dependencia = "INSTITUTO DE IDIOMAS";
                            break;
                        case 'ING. ELECTRONICA':
                            $dependencia = "FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA (FIEI)";
                            break;
                        case 'IRED':
                            $dependencia = "INSTITUTO DE RECREACION EDUCACION FISICA Y DEPORTES (IRED)";
                            break;
                        case 'MEDICINA':
                            $dependencia = "FACULTAD DE MEDICINA HUMANA";
                            break;
                        case 'OCRACC':
                            $dependencia = "OFICINA CENTRAL DE REGISTROS ACADEMICOS Y CENTRO DE COMPUTO (OCRACC)";
                            break;
                        case 'ODONTOLOGIA':
                            $dependencia = "FACULTAD DE ODONTOLOGIA";
                            break;
                        case 'PSICOLOGIA':
                            $dependencia = "FACULTAD DE PSICOLOGIA";
                            break;
                        case 'SEC. GENERAL':
                            $dependencia = "SECRETARIA GENERAL";
                            break;
                        case 'SOCIALES':
                            $dependencia = "FACULTAD DE CIENCIAS SOCIALES";
                            break;
                        case 'TEC. MEDICA':
                            $dependencia = "FACULTAD DE TECNOLOGIA MEDICA";
                            break;
                        case 'VARIOS':
                            $dependencia = "VARIOS";
                            break;

                    }

                    $detalle = trim($row['6']);
                    $banco = trim($row['7']);

                    switch ($banco) {
                        case 'COMERCIO':
                            $banco = "BANCO DE COMERCIO";
                            break;
                        case 'CREDITO':
                            $banco = "BANCO DE CREDITO DEL PERU";
                            break;
                        case 'NACION':
                            $banco = "BANCO DE LA NACION";
                            break;
                        case 'PICHINCHA':
                            $banco = "BANCO PICHINCHA";
                            break;
                        case 'DNTP':
                            $banco = "DNTP";
                            break;

                    }

                    $cta = trim($row['8']);
                    $nombre = trim($row['9']);

                    if ($nombre == null) {
                        $nombre = "";
                    }






                    $sql_conciliacion = "SELECT * FROM tb_conciliacion_bancaria where visible!=1";
                    $query_conciliacion = $pdo->prepare($sql_conciliacion);
                    $query_conciliacion->execute();
                    $conciliacion_datos = $query_conciliacion->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($conciliacion_datos as $conciliacion_dato) {
                        if (
                            ($conciliacion_dato["fecha_ingresos"] == $fecha_ingreso) && ($conciliacion_dato["clasificador_ingresos"] == $clasificador) && ($conciliacion_dato["importe_ingresos"] == $monto)
                            && ($conciliacion_dato["siic_ingresos"] == $siic) && ($conciliacion_dato["siaf_ingresos"] == $siaf) && ($conciliacion_dato["dependencia_ingresos"] == $dependencia)
                            && ($conciliacion_dato["detalle_ingresos"] == $detalle) && ($conciliacion_dato["banco_ingresos"] == $banco) && ($conciliacion_dato["cta_ingresos"] == $cta)
                            && ($conciliacion_dato["nombre_ingresos"] == $nombre)
                        ) {

                            $verificador = 1; //ubica el duplicado
                        }
                    }




                    #Verifica si tiene duplicados en la base de datos el tipo de archivo a importar
                    if ($verificador != 1) {
                        #if ($lineas == 0 && $modalidad != "SELECCIONAR") {
                        $contador++;

                        // Insertar la información del archivo en la base de datos

                        //**************CARGAR A TABLA DE CONCILIACION BANCARIA****************



                        $sentencia = $pdo->prepare('INSERT INTO tb_conciliacion_bancaria(mes_ingresos,anio_ingresos,fecha_ingresos,clasificador_ingresos,importe_ingresos,siic_ingresos,siaf_ingresos,
                        dependencia_ingresos,detalle_ingresos,banco_ingresos,cta_ingresos,nombre_ingresos,estado,visible,id_usuario,fyh_creacion) 
                        VALUES (:mes_ingresos,:anio_ingresos,:fecha_ingresos,:clasificador_ingresos,:importe_ingresos,:siic_ingresos,:siaf_ingresos,:dependencia_ingresos,:detalle_ingresos,:banco_ingresos,
                        :cta_ingresos,:nombre_ingresos,:estado,:visible,:id_usuario,:fyh_creacion)');

                        $sentencia->bindParam('mes_ingresos', $mes);
                        $sentencia->bindParam('anio_ingresos', $anio);
                        $sentencia->bindParam('fecha_ingresos', $fecha_ingreso);
                        $sentencia->bindParam('clasificador_ingresos', $clasificador);
                        $sentencia->bindParam('importe_ingresos', $monto);
                        $sentencia->bindParam('siic_ingresos', $siic);
                        $sentencia->bindParam('siaf_ingresos', $siaf);
                        $sentencia->bindParam('dependencia_ingresos', $dependencia);
                        $sentencia->bindParam('detalle_ingresos', $detalle);
                        $sentencia->bindParam('banco_ingresos', $banco);
                        $sentencia->bindParam('cta_ingresos', $cta);
                        $sentencia->bindParam('nombre_ingresos', $nombre);
                        $sentencia->bindParam('estado', $estado);
                        $sentencia->bindParam('visible', $visible);
                        $sentencia->bindParam('id_usuario', $usuario);
                        $sentencia->bindParam('fyh_creacion', $fechaHora);
                        $sentencia->execute();



                        $msg = true;
                    } else {

                    }





                } else {
                    $count = "1";
                }

            }




            if (isset($msg)) {
                session_start();
                $_SESSION['mensaje'] = "Se cargaron $contador filas de ingresos de la manera correcta";
                $_SESSION['icono'] = "success";
                #header('Location: ' . $URL . '/categorias/');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/conciliacion_bancaria";
                </script>
                <?php
            } else {
                #echo "Error las contraseñas no son iguales";
                session_start();
                $_SESSION['mensaje'] = "No se registro ningun dato por duplicado en el sistema";
                $_SESSION['icono'] = "error";
                #header('Location: ' . $URL . '/categorias');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/conciliacion_bancaria";
                </script>
                <?php
            }

        }





    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al subir el archivo, solo se permitern archivos en formato Excel (XLSX, XLS)";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/conciliacion_bancaria');
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al subir el archivo";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/conciliacion_bancaria');
}








