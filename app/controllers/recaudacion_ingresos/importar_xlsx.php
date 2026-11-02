<?php
/**

 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$contador = 0;
$visible = 0;
$nro_documento= "20170934289";
$estado = "PAGADO";
$usuario = $_POST["id_usuario"];



// Comprobar si se ha cargado un archivo
if (isset($_FILES['dataRecaudacion'])) {
    extract($_POST);

    // Definir la carpeta de destino
    $carpeta_destino = "data/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["dataRecaudacion"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "xls" || $extension == "xlsx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["dataRecaudacion"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


            $inputFileNamePath = $carpeta_destino . $nombre_archivo;
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = "0"; //primera fila es a 0

            foreach ($data as $row) {

                //empieza a registrar recorriendo desde la segunda fila es a 1
                if ($count > 0) {


                


                    $dependencia = mb_strtoupper(trim($row['0']));

                    switch ($dependencia) {
                        case 'ADM. CENTRAL':
                            $dependencia = "ADMINISTRACION CENTRAL";
                            break;
                        case 'EDITORIAL UNIVERSITARIA':
                            $dependencia = "EDITORIAL UNIVERSITARIA";
                            break;
                        case 'FACULTAD ODONTOLOGIA':
                            $dependencia = "FACULTAD DE ODONTOLOGIA";
                            break;
                        case 'FACULTAD TECNOLOGIA MEDICA':
                            $dependencia = "FACULTAD DE TECNOLOGIA MEDICA";
                            break;
                    }

                    $detalle = mb_strtoupper(trim($row['1']));

                    $banco = mb_strtoupper(trim($row['2']));

                    switch ($banco) {
                        case 'EFECTIVO':
                            $banco = "EFECTIVO";
                            break;
                        case 'PICHINCHA':
                            $banco = "BANCO PICHINCHA";
                            break;
                        case 'SCOTIABANK':
                            $banco = "SCOTIABANK PERÚ";
                            break;
                    }

                    $fecha_recaudacion = $row['3'];

                    $theDate = new DateTime($fecha_recaudacion);
                    $fecha_recaudacion = $theDate->format('Y-m-d');



                    $nombre_encargado = mb_strtoupper(trim($row['4']));

                    $documento_recepcion = mb_strtoupper(trim($row['5']));

                    $monto_recaudado = trim($row['6']);
                    $monto_recaudado = str_replace(",", "", $monto_recaudado);

                    $banco_deposito = mb_strtoupper(trim($row['7']));

                    $cuenta_deposito = mb_strtoupper(trim($row['8']));

                    switch ($cuenta_deposito) {
                        case '257443':
                            $cuenta_deposito = "0000-257443";
                            break;
                        
                    }

                    $fecha_deposito = $row['9'];

                    $theDate = new DateTime($fecha_deposito);
                    $fecha_deposito = $theDate->format('Y-m-d');

                    $importe = trim($row['10']);
                    $importe = str_replace(",", "", $importe);

                    $nombre_depositante = mb_strtoupper(trim($row['11']));


                    $nro_dni = mb_strtoupper(trim($row['12']));
 
                    switch ($nro_dni) {
                        case '6281855':
                            $nro_dni = "06281855";
                            break;
                        
                    }


                    $codigo_operacion = mb_strtoupper(trim($row['13']));





                        $contador++;

                        // Insertar la información del archivo en la base de datos

                        //**************CARGAR A TABLA DE CONCILIACION BANCARIA****************



                        $sentencia = $pdo->prepare('INSERT INTO tb_recaudacion_ingresos(nombre_dependencia,detalle_concepto,nombre_banco,fecha_recaudacion,nombre_encargado,
                        documento_recepcion,monto_recaudado,nombre_banco2,numero_cuenta2,fecha_deposito,numero_documento,importe,nombre_depositante,dni,numero_operacion,
                        estado,visible,id_usuario,fyh_creacion) VALUES (:nombre_dependencia,:detalle_concepto,:nombre_banco,:fecha_recaudacion,:nombre_encargado,
                        :documento_recepcion,:monto_recaudado,:nombre_banco2,:numero_cuenta2,:fecha_deposito,:numero_documento,:importe,:nombre_depositante,:dni,:numero_operacion,
                        :estado,:visible,:id_usuario,:fyh_creacion)');

                        $sentencia->bindParam('nombre_dependencia', $dependencia);
                        $sentencia->bindParam('detalle_concepto', $detalle);
                        $sentencia->bindParam('nombre_banco', $banco);
                        $sentencia->bindParam('fecha_recaudacion', $fecha_recaudacion);
                        $sentencia->bindParam('nombre_encargado', $nombre_encargado);
                        $sentencia->bindParam('documento_recepcion', $documento_recepcion);
                        $sentencia->bindParam('monto_recaudado', $monto_recaudado);
                        $sentencia->bindParam('nombre_banco2', $banco_deposito);
                        $sentencia->bindParam('numero_cuenta2', $cuenta_deposito);
                        $sentencia->bindParam('fecha_deposito', $fecha_deposito);
                        $sentencia->bindParam('numero_documento', $nro_documento);
                        $sentencia->bindParam('importe', $importe);
                        $sentencia->bindParam('nombre_depositante', $nombre_depositante);
                        $sentencia->bindParam('dni', $nro_dni);
                        $sentencia->bindParam('numero_operacion', $codigo_operacion);
                        $sentencia->bindParam('estado', $estado);
                        $sentencia->bindParam('visible', $visible);
                        $sentencia->bindParam('id_usuario', $usuario);
                        $sentencia->bindParam('fyh_creacion', $fechaHora);
                        $sentencia->execute();



                        $msg = true;





                } else {
                    $count = "1";
                }

            }




            if (isset($msg)) {
                session_start();
                $_SESSION['mensaje'] = "Se cargaron $contador filas de recaudacion de la manera correcta";
                $_SESSION['icono'] = "success";
                #header('Location: ' . $URL . '/categorias/');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/recaudacion_ingresos";
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
                    location.href = "<?php echo $URL; ?>/recaudacion_ingresos";
                </script>
                <?php
            }

        }





    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al subir el archivo, solo se permitern archivos en formato Excel (XLSX, XLS)";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/recaudacion_ingresos');
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al subir el archivo";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/recaudacion_ingresos');
}








