<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../librerias/PHP_MAILER/Exception.php';
require '../../librerias/PHP_MAILER/PHPMailer.php';
require '../../librerias/PHP_MAILER/SMTP.php';

include ('../../config.php');
$saldo = 0;

$id_detalle_devolucion = $_POST['id_detalle_devolucion'];
$id_usuario = $_POST['id_usuario'];
$nliquidacion = mb_strtoupper($_POST['nliquidacion']);
$banco = $_POST['banco'];
$ncuentabanco = $_POST['ncuentabanco'];
$importevoucher = $_POST['importevoucher'];
$fechavoucher = $_POST['fechavoucher'];
$id_concepto = $_POST['id_concepto'];
$id_anio_concepto = $_POST['id_anio_concepto'];
$id_ciclo_concepto = $_POST['id_ciclo_concepto'];
$clasificador = $_POST['clasificador'];
$siafdevolucion = $_POST['siafdevolucion'];
$id_anio_siaf_devolucion = $_POST['id_anio_siaf_devolucion'];
$siaforigen = $_POST['siaforigen'];
$id_anio_siaf_origen = $_POST['id_anio_siaf_origen'];
$observacion_giro = mb_strtoupper($_POST['observacion_giro']);
$id_tipo_documento = $_POST['id_tipo_documento'];
$nro_dni = $_POST['nro_dni'];
$nsolicitante = mb_strtoupper($_POST['nsolicitante']);
$nro_dni_apoderado = $_POST['nro_dni_apoderado'];
$npostulante = mb_strtoupper($_POST['npostulante']);
$razon_social = $_POST['razon_social'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$devolucionunfv = $_POST['devolucionunfv'];
$devolucionbn = $_POST['devolucionbn'];
$id_nrocuenta = $_POST['id_nrocuenta'];
$id_estado_giro = $_POST['id_estado_giro'];

if ($_POST['doc_pago'] == "") {
    $_POST['doc_pago'] = 1;
}

if ($_POST['id_anio_envio'] == "") {
    $_POST['id_anio_envio'] = 1;
}

if ($_POST['id_condicion'] == "") {
    $_POST['id_condicion'] = 1;
}

if ($_POST['id_condicion2'] == "") {
    $_POST['id_condicion2'] = 1;
}


$doc_pago = $_POST['doc_pago'];
$nro_cheque = $_POST['nro_cheque'];
$fecha_cheque = $_POST['fecha_cheque'];
$nro_ope = $_POST['nro_ope'];
$fecha_ope = $_POST['fecha_ope'];
$nro_cci = $_POST['nro_cci'];
$fecha_cci = $_POST['fecha_cci'];
$nro_cart_ord = $_POST['nro_cart_ord'];
$fecha_cart_ord = $_POST['fecha_cart_ord'];
$nro_envio = $_POST['nro_envio'];
$id_anio_envio = $_POST['id_anio_envio'];
$nro_comp_int = $_POST['nro_comp_int'];
$nro_comp_ext = $_POST['nro_comp_ext'];
$fecha_entrega = $_POST['fecha_entrega'];
$id_condicion = $_POST['id_condicion'];
$fecha_pago = $_POST['fecha_pago'];
$id_condicion2 = $_POST['id_condicion2'];
$observacion = mb_strtoupper($_POST['observacion']);


$saldo = floatval($_POST['importevoucher']) - floatval($_POST['devolucionunfv']);
$saldo = number_format($saldo, 2, '.', ''); //convertir int a decimal

if($importevoucher==null){
    $importevoucher=0;
}

if($devolucionunfv==null){
    $devolucionunfv=0;
}

if($devolucionbn==null){
    $devolucionbn=0;
}


if ($devolucionbn == 0) {
    $diferencia = 0;
} else {

    $diferencia = floatval($_POST['devolucionunfv']) - floatval($_POST['devolucionbn']);
    $diferencia = number_format($diferencia, 2, '.', ''); //convertir int a decimal
}




if ($saldo >= 0) {

    $sentencia = $pdo->prepare("UPDATE tb_detalle_devolucion
    SET 
    id_tipo_documento=:id_tipo_documento,
    dni=:dni,
    nombre_solicitante=:nombre_solicitante,
    dni_apoderado=:dni_apoderado,
    nombre_apoderado=:nombre_apoderado,
    telefono=:telefono,
    correo=:correo,
    id_empresa=:id_empresa,
    nro_liquidacion=:nro_liquidacion,
    id_banco=:id_banco,
    nro_cuenta_banco=:nro_cuenta_banco,
    importe_voucher=:importe_voucher,
    fecha_voucher=:fecha_voucher,
    id_concepto=:id_concepto,
    id_ciclo_concepto=:id_ciclo_concepto,
    id_anio_concepto=:id_anio_concepto,
    clasificador=:clasificador,
    siaf_devolucion=:siaf_devolucion,
    id_anio_siaf_devolucion=:id_anio_siaf_devolucion,
    siaf_origen=:siaf_origen,
    id_anio_siaf_origen=:id_anio_siaf_origen,
    observacion_giro=:observacion_giro,
    importe_devolucion_unfv=:importe_devolucion_unfv,
    importe_devolucion_bn=:importe_devolucion_bn,
    saldo=:saldo,
    diferencia=:diferencia,
    id_usuario=:id_usuario,
    id_nrocuenta=:id_nrocuenta,
    id_estado_giro=:id_estado_giro,
    id_doc_pagos=:id_doc_pagos,
    numero_cheque=:numero_cheque,
    fecha_cheque=:fecha_cheque,
    numero_ope=:numero_ope,
    fecha_ope=:fecha_ope,
    numero_cci=:numero_cci,
    fecha_cci=:fecha_cci,
    numero_cartaorden=:numero_cartaorden,
    fecha_cartaorden=:fecha_cartaorden,
    nci=:nci,
    nce=:nce,
    fecha_entrega=:fecha_entrega,
    id_condicion=:id_condicion,
    fecha_pago=:fecha_pago,
    id_condicion2=:id_condicion2,
    nro_envio=:nro_envio,
    id_anio_envio=:id_anio_envio,
    observacion=:observacion,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_detalle_devolucion = :id_detalle_devolucion");

    $sentencia->bindParam('id_tipo_documento', $id_tipo_documento);
    $sentencia->bindParam('dni', $nro_dni);
    $sentencia->bindParam('nombre_solicitante', $nsolicitante);
    $sentencia->bindParam('dni_apoderado', $nro_dni_apoderado);
    $sentencia->bindParam('nombre_apoderado', $npostulante);
    $sentencia->bindParam('telefono', $telefono);
    $sentencia->bindParam('correo', $correo);
    $sentencia->bindParam('id_empresa', $razon_social);
    $sentencia->bindParam('nro_liquidacion', $nliquidacion);
    $sentencia->bindParam('id_banco', $banco);
    $sentencia->bindParam('nro_cuenta_banco', $ncuentabanco);
    $sentencia->bindParam('importe_voucher', $importevoucher);
    $sentencia->bindParam('fecha_voucher', $fechavoucher);
    $sentencia->bindParam('id_concepto', $id_concepto);
    $sentencia->bindParam('id_ciclo_concepto', $id_ciclo_concepto);
    $sentencia->bindParam('id_anio_concepto', $id_anio_concepto);
    $sentencia->bindParam('clasificador', $clasificador);
    $sentencia->bindParam('siaf_devolucion', $siafdevolucion);
    $sentencia->bindParam('id_anio_siaf_devolucion', $id_anio_siaf_devolucion);
    $sentencia->bindParam('siaf_origen', $siaforigen);
    $sentencia->bindParam('id_anio_siaf_origen', $id_anio_siaf_origen);
    $sentencia->bindParam('observacion_giro', $observacion_giro);
    $sentencia->bindParam('importe_devolucion_unfv', $devolucionunfv);
    $sentencia->bindParam('importe_devolucion_bn', $devolucionbn);
    $sentencia->bindParam('saldo', $saldo);
    $sentencia->bindParam('diferencia', $diferencia);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('id_nrocuenta', $id_nrocuenta);
    $sentencia->bindParam('id_estado_giro', $id_estado_giro);
    $sentencia->bindParam('id_doc_pagos', $doc_pago);
    $sentencia->bindParam('numero_cheque', $nro_cheque);
    $sentencia->bindParam('fecha_cheque', $fecha_cheque);
    $sentencia->bindParam('numero_ope', $nro_ope);
    $sentencia->bindParam('fecha_ope', $fecha_ope);
    $sentencia->bindParam('numero_cci', $nro_cci);
    $sentencia->bindParam('fecha_cci', $fecha_cci);
    $sentencia->bindParam('numero_cartaorden', $nro_cart_ord);
    $sentencia->bindParam('fecha_cartaorden', $fecha_cart_ord);
    $sentencia->bindParam('nci', $nro_comp_int);
    $sentencia->bindParam('nce', $nro_comp_ext);
    $sentencia->bindParam('fecha_entrega', $fecha_entrega);
    $sentencia->bindParam('id_condicion', $id_condicion);
    $sentencia->bindParam('fecha_pago', $fecha_pago);
    $sentencia->bindParam('id_condicion2', $id_condicion2);
    $sentencia->bindParam('nro_envio', $nro_envio);
    $sentencia->bindParam('id_anio_envio', $id_anio_envio);
    $sentencia->bindParam('observacion', $observacion);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_detalle_devolucion', $id_detalle_devolucion);
    $sentencia->execute();

    

    /*ENVIAR CORREO AUTOMATIZADO*/
    /*
    if (isset($correo) && $id_estado_giro == 2 && $doc_pago == 2 && isset($nro_cheque) && isset($fecha_cheque) && empty($fecha_entrega) && $id_condicion == 4) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.office365.com';                     //Set the SMTP server to send through
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'ot@unfv.edu.pe';                     //SMTP username
            $mail->Password = 'Ale351024';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            //Recipients
            $mail->setFrom('ot@unfv.edu.pe', 'Oficina de Tesorería');
            $mail->addAddress($correo);     //Add a recipient

            //Content
            //Set email format to HTML
            $mail->Subject = 'DEVOLUCION DE DINERO';
            $mail->Body = '<html>
            <body>
            <p>Saludos ante todo <b>' . $nsolicitante . '</b>, acerquese a la Oficina de Tesoreria del Rectorado UNFV a recoger su cheque.<br> Por el numero de recibo ' . $nliquidacion . ' a devolver.</p>
            <br>
            <p>Atentamente,
            <br>
            <br>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/Escudo_UNFV.png" width="150" height="50" />
            <br>
            <b>Oficina de Tesorería</b><br><b>Calle Carlos Gonzales 285 Urb. Maranga - San Miguel</b></p>
            </body>
            </html>';

            $mail->send();
            echo 'Enviado correctamente';
        } catch (Exception $e) {
            echo "Error al enviar: {$mail->ErrorInfo}";
        }
    } else if (isset($correo) && $id_estado_giro == 2 && $doc_pago == 3 && isset($nro_ope) && isset($fecha_ope) && empty($fecha_pago) && $id_condicion2 == 1) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.office365.com';                     //Set the SMTP server to send through
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'ot@unfv.edu.pe';                     //SMTP username
            $mail->Password = 'Ale351024';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            //Recipients
            $mail->setFrom('ot@unfv.edu.pe', 'Oficina de Tesorería');
            $mail->addAddress($correo);     //Add a recipient

            //Content
            //Set email format to HTML
            $mail->Subject = 'DEVOLUCION DE DINERO';
            $mail->Body = '<html>
            <body>
            <p>Saludos ante todo <b>' . $nsolicitante . '</b>, acerquese a cualquier agencia del Banco de la Nación a cobrar su devolución, llevar su DNI.<br> Tiene 30 dias calendario. Por el numero de recibo ' . $nliquidacion . ' a devolver. Si ya cobro, omita este mensaje.</p>
            <br>
            <p>Atentamente,
            <br>
            <br>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/Escudo_UNFV.png" width="150" height="50" />
            <br>
            <b>Oficina de Tesorería</b><br><b>Calle Carlos Gonzales 285 Urb. Maranga - San Miguel</b></p>
            </body>
            </html>';

            $mail->send();
            echo 'Enviado correctamente';
        } catch (Exception $e) {
            echo "Error al enviar: {$mail->ErrorInfo}";
        }
    }

    */

    


    $respuesta = 0;
} else if ($saldo < 0) {
    $respuesta = 1;
}





if ($respuesta == 0) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el pago realizado de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_devolucion/');
} else if ($respuesta == 1) {
    session_start();
    $_SESSION['mensaje'] = "Error, el saldo es menor que cero";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_devolucion/update.php?id=' . $id_detalle_devolucion);
}








