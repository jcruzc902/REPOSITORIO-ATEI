<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */
include ('../../config.php');

$contador = 0;
$saldo = 0;
$sql_detalle_devolucion = "SELECT * FROM tb_detalle_devolucion where visible!=1";
$query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
$query_detalle_devolucion->execute();
$detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);

foreach ($_POST['id_tipo_documento'] as $key => $value) {

    /*DETECTA SI EXISTE DUPLICADO EN EL VALOR DE NUMERO DE LIQUIDACION EN LA BASE DE DATOS*/
    foreach ($detalle_devolucion_datos as $detalle_devolucion_dato) {
        if ($detalle_devolucion_dato["nro_liquidacion"] == $_POST['nliquidacion'][$key]) {
            $numero_liquidacion = $_POST['nliquidacion'][$key];
            $contador = 1;
        }
    }

    $saldo = floatval($_POST['importevoucher'][$key]) - floatval($_POST['devolucionunfv'][$key]);
    $saldo = number_format($saldo, 2, '.', ''); //convertir int a decimal

    /*SI NO HAY DUPLICADOS EMPIEZA A EGISTRAR LOS DATOS MULTIPLES, CASO CONTRARIO EMITE UNA ALERTA DE ERROR*/
    if ($contador != 1 && $saldo >= 0) {





        $stmt = $pdo->prepare('INSERT INTO tb_detalle_devolucion (id_tipo_documento,dni,nombre_solicitante,dni_apoderado,nombre_apoderado,telefono,correo,id_empresa,
    nro_liquidacion,id_banco,nro_cuenta_banco,importe_voucher,fecha_voucher,id_concepto,id_ciclo_concepto,id_anio_concepto,clasificador,siaf_devolucion,id_anio_siaf_devolucion,
    siaf_origen,id_anio_siaf_origen,observacion_giro,importe_devolucion_unfv,importe_devolucion_bn,saldo,diferencia,id_nrocuenta,nt,id_anio_nt,id_usuario,id_estado_giro,
    id_doc_pagos,numero_cheque,fecha_cheque,numero_ope,fecha_ope,numero_cci,fecha_cci,numero_cartaorden,fecha_cartaorden,nci,nce,fecha_entrega,
    id_condicion,fecha_pago,id_condicion2,nro_envio,id_anio_envio,observacion,fyh_creacion) 
    VALUES (:id_tipo_documento,:dni,:nombre_solicitante,:dni_apoderado,:nombre_apoderado,:telefono,:correo,:id_empresa,:nro_liquidacion,
    :id_banco,:nro_cuenta_banco,:importe_voucher,:fecha_voucher,:id_concepto,:id_ciclo_concepto,:id_anio_concepto,:clasificador,:siaf_devolucion,:id_anio_siaf_devolucion,
    :siaf_origen,:id_anio_siaf_origen,:observacion_giro,:importe_devolucion_unfv,:importe_devolucion_bn,:saldo,:diferencia,:id_nrocuenta,:nt,:id_anio_nt,:id_usuario,:id_estado_giro,
    :id_doc_pagos,:numero_cheque,:fecha_cheque,:numero_ope,:fecha_ope,:numero_cci,:fecha_cci,:numero_cartaorden,:fecha_cartaorden,:nci,:nce,:fecha_entrega,
    :id_condicion,:fecha_pago,:id_condicion2,:nro_envio,:id_anio_envio,:observacion,:fyh_creacion)');

        $stmt->execute([
            'id_tipo_documento' => $value,
            'dni' => $_POST['nro_dni'][$key],
            'nombre_solicitante' => mb_strtoupper($_POST['nsolicitante'][$key]),
            'dni_apoderado' => $_POST['nro_dni_apoderado'][$key],
            'nombre_apoderado' => mb_strtoupper($_POST['npostulante'][$key]),
            'telefono' => $_POST['telefono'][$key],
            'correo' => mb_strtolower($_POST['correo'][$key]),
            'id_empresa' => $_POST['razon_social'][$key],
            'nro_liquidacion' => mb_strtoupper($_POST['nliquidacion'][$key]),
            'id_banco' => $_POST['banco'][$key],
            'nro_cuenta_banco' => $_POST['ncuentabanco'][$key],
            'importe_voucher' => $_POST['importevoucher'][$key],
            'fecha_voucher' => $_POST['fechavoucher'][$key],
            'id_concepto' => $_POST['id_concepto'][$key],
            'id_ciclo_concepto' => $_POST['id_ciclo_concepto'][$key],
            'id_anio_concepto' => $_POST['id_anio_concepto'][$key],
            'clasificador' => $_POST['clasificador'][$key],
            'siaf_devolucion' => $_POST['siafdevolucion'][$key],
            'id_anio_siaf_devolucion' => $_POST['id_anio_siaf_devolucion'][$key],
            'siaf_origen' => $_POST['siaforigen'][$key],
            'id_anio_siaf_origen' => $_POST['id_anio_siaf_origen'][$key],
            'observacion_giro' => $_POST['observacion_giro'][$key],
            'importe_devolucion_unfv' => $_POST['devolucionunfv'][$key],
            'importe_devolucion_bn' => 0,
            'saldo' => $saldo,
            'diferencia' => 0,
            'id_usuario' => $_POST['id_usuario'][$key],
            'id_nrocuenta' => $_POST['id_nrocuenta'][$key],
            'nt' => $_POST['nt'][$key],
            'id_anio_nt' => $_POST['id_anio_nt'][$key],
            'id_estado_giro' => $_POST['id_estado_giro'][$key],
            'id_doc_pagos' => 1,
            'numero_cheque' => "",
            'fecha_cheque' => '0000-00-00',
            'numero_ope' => "",
            'fecha_ope' => '0000-00-00',
            'numero_cci' => "",
            'fecha_cci' => '0000-00-00',
            'numero_cartaorden' => "",
            'fecha_cartaorden' => '0000-00-00',
            'nci' => "",
            'nce' => "",
            'fecha_entrega' => '0000-00-00',
            'id_condicion' => 4,
            'fecha_pago' => '0000-00-00',
            'id_condicion2' => 1,
            'nro_envio' => "",
            'id_anio_envio' => 1,
            'observacion' => "",
            'fyh_creacion' => $fechaHora
        ]);

        $respuesta = 0;
    } else if ($contador == 1) {
        $respuesta = 1;
    } else if ($saldo < 0) {
        $respuesta = 2;
    }
}

if ($respuesta == 0) {
    session_start();
    $_SESSION['mensaje'] = "Se registro el pago realizado de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_devolucion/index.php');
} else if ($respuesta == 1) {
    session_start();
    $_SESSION['mensaje'] = "Este numero de recibo " . $numero_liquidacion . " a sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_devolucion/create.php');
} else if ($respuesta == 2) {
    session_start();
    $_SESSION['mensaje'] = "Error, el saldo es menor que cero";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_devolucion/create.php');
}







